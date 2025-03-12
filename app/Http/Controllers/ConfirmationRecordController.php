<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConfirmationFolder;
use Illuminate\Support\Carbon;
use App\Models\ConfirmationRecord;
class ConfirmationRecordController extends Controller
{
    public function showByFuneral($confirmation_id)
    {
        // Fetch records from 'bookrecord' table where baptism_id matches
        $confirmatioRecords = ConfirmationRecord::where('confirmation_id', $confirmation_id)
        ->where('archive', 0)
        ->get();
        

        $ConfirmationFolder = ConfirmationFolder::where('id', $confirmation_id)->firstOrFail();

        $confirmationYear = $ConfirmationFolder->year;
        $confirmationID = $ConfirmationFolder->id;
   
        return view('record/confirmation_record', compact('confirmatioRecords', 'confirmation_id','ConfirmationFolder', 'confirmationYear', 'confirmationID'));
    }

    public function showByFuneralArchived($confirmation_id)
    {
        // Fetch records from 'bookrecord' table where baptism_id matches
        $confirmatioRecords = ConfirmationRecord::where('confirmation_id', $confirmation_id)
        ->where('archive', 1)
        ->get();
        

        $ConfirmationFolder = ConfirmationFolder::where('id', $confirmation_id)->firstOrFail();

        $confirmationYear = $ConfirmationFolder->year;
        $confirmationID = $ConfirmationFolder->id;
   
        return view('record/confirmation_record', compact('confirmatioRecords', 'confirmation_id','ConfirmationFolder', 'confirmationYear', 'confirmationID'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'confirmation_id' => 'required',
            'seriesYearNo' => 'required|string',
            'pageNo' => 'required|string',
            'confirmationDate' => 'required|date',
            'childFirstName' => 'required|string',
            'childMiddleName' => 'nullable|string',
            'childLastName' => 'required|string',
            'childDOB' => 'required|date',
            'childProvince' => 'required|string',
            'childCity' => 'required|string',
            'fatherFirstName' => 'required|string',
            'fatherMiddleName' => 'nullable|string',
            'fatherLastName' => 'required|string',
            'motherFirstName' => 'required|string',
            'motherMiddleName' => 'nullable|string',
            'motherLastName' => 'required|string',
            'purokNo' => 'nullable|string',
            'streetAddress' => 'nullable|string',
            'barangay' => 'nullable|string',
            'residenceProvince' => 'required|string',
            'residenceCity' => 'required|string',
            'godparentFirstName' => 'required|string',
            'godparentMiddleName' => 'nullable|string',
            'godparentLastName' => 'required|string',
           
        ]);

        $confirmationYear = $request->confirmationYear;
        $confirmationID = $request->confirmation_id;
        $latestRecord = ConfirmationRecord::where('confirmation_id', $confirmationID)
                ->orderBy('id', 'desc')
                ->first();
    
           
            $nextNumber = 1;
    
            if ($latestRecord) {
               
                $lastRecordCode = $latestRecord->record_code;
                $lastNumber = (int)substr($lastRecordCode, -3);
                $nextNumber = $lastNumber + 1; 
            }
    
    
            $newRecordCode = 'C' . $confirmationYear . ' - ' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);


        $confirmationRecord = ConfirmationRecord::create([
            'confirmation_id' => $confirmationID,
            'series_year_no' => $validatedData['seriesYearNo'],
            'page_no' => $validatedData['pageNo'],
            'record_code' => $newRecordCode,
            'confirmation_date' => $validatedData['confirmationDate'],
            'child_first_name' => $validatedData['childFirstName'],
            'child_middle_name' => $validatedData['childMiddleName'],
            'child_last_name' => $validatedData['childLastName'],
            'child_dob' => $validatedData['childDOB'],
            'child_province' => $validatedData['childProvince'],
            'child_city' => $validatedData['childCity'],
            'father_first_name' => $validatedData['fatherFirstName'],
            'father_middle_name' => $validatedData['fatherMiddleName'],
            'father_last_name' => $validatedData['fatherLastName'],
            'mother_first_name' => $validatedData['motherFirstName'],
            'mother_middle_name' => $validatedData['motherMiddleName'],
            'mother_last_name' => $validatedData['motherLastName'],
            'purok_no' => $validatedData['purokNo'],
            'street_address' => $validatedData['streetAddress'],
            'barangay' => $validatedData['barangay'],
            'residence_province' => $validatedData['residenceProvince'],
            'residence_city' => $validatedData['residenceCity'],
            'godparent_first_name' => $validatedData['godparentFirstName'],
            'godparent_middle_name' => $validatedData['godparentMiddleName'],
            'godparent_last_name' => $validatedData['godparentLastName'],
            
        ]);

        

