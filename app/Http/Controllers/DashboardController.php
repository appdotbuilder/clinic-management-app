<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard based on user role.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $stats = [];

        if ($user->isAdmin()) {
            $stats = [
                'total_patients' => Patient::count(),
                'total_visits' => PatientVisit::count(),
                'total_doctors' => User::where('role', 'doctor')->count(),
                'total_receptionists' => User::where('role', 'receptionist')->count(),
                'visits_today' => PatientVisit::whereDate('visited_at', today())->count(),
                'recent_patients' => Patient::latest()->take(5)->get(),
                'recent_visits' => PatientVisit::with('patient')->latest('visited_at')->take(5)->get(),
            ];
        } elseif ($user->isDoctor()) {
            $stats = [
                'total_patients' => Patient::count(),
                'total_visits' => PatientVisit::count(),
                'visits_today' => PatientVisit::whereDate('visited_at', today())->count(),
                'visits_this_week' => PatientVisit::whereBetween('visited_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
                'recent_patients' => Patient::latest()->take(5)->get(),
                'recent_visits' => PatientVisit::with('patient')->latest('visited_at')->take(5)->get(),
            ];
        } else { // Receptionist
            $stats = [
                'total_patients' => Patient::count(),
                'visits_today' => PatientVisit::whereDate('visited_at', today())->count(),
                'patients_this_month' => Patient::whereMonth('created_at', now()->month)->count(),
                'recent_patients' => Patient::latest()->take(5)->get(),
                'recent_visits' => PatientVisit::with('patient')->latest('visited_at')->take(5)->get(),
            ];
        }

        return view('dashboard', [
            'stats' => $stats,
            'user_role' => $user->role,
        ]);
    }
}