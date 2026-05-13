<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendeeRequest;
use App\Models\Acta;
use App\Services\AttendeeService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class AttendeeController extends Controller
{
    protected AttendeeService $attendeeService;

    public function __construct(AttendeeService $attendeeService)
    {
        $this->attendeeService = $attendeeService;
    }

    public function create(string $token): Response
    {
        $acta = Acta::where('share_token', $token)->firstOrFail();

        return Inertia::render('Attendees/Create', [
            'acta' => $acta,
            'token' => $token,
        ]);
    }

    public function store(StoreAttendeeRequest $request, string $token): RedirectResponse
    {
        $attendee = $this->attendeeService->registerForActa($token, $request->validated());

        if ($request->hasFile('firma')) {
            $this->attendeeService->uploadSignature($attendee, $request->file('firma'));
        }

        return redirect()->route('actas.shared.show', ['token' => $token])->with('success', 'Registrado exitosamente.');
    }

    public function editShared(Acta $acta): Response
    {
        // For editing descripcion and compromisos
        return Inertia::render('Actas/SharedEdit', [
            'acta' => $acta->load('attendees'),
        ]);
    }

    public function updateShared(Request $request, Acta $acta): RedirectResponse
    {
        // Update descripcion or compromisos
        $field = $request->input('field');
        $value = $request->input('value');
        $userOrAttendee = auth()->user() ?? $acta->attendees()->where('cedula', $request->input('cedula'))->first();

        $this->actaService->editField($acta, $userOrAttendee, $field, $value, $request->ip());

        return redirect()->back()->with('success', ucfirst($field) . ' actualizado.');
    }
}
