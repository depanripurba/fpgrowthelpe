<?php

namespace App\Http\Controllers;

use App\Models\Login as ModelsLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login');
    }

    public function Validasi_login(Request $request)
    {
        // 1. cari data dengan username di database
        $user = ModelsLogin::where('username', $request->username)->first();
        // 2. jika ada cek password
        if ($user != null) {
            if (Hash::check($request->password, $user->password)) {
                //   Password COCOK
                $request->session()->regenerate();
                Auth::login($user);
                return redirect()->intended('/');
            } else {
                // Password SALAH
                return back()->withErrors([
                    'email' => 'Password Salah',
                ])->withInput($request->only('username'));
            }
        } else {
            return back()->withErrors(['email' => 'Usertidak terdaftar'])->withInput($request->only('username'));
        }
    }

    // register a user
    public function register()
    {
        return view('register');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // insert to table
    public function registered(Request $request)
    {
        ModelsLogin::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        echo $request->username;
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
