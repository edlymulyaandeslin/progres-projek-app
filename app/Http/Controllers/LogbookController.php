<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Logbook;
use App\Models\Judulprojek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // mentor
        if (auth()->user()->level_id === 2) {
            $logbooks = DB::table('logbooks')
                ->join('judulprojeks', 'judulprojeks.id', 'logbooks.judul_id')
                ->join('users', 'users.id', 'logbooks.user_id')
                ->select('logbooks.*', 'judulprojeks.judul', 'judulprojeks.pembimbing', 'users.nama')
                ->where('pembimbing', auth()->user()->nama)
                ->where('judul', 'like', '%' . request('search') . '%')
                ->orWhere('nama', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('logbooks.created_at', 'like', '%' . request('search') . '%')
                ->orWhere('logbooks.status', 'like', '%' . request('search') . '%')
                ->latest();

            return view('logbook.index', [
                'logbooks' => $logbooks->paginate(5)->withQueryString(),
            ]);
        }

        // users / mahasiswa
        $logbooks = Logbook::latest()->filter(request(['search']))->where('user_id', auth()->user()->id)->paginate(5)->withQueryString();

        return view('logbook.index', [
            'logbooks' => $logbooks,
            'status' => Logbook::where('user_id', auth()->user()->id)->where('status', 'diterima')->get(),
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
    public function show($id)
    {
        $logbook = DB::table('logbooks')
            ->join('judulprojeks', 'judulprojeks.id', 'logbooks.judul_id')
            ->select('logbooks.*', 'judulprojeks.judul')
            ->get();

        $logbook = $logbook->where('id', $id)->first();

        return response()->json($logbook);
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
