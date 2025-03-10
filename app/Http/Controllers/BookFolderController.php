<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookFolder;
use App\Models\Baptism_folder;


class BookFolderController extends Controller
{
    public function store(Request $request)
{
    // Validate the input
    $request->validate([
        'book_number' => 'required|integer|min:1',
        'baptism_id' => 'required|integer|exists:baptismfolder,id', // Ensure baptism_id is valid
    ]);

    // Create new book record
    $book = new BookFolder();
    $book->book_number = $request->input('book_number');
    $book->baptism_id = $request->input('baptism_id'); // Include baptism_id
    $book->save();

    // Return success response with SweetAlert
    return response()->json([
        'success' => true,
        'message' => 'Book number added successfully!'
    ]);
}



    public function showByBaptism($baptism_id)
    {
        $baptismFolder = Baptism_folder::findOrFail($baptism_id);

        $books = BookFolder::where('baptism_id', $baptism_id)
        ->where('archive', 0)
        ->withCount('bookRecords') 
        ->get();
        
        return view('record/book', compact('books', 'baptismFolder'));
    }
    public function showByBaptismArchived($baptism_id)
    {
        $baptismFolder = Baptism_folder::findOrFail($baptism_id);

        $books = BookFolder::where('baptism_id', $baptism_id)

        ->withCount('bookRecords') 
        ->get();
        
        return view('record/book', compact('books', 'baptismFolder'));
    }

    public function archive($id)
{
    // Find the book folder record by ID and update the archive column
    $bookFolder = BookFolder::findOrFail($id);
    $bookFolder->archive = 1;
    $bookFolder->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Book folder moved to archive successfully.');
}
}