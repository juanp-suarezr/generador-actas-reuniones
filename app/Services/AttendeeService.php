<?php

namespace App\Services;

use App\Models\Acta;
use App\Models\Attendee;
use Illuminate\Support\Facades\DB;

class AttendeeService
{
    public function registerForActa(string $token, array $data)
    {
        $acta = Acta::where('share_token', $token)->firstOrFail();

        // Check if already registered
        $existing = $acta->attendees()->where('cedula', $data['cedula'])->first();
        if ($existing) {
            throw new \Exception('Ya estás registrado en esta acta.');
        }

        return DB::transaction(function () use ($acta, $data) {
            return $acta->attendees()->create($data);
        });
    }

    public function updateAttendee(Attendee $attendee, array $data)
    {
        return DB::transaction(function () use ($attendee, $data) {
            $attendee->update($data);
            return $attendee;
        });
    }

    public function uploadSignature(Attendee $attendee, $file)
    {
        $path = $file->store('signatures', 'public');
        $attendee->update(['firma_path' => $path]);
        return $attendee;
    }
}