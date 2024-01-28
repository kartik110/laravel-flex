<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};

class StudentAuthController extends Controller
{

    public function index() {
        return view('auth.student_register');
    }

    public function showLoginForm()
    {
        return view('auth.student_login');
    }

        /**
    * Authenticate the Student.
    *
    * @param register $request
    */
    // public function create(storeRegister $request)
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name'            => 'required',
                'email'           => 'required',
                'password'        => 'required',
                'confirmPassword' => 'required|same:password'
            ]);

            $register = $request->except('_token', 'confirmPassword');
            $register['password'] = Hash::make($request->password);

            // Create the Student
            Students::create($register);

            $credentials = $request->only('email', 'password');

            if (Auth::guard('student')->attempt($credentials)) {
                return redirect()->intended('/home');
            } else {
                return redirect()->back()->with('error', 'Some thing went wrong!');
            }

        } catch (\Throwable $th) {
            // throw $th;
            return back()->with('error', 'Something went wrong, Please try later!');
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('email', 'password');
        // dd($credentials);

        // if (Auth::guard('student')->attempt($credentials)) {
        if (Auth::guard('student')->attempt($credentials)) {
            return redirect()->intended('/student/home'); // Redirect to the user dashboard
        }

        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect(url('/student/login'));
    }
}
