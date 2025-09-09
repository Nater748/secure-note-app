<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('front-end.login');
    }
    public function showRegisterForm()
    {
        return view('front-end.index');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

       $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // Validate and create user logic here
        return redirect('/login')->with('success',"registration complete");
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);
        
        $user = User::where('email',$request->email)->first();
        if($user && Hash::check($request->password,$user->password)){
            Auth::login($user);
            return redirect('/home')->with('success', 'Login Successful! Welcome');
        }
        return redirect('/login')->with('error', 'login failed Try again Later');
    }

    public function logout(Request $request)
    {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
    }
}