        // Redirect with success message
        return redirect()->back()->with('success', 'Confirmation record saved successfully!');
    }
    
    public function showConfirmationInfo($id)
    {
       
        $confirmationRecord = ConfirmationRecord::findOrFail($id);
        $record = $confirmationRecord->confirmation_id;

      
        $ConfirmationFolder = ConfirmationFolder::where('id', $record)->firstOrFail();

        $confirmationYear = $ConfirmationFolder->year;
        $confirmationID = $ConfirmationFolder->id;



        return view('record/confirmation_info', compact('confirmationRecord', 'ConfirmationFolder', 'confirmationYear', 'confirmationID'));
    }
    public function archive($id)
{
    // Find the confirmation record by ID
    $confirmationRecord = ConfirmationRecord::findOrFail($id);

    // Update the archive status
    $confirmationRecord->archive = 1; // Set to 1 to mark as archived
    $confirmationRecord->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Confirmation record archived successfully.');
}
public function certificate($id)
    {
       
        $confirmationRecord = ConfirmationRecord::findOrFail($id);
        $record = $confirmationRecord->confirmation_id;

      
        $ConfirmationFolder = ConfirmationFolder::where('id', $record)->firstOrFail();

        $confirmationYear = $ConfirmationFolder->year;
        $confirmationID = $ConfirmationFolder->id;



        return view('record/confirmation_certificate', compact('confirmationRecord', 'ConfirmationFolder', 'confirmationYear', 'confirmationID'));
    }
    public function print($id)
    {
       
        $confirmationRecord = ConfirmationRecord::findOrFail($id);
        $record = $confirmationRecord->confirmation_id;

      
        $ConfirmationFolder = ConfirmationFolder::where('id', $record)->firstOrFail();

        $confirmationYear = $ConfirmationFolder->year;
        $confirmationID = $ConfirmationFolder->id;



        return view('record/confirmation_print', compact('confirmationRecord', 'ConfirmationFolder', 'confirmationYear', 'confirmationID'));
    }



    public function update(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
         
            'SeriesYearNo' => 'required|string|max:255',
            'PageNo' => 'required|string|max:255',
            'ConfirmationDate' => 'required|date',
            'ChildFirstName' => 'required|string|max:255',
            'ChildMiddleName' => 'nullable|string|max:255',
            'ChildLastName' => 'required|string|max:255',
            'ChildDOB' => 'required|date',
            'motherProvince' => 'required|string|max:255', // Capitalize field names for consistency
            'motherCity' => 'required|string|max:255',
            'FatherFirstName' => 'required|string|max:255',
            'FatherMiddleName' => 'nullable|string|max:255',
            'FatherLastName' => 'required|string|max:255',
            'MotherFirstName' => 'required|string|max:255',
            'MotherMiddleName' => 'nullable|string|max:255',
            'MotherLastName' => 'required|string|max:255',
            'PurokNo' => 'nullable|string|max:255',
            'StreetAddress' => 'nullable|string|max:255',
            'Barangay' => 'nullable|string|max:255',
            'fatherProvince' => 'required|string|max:255',
            'fatherCity' => 'required|string|max:255',
            'GodparentFirstName' => 'nullable|string|max:255',
            'GodparentMiddleName' => 'nullable|string|max:255',
            'GodparentLastName' => 'nullable|string|max:255',
        ]);
    
        // Find the confirmation record using the provided ID
        $confirmationRecord = ConfirmationRecord::findOrFail($request->confirmation_id); // Use the ID passed in the request
    
        // Update the record with new data
        $confirmationRecord->update([
            'series_year_no' => $request->SeriesYearNo,
            'page_no' => $request->PageNo,
            'confirmation_date' => $request->ConfirmationDate,
            'child_first_name' => $request->ChildFirstName,
            'child_middle_name' => $request->ChildMiddleName,
            'child_last_name' => $request->ChildLastName,
            'child_dob' => $request->ChildDOB,
            'mother_province' => $request->motherProvince, // Correct field name
            'mother_city' => $request->motherCity, // Correct field name
            'father_first_name' => $request->FatherFirstName,
            'father_middle_name' => $request->FatherMiddleName,
            'father_last_name' => $request->FatherLastName,
            'mother_first_name' => $request->MotherFirstName,
            'mother_middle_name' => $request->MotherMiddleName,
            'mother_last_name' => $request->MotherLastName,
            'purok_no' => $request->PurokNo,
            'street_address' => $request->StreetAddress,
            'barangay' => $request->Barangay,
            'residence_province' => $request->fatherProvince, // Correct field name
            'residence_city' => $request->fatherCity, // Correct field name
            'godparent_first_name' => $request->GodparentFirstName,
            'godparent_middle_name' => $request->GodparentMiddleName,
            'godparent_last_name' => $request->GodparentLastName,
        ]);
    
        // Return a success response
        session()->flash('success', 'Confirmation record updated successfully.');

    // Redirect back to the previous page or a specific page
          return redirect()->back();
    }
    
    public function retrieve($id)
{
    $record = ConfirmationRecord::findOrFail($id); // Replace `BookRecord` with your actual model
    $record->archive = 0; // Set archive field to 0
    $record->save();

    return redirect()->back()->with('success', 'Record successfully retrieved.');
}

public function checkConfirmation(Request $request)
    {
        $MAX_CONFIRMATIONS_PER_DAY = 2; // Change as needed
        $confirmationDate = Carbon::parse($request->date)->format('Y-m-d');

        $existingConfirmations = ConfirmationRecord::whereDate('confirmation_date', $confirmationDate)->count();

        return response()->json([
            'isFull' => $existingConfirmations >= $MAX_CONFIRMATIONS_PER_DAY
        ]);
    }
}
