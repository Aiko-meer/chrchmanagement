<?php

namespace App\Http\Controllers;
use App\Models\Member;
use App\Models\Volunteer;
use App\Models\Payment;
use App\Models\Donation;
use App\Models\CollectionRecord;
use App\Models\Baptism_folder;
use App\Models\BookFolder;
use App\Models\BookRecord;
use App\Models\ConfirmationFolder;
use App\Models\ConfirmationRecord;
use App\Models\WeddingFolder;
use App\Models\WeddingRecord;
use App\Models\Funeral_folder;
use App\Models\FuneralRecord;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index()
    {
        
       
        $members = Member::where('archive', 1)->get();
        $volunteers = Volunteer::where('archive', 1)->get();
        $payments = Payment::where('archive', 1)->get();
        $collections = CollectionRecord::where('archive', 1)->get();
        $donations = Donation::where('archive', 1)->get();


        $baptisms = Baptism_folder::where('archive', 1)->get();

        $baptismWithBookCounts = $baptisms->groupBy('year')->map(function ($baptismsByYear, $year) {
            $totalBookCount = $baptismsByYear->sum(function ($baptism) {
                return BookFolder::where('baptism_id', $baptism->id)->count();
            });
        
            return [
                
                'year' => $year,
                'book_count' => $totalBookCount,
            ];
        })->values(); // Reset keys
        
        //confirmation group by year
        $years = ConfirmationFolder::where('archive', 1)->get();

$groupedConfirmationCounts = $years->groupBy('year')->map(function ($confirmations, $year) {
    $totalConfirmationCount = $confirmations->sum(function ($confirmation) {
        return ConfirmationRecord::where('confirmation_id', $confirmation->id)->count();
    });

    return [
        'year' => $year,
        'total_confirmation_count' => $totalConfirmationCount,
    ];
})->values(); // Reset array keys

        
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
        //confirmation
        
        $years = ConfirmationFolder::where('archive', 1)->get();

$ConfirmationrecordCounts = $years->groupBy('year')->map(function ($confirmations, $year) {
    // Get the first confirmation ID for that year
    $firstId = $confirmations->first()->id; 

    // Sum all confirmation records related to each year
    $totalConfirmationCount = $confirmations->sum(function ($confirmation) {
        return ConfirmationRecord::where('confirmation_id', $confirmation->id)->count();
    });

    return [
        'id' => $firstId, // Display the first ID for the year
        'year' => $year,
        'funeral_count' => $totalConfirmationCount
    ];
})->values(); // Reset array keys

        
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

        // Group by year
        $WeddingrecordCounts = $weddings->groupBy('year')->map(function ($weddings, $year) {
            $totalWeddingCount = $weddings->sum(function ($wedding) {
                return WeddingRecord::where('wedding_id', $wedding->id)->count();
            });
        
            return [
                'year' => $year, 
                'wedding_count' => $totalWeddingCount, 
            ];
        })->values(); // Reset array keys
        

     
        $WeddingRecords = WeddingRecord::where('archive', 1)->get();

    
        $wedding_ids = $WeddingRecords->pluck('wedding_id')->unique(); 


        $WeddingFolders = WeddingFolder::whereIn('id', $wedding_ids)->get();

        if ($WeddingFolders->isNotEmpty()) {
            $weddingYear = $WeddingFolders->first()->year; 
        }


        $funerals = Funeral_folder::where('archive', 1)->get();

$FuneralrecordCounts = $funerals->groupBy('year')->map(function ($funerals, $year) {
    $totalFuneralCount = $funerals->sum(function ($funeral) {
        return FuneralRecord::where('funeral_id', $funeral->id)->count();
    });

    return [
        'year' => $year, 
        'funeral_count' => $totalFuneralCount, 
    ];
})->values(); // Reset array keys


     
        $FuneralRecords = FuneralRecord::where('archive', 1)->get();

    
        $funeral_ids = $FuneralRecords->pluck('wedding_id')->unique(); 


        $FuneralFolders = Funeral_folder::whereIn('id', $funeral_ids)->get();

        if ($FuneralFolders->isNotEmpty()) {
            $funeralYear = $FuneralFolders->first()->year; 
        }
        

        return view('archives/archives', compact(
            
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

  
        
            
        ));
    }

   
}
