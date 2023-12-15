<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Logbook;
use App\Models\Presentasi;
use App\Models\Judulprojek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // admin
        if (auth()->user()->level_id === 4 || auth()->user()->level_id === 3) {

            $presents = DB::table('presentasis')
                ->join('judulprojeks', 'judulprojeks.id', 'presentasis.judul_id')
                ->join('users', 'users.id', 'presentasis.user_id')
                ->select('presentasis.*', 'judulprojeks.judul', 'judulprojeks.pembimbing', 'users.nama')
                ->where('judul', 'like', '%' . request('search') . '%')
                ->orWhere('nama', 'like', '%' . request('search') . '%')
                ->orWhere('tanggal', 'like', '%' . request('search') . '%')
                ->orWhere('jam', 'like', '%' . request('search') . '%')
                ->orWhere('presentasis.status', 'like', '%' . request('search') . '%')
                ->paginate(5)->withQueryString();

            return view('presentasi.index', [
                'presents' => $presents,
                'status' =>  Logbook::where('user_id', auth()->user()->id)->where('status', 'diterima')->get()
            ]);
        }

        // mentor
        if (auth()->user()->level_id === 2) {

            $presents = DB::table('presentasis')
                ->join('judulprojeks', 'judulprojeks.id', 'presentasis.judul_id')
                ->join('users', 'users.id', 'presentasis.user_id')
                ->select('presentasis.*', 'judulprojeks.judul', 'judulprojeks.pembimbing', 'users.nama')
                ->where('pembimbing', auth()->user()->nama)
                ->where('judul', 'like', '%' . request('search') . '%')
                ->orWhere('nama', 'like', '%' . request('search') . '%')
                ->orWhere('tanggal', 'like', '%' . request('search') . '%')
                ->orWhere('jam', 'like', '%' . request('search') . '%')
                ->orWhere('presentasis.status', 'like', '%' . request('search') . '%')
                ->paginate(5)->withQueryString();


            return view('presentasi.index', [
                'presents' => $presents,
                'status' =>  Logbook::where('user_id', auth()->user()->id)->where('status', 'diterima')->get()
            ]);
        }

        // users / mahasiswa
        return view('presentasi.index', [
            'presents' => Presentasi::where('user_id', auth()->user()->id)->filter(request(['search']))->paginate(5)->withQueryString(),
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
    public function show($id)
    {

        $present = DB::table('presentasis')
            ->join('judulprojeks', 'judulprojeks.id', 'presentasis.judul_id')
            ->join('users', 'users.id', 'judulprojeks.user_id')
            ->select('presentasis.*', 'users.nama')
            ->get();

        $present = $present->where('id', $id)->first();

        return response()->json($present);
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
