<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserStatu;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function AllUsers()
    {
        $users = User::latest()->get();
        return view('users.all_users_list', compact('users'));
    }


    public function AddUser()
    {
        $user = User::latest()->get();
        return view('users.add_user', compact('user'));
       
    }

    public function ShowUser($id)
    {
        $user = User::findOrFail($id);
        return view('users.show_user', compact('users'));
    }

    // Store a new user
    public function StoreUser(Request $request)
    {
      // Validate the request data
      $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'nullable|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Modify image validation as needed
        'role' => 'required|string', // Validate role input
        'status' => 'required|string', // Validate status input
    ]);

    // Create a new user using the validated data
    $user = User::create([
        'name' => $validatedData['name'],
        'username' => $validatedData['username'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'photo' => null, // Handle photo upload separately if needed
        'role' => $validatedData['role'],
        'status' => $validatedData['status'],
    ]);

    // Save the Production record
    $user->save();
    // Redirect to a success page or return a response
    return redirect('/tous/users')->with('success', 'Production record created successfully');
    }

    public function EditUser($id)
    {
        // Find the user to edit by their ID
        $user = User::find($id);
    
        if (!$user) {
            // Handle case where the user is not found (e.g., show an error message or redirect)
            return redirect('/tous/users')->with('error', 'User not found');
        }
    
        // Load the edit view with the user data
        return view('users.edit_user', compact('user'));
    }

    // Update the edited user
    public function UpdateUser(Request $request, $id)
{
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'nullable|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id, // Ignore the current user's email for uniqueness validation
        'password' => 'nullable|string|min:8', // Allow password to be optional
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Modify image validation as needed
        'role' => 'required|string', // Validate role input
        'status' => 'required|string', // Validate status input
    ]);

    // Find the user to update by their ID
    $user = User::find($id);

    if (!$user) {
        // Handle case where the user is not found (e.g., show an error message or redirect)
        return redirect('/tous/users')->with('error', 'User not found');
    }

    // Update user data using the validated input
    $user->name = $validatedData['name'];
    $user->username = $validatedData['username'];
    $user->email = $validatedData['email'];

    // Check if a new password was provided and update it
    if (!empty($validatedData['password'])) {
        $user->password = Hash::make($validatedData['password']);
    }

    // Handle photo upload if needed
    // if ($request->hasFile('photo')) {
    //     // Handle photo upload logic here
    // }

    $user->role = $validatedData['role'];
    $user->status = $validatedData['status'];

    // Save the updated user record
    $user->save();

    // Redirect to a success page or return a response
    return redirect('/tous/users')->with('success', 'User updated successfully');
}
    public function DeleteUser($id)
    {
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return redirect('/tous/users')->with('error', 'User not found');
        }

        // Handle image deletion if the user has a photo
        if ($user->photo) {
            Storage::delete($user->photo); // Delete the user's photo from storage
        }

        // Delete the user
        $user->delete();

        // Redirect to a success page or return a response
        return redirect('/tous/users')->with('success', 'User deleted successfully');
    }
}
