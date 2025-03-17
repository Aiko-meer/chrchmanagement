<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
class PaymentController extends Controller
{


    public function index()
    {
        $payments = Payment::where('archive', 0)->get();
        return view('finances.payment', compact('payments'));
    }

    public function print(Request $request)
    {  
        $validatedData = $request->validate([
            'yearmonth' => 'required',
        ]);
        
        $yearMonth = explode('-', $validatedData['yearmonth']); // Split "YYYY-MM"
        $year = $yearMonth[0]; // Get the year
        $month = $yearMonth[1]; // Get the month
      
        $payments = Payment::whereYear('created_at', $year)
                                       ->whereMonth('created_at', $month)
                                       ->get();
        
    
        return view('finances.payment_print', compact('payments')); // ✅ Correct way
    }

    public function info($id)
    {
        $payments = Payment::findOrFail($id);
        return view('finances.payment_info', compact('payments'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_time' => 'required',
        ]);

            Payment::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'reason' => $request->reason,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'payment_time' => $request->payment_time,
        ]);

        return redirect()->back()->with('success', 'Payment recorded successfully.');
    }
    public function archive($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->archive = 1;
        $payment->save();

        return redirect()->back()->with('success', 'Payment archived successfully.');
    }
}
