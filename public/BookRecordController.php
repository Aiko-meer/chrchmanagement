<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookRecord;
use App\Models\GodParent;
use App\Models\BookFolder;
use App\Models\Baptism_folder;


class BookRecordController extends Controller
{
    public function store(Request $request)
{
    // Validate the request data
    $validated = $request->validate([
        'seriesYearNo' => 'required',
        'bookNo' => 'required',
        'pageNo' => 'required',
        'recordCode' => 'required',
        'baptismDate' => 'required|date',
        'childFirstName' => 'required',
        'childMiddleName' => 'nullable',
        'childLastName' => 'required',
        'childDOB' => 'required|date',
        'childProvince' => 'nullable',
        'childCity' => 'nullable',
        'fatherFirstName' => 'required',
        'fatherMiddleName' => 'nullable',
        'fatherLastName' => 'required',
        'fatherProvince' => 'nullable',
        'fatherCity' => 'nullable',
        'motherFirstName' => 'required',
        'motherMiddleName' => 'nullable',
        'motherLastName' => 'required',
        'motherProvince' => 'nullable',
        'motherCity' => 'nullable',
        'purokNo' => 'nullable',
        'streetAddress' => 'nullable',
        'barangay' => 'nullable',
        'residenceProvince' => 'nullable',
        'residenceCity' => 'nullable',
        // Godparent validation (nullable and array check)
        'godparentFirstName' => 'array|nullable',
        'godparentMiddleName' => 'array|nullable',
        'godparentLastName' => 'array|nullable',
        'godparentPurok' => 'array|nullable',
        'godparentStreetAddress' => 'array|nullable',
        'godparentBarangay' => 'array|nullable',
        'godparentCity' => 'array|nullable',
        'godparentProvince' => 'array|nullable',
        'baptism_id' => 'required',
    ]);

    // Save the baptism record
    $bookRecord = BookRecord::create([
        'series_year_no' => $validated['seriesYearNo'],
        'book_no' => $validated['bookNo'],
        'page_no' => $validated['pageNo'],
        'record_code' => $validated['recordCode'],
        'baptism_date' => $validated['baptismDate'],
        'child_first_name' => $validated['childFirstName'],
        'child_middle_name' => $validated['childMiddleName'],
        'child_last_name' => $validated['childLastName'],
        'child_dob' => $validated['childDOB'],
        'child_province' => $validated['childProvince'],
        'child_city' => $validated['childCity'],
        'father_first_name' => $validated['fatherFirstName'],
        'father_middle_name' => $validated['fatherMiddleName'],
        'father_last_name' => $validated['fatherLastName'],
        'father_province' => $validated['fatherProvince'],
        'father_city' => $validated['fatherCity'],
        'mother_first_name' => $validated['motherFirstName'],
        'mother_middle_name' => $validated['motherMiddleName'],
        'mother_last_name' => $validated['motherLastName'],
        'mother_province' => $validated['motherProvince'],
        'mother_city' => $validated['motherCity'],
        'purok_no' => $validated['purokNo'],
        'street_address' => $validated['streetAddress'],
        'barangay' => $validated['barangay'],
        'residence_province' => $validated['residenceProvince'],
        'residence_city' => $validated['residenceCity'],
        'book_id' => $validated['baptism_id'],
    ]);

    // Save each godparent only if godparentFirstName exists and is not empty
    if (isset($validated['godparentFirstName']) && count($validated['godparentFirstName']) > 0) {
        foreach ($validated['godparentFirstName'] as $index => $firstName) {
            if (!empty($firstName)) {
                Godparent::create([
                    'first_name' => $firstName,
                    'middle_name' => $validated['godparentMiddleName'][$index] ?? null,
                    'last_name' => $validated['godparentLastName'][$index],
                    'purok_no' => $validated['godparentPurok'][$index] ?? null,
                    'street_address' => $validated['godparentStreetAddress'][$index] ?? null,
                    'barangay' => $validated['godparentBarangay'][$index] ?? null,
                    'municipality_city' => $validated['godparentCity'][$index] ?? null,
                    'province' => $validated['godparentProvince'][$index] ?? null,
                    'baptism_id' => $bookRecord->id, // Ensure this matches the foreign key
                ]);
            }
        }
    }

    // Return JSON response for AJAX or redirect with success message
    if ($request->ajax()) {
        return response()->json(['success' => true, 'message' => 'Baptism record and godparents saved successfully!']);
    } else {
        // Flash success message to the session
        session()->flash('success', 'Baptism record and godparents saved successfully!');
    
        // Return a JavaScript response that triggers the SweetAlert
        return response()->json(['success' => true, 'message' => 'Baptism record and godparents saved successfully!']);
    }
}
    public function showByBaptism($baptism_id)
    {
        // Fetch records from 'bookrecord' table where baptism_id matches
        $bookRecords = BookRecord::where('book_id', $baptism_id)->get();

        $bookFolder = BookFolder::where('id', $baptism_id)->firstOrFail();

        $baptismFolder = Baptism_folder::findOrFail($bookFolder->baptism_id);

        $baptismYear = $baptismFolder->year;
        $baptismID = $baptismFolder->id;
        // Pass records to the view
        return view('record/book_record', compact('bookRecords', 'baptism_id','bookFolder', 'baptismYear', 'baptismID'));
    }
        public function showInfo($id)
    {
       
        $bookRecord = BookRecord::findOrFail($id);
        $record = $bookRecord->book_id;

        $godparents = Godparent::where('baptism_id', $id)->get();
        
        $bookFolder = BookFolder::where('id', $record)->firstOrFail();

        $baptismFolder = Baptism_folder::findOrFail($bookFolder->baptism_id);
        $baptismYear = $baptismFolder->year;
        $baptismID = $baptismFolder->id;



        return view('record.book_record_info', compact('bookRecord', 'godparents','bookFolder', 'baptismYear', 'baptismID'));
    }
    
}
