<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_anggota = DB::table('anggota')->get();
return view ('admin.data_anggota', compact('data_anggota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.inputanggota');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'id_user'=>'nullable',
        ]);
        DB::table('anggota')->insert([
            'nama'=>$request->nama,
            'nis'=>$request->nis,
            'no_hp'=>$request->no_hp,
            'kelas'=>$request->kelas,

        ]);
        return redirect()->route('dataanggota')->with('info','data berhasil disimpan.!');
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
