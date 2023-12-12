<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;

class PembimbingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pembimbing.index', [
            'pembimbings' => User::where('level_id', 2)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('pembimbing.create', [
            'levels' => Level::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'level_id' => 'required',
            'email' => 'required|email|unique:users',
            'alamat' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'password' => 'required|min:8'
        ]);

        User::create($validateData);

        return redirect('/pembimbing')->with('success', 'Pembimbing berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('pembimbing.edit', [
            'pembimbing' => User::find($id),
            'levels' => Level::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'level_id' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
        ];

        if ($request->input('password')) {
            $rules['password'] = 'required|min:8';
        }

        $validateData = $request->validate($rules);

        if ($request->input('password')) {
            $validateData['password'] = bcrypt($request->input('password'));
        }

        User::where('id', $id)->update($validateData);

        return redirect('/pembimbing')->with('success', 'Pembimbing berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect('/pembimbing')->with('success', 'Pembimbing berhasil dihapus');
    }
}
