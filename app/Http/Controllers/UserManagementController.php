<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;


class UserManagementController extends Controller
{
    // index page
    public function index()
    {
        $users = User::all();
        return view('usermanagement.list_users',compact('users'));
    }
    public function userAdd()
    {
        $roles = DB::table('role_type_users')->get();
        $user = User::latest()->get();
        return view('usermanagement.add_user', compact('user', 'roles'));
       
    }
   
    
    /** user store  */

    public function userStore(Request $request)
{
    // Validate the request data
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'role_name' => 'required',
        'password' => 'required|min:8',
    ]);

    try {
        // Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_name' => $request->role_name,
            'password' => bcrypt($request->password),
        ]);

        Toastr::success('User added successfully :)', 'Success');
        return redirect('liste/utilisateurs');
    } catch (\Exception $e) {
        Toastr::error('User add fail :)', 'Error');
        return redirect()->back();
    }
}
   
    /** user view */
    public function userView($id)
    {
        $users = User::where('user_id',$id)->first();
        return view('usermanagement.user_update',compact('users',));
    }

    /** user Update */
    public function userUpdate(Request $request)
    {
        DB::beginTransaction();
    
        try {
            if (Session::get('role_name') === 'Super Admin') {
                $user_id = $request->user_id;
                $name = $request->name;
                $email = $request->email;
                $role_name = $request->role_name;
                $position = $request->position;
                $phone = $request->phone_number;
                $department = $request->department;
                $status = $request->status;
    
                $update = [
                    'user_id' => $user_id,
                    'name' => $name,
                    'role_name' => $role_name,
                    'email' => $email,
                    'position' => $position,
                    'phone_number' => $phone,
                    'department' => $department,
                    'status' => $status,
                ];
    
                User::where('user_id', $request->user_id)->update($update);
            } else {
                Toastr::error('User update fail :)', 'Error');
            }
    
            DB::commit();
            Toastr::success('User updated successfully :)', 'Success');
            return redirect('liste/utilisateurs');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('User update fail :)', 'Error');
            return redirect()->back();
        }
    }

   
    
    /** user delete */
    public function userDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            if (Session::get('role_name') === 'Super Admin')
            {
                if ($request->photo =='photo_defaults.jpg')
                {
                    User::destroy($request->user_id);
                } else {
                    User::destroy($request->user_id);
                    unlink('images/'.$request->photo);
                }
            } else {
                Toastr::error('User deleted fail :)','Error');
            }

            DB::commit();
            Toastr::success('User deleted successfully :)','Success');
            return redirect()->back();
    
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('User deleted fail :)','Error');
            return redirect()->back();
        }
    }

    /** change password */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password'     => ['required', new MatchOldPassword],
            'new_password'         => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        DB::commit();
        Toastr::success('User change successfully :)','Success');
        return redirect()->intended('accueil');
    }


// ==================
    public function profileUpdateForm()
    {
        // Fetch the user data as needed
        $id = Auth::user()->id;
        $users = User::find($id);// Assuming you're using Laravel's built-in authentication

        // Pass the user data to the view
        return view('dashboard.profile', compact('users'));
    }

  /** Update User Profile */
  public function updateProfile(Request $request)
  {
      DB::beginTransaction();
  
      try {
          // Get the current user
          $id = Auth::user()->id;
          $data = User::find($id);
  
          // Update user profile data
          $data->name = $request->name;
          $data->email = $request->email;
          $data->position = $request->position;
          $data->phone_number = $request->phone_number;
          $data->department = $request->department;
  
          // Handle photo upload
          if ($request->file('photo')) {
              $file = $request->file('photo');
  
              // Delete the existing photo file if it exists
              if ($data->photo) {
                  @unlink(public_path('upload/admin_images/' . $data->photo));
              }
  
              // Generate a unique filename based on the current date and time
              $filename = date('YmdHi') . $file->getClientOriginalName();
  
              // Move the uploaded file to the designated directory
              $file->move(public_path('upload/admin_images'), $filename);
  
              // Update the user's photo field in the database
              $data->photo = $filename;
          }
  
          // Save the user model
          $data->save();
  
          // Commit the transaction
          DB::commit();
  
          // Display success message and redirect
          Toastr::success('Profile updated successfully :)', 'Success');
          return redirect('user/profile/page');
      } catch (\Exception $e) {
          // Rollback the transaction in case of an exception
          DB::rollback();
  
          // Display error message and redirect back
          Toastr::error('Profile update failed :(', 'Error');
          return redirect()->back();
      }
  }
}
