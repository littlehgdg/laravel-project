<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ward;
use App\Models\Doctor;
use App\Models\Patient;

class WardController extends Controller
{
    public function index()
    {
        $ward_arr = Ward::with('doctor', 'patient')->get();
        return view('ward_show', compact('ward_arr'));
    }

    public function create()
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('ward_create', compact('doctors', 'patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bangsal' => 'required',
            'tipe_bed' => 'required',
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|unique:wards,patient_id|exists:patients,id',
        ]);

        Ward::create($request->all());
        return redirect('ward_show')->with('msg', 'Ward added successfully');
    }

    public function edit($id)
{
    $ward = Ward::find($id);
    $doctors = Doctor::all();
    $patients = Patient::all();
    return view('ward_update', compact('ward', 'doctors', 'patients'));
}

    public function update(Request $request, $id)
    {
        $ward = Ward::find($id);
        $request->validate([
            'nama_bangsal' => 'required',
            'tipe_bed' => 'required',
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|unique:wards,patient_id,' . $ward->id . '|exists:patients,id',
        ]);
        $ward->update($request->all());
        return redirect('ward_show')->with('msg', 'Ward updated successfully');
    }

    public function destroy($id)
    {
        $ward = Ward::find($id);
        $ward->delete();
        return redirect('ward_show')->with('msg', 'Ward deleted successfully');
    }
}
