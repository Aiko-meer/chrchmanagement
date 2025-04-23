<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Baptism_folder;
use App\Models\BookFolder;
use App\Models\BookRecord;
use App\Models\Member;
use App\Models\Volunteer;
use App\Models\Payment;
use App\Models\Donation;
use App\Models\CollectionRecord;
use App\Models\ConfirmationFolder;
use App\Models\ConfirmationRecord;
use App\Models\WeddingFolder;
use App\Models\WeddingRecord;
use App\Models\Funeral_folder;
use App\Models\FuneralRecord;


class BaptismFolderController extends Controller
{
    // Method to add a new year
    public function addYear(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|min:1000|max:3000',
            'month' => 'required|string'
        ]);
    
        $year = new Baptism_folder();
        $year->year = $request->input('year'); // Assign year properly
        $year->month = $request->input('month'); // Ensure "month" is stored in the correct field
        $year->save();

        return response()->json([
            'success' => true,
            'message' => 'Year added successfully!'
        ]);
    }

    public function index()
    {
        // Fetch all baptism records
        $years = Baptism_folder::where('archive', 0)->get();
    
        // Initialize an array to hold baptism records with book counts
        $baptismWithBookCounts = $years->map(function($baptism) {
            // Get the count of book records where baptism_id matches
            $bookCount = BookFolder::where('baptism_id', $baptism->id)->count();
            return [
                'id' => $baptism->id, // Include the id
                'year' => $baptism->year,
                'month' => $baptism->month,
                'book_count' => $bookCount
            ];
        });
    
        return view('record/baptism', ['baptisms' => $baptismWithBookCounts]);
    }

    public function archive($id)
{
    // Find the baptism record by ID and update the archive column
    $baptism = Baptism_folder::findOrFail($id);
    
    // Archive the baptism
    $baptism->archive = 1;
    $baptism->save();

    // Archive all related BookFolder records
    $bookFolders = BookFolder::where('baptism_id', $baptism->id)->get();
    
    // Update the archive column for related BookFolder records
    foreach ($bookFolders as $bookFolder) {
        $bookFolder->archive = 1;
        $bookFolder->save();

        // Archive all related BookRecord records
        $bookRecords = BookRecord::where('book_id', $bookFolder->id)->get();
        
        foreach ($bookRecords as $bookRecord) {
            $bookRecord->archive = 1;
            $bookRecord->save();
        }
    }

  

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Baptism record and related books and records moved to archive successfully.');
}
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
                'year' => $baptism->year,
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

    $years = ConfirmationFolder::where('archive', 1)->get();


    $ConfirmationrecordCounts = $years->map(function($confirmation) {
    $ConfirmationCount = ConfirmationRecord::where('confirmation_id', $confirmation->id)->count();
    return [
    'id' => $confirmation->id,
    'year' => $confirmation->year,
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
    $weddings = WeddingFolder::where('archive', 1)->get();


    $WeddingrecordCounts = $weddings->map(function ($wedding) {
    $WeddingCount = WeddingRecord::where('wedding_id', $wedding->id)->count();
    return [
    'id' => $wedding->id, 
    'year' => $wedding->year, 
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


    return view('archives/archived_baptism_month', compact(

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

    public function retrieve($year)
{
    // Update all records where the baptism_date is in the given year
    Baptism_folder::where('year', $year)
                  ->update(['archive' => 0]);

    return redirect()->back()->with('success', "All baptism records for $year have been retrieved.");
}

public function destroy($id)
{
    $record = Baptism_folder::findOrFail($id); // Replace `BookRecord` with your actual model
    $record->delete(); // Permanently delete the record

    return redirect()->back()->with('success', 'Record successfully deleted.');
}

}