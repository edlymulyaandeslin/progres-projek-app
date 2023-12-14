<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use Illuminate\Http\Request;

class KoordinatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('koordinator.index', [
            'koordinators' => User::where('level_id', 3)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('koordinator.create', [
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

        return redirect('/koordinator')->with('success', 'Koordinator berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $koordinator = User::find($id);

        return response()->json($koordinator);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('koordinator.edit', [
            'koordinator' => User::find($id),
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

        return redirect('/koordinator')->with('success', 'Koordinator berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect('/koordinator')->with('success', 'Koordinator berhasil dihapus');
    }
}
