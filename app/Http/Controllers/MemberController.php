<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Ministry;

class MemberController extends Controller
{
     
    public function index()
    {
        $members = Member::where('archive', 0)->get();
        $ministries = Ministry::all(); // Fetches all records
        return view('members.member', compact('members','ministries'));
    }
    public function header()
    {
       
        $ministries = Ministry::all(); // Fetches all records
        return view('layout.header', compact('ministries'));
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
    
        // Create new member
        Member::create([
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
    
        return redirect()->back()->with('success', 'Member registered successfully');
    }

    public function ministry(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
        ]);
    
        // Create a new ministry and store it in a variable
        $ministry = Ministry::create([
            'ministry' => $request->first_name,
        ]);
    
        // Redirect using the ministry name instead of ID
        return redirect()->back()->with('success', 'Member registered successfully');



    }
    
    public function delete(Request $request)
    {
       
        $validated = $request->validate([
            'first_name' => 'required',
        ]);

        
    
        // Find the ministry by first_name instead of ID
        $ministry = Ministry::where('ministry', $request->first_name)->firstOrFail();

        // Delete the record
        $ministry->delete();

        $members = Member::where('archive', 0)->get();
        $ministries = Ministry::all(); // Fetches all records
                // Redirect using the ministry name instead of ID
        return view('members.member', compact('members','ministries'));



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
            'image' => 'nullable|image|max:2048', // Adjust as needed
        ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error("Validation failed: ", $e->validator->errors()->toArray());
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    
        $member = Member::findOrFail($id);
    
        \Log::info("Member before update: ", $member->toArray());
    
        $member->first_name = $request->first_name;
        $member->middle_name = $request->middle_name;
        $member->last_name = $request->last_name;
        $member->dob = $request->dob;
        $member->civil_status = $request->civil_status;
        $member->email = $request->email;
        $member->contact_number = $request->contact_number;
        $member->position = $request->position;
        $member->status = $request->status; // Ensure this is being set correctly
        $member->purok_no = $request->purok_no;
        $member->street_address = $request->street_address;
        $member->barangay = $request->barangay;
        $member->municipality = $request->municipality;
        $member->province = $request->province;
    
        // Handle the image upload if a new one is provided
        if ($request->hasFile('image')) {
            // Delete the old image if needed
            if ($member->image) {
                Storage::delete('public/pictures/' . $member->image);
            }
            // Store the new image
            $imageName = time() . '.' . $request->image->extension();
            $member->picture =  $request->image->storeAs('pictures', $imageName, 'public');
        }
    
        $member->save();
    
        \Log::info("Member after update: ", $member->toArray());
    
        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }
    public function archive($id)
    {
        $member = Member::findOrFail($id);
        $member->archive = 1;
        $member->save();
    
        return redirect()->back()->with('success', 'Member archived successfully.');
    }

    public function retrieve($id)
    {
        $member = Member::findOrFail($id);
        $member->archive = 0;
        $member->save();
    
        return redirect()->back()->with('success', 'Member archived successfully.');
    }

}
