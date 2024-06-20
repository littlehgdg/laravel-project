<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function show()
    {
        $doctors = Doctor::all();
        return view('doctor_show', compact('doctors'));
    }

    public function create()
    {
        return view('doctor_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'speciality' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:doctors',
            'address' => 'required|string|max:255',
        ]);

        Doctor::create($request->all());

        return redirect()->route('doctor_show')->with('success', 'Doctor created successfully.');
    }

    public function edit($id)
    {
        $doctor = Doctor::find($id);
        return view('doctor_update', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        
        $doctor = Doctor::findOrFail($id);
        $doctor->name = $request->input('name');
        $doctor->speciality = $request->input('speciality');
        $doctor->address = $request->input('address');
        $doctor->phone_number = $request->input('phone_number');
        $doctor->email = $request->input('email');
        $doctor->save();

        return redirect()->route('doctor_show')->with('success', 'Doctor updated successfully');
    }

    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        $doctor->delete();
        return redirect()->route('doctor_show')->with('msg', 'Doctor deleted successfully.');
    }
}
