<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PembimbingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('adXkoor');

        return view('pembimbing.index', [
            'pembimbings' => User::where('level_id', 2)->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('adXkoor');

        return view('pembimbing.create', [
            'levels' => Level::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->authorize('adXkoor');

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

        Alert::success('Success!', 'Pembimbing Berhasil Ditambahkan');

        return redirect('/pembimbing');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pembimbing = User::find($id);

        return response()->json($pembimbing);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $this->authorize('adXkoor');

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
        $this->authorize('adXkoor');

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

        Alert::success('Success!', 'Pembimbing Berhasil Diupdate');

        return redirect('/pembimbing');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('adXkoor');

        User::destroy($id);

        Alert::success('Success!', 'Pembimbing Berhasil Dihapus');

        return redirect('/pembimbing');
    }
}
