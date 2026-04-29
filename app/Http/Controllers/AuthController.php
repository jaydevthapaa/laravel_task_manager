<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    //when user visit /register- show the register page
    public function showRegister(){
        return view('auth.register');
    }
    // when user submit the regiter form
    public function register(Request $request){
        // validate inputs
        $request-> validate([
            'name'=> 'required|max:100',
            'email'=> 'required|email| unique:users',
            'password'=> 'required| min:6 |confirmed'
        ]);
        // user in database
        $user= User::create(['name'=> $request->name,
                             'email'=> $request->email,
                             'password'=>Hash::make($request->password),
        ]);

        // log user in
        Auth::login($user);
        // send them to the task page
        return redirect()-> route('tasks.index');
    }

        public function showLogin(){
            return view('auth.login');
        
        }
        
        // when user submits login form
        public  function login(Request $request)
        {
            // validate inputs
            $request->validate([
                    'email'    => 'required|email',
                    'password' => 'required',
                ]);
            //  try to log in- if email and password match, show login succeeds
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            {
                $request->session()->regenerate(); // security step
                return redirect()->route('tasks.index');
            }
        return back()->withErrors([
            'email'=>'wrong email or password.',
        ]);
        }

        // when user click logout
        
        public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login');
        }
}

