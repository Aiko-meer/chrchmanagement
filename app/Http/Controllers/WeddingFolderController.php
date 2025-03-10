<?php

namespace App\Http\Controllers;
use App\Models\WeddingFolder;
use App\Models\WeddingRecord;
use App\Models\ConfirmationFolder;
use App\Models\ConfirmationRecord;
use App\Models\Baptism_folder;
use App\Models\BookFolder;
use App\Models\BookRecord;
use App\Models\Member;
use App\Models\Volunteer;
use App\Models\Payment;
use App\Models\Donation;
use App\Models\CollectionRecord;
use App\Models\Funeral_folder;
use App\Models\FuneralRecord;
use Illuminate\Http\Request;

class WeddingFolderController extends Controller
{
    public function index()
    {
        // Fetch all baptism records
        $years = WeddingFolder::where('archive', 0)->get();
 
      
        $WeddingrecordCounts = $years->map(function($wedding) {
            
            $WeddingCount = WeddingRecord::where('wedding_id', $wedding->id)->count();
            return [
                'id' => $wedding->id, // Include the id
                'year' => $wedding->year,
                'month' => $wedding->month,
                'wedding_count' => $WeddingCount
            ];
        });
    
        return view('record/wedding', ['weddings' => $WeddingrecordCounts]);
    }
    public function addYear(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|min:1000|max:3000'
        ]);

        $year = new WeddingFolder();
        $year->year = $request->input('year');
        $year->save();

        return response()->json([
            'success' => true,
            'message' => 'Year added successfully!'
        ]);
    }

    public function showByWedding($wedding_id)
    {
        // Fetch records from 'bookrecord' table where baptism_id matches
        $WeddingRecords = WeddingRecord::where('wedding_id', $wedding_id)
        ->where('archive', 0)
        ->get();
        

        $WeddingFolder = WeddingFolder::where('id', $wedding_id)->firstOrFail();

        $weddingYear = $WeddingFolder->year;
        $weddingID = $WeddingFolder->id;
   
        return view('record/wedding_record', compact('WeddingRecords', 'wedding_id','WeddingFolder', 'weddingYear', 'weddingID'));
    }
    public function showByWeddingArchived($wedding_id)
    {
        // Fetch records from 'bookrecord' table where baptism_id matches
        $WeddingRecords = WeddingRecord::where('wedding_id', $wedding_id)
        ->where('archive', 1)
        ->get();
        

        $WeddingFolder = WeddingFolder::where('id', $wedding_id)->firstOrFail();

        $weddingYear = $WeddingFolder->year;
        $weddingID = $WeddingFolder->id;
   
        return view('record/wedding_record', compact('WeddingRecords', 'wedding_id','WeddingFolder', 'weddingYear', 'weddingID'));
    }
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'wedding_id' => 'required|string|max:255',
       
            'wedding_date' => 'required|date',
            'groom_first_name' => 'required|string|max:255',
            'groom_middle_name' => 'nullable|string|max:255',
            'groom_last_name' => 'required|string|max:255',
            'groom_dob' => 'required|date',
            'groom_purok_no' => 'nullable|string|max:255',
            'groom_street_address' => 'nullable|string|max:255',
            'groom_barangay' => 'nullable|string|max:255',
            'groom_residence_province' => 'nullable|string|max:255',
            'groom_residence_city' => 'nullable|string|max:255',
            'groom_contact' => 'nullable|string|max:255',
            'bride_first_name' => 'required|string|max:255',
            'bride_middle_name' => 'nullable|string|max:255',
            'bride_last_name' => 'required|string|max:255',
            'bride_dob' => 'required|date',
            'bride_purok_no' => 'nullable|string|max:255',
            'bride_street_address' => 'nullable|string|max:255',
            'bride_barangay' => 'nullable|string|max:255',
            'bride_residence_province' => 'nullable|string|max:255',
            'bride_residence_city' => 'nullable|string|max:255',
            'bride_contact' => 'nullable|string|max:255',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        // Handle file upload if a document is provided
        $documentPath = null;
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
        }

        $weddingYear = $request->weddingYear;
        $weddingID = $request->wedding_id;

        
        $latestRecord = WeddingRecord::where('wedding_id', $weddingID)
            ->orderBy('id', 'desc')
            ->first();

       
        $nextNumber = 1;

        if ($latestRecord) {
           
            $lastRecordCode = $latestRecord->record_code;
            $lastNumber = (int)substr($lastRecordCode, -3);
            $nextNumber = $lastNumber + 1; 
        }


        $newRecordCode = 'W' . $weddingYear . ' - ' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        // Create a new wedding record
        WeddingRecord::create([
            'wedding_id' =>$request->wedding_id,
            'record_code' => $newRecordCode,
            'wedding_date' => $request->wedding_date,
            'groom_first_name' => $request->groom_first_name,
            'groom_middle_name' => $request->groom_middle_name,
            'groom_last_name' => $request->groom_last_name,
            'groom_dob' => $request->groom_dob,
            'groom_purok_no' => $request->groom_purok_no,
            'groom_street_address' => $request->groom_street_address,
            'groom_barangay' => $request->groom_barangay,
            'groom_residence_province' => $request->groom_residence_province,
            'groom_residence_city' => $request->groom_residence_city,
            'groom_contact' => $request->groom_contact,
            'bride_first_name' => $request->bride_first_name,
            'bride_middle_name' => $request->bride_middle_name,
            'bride_last_name' => $request->bride_last_name,
            'bride_dob' => $request->bride_dob,
            'bride_purok_no' => $request->bride_purok_no,
            'bride_street_address' => $request->bride_street_address,
            'bride_barangay' => $request->bride_barangay,
            'bride_residence_province' => $request->bride_residence_province,
            'bride_residence_city' => $request->bride_residence_city,
            'bride_contact' => $request->bride_contact,
            'document' => $documentPath,
        ]);

        // Redirect or respond back with a success message
        return back()->with('success', 'Wedding record has been added successfully.');
    }
    public function archive($id)
{
    // Find the wedding folder record by ID
    $weddingFolder = WeddingFolder::findOrFail($id);

    // Update the archive status
    $weddingFolder->archive = 1; // Set to 1 to mark as archived
    $weddingFolder->save();
    WeddingRecord::where('wedding_id', $weddingFolder->id)
    ->update(['archive' => 1]);
    // Redirect back with a success message
    return redirect()->back()->with('success', 'Wedding record archived successfully.');
}

