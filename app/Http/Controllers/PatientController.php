<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patient_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'age' => 'required|integer',
            'gender' => 'required|string|max:10',
            'medical_history' => 'nullable|string',
            'email' => 'required|email|max:255|unique:patients,email',
            'address' => 'required|string|max:255',
        ]);

        $patient = new Patient;
        $patient->fname = $request->input('fname');
        $patient->lname = $request->input('lname');
        $patient->phone_number = $request->input('phone_number');
        $patient->age = $request->input('age');
        $patient->gender = $request->input('gender');
        $patient->medical_history = $request->input('medical_history');
        $patient->email = $request->input('email');
        $patient->address = $request->input('address');
        $patient->save();

        $request->session()->flash('success', 'Patient Data Submitted');
        return redirect()->route('patient_show');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $patients = Patient::all();
        return view('patient_show', compact('patients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::find($id);
        return view('patient_update', compact('patient'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'age' => 'required|integer',
            'gender' => 'required|string|max:10',
            'medical_history' => 'nullable|string',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
        ]);

        $patient = Patient::find($id);
        $patient->fname = $request->input('fname');
        $patient->lname = $request->input('lname');
        $patient->phone_number = $request->input('phone_number');
        $patient->age = $request->input('age');
        $patient->gender = $request->input('gender');
        $patient->medical_history = $request->input('medical_history');
        $patient->email = $request->input('email');
        $patient->address = $request->input('address');
        $patient->save();

        $request->session()->flash('success', 'Patient Data Updated');
        return redirect()->route('patient_show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);
        if ($patient) {
            $patient->delete();
            return redirect()->route('patient_show')->with('success', 'Patient Data Deleted');
        } else {
            return redirect()->route('patient_show')->with('success', 'Patient Data Not Found');
        }
    }

    public function showHistory($id)
    {
        $patient = Patient::find($id);
        if (!$patient) {
            return redirect()->route('patient_report')->with('success', 'Patient not found');
        }

        return view('patient_history', compact('patient'));
    }
}
