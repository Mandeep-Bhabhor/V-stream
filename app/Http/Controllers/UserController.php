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
}