public function archive_record($id)
{
    // Find the wedding record by ID
    $weddingRecord = WeddingRecord::findOrFail($id);

    // Update the archive status
    $weddingRecord->archive = 1; // Set to 1 to mark as archived
    $weddingRecord->save();
    

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Wedding record archived successfully.');
}


public function update(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'id' => 'required|exists:weddingrecord,id',

        'wedding_date' => 'required|date',
        'groom_first_name' => 'required|string|max:255',
        'groom_middle_name' => 'nullable|string|max:255',
        'groom_last_name' => 'required|string|max:255',
        'groom_dob' => 'nullable|date',
        'groom_province' => 'nullable|string|max:255',
        'groom_city' => 'nullable|string|max:255',
        'groom_barangay' => 'nullable|string|max:255',
        'groom_street_address' => 'nullable|string|max:255',
        'groom_purok_no' => 'nullable|string|max:255',
        'groom_contact' => 'nullable|string|max:20',
        'bride_first_name' => 'required|string|max:255',
        'bride_middle_name' => 'nullable|string|max:255',
        'bride_last_name' => 'required|string|max:255',
        'bride_dob' => 'nullable|date',
        'bride_province' => 'nullable|string|max:255',
        'bride_city' => 'nullable|string|max:255',
        'bride_barangay' => 'nullable|string|max:255',
        'bride_street_address' => 'nullable|string|max:255',
        'bride_purok_no' => 'nullable|string|max:255',
        'bride_contact' => 'nullable|string|max:20',
        'presented_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Allow specific file types
    ]);

    // Find the wedding record
    $wedding = WeddingRecord::findOrFail($request->id);

    // Update wedding details

    $wedding->wedding_date = $request->wedding_date;

    // Update groom's information
    $wedding->groom_first_name = $request->groom_first_name;
    $wedding->groom_middle_name = $request->groom_middle_name;
    $wedding->groom_last_name = $request->groom_last_name;
    $wedding->groom_dob = $request->groom_dob;
    $wedding->groom_residence_province = $request->groom_province;
    $wedding->groom_residence_city = $request->groom_city;
    $wedding->groom_barangay = $request->groom_barangay;
    $wedding->groom_street_address = $request->groom_street_address;
    $wedding->groom_purok_no = $request->groom_purok_no;
    $wedding->groom_contact = $request->groom_contact;

    // Update bride's information
    $wedding->bride_first_name = $request->bride_first_name;
    $wedding->bride_middle_name = $request->bride_middle_name;
    $wedding->bride_last_name = $request->bride_last_name;
    $wedding->bride_dob = $request->bride_dob;
    $wedding->bride_residence_province = $request->bride_province;
    $wedding->bride_residence_city = $request->bride_city;
    $wedding->bride_barangay = $request->bride_barangay;
    $wedding->bride_street_address = $request->bride_street_address;
    $wedding->bride_purok_no = $request->bride_purok_no;
    $wedding->bride_contact = $request->bride_contact;

    // Handle file upload for the presented file
    if ($request->hasFile('presented_file')) {
        // Delete the old file if it exists
        if ($wedding->document && \Storage::disk('public')->exists($wedding->document)) {
            \Storage::disk('public')->delete($wedding->document);
        }

        // Store the new file
        $fileName = time() . '_' . $request->file('presented_file')->getClientOriginalName();
        $filePath = $request->file('presented_file')->storeAs('uploads', $fileName, 'public');
        $wedding->document = $filePath;
    }

    // Save the updated wedding record
    $wedding->save();

    // Return success response
    session()->flash('success', 'Wedding record updated successfully.');

    // Redirect back to the previous page or a specific page
          return redirect()->back();
}

