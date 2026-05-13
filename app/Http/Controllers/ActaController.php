<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActaRequest;
use App\Http\Requests\UpdateActaRequest;
use App\Models\Acta;
use App\Services\ActaService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ActaController extends Controller
{
    protected ActaService $actaService;

    public function __construct(ActaService $actaService)
    {
        $this->actaService = $actaService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $filters = $request->only(['fecha', 'tipo', 'search']);
        $actas = $this->actaService->getActasPaginated($filters);

        return Inertia::render('Actas/Index', [
            'actas' => $actas,
            'filters' => $filters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Actas/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActaRequest $request): RedirectResponse
    {
        $acta = $this->actaService->create($request->validated(), auth()->id());

        return redirect()->route('actas.show', $acta)->with('success', 'Acta creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Acta $acta): Response
    {
        $this->authorize('view', $acta);

        return Inertia::render('Actas/Show', [
            'acta' => $acta->load('attendees', 'user', 'editLogs'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Acta $acta): Response
    {
        $this->authorize('update', $acta);

        return Inertia::render('Actas/Edit', [
            'acta' => $acta,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActaRequest $request, Acta $acta): RedirectResponse
    {
        $this->actaService->update($acta, $request->validated());

        return redirect()->route('actas.show', $acta)->with('success', 'Acta actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Acta $acta): RedirectResponse
    {
        $this->authorize('delete', $acta);

        $acta->delete();

        return redirect()->route('actas.index')->with('success', 'Acta eliminada exitosamente.');
    }

    public function share(Acta $acta): RedirectResponse
    {
        $this->authorize('share', $acta);

        $this->actaService->share($acta);

        return redirect()->back()->with('success', 'Enlace de compartir generado.');
    }

    public function downloadPdf(Acta $acta)
    {
        $this->authorize('downloadPdf', $acta);

        return $this->actaService->generatePdf($acta);
    }
}
