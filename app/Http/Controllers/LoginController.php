<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $randomNumber = $request->session()->get('randomNumber');
            if (!$randomNumber) {
                $randomNumber = rand(1, 14);
                $request->session()->put('randomNumber', $randomNumber);
            }

            $user = auth()->user();

            session()->flash('login', [
                'title' => 'Welcome Back, ' . $user->name . '!',
                'text' => 'Have A Nice Day!',
                'image' => asset('assets/img/user/user-' . $randomNumber . '.jpg'),
                'time' => 2000
            ]);

            LogActivity::writeLog('User logged in.', 'info', $user->id, ['user_id' => $user->id,
                                                                'username' => $user->name,
                                                                ]);

            return redirect()->intended('/');
        }

        return back()->with('error', 'Login failed!');
    }


    public function logout()
    {
        $user = auth()->user();

        LogActivity::writeLog('User logged out.', 'info', $user->id, ['user_id' => $user->id,
                                                            'username' => $user->name,
                                                            ]);
        Session::forget('randomNumber');
        Auth::logout();
        return redirect('/login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
