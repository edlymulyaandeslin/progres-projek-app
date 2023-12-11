<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Logbook;
use App\Models\Judulprojek;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // admin
        if (auth()->user()->level_id === 4) {
            return view('logbook.index', [
                'logbooks' => Logbook::all()
            ]);
        }

        // mentor
        if (auth()->user()->level_id === 2) {
            return view('logbook.index', [
                'logbooks' => Logbook::all()
            ]);
        }

        // users / mahasiswa
        $logbooks = Logbook::where('user_id', auth()->user()->id)->get();
        $logbookStatus = $logbooks->where('status', 'diterima');

        return view('logbook.index', [
            'logbooks' => $logbooks,
            'status' => $logbookStatus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('logbook.create', [
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
            'description' => 'required',
            'status' => 'string'
        ]);

        $validateData['user_id'] = auth()->user()->id;

        Logbook::create($validateData);

        return redirect('/logbook')->with('success', 'Log book berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Logbook $logbook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('logbook.edit', [
            'logbook' =>  Logbook::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'judul_id' => 'required',
            'description' => 'required',
            'status' => 'string'
        ]);

        Logbook::where('id', $id)->update($validateData);

        return redirect('/logbook')->with('success', 'Log book berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Logbook::destroy($id);

        return redirect('/logbook')->with('success', 'Log book berhasil dihapus');
    }
}
