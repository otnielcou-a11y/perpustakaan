<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buku;
use DB;
use Hash;
use Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    return view('login');

    }

     public function autentikasi(Request $request){
        $request->validate([
            'email' =>'required',
            'password'=>'required',
            'role'=>'required'
        ]);
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password], true )){
            if($request->role == 'siswa'){
                return redirect()->route('siswa_dashboard');
            } elseif($request->role == 'admin'){
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->with('info','anda login sebagai '.$request->role);
            }
        }else{
            return redirect()->route('login')->with('info','Anda belum daftar atau username dan password anda salah');
        }
        }

    public function registrasi()
    {

    return view('registrasi');

    }
public function simpanregistrasi(Request $request){
    $request->validate([
        'nama' => 'required', // Sesuaikan dengan name="nama" di HTML
        'username' => 'required|unique:users,email', // Gunakan username sebagai email atau tambah field email
        'password' => 'required|min:6',
        'password_confirmation' => 'required|same:password' // Laravel standarnya pakai password_confirmation
    ]);

    $user = new User;
    $user->name = trim($request->nama);
    $user->email = trim($request->username); // Jika di DB kolomnya email, masukkan username ke sini
    $user->password = Hash::make($request->password);
    $user->role = 'siswa'; // Set default role karena di form tidak ada pilihan role
    $user->save();

    return redirect()->route('login')->with('info','Anda sudah terdaftar!');
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

     public function logout(){
Auth::logout();
return redirect()->route('login')->with('info','terima kasih sudah menggunakan aplikasi
ini!');
}
}
