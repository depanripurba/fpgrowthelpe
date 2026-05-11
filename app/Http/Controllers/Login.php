<?php

namespace App\Http\Controllers;

use App\Models\Login as ModelsLogin;
use Illuminate\Http\Request;

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
       // 1. Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba login
        if (ModelsLogin::attempt($credentials)) {
            $request->session()->regenerate(); // Mencegah session fixation

            return redirect()->intended('dashboard');
        }

        // 3. Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // register a user
    public function register(){
        return view('register');
    }
    // insert to table
    public function registered(Request $request){
        ModelsLogin::create([
             'username'=>$request->username,
             'password'=>bcrypt($request->password)
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
