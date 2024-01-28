<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeacherAuthController extends Controller
{

    public function index() {
        return view('auth.teacher_register');
    }

    /**
    * Authenticate the Teacher.
    *
    * @param storeRegister $request
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
            // Set password and removed unused fields
            $register = $request->except('_token', 'confirmPassword');
            $register['password'] = Hash::make($request->password);

            // Create the Teacher
            Teacher::create($register);

            $credentials = $request->only('email', 'password');

            if (Auth::guard('teacher')->attempt($credentials)) {
                return redirect()->intended('/home');
            } else {
                return redirect()->back()->with('error', 'Some thing went wrong!');
            }

        } catch (\Throwable $th) {
            // throw $th;
            return back()->with('error', 'Something went wrong, Please try later!');
        }
    }


    public function showLoginForm()
    {
        return view('auth.teacher_login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::guard('teacher')->attempt($credentials)) {
            return redirect()->intended('/teacher/home');
        }

        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    

    public function logout()
    {
        Auth::guard('teacher')->logout();
        return redirect(url('/teacher/login'));
    }
}
