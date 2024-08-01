<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CustomAuthController extends Controller
{
     // Show the registration form
     public function showRegistrationForm()
     {
         return view('auth.register');
     }

     // Handle registration
     public function register(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:users',
             'password' => 'required|string|min:5',
             'confirm_password' => 'required|string|same:password',
         ]);

         $user = User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password),
         ]);

        //  Auth::login($user);

         return redirect()->route('login')->with('message',"you have registered successfull");
     }

     // Show the login form
     public function showLoginForm()
     {
         return view('auth.login');
     }

     // Handle login
     public function login(Request $request)
     {
         $request->validate([
             'email' => 'required|string|email',
             'password' => 'required|string',
         ]);

         if (Auth::attempt($request->only('email', 'password'))) {
             return redirect()->route('home');
         }

         return back()->withErrors([
             'validate' => 'The provided credentials do not match our records.',
         ]);
     }

     // Handle logout
     public function logout(Request $request)
     {
         Auth::logout();
         return redirect('login');
     }
}
