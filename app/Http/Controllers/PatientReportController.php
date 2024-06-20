<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query();

        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        if ($request->filled('age_group')) {
            $ageGroup = $request->input('age_group');
            if ($ageGroup == 'children') {
                $query->where('age', '<=', 12);
            } elseif ($ageGroup == 'adult') {
                $query->whereBetween('age', [13, 59]);
            } elseif ($ageGroup == 'senior') {
                $query->where('age', '>=', 60);
            }
        }

        $patients = $query->get();

        return view('patient_report', compact('patients'));
    }

    public function showHistory($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return redirect()->route('patient_report')->with('error', 'Patient not found');
        }

        return view('patient_history', compact('patient'));
    }
}
