<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookRecord;
use App\Models\ConfirmationRecord;
use App\Models\WeddingRecord;
use App\Models\FuneralRecord;


class AllrecordController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        // Search Baptism Records
        $baptism = BookRecord::where('child_first_name', 'LIKE', "%$search%")
            ->orWhere('child_middle_name', 'LIKE', "%$search%")
            ->orWhere('child_last_name', 'LIKE', "%$search%")
            ->get();
    
        // Search Confirmation Records
        $confirmation = ConfirmationRecord::where('child_first_name', 'LIKE', "%$search%")
            ->orWhere('child_middle_name', 'LIKE', "%$search%")
            ->orWhere('child_last_name', 'LIKE', "%$search%")
            ->get();
    
        // Search Wedding Records
        $wedding = WeddingRecord::where('groom_first_name', 'LIKE', "%$search%")
            ->orWhere('groom_middle_name', 'LIKE', "%$search%")
            ->orWhere('groom_last_name', 'LIKE', "%$search%")
            ->orWhere('bride_first_name', 'LIKE', "%$search%")
            ->orWhere('bride_middle_name', 'LIKE', "%$search%")
            ->orWhere('bride_last_name', 'LIKE', "%$search%")
            ->get();

        
    
        return view('allrecords.allrecord', compact('baptism', 'confirmation', 'wedding', 'search',));
    }
    
}
