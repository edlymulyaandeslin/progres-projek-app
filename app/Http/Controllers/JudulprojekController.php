<?php

namespace App\Http\Controllers;

use App\Models\Judulprojek;
use App\Http\Requests\StoreJudulprojekRequest;
use App\Http\Requests\UpdateJudulprojekRequest;
use App\Models\User;
use Illuminate\Http\Request;

class JudulprojekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $judulprojeks = Judulprojek::all();
        return view('judulprojek.index', [
            'judulprojeks' => $judulprojeks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pembimbing = User::where('level_id', 2)->get();
        return view('judulprojek.create', [
            'pembimbing' => $pembimbing
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'judul' => 'required',
            'pembimbing' => 'string',
            'status' => 'string'
        ]);

        $validateData['user_id'] = 1;

        Judulprojek::create($validateData);

        return redirect('/judulprojek')->with('success', 'Data Berhasil Ditambahkan');

        // dd('nice');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $judulprojek = Judulprojek::find($id);

        return response()->json($judulprojek);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $judulprojek = Judulprojek::find($id);
        $dataUser = User::where('level_id', 2)->get();

        return view('judulprojek.edit', [
            'judulprojek' => $judulprojek,
            'users' => $dataUser,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {

        $validateData = $request->validate([
            'judul' => 'required',
            'pembimbing' => 'string',
            'status' => 'string'
        ]);

        Judulprojek::where('id', $id)->update($validateData);

        return redirect('/judulprojek')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Judulprojek::destroy($id);

        return redirect('/judulprojek')->with('success', 'Data berhasil dihapus');
    }
}
