<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get(); // Exclude the logged-in user
    
        return view('members.user', ['users' => $users]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'type' => 'required|integer',
        ], [
            'name.unique' => 'This name is already taken. Please choose a different one.',
            'email.unique' => 'This email is already registered. Try logging in instead.',
        ]);
        
    
        // Create the user if validation passes
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
            'type' => $request->type,
            'otp' => '0000',
        ]);
    
        return redirect()->back()->with('success', 'User created successfully!');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required', 
            'email' => 'required|email',
            'password' => 'nullable|min:8', // Password is optional but must be at least 8 characters if provided
            'type' => 'required|integer',
        ]);
    
        // Find user by ID
        $user = User::findOrFail($id);
    
        // Update user details
        $user->name = $request->name;
        $user->email= $request->email;
        $user->type = $request->type;
    
        // Check if password is provided, then update it
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
    
        $user->save();
    
        return redirect()->back()->with('success', 'User updated successfully!');
    }
    

public function destroy($id)
{
    $record = User::findOrFail($id); // Replace `BookRecord` with your actual model
    $record->delete(); // Permanently delete the record

    return redirect()->back()->with('success', 'Record successfully deleted.');
}

}
