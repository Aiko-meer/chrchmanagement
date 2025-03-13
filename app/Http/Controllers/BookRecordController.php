<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookRecord;
use App\Models\GodParent;
use App\Models\BookFolder;
use App\Models\Baptism_folder;
use Carbon\Carbon;
use Illuminate\Http\Response;



class BookRecordController extends Controller
{
    public function store(Request $request)
    {
        $MAX_BOOKINGS_PER_DAY = 2; // Set max bookings per day
    
        // Validate request
        $validated = $request->validate([
            'seriesYearNo' => 'required',
        'bookNo' => 'required',
        'pageNo' => 'required',
       
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
        'status' => 'nullable',
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
    
        // Convert baptism date to Y-m-d format
        $baptismDate = Carbon::parse($validated['baptismDate'])->format('Y-m-d');
    
        // Count existing bookings for the date
        $existingBookings = BookRecord::whereDate('baptism_date', $baptismDate)->count();
    
        // **Check if booking limit reached**
        if ($existingBookings >= $MAX_BOOKINGS_PER_DAY) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the maximum number of baptisms for this date has been reached. Please choose another date.'
            ], Response::HTTP_BAD_REQUEST); // Uses Symfony HTTP status codes
        }
        
        
    
        // Generate new record code
        $baptismYear = date('Y', strtotime($baptismDate));
        $latestRecord = BookRecord::where('book_id', $validated['baptism_id'])
            ->orderBy('id', 'desc')
            ->first();
    
        $lastNumber = $latestRecord ? (int)substr($latestRecord->record_code, -3) : 0;
        $nextNumber = $lastNumber + 1;
        $newRecordCode = 'B' . $baptismYear . ' - ' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    
        // Create new baptism record
        BookRecord::create([
            'series_year_no' => $validated['seriesYearNo'],
        'book_no' => $validated['bookNo'],
        'page_no' => $validated['pageNo'],
        'record_code' => $newRecordCode,
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
        'status' => $validated['status'],
        ]);
    
