<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acolyte;
use App\Models\CollectionRecord;
use App\Models\InKindCollection;


class CollectionController extends Controller
{
    public function index()
    {  
        $collections = CollectionRecord::where('archive', 0)->get();
        $acolytes = Acolyte::all();
        
        $inkinds = InKindCollection::all();
        return view('finances.collection', compact('acolytes','collections','inkinds'));
    }

    public function print(Request $request)
{  
    $validatedData = $request->validate([
        'yearmonth' => 'required',
    ]);
    $acolytes = Acolyte::all();
    $yearMonth = explode('-', $validatedData['yearmonth']); // Split "YYYY-MM"
    $year = $yearMonth[0]; // Get the year
    $month = $yearMonth[1]; // Get the month
    
    $collections = CollectionRecord::whereYear('created_at', $year)
                                   ->whereMonth('created_at', $month)
                                   ->get();
    

    return view('finances.collection_print', compact('collections','acolytes')); // ✅ Correct way
}


    public function info($id)
    {  
        $collections = CollectionRecord::findOrFail($id);

        $acolytes = Acolyte::all();
        $inkinds = InKindCollection::where('collection_record_id', $id)->get();
        return view('finances.collection_info', compact('acolytes','collections','inkinds'));
    }
    public function archive($id)
    {
        $collectionRecord = CollectionRecord::findOrFail($id);
        $collectionRecord->archive = 1;
        $collectionRecord->save();

        return redirect()->back()->with('success', 'Collection record archived successfully.');
    }

    public function store(Request $request)
    {
        // Enable query logging for debugging
        \DB::enableQueryLog();
    
        // Validate the request data
        $validatedData = $request->validate([
            'acolyteFirstName' => 'required|array',
            'acolyteFirstName.*' => 'required|string|max:255',
          
            'acolyteMiddleName.*' => 'nullable|string|max:255',
           
            'acolyteLastName.*' => 'required|string|max:255',
            'collectionDate' => 'required|date:Y-m-d',
            'startTime' => 'required|date_format:H:i',
            'endTime' => 'required|date_format:H:i',
            'inkindItems' => 'required|array',
            'inkindItems.*' => 'nullable|string|max:255',
          
            'inkindPieces.*' => 'nullable|integer|min:1',
            'moneyAmount' => 'nullable|numeric|min:0',
        ]);
    
        try {
            // Create collection record
            $collection = CollectionRecord::create([
                'collection_date' => $validatedData['collectionDate'],
                'start_time' => $validatedData['startTime'],
                'end_time' => $validatedData['endTime'],
                'money_amount' => $validatedData['moneyAmount'] ?? 0,
            ]);
    
            // Loop through each acolyte and save to related model
            foreach ($validatedData['acolyteFirstName'] as $index => $firstName) {
                $collection->acolytes()->create([
                    'first_name' => $firstName,
                    'middle_name' => $validatedData['acolyteMiddleName'][$index] ?? null,
                    'last_name' => $validatedData['acolyteLastName'][$index],
                ]);
            }
    
            // Initialize in-kind arrays if they don't exist
            $inkindItems = $validatedData['inkindItems'] ?? [];
            $inkindPieces = $validatedData['inkindPieces'] ?? [];
    
            // Loop through each in-kind item and save to related model
            foreach ($inkindItems as $index => $itemName) {
                $collection->in_kind_collections()->create([
                    'item_name' => $itemName,
                    'pieces' => $inkindPieces[$index] ?? 0,
                ]);
            }
    
            \Log::info(\DB::getQueryLog()); // Log queries
    
            return redirect()->back()->with('success', 'Collection record saved successfully.');
        } catch (\Exception $e) {
            \Log::error('Collection save failed: ' . $e->getMessage());
            \Log::info(\DB::getQueryLog()); // Log queries on failure too
            return redirect()->back()->with('error', 'Failed to save collection. Please try again.');
        }
    }

    public function destroy($id)
{
    $record = CollectionRecord::findOrFail($id); // Replace `BookRecord` with your actual model
    $record->delete(); // Permanently delete the record

    return redirect()->back()->with('success', 'Record successfully deleted.');
}
    
    
}
