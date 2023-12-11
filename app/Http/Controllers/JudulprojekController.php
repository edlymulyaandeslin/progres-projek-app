<?php

namespace App\Http\Controllers;

use App\Models\Judulprojek;
use App\Http\Requests\StoreJudulprojekRequest;
use App\Http\Requests\UpdateJudulprojekRequest;
use App\Models\Logbook;
use App\Models\Presentasi;
use App\Models\User;
use Illuminate\Http\Request;

class JudulprojekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (auth()->user()->level_id === 4 || auth()->user()->level_id === 3) {
            return view('judulprojek.index', [
                'judulprojeks' => Judulprojek::all()
            ]);
        }

        return view('judulprojek.index', [
            'judulprojeks' => Judulprojek::where('user_id', auth()->user()->id)->get()
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

        $validateData['user_id'] = auth()->user()->id;

        Judulprojek::create($validateData);

        return redirect('/judulprojek')->with('success', 'Judul Berhasil Diajukan, mohon menunggu acc koordinator');

        // dd('nice');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $judulprojek = Judulprojek::find($id);
        $dataPembimbing = User::where('level_id', 2)->get();

        return view('judulprojek.edit', [
            'judulprojek' => $judulprojek,
            'users' => $dataPembimbing,
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

        return redirect('/judulprojek')->with('success', 'Judul Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Judulprojek::destroy($id);

        Logbook::where('judul_id', $id)->delete();

        Presentasi::where('judul_id', $id)->delete();

        return redirect('/judulprojek')->with('success', 'Judul berhasil dihapus');
    }
}