        return response()->json(['success' => true, 'message' => 'Baptism record saved successfully!']);
    }
    public function showByBaptism($baptism_id)
    {
        // Fetch records from 'bookrecord' table where baptism_id matches
        $bookRecords = BookRecord::where('book_id', $baptism_id)
        ->where('archive', 0)->where('status', 0)
        ->get();
        

        $bookFolder = BookFolder::where('id', $baptism_id)->firstOrFail();

        $baptismFolder = Baptism_folder::findOrFail($bookFolder->baptism_id);

        $baptismYear = $baptismFolder->year;
        $baptismID = $baptismFolder->id;
        // Pass records to the view
        return view('record/book_record', compact('bookRecords', 'baptism_id','bookFolder', 'baptismYear', 'baptismID'));
    }
    public function showByBaptismArchived($baptism_id)
    {
        // Fetch records from 'bookrecord' table where baptism_id matches
        $bookRecords = BookRecord::where('book_id', $baptism_id)
       
        ->get();
        

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
    public function getGodparents($baptism_id)
{
    // Fetch godparents based on baptism_id
    $godparents = Godparent::where('baptism_id', $baptism_id)->get();
    return response()->json($godparents);
}
public function update(Request $request, $id)
{
    // Validate the incoming request data
    $request->validate([
        'series_year_no' => 'required|string',
        'book_no' => 'required|string',
        'page_no' => 'required|string',
        'record_code' => 'required|string',
        'baptism_date' => 'required|date',
        'child_first_name' => 'required|string',
        'child_middle_name' => 'nullable|string',
        'child_last_name' => 'required|string',
        'child_dob' => 'required|date',
        'child_province' => 'required|string',
        'child_city' => 'required|string',
        'father_first_name' => 'required|string',
        'father_middle_name' => 'nullable|string',
        'father_last_name' => 'required|string',
        'father_province' => 'required|string',
        'father_city' => 'required|string',
        'mother_first_name' => 'required|string',
        'mother_middle_name' => 'nullable|string',
        'mother_last_name' => 'required|string',
        'mother_province' => 'required|string',
        'mother_city' => 'required|string',
        'purok_no' => 'required|string',
        'street_address' => 'required|string',
        'barangay' => 'required|string',
        'residence_province' => 'required|string',
        'residence_city' => 'required|string',
        'godparent_first_name' => 'array|nullable',
        'godparent_first_name.*' => 'string',
        'godparent_last_name' => 'array|nullable',
        'godparent_last_name.*' => 'string',
        'godparent_purok_no' => 'array|nullable',
        'godparent_purok_no.*' => 'string',
        'godparent_street_address' => 'array|nullable',
        'godparent_street_address.*' => 'string',
        'godparent_barangay' => 'array|nullable',
        'godparent_barangay.*' => 'string',
        'godparent_municipality_city' => 'array|nullable',
        'godparent_municipality_city.*' => 'string',
        'godparent_province' => 'array|nullable',
        'godparent_province.*' => 'string',
    ]);

    // Update the baptism record
    $baptismRecord = BookRecord::findOrFail($id);
    $baptismRecord->update($request->only([
        'series_year_no', 'book_no', 'page_no','record_code','baptism_date',
        'child_first_name', 'child_middle_name', 'child_last_name',
        'child_dob', 'child_province', 'child_city',
        'father_first_name', 'father_middle_name', 'father_last_name',
        'father_province', 'father_city',
        'mother_first_name', 'mother_middle_name', 'mother_last_name',
        'mother_province', 'mother_city',
        'purok_no', 'street_address', 'barangay',
        'residence_province', 'residence_city'
    ]));

    
    if (!is_null($request->godparent_first_name) && count($request->godparent_first_name) > 0) {
        foreach ($request->godparent_first_name as $index => $firstName) { 
            // Update existing godparents or create new ones
            Godparent::updateOrCreate(
                ['baptism_id' => $baptismRecord->id, 'id' => $request->godparent_id[$index] ?? null],
                [
                    'first_name' => $firstName,
                    'middle_name' => $request->godparent_middle_name[$index] ?? null,
                    'last_name' => $request->godparent_last_name[$index],
                    'purok_no' => $request->godparent_purok_no[$index],
                    'street_address' => $request->godparent_street_address[$index],
                    'barangay' => $request->godparent_barangay[$index],
                    'municipality_city' => $request->godparent_municipality_city[$index],
                    'province' => $request->godparent_province[$index],
                ]
            );
        }
    }

    return redirect()->back()->with('success', 'Member registered successfully');
}
public function archive($id)
{
    // Find the book record by ID
    $bookRecord = BookRecord::findOrFail($id);

    // Update the archive status
    $bookRecord->archive = 1; // Set to 1 to mark as archived
    $bookRecord->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Book record archived successfully.');
}



public function certificate($id)  {

    $bookRecord = BookRecord::findOrFail($id);
        $record = $bookRecord->book_id;

        $godparents = Godparent::where('baptism_id', $id)->get();
        
        $bookFolder = BookFolder::where('id', $record)->firstOrFail();

        $baptismFolder = Baptism_folder::findOrFail($bookFolder->baptism_id);
        $baptismYear = $baptismFolder->year;
        $baptismID = $baptismFolder->id;



    return view('record.baptism_certificate',compact('bookRecord', 'godparents','bookFolder', 'baptismYear', 'baptismID'));
}
public function print($id)  {

    $bookRecord = BookRecord::findOrFail($id);
        $record = $bookRecord->book_id;

        $godparents = Godparent::where('baptism_id', $id)->get();
        
        $bookFolder = BookFolder::where('id', $record)->firstOrFail();

        $baptismFolder = Baptism_folder::findOrFail($bookFolder->baptism_id);
        $baptismYear = $baptismFolder->year;
        $baptismID = $baptismFolder->id;



    return view('record.baptism_print',compact('bookRecord', 'godparents','bookFolder', 'baptismYear', 'baptismID'));
}

public function retrieve($id)
{
    $record = BookRecord::findOrFail($id); // Replace `BookRecord` with your actual model
    $record->archive = 0; // Set archive field to 0
    $record->save();

    return redirect()->back()->with('success', 'Record successfully retrieved.');
}

public function checkBaptismDate(Request $request)
{
    $MAX_BOOKINGS_PER_DAY = 2;
    $baptismDate = Carbon::parse($request->date)->format('Y-m-d');

    $existingBookings = BookRecord::whereDate('baptism_date', $baptismDate)->count();

    return response()->json([
        'isFull' => $existingBookings >= $MAX_BOOKINGS_PER_DAY
    ]);
}

public function destroy($id)
{
    $record = BookRecord::findOrFail($id); // Replace `BookRecord` with your actual model
    $record->delete(); // Permanently delete the record

    return redirect()->back()->with('success', 'Record successfully deleted.');
}

public function check($id)
{
    $record = BookRecord::findOrFail($id); // Replace `BookRecord` with your actual model
    $record->status = 1; // Set archive field to 0
    $record->save();

    return redirect()->back()->with('success', 'Record successfully retrieved.');
}

}
