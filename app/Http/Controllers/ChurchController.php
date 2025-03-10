<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Member;
use App\Models\Volunteer;
use App\Models\CollectionRecord;
use App\Models\Donation;
use App\Models\Schedule;
use App\Models\Baptism_folder;
use App\Models\BookFolder;
use App\Models\BookRecord;
use App\Models\ConfirmationFolder;
use App\Models\ConfirmationRecord;
use App\Models\WeddingFolder;
use App\Models\WeddingRecord;
use App\Models\Funeral_folder;
use App\Models\FuneralRecord;
use Carbon\Carbon;
class ChurchController extends Controller
{
    public function index(){
        $payments = Payment::where('archive', 0)->get();

        $bookRecordsCount = BookRecord::where('archive', 0)->count();
        $confirmationRecordsCount = ConfirmationRecord::where('archive', 0)->count();
        $weddingRecordsCount = WeddingRecord::where('archive', 0)->count();
        $funeralRecordsCount = FuneralRecord::where('archive', 0)->count();
        $scheduleRecordsCount = Schedule::count();

        $DonationCashSum = Donation::where('archive', 0)->sum('cash_amount');
        
        $PaymentCashSum = Payment::where('archive', 0)->sum('amount');

        $today = Carbon::today()->toDateString();

        // Fetch schedules where today is between the start and end date
        $todayEvents = Schedule::whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->get();
       
    
        // Total records count
        $totalRecords = $bookRecordsCount + $confirmationRecordsCount + $weddingRecordsCount + $funeralRecordsCount;
        $memberRecordsCount = Member::where('archive', 0)->count();
        $volunteerRecordsCount = Volunteer::where('archive', 0)->count();


        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;


        $DonationMonth = Donation::where('archive', 0)
        ->whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)
        ->sum('cash_amount');

        $PaymentMonth = Payment::where('archive', 0)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('amount');

        $CollectionMonth = CollectionRecord::where('archive', 0)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('money_amount');

        return view('index', compact('payments','totalRecords','bookRecordsCount',
        'confirmationRecordsCount',
        'weddingRecordsCount',
        'funeralRecordsCount',
        'memberRecordsCount',
        'volunteerRecordsCount',
        'DonationCashSum',
        'scheduleRecordsCount',
        'PaymentCashSum',
        'DonationMonth',
        'PaymentMonth',
        'CollectionMonth',
        'todayEvents'));
    }
    public function baptism() {
        return view('record/baptism');
    }
    public function book() {
        return view('record/book');
    }
 
    public function confirmation() {
        return view('record/confirmation');
    }
    public function confirmation_record() {
        return view('record/confirmation_record');
    }
    public function wedding() {
        return view('record/wedding');
    }
    public function wedding_record() {
        return view('record/wedding_record');
    }
    public function funeral() {
        return view('record/funeral');
    }
    public function funeral_record() {
        return view('record/funeral_record');
    }
    
    public function member()  {
        return view('members/member');
    }
    public function volunteer()  {
        return view('members/volunteer');
    }
    public function collection()  {
        return view('finances/collection');
    }
    public function donation()  {
        return view('finances/donation');
    }
    public function payment()  {
        return view('finances/payment');
    }
    public function calendar() {
        return view('calendars/calendar');
    }
    public function archives()  {
        return view('archives/archives');
    }

    
       
}
