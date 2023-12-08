<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Http\Requests\StoreLogbookRequest;
use App\Http\Requests\UpdateLogbookRequest;
use App\Models\Judulprojek;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('logbook.index', [
            'logbooks' => Logbook::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('logbook.create', [
            'juduls' => Judulprojek::all()
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
        ]);
        $validateData['user_id'] = 1;

        Logbook::create($validateData);

        return redirect('/logbook')->with('success', 'Log book berhasil ditambahkan');
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
        $validateData['user_id'] = 1;

        Logbook::where('id', $id)->update($validateData);

        return redirect('/logbook')->with('success', 'Log book berhasil diubah');
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
