<?php
use Illuminate\Http\Request;
use App\Models\Baptism_folder;
use Illuminate\Support\Facades\Route;

// Route to check if the record exists
Route::get('/check-year-month', function (Request $request) {
    $year = $request->query('year');
    $month = $request->query('month');

    $exists = Baptism_folder::where('year', $year)->where('month', $month)->exists();

    return response()->json(['exists' => $exists]);
});

// Route to add a new record
Route::post('/add-year', function (Request $request) {
    $request->validate([
        'year' => 'required|integer',
        'month' => 'required|string'
    ]);

    // Prevent direct duplicate entry (double-check)
    $exists = Baptism_folder::where('year', $request->year)
                            ->where('month', $request->month)
                            ->exists();

    if ($exists) {
        return response()->json(['success' => false, 'message' => 'Record already exists.']);
    }

    $baptism = new Baptism_folder();
    $baptism->year = $request->year;
    $baptism->month = $request->month;
    $baptism->save();

    return response()->json(['success' => true, 'message' => 'Year added successfully!']);
});
