<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientVisit;
use Illuminate\Http\Request;

class PatientVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visits = PatientVisit::with('patient')
            ->latest('visited_at')
            ->paginate(15);
        
        return view('visits.index', [
            'visits' => $visits
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::orderBy('nama')->get(['id', 'nama']);
        
        return view('visits.create', [
            'patients' => $patients
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'visited_at' => 'nullable|date',
        ]);

        $visit = PatientVisit::create([
            'patient_id' => $request->patient_id,
            'visited_at' => $request->visited_at ?? now(),
        ]);

        return redirect()->route('visits.index')
            ->with('success', 'Kunjungan pasien berhasil dicatat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PatientVisit $visit)
    {
        $visit->load('patient');
        
        return view('visits.show', [
            'visit' => $visit
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PatientVisit $visit)
    {
        $visit->delete();

        return redirect()->route('visits.index')
            ->with('success', 'Data kunjungan berhasil dihapus.');
    }
}