<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Register Creaete Method
    public function register()
    {
        return view("auth.register");
    }

    // Register Store Method
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name'     => "required|string|max:255",
            'email'    => "required|string|email|max:255|unique:users",
            'phone'    => "required|string|max:20|unique:users",
            'password' => "required|string|min:8",
        ]);

        // Create a new user (assuming you have a User model)
        User::create([
            'name'     => $validatedData['name'],
            'email'    => $validatedData['email'],
            'phone'    => $validatedData['phone'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('login.create')->with('success', 'Registration successful. Please login.');

    }

    // Login Create Method
    public function loginCreate()
    {
        return view("auth.login");
    }

    // Login Method
    public function login(Request $request)
    {
        // Validate the incoming request data
        $credentials = $request->validate([
            'email'    => "required|string|email",
            'password' => "required|string",
        ]);
        // Attempt to find the user
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect to intended home page
            return redirect('/')->with('success', 'Login successful.');
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided email & password do not match our records.',
        ]);
    }

    // Logout Method
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully.');

    }
}
