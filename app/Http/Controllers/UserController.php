<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        // Handle the login logic here
        // For example, validate the request and authenticate the user

        return view('login');
    }


    public function register(Request $request)
    {
        // Handle the login logic here
        // For example, validate the request and authenticate the user

        return view('register');
    }


    public function adduser(Request $data)
  {
      // Validate the incoming request data
      $validated = $data->validate([
          'username' => 'required|string|max:255',
          'email'    => 'required|email|unique:users,email',
          'password' => 'required|string|min:8',
          'phone'    => 'required|numeric|digits_between:10,15',
          'address'  => 'required|string|max:500',
          'role'     => 'required|in:admin,viewer,creator',
      ], [
          // Optional: Custom error messages
          'username.required' => 'Please provide a username.',
          'email.required'    => 'The email address is required.',
          'email.unique'      => 'This email is already registered.',
          'phone.numeric'     => 'The phone number must be numeric.',
          'phone.digits_between' => 'The phone number must be between 10 and 15 digits.',
          'address.required'  => 'Please provide your address.',
        //  'role.required'  => 'Please choose role.',
      ]);
  
      // Create a new user
      $newuser = new User();
      $newuser->name = $validated['username'];
      $newuser->email = $validated['email'];
      $newuser->password = $validated['password']; // Hash the password
      $newuser->phone = $validated['phone'];
      $newuser->address = $validated['address'];
      $newuser->usertype = $validated['role']; // Default user type
    //  $newuser->role = $validated['role'];
  
      if ($newuser->save()) {
          return redirect('login')->with('success', 'Congratulations! Your account has been created.');
      }
  
      return redirect()->back()->with('error', 'Failed to create an account. Please try again.');
  }

  public function ulogin(Request $data)
     {
         // Validate the input
         $data->validate([
             'email'    => 'required|email',
             'password' => 'required|string|min:8',
         ], [
             'email.required'    => 'The email field is required.',
             'email.email'       => 'Please provide a valid email address.',
             'password.required' => 'The password field is required.',
             'password.min'      => 'The password must be at least 8 characters.',
         ]);
     
         // Attempt to retrieve the user with plain-text password (insecure, but matches your scenario)
         $user = User::where('email', $data->input('email'))
                     ->where('password', $data->input('password')) // Direct comparison (not hashed)
                     ->first();
     
         if ($user) {
             // Log the user in using Laravel's Auth facade
             Auth::login($user);
     
             $uid = Auth::id();
     
             // Insert login details into the Audit table
            //  DB::table('Audits')->insert([
            //      'user_id'    => $uid,
            //      'usertype'   => $user->usertype,
            //      'logindate'  => now()->toDateString(),
            //      'logintime'  => now()->toTimeString(),
            //      'logouttime' => null
            //  ]);
     
             // Redirect based on user type
             if ($user->usertype === 'viewer') {  
                 return redirect('/');
             } else if ($user->usertype === 'admin') {
                 return redirect('/adminview/dashboard');
             }
             else if ($user->usertype === 'creator') {
                 return redirect('/creatorview/dashboard');
             }
         } else {
             // Redirect back with an error message
             return redirect('login')->with('error', 'The provided credentials are incorrect.');
         }
     }


     function ulogout()
  {
      // Check if the user is logged in
      if (Auth::check()) {
          $user = Auth::user(); // Get the authenticated user
          
          // Update logout time in the Audit table
          // DB::table('Audits')
          // ->where('user_id', Auth::id()) // Check for the authenticated user's ID
          // ->whereNull('logouttime')      // Update only the last log entry with null logout time
          // ->update(['logouttime' => now()->toTimeString()]);
      
  
          // Log out the user and clear session
          Auth::logout(); // Laravel's built-in logout method
  
          session()->flush();  // Clear all session data
          
          return redirect('/login');  // Redirect after logout
      }
  
      // If the user is not logged in, just redirect
      return redirect('/login');
  }
     
}
