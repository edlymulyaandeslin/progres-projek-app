<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Logbook;
use App\Models\Presentasi;
use App\Models\Judulprojek;
use Illuminate\Http\Request;

class PresentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // admin
        if (auth()->user()->level_id === 4) {

            return view('presentasi.index', [
                'presents' => Presentasi::all(),
                'status' =>  Logbook::where('user_id', auth()->user()->id)->where('status', 'diterima')->get()
            ]);
        }

        // mentor
        if (auth()->user()->level_id === 2) {

            return view('presentasi.index', [
                'presents' => Presentasi::all(),
                'status' =>  Logbook::where('user_id', auth()->user()->id)->where('status', 'diterima')->get()
            ]);
        }

        // users / mahasiswa
        return view('presentasi.index', [
            'presents' => Presentasi::where('user_id', auth()->user()->id)->get(),
            'status' =>  Logbook::where('user_id', auth()->user()->id)->where('status', 'diterima')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('presentasi.create', [
            'juduls' => Judulprojek::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'judul_id' => 'required',
        ]);

        $validateData['user_id'] = auth()->user()->id;

        Presentasi::create($validateData);

        return redirect('/presentasi')->with('success', 'Presentasi telah diajukan, mohon menunggu konfirmasi pembimbing atau koordinator');
    }

    /**
     * Display the specified resource.
     */
    public function show(Presentasi $presentasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('presentasi.edit', [
            'present' => Presentasi::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'judul_id' => 'required',
            'tanggal' => 'required',
            'jam' => 'required',
            'status' => 'string'
        ]);

        Presentasi::where('id', $id)->update($validateData);

        return redirect('/presentasi')->with('success', 'Presentasi berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Presentasi::destroy($id);

        return redirect('/presentasi')->with('success', 'Presentasi berhasil di hapus');
    }
}
