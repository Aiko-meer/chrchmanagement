<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funeral_folder;
use App\Models\FuneralRecord;
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

class FuneralFolderController extends Controller
{
    public function addYear(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|min:1000|max:3000'
        ]);

        $year = new Funeral_folder();
        $year->year = $request->input('year');
        $year->save();

        return response()->json([
            'success' => true,
            'message' => 'Year added successfully!'
        ]);
    }

    public function index()
    {
        // Fetch all baptism records
        $years = Funeral_folder::where('archive', 0)->get();
        // Initialize an array to hold baptism records with book counts
        $funeralrecordCounts = $years->map(function($funeral) {
            
            $FuneralCount = FuneralRecord::where('funeral_id', $funeral->id)->count();
            return [
                'id' => $funeral->id, // Include the id
                'year' => $funeral->year,
                'month' => $funeral->month,
                'funeral_count' => $FuneralCount
            ];
        });
    
        return view('record/funeral', ['funerals' => $funeralrecordCounts]);
    }
    public function archive($id)
{
    // Find the funeral folder by ID
    $funeralFolder = Funeral_folder::findOrFail($id);

    // Update the archive status
    $funeralFolder->archive = 1; // Set to 1 to mark as archived
    $funeralFolder->save();
    FuneralRecord::where('funeral_id', $funeralFolder->id)
    ->update(['archive' => 1]);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Funeral folder archived successfully.');
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

    $weddingsIds = $weddings->pluck('id');

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


   

    $funerals = Funeral_folder::where('year', $year)
    ->where('archive', 1)
    ->get();

    $funeralIds = $funerals->pluck('id');

    $FuneralrecordCounts = $funerals->map(function ($funeral) {
    $FuneralCount = FuneralRecord::where('funeral_id', $funeral->id)->count();
    return [
    'id' => $funeral->id, 
    'year' => $funeral->year, 
    'month' => $funeral->month,
    'funeral_count' => $FuneralCount, 
    ];
    });


    $FuneralRecords = FuneralRecord::where('archive', 1)->get();


    $funeral_ids = $FuneralRecords->pluck('wedding_id')->unique(); 


    $FuneralFolders = Funeral_folder::whereIn('id', $funeral_ids)->get();

    if ($FuneralFolders->isNotEmpty()) {
    $funeralYear = $FuneralFolders->first()->year; 
    }


    return view('archives/archived_funeral_month', compact(

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
