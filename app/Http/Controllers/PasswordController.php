<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    //reset password
    public function index()
    {
        return view('auth.passwords.reset');
    }
    
    public function conemail(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    $user = User::where('email', $request->email)->first();

    if ($user) {
        // Generate new OTP
        $newOtp = rand(1000, 9999);
        $user->update(['otp' => $newOtp]);

        // Pass data to the view instead of session
        return view('auth.sendotp', [
            'success' => 'OTP has been updated successfully!',
            'otp' => $newOtp,
            'email' => $request->email 
        ]);
    } else {
        return redirect()->back()->with('error', 'Email doesnt Exist');
    }
}

public function otpconfirm(Request $request){
    $request->validate([
        'emails' => 'required|email',
        'otp' => 'required',
    ]);

    // Find user by email (use $request->emails)
    $user = User::where('email', $request->emails)->first();

    // Check if user exists and OTP matches
    if ($user && $user->otp == $request->otp) {
        return view('auth.passwords.passchange', [
            'success' => 'Enter a New Password',
            'email' =>$request->emails
        ]);
    } else {
        return back()->with('error', 'Invalid OTP or email.');
    }
}

    public function changepass(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'pass' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        $user->update(['password' => $request->pass]);
        return redirect()->route('login')->with('success', 'Password changed successfully!');

    }

    public function login()
    {
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        // Clear all session data
        Session::flush();
    
        // Log the user out
        Auth::logout();
    
        // Set a flash message for SweetAlert
        return redirect('/login')->with('logout_success', 'You have been logged out successfully!');
    }
    

    
    
}
