<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funeral_folder;
use App\Models\FuneralRecord;

class FuneralRecordController extends Controller
{
    public function showByFuneral($funerals_id)
    {
        // Fetch records from 'bookrecord' table where baptism_id matches
        $funeralRecords = FuneralRecord::where('funeral_id', $funerals_id)
        ->where('archive', 0)
        ->get();
        

        $FuneraFolder = Funeral_folder::where('id', $funerals_id)->firstOrFail();

        $funeralYear = $FuneraFolder->year;
        $funeralID = $FuneraFolder->id;
   
        return view('record/funeral_record', compact('funeralRecords', 'funerals_id','FuneraFolder', 'funeralYear', 'funeralID'));
    }

    public function showByFuneralArchived($funerals_id)
    {
        // Fetch records from 'bookrecord' table where baptism_id matches
        $funeralRecords = FuneralRecord::where('funeral_id', $funerals_id)
        ->where('archive', 1)
        ->get();
        

        $FuneraFolder = Funeral_folder::where('id', $funerals_id)->firstOrFail();

        $funeralYear = $FuneraFolder->year;
        $funeralID = $FuneraFolder->id;
   
        return view('record/funeral_record', compact('funeralRecords', 'funerals_id','FuneraFolder', 'funeralYear', 'funeralID'));
    }

    public function store(Request $request)
    {
        // Validate form inputs
        $request->validate([
            'funeral_id' => 'required|string|max:255',
            'funeral_date' => 'required|date',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'dod' => 'required|date',
            'contact' => 'nullable|string|max:20',
        ]);

        
        $funeralYear = $request->funeralYear;
        $funeralID = $request->funeral_id;

        
        $latestRecord = FuneralRecord::where('funeral_id', $funeralID)
            ->orderBy('id', 'desc')
            ->first();

       
        $nextNumber = 1;

        if ($latestRecord) {
           
            $lastRecordCode = $latestRecord->record_code;
            $lastNumber = (int)substr($lastRecordCode, -3);
            $nextNumber = $lastNumber + 1; 
        }


        $newRecordCode = 'F' . $funeralYear . ' - ' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Save the funeral record to the database
        FuneralRecord::create([
            'funeral_id' => $request->funeral_id,
            'record_code' => $newRecordCode,
            'funeral_date' => $request->funeral_date,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'dod' => $request->dod,
            'contact' => $request->contact,
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Funeral record created successfully!');
    }
    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'record_code' => 'required|string|max:255',
            'funeral_date' => 'required|date',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'dod' => 'required|date',
            'contact' => 'nullable|string|max:20',
        ]);

        // Find the funeral record by ID and update it
        $funeralRecord = FuneralRecord::findOrFail($request->funeral_id);
        $funeralRecord->update([
            'record_code' => $request->record_code,
            'funeral_date' => $request->funeral_date,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'dod' => $request->dod,
            'contact' => $request->contact,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Funeral record updated successfully.');
    }
    public function showFuneralInfo($id)
    {
        $funeralRecord = FuneralRecord::findOrFail($id);
        return view('record/funeral_info', compact('funeralRecord'));
    }

    public function archive($id)
    {
        // Find the funeral record by ID
        $funeralRecord = FuneralRecord::findOrFail($id);

        // Update the archive status
        $funeralRecord->archive = 1; // Set to 1 to mark as archived
        $funeralRecord->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Funeral record archived successfully.');
    }

    public function retrieve($id)
{
    $record = FuneralRecord::findOrFail($id); // Replace `BookRecord` with your actual model
    $record->archive = 0; // Set archive field to 0
    $record->save();

    return redirect()->back()->with('success', 'Record successfully retrieved.');
}
}
