<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Auth;
use Session;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use App\Rules\MatchOldPassword;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
            'locked',
            'unlock'
        ]);
    }
    /** index page login */
    public function login()
    {

        return view('auth.login');
    }

    /** login with databases */
    public function authenticate(Request $request)
{
    $request->validate([
        'email' => 'required|string',
        'password' => 'required|string',
    ]);

    DB::beginTransaction();

    try {
        $email = $request->email;
        $password = $request->password;

        // Check if the user is active
        $user = User::where('email', $email)
            ->first();

        if ($user) {
            if ($user->status === 'Active' && Auth::attempt(['email' => $email, 'password' => $password])) {
                // Authentication successful for an active user
                $user = Auth::user();
                Session::put('name', $user->name);
                Session::put('email', $user->email);
                Session::put('user_id', $user->id); // Use 'id' instead of 'user_id'
                Session::put('join_date', $user->join_date);
                Session::put('phone_number', $user->phone_number);
                Session::put('status', $user->status);
                Session::put('role_name', $user->role_name);
                Session::put('photo', $user->photo);
                Session::put('position', $user->position);
                Session::put('department', $user->department);
                Toastr::success('Login successfully :)', 'Success');
                DB::commit(); // Commit the transaction
                return redirect()->intended('accueil');
            } else {
                Toastr::error('Login failed. Your account is inactive or disabled :(', 'Error');
            }
        } else {
            Toastr::error('Login failed. Wrong username or password :(', 'Error');
        }

        return redirect('login');
    } catch (\Exception $e) {
        DB::rollBack(); // Rollback the transaction on error
        Toastr::error('Login failed :(', 'Error');
        return redirect()->back();
    }
}

    /** logout */
    public function logout(Request $request)
    {
        Auth::logout();
        // forget login session
        $request->session()->forget('name');
        $request->session()->forget('email');
        $request->session()->forget('user_id');
        $request->session()->forget('join_date');
        $request->session()->forget('phone_number');
        $request->session()->forget('status');
        $request->session()->forget('role_name');
        $request->session()->forget('photo');
        $request->session()->forget('position');
        $request->session()->forget('department');
        $request->session()->flush();

        Toastr::success('Logout successfully :)', 'Success');
        return redirect('login');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password'      => ['required', new MatchOldPassword],
            'new_password'          => ['required', 'min:8', 'different:current_password'],
            'new_confirm_password'  => ['required', 'same:new_password'],
        ]);

        try {
            // Get the authenticated user
            $user = Auth::user();

            // Update the user's password
            $user->update(['password' => Hash::make($request->new_password)]);

            Toastr::success('Password changed successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Failed to change password :(', 'Error');
            return redirect()->back();
        }
    }
}