public function showWeddingInfo($wedding_id)
    {
        // Fetch records from 'bookrecord' table where baptism_id matches
        $WeddingRecords = WeddingRecord::findOrFail($wedding_id);
        
        $wedding = $WeddingRecords->wedding_id;
        $WeddingFolder = WeddingFolder::where('id', $wedding)->firstOrFail();

        $weddingYear = $WeddingFolder->year;
        $weddingID = $WeddingFolder->id;
   
        return view('record/wedding_info', compact('WeddingRecords', 'wedding_id','WeddingFolder', 'weddingYear', 'weddingID'));
    }


    //month
    public function month($year)
    {
        //fetch all archive
        $members = Member::where('archive', 1)->get();
        $volunteers = Volunteer::where('archive', 1)->get();
        $payments = Payment::where('archive', 1)->get();
        $collections = CollectionRecord::where('archive', 1)->get();
        $donations = Donation::where('archive', 1)->get();

        $baptisms = Baptism_folder::where('year', $year)
        ->where('archive', 1)
        ->get();

        $baptismIds = $baptisms->pluck('id');
        $baptismWithBookCounts = $baptisms->map(function ($baptism) {
            $bookCount = BookFolder::where('baptism_id', $baptism->id)->count();
            return [
                'id' => $baptism->id, // Include the ID
                
                'month' => $baptism->month,
                'book_count' => $bookCount,
            ];
        });

    $books = BookFolder::where('archive', 1)
    // Use the IDs from the baptism_folder
    ->get();

    $booksWithRecordCounts = $books->map(function ($book) {

    $baptism = Baptism_folder::find($book->baptism_id);


    $recordCount = BookRecord::where('book_id', $book->id)->count();
    return [
    'id' => $book->id,
    'baptism_id' => $book->baptism_id,
    'book_number' => $book->book_number, // Accessing model property correctly
    'record_count' => $recordCount,
    'baptism_year' => $baptism ? $baptism->year : null,
    ];
    });

    $bookRecords = BookRecord::where('archive', 1)
    // Use the IDs from the bookfolder
    ->get();

    $years = ConfirmationFolder::where('year', $year)
    ->where('archive', 1)
    ->get();

    $confirmationIds = $years->pluck('id');
    $ConfirmationrecordCounts = $years->map(function($confirmation) {
    $ConfirmationCount = ConfirmationRecord::where('confirmation_id', $confirmation->id)->count();
    return [
    'id' => $confirmation->id,
    'year' => $confirmation->year,
    'month' => $confirmation->month,
    'funeral_count' => $ConfirmationCount
    ];
    });

    // Retrieve confirmation records with `archive` set to 1
    $confirmationRecords = ConfirmationRecord::where('archive', 1)->get();

    $confirmationFolder = null; // Initialize variable to avoid undefined error
    $confirmationYear = null;
    $confirmationID = null;

    if ($confirmationRecords->isNotEmpty()) {
    // Extract all `confirmation_id` values from the records
    $confirmationIds = $confirmationRecords->pluck('confirmation_id')->unique();

    // Find the first matching confirmation folder based on `confirmation_id`
    $confirmationFolder = ConfirmationFolder::whereIn('id', $confirmationIds)->first();

    // Ensure the folder exists before accessing properties
    if ($confirmationFolder) {
    $confirmationYear = $confirmationFolder->year;
    $confirmationID = $confirmationFolder->id;
    }
    }
    

    //month wedding
    $weddings = weddingFolder::where('year', $year)
    ->where('archive', 1)
    ->get();

    $weddingsIds = $years->pluck('id');

    $WeddingrecordCounts = $weddings->map(function ($wedding) {
    $WeddingCount = WeddingRecord::where('wedding_id', $wedding->id)->count();
    return [
    'id' => $wedding->id, 
    'year' => $wedding->year, 
    'month' => $wedding->month,
    'wedding_count' => $WeddingCount, 
    ];
    });


    $WeddingRecords = WeddingRecord::where('archive', 1)->get();


    $wedding_ids = $WeddingRecords->pluck('wedding_id')->unique(); 


    $WeddingFolders = WeddingFolder::whereIn('id', $wedding_ids)->get();

    if ($WeddingFolders->isNotEmpty()) {
    $weddingYear = $WeddingFolders->first()->year; 
    }


    $funerals = Funeral_folder::where('archive', 1)->get();


    $FuneralrecordCounts = $funerals->map(function ($funeral) {
    $FuneralCount = FuneralRecord::where('funeral_id', $funeral->id)->count();
    return [
    'id' => $funeral->id, 
    'year' => $funeral->year, 
    'funeral_count' => $FuneralCount, 
    ];
    });


    $FuneralRecords = FuneralRecord::where('archive', 1)->get();


    $funeral_ids = $FuneralRecords->pluck('wedding_id')->unique(); 


    $FuneralFolders = Funeral_folder::whereIn('id', $funeral_ids)->get();

    if ($FuneralFolders->isNotEmpty()) {
    $funeralYear = $FuneralFolders->first()->year; 
    }


    return view('archives/archived_wedding_month', compact(

    'members',
    'volunteers',
    'payments',
    'collections',
    'donations',
    'ConfirmationrecordCounts',
    'baptismWithBookCounts',
    'confirmationRecords',
    'confirmationFolder',
    'confirmationYear',
    'confirmationID',
    'booksWithRecordCounts',
    'bookRecords',
    'WeddingrecordCounts',
    'weddings',
    'WeddingRecords',
    'FuneralrecordCounts',
    'funerals',
    'FuneralRecords',
    'year',




    ));
    }



    
}
