<?php

namespace App\Services;

use App\Models\Acta;
use App\Models\ActaEditLog;
use App\Models\Attendee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class ActaService
{
    public function create(array $data, $userId)
    {
        return DB::transaction(function () use ($data, $userId) {
            $data['user_id'] = $userId;
            return Acta::create($data);
        });
    }

    public function update(Acta $acta, array $data)
    {
        return DB::transaction(function () use ($acta, $data) {
            $acta->update($data);
            return $acta;
        });
    }

    public function share(Acta $acta)
    {
        // Regenerate token if needed
        $acta->update([
            'share_token' => \Illuminate\Support\Str::random(32),
            'share_expires_at' => now()->addDays(30), // Example expiration
        ]);
        return $acta;
    }

    public function addAttendee(Acta $acta, array $data)
    {
        return DB::transaction(function () use ($acta, $data) {
            return $acta->attendees()->create($data);
        });
    }

    public function editField(Acta $acta, $userOrAttendee, string $field, string $newValue, string $ip = null)
    {
        if ($field === 'descripcion' && !$acta->canEditDescription($userOrAttendee)) {
            throw new \Exception('No se puede editar la descripción más de una vez.');
        }

        if ($field === 'compromisos' && !$acta->canEditCompromisos($userOrAttendee)) {
            throw new \Exception('No se puede editar los compromisos más de una vez.');
        }

        $oldValue = $acta->$field;

        DB::transaction(function () use ($acta, $userOrAttendee, $field, $oldValue, $newValue, $ip) {
            $acta->update([$field => $newValue]);

            ActaEditLog::create([
                'acta_id' => $acta->id,
                'user_id' => $userOrAttendee instanceof \App\Models\User ? $userOrAttendee->id : null,
                'attendee_id' => $userOrAttendee instanceof Attendee ? $userOrAttendee->id : null,
                'field' => $field,
                'old_value' => $oldValue,
                'new_value' => $newValue,
                'edited_at' => now(),
                'ip_address' => $ip,
            ]);

            Log::info("Acta {$acta->id} field {$field} edited by " . ($userOrAttendee instanceof \App\Models\User ? 'user ' . $userOrAttendee->id : 'attendee ' . $userOrAttendee->id));
        });

        return $acta;
    }

    public function generatePdf(Acta $acta)
    {
        $data = [
            'acta' => $acta->load('attendees', 'user'),
        ];

        $pdf = Pdf::loadView('pdf.acta', $data);
        return $pdf->download('acta-' . $acta->id . '.pdf');
    }

    public function getActasPaginated(array $filters = [], int $perPage = 15)
    {
        return Acta::with('user')
            ->filter($filters)
            ->orderBy('fecha', 'desc')
            ->paginate($perPage);
    }
}