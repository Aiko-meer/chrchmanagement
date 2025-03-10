<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volunteer;

class VolunteerController extends Controller
{
    public function index()
    {
        $volunteers = Volunteer::where('archive', 0)->get();
        return view('members.volunteer', compact('volunteers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required|date',
            'civil_status' => 'required',
            'age' => 'required|integer',
            'gender' => 'required',
            'email' => 'required|email',
            'contact_number' => 'required',
            'purok_no' => 'required',
            'street_address' => 'required',
            'barangay' => 'required',
            'municipality' => 'required',
            'province' => 'required',
            'picture' => 'nullable|image|max:2048',
        ]);

        // Handle picture upload
        $picturePath = null;
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('pictures', 'public');
        }

        // Create new volunteer
        Volunteer::create([
            'status' => $request->status,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'civil_status' => $request->civil_status,
            'age' => $request->age,
            'gender' => $request->gender,
            'position' => $request->position,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'purok_no' => $request->purok_no,
            'street_address' => $request->street_address,
            'barangay' => $request->barangay,
            'municipality' => $request->municipality,
            'province' => $request->province,
            'picture' => $picturePath,
        ]);

        return redirect()->back()->with('success', 'Volunteer registered successfully');
    }

    public function update(Request $request, $id)
    {
        \Log::info($request->all());

        try {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'dob' => 'nullable|date',
                'civil_status' => 'required|string',
                'email' => 'nullable|email',
                'contact_number' => 'nullable|string',
                'position' => 'nullable|string|max:255',
                'status' => 'required|string',
                'purok_no' => 'nullable|string|max:255',
                'street_address' => 'nullable|string|max:255',
                'barangay' => 'nullable|string|max:255',
                'municipality' => 'nullable|string|max:255',
                'province' => 'nullable|string|max:255',
                'image' => 'nullable|image|max:2048',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error("Validation failed: ", $e->validator->errors()->toArray());
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        $volunteer = Volunteer::findOrFail($id);

        \Log::info("Volunteer before update: ", $volunteer->toArray());

        $volunteer->first_name = $request->first_name;
        $volunteer->middle_name = $request->middle_name;
        $volunteer->last_name = $request->last_name;
        $volunteer->dob = $request->dob;
        $volunteer->civil_status = $request->civil_status;
        $volunteer->email = $request->email;
        $volunteer->contact_number = $request->contact_number;
        $volunteer->position = $request->position;
        $volunteer->status = $request->status;
        $volunteer->purok_no = $request->purok_no;
        $volunteer->street_address = $request->street_address;
        $volunteer->barangay = $request->barangay;
        $volunteer->municipality = $request->municipality;
        $volunteer->province = $request->province;

        // Handle the image upload if a new one is provided
        if ($request->hasFile('image')) {
            // Delete the old image if needed
            if ($volunteer->image) {
                Storage::delete('public/pictures/' . $volunteer->image);
            }
            // Store the new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('pictures', $imageName, 'public');
            $volunteer->image = $imageName;
        }

        $volunteer->save();

        \Log::info("Volunteer after update: ", $volunteer->toArray());

        return redirect()->route('volunteers.index')->with('success', 'Volunteer updated successfully.');
    }
    public function archive($id)
{
    $volunteer = Volunteer::findOrFail($id);
    $volunteer->archive = 1;
    $volunteer->save();

    return redirect()->back()->with('success', 'Volunteer archived successfully.');
}
}
