<?php

namespace App\Http\Controllers;
use App\Models\Donor;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    
    public function index()
    {  
        $donations = Donation::where('archive', 0)->get();
        $donors = Donor::all();
        
        return view('finances.donation', compact('donations','donors'));
    }

    public function print(Request $request)
    {  
        $validatedData = $request->validate([
            'yearmonth' => 'required',
        ]);
        
        $yearMonth = explode('-', $validatedData['yearmonth']); // Split "YYYY-MM"
        $year = $yearMonth[0]; // Get the year
        $month = $yearMonth[1]; // Get the month
        $donors = Donor::all();
        $donations = Donation::whereYear('created_at', $year)
                                       ->whereMonth('created_at', $month)
                                       ->get();
        
    
        return view('finances.donation_print', compact('donors','donations')); // ✅ Correct way
    }

    public function info($id)
    {  
        $donations = Donation::findOrFail($id);
        $donors = Donor::all();
        
        return view('finances.donation_info', compact('donations','donors'));
    }
    public function store(Request $request)
        {
            // Validate the request data
            $request->validate([
                'donorFirstName' => 'required|array',
                'donorFirstName.*' => 'required|string|max:255',
                'donorMiddleName.*' => 'nullable|string|max:255',
                'donorLastName.*' => 'required|string|max:255',
                'donorContactNo.*' => 'nullable|string|max:20',
                'donationType' => 'required|string|in:Cash,In-kind,Cash and In-kind',
                'cashAmount' => 'nullable|numeric',
                'inkindDetails' => 'nullable|string',
            ]);

            // Create the donation
            $donation = Donation::create([
                'type' => $request->donationType,
                'cash_amount' => $request->donationType === 'Cash' || $request->donationType === 'Cash and In-kind' ? $request->cashAmount : null,
                'inkind_details' => $request->donationType === 'In-kind' || $request->donationType === 'Cash and In-kind' ? $request->inkindDetails : null,
            ]);

            // Loop through each donor's details and save
            foreach ($request->donorFirstName as $index => $firstName) {
                $donation->donors()->create([
                    'first_name' => $firstName,
                    'middle_name' => $request->donorMiddleName[$index] ?? null,
                    'last_name' => $request->donorLastName[$index],
                    'contact_no' => $request->donorContactNo[$index] ?? null,
                ]);
            }

            return redirect()->back()->with('success', 'Donation record saved successfully!');
        }
        public function archive($id)
    {
        $donation = Donation::findOrFail($id);
        $donation->archive = 1;
        $donation->save();

        return redirect()->back()->with('success', 'Donation archived successfully.');
    }
}
