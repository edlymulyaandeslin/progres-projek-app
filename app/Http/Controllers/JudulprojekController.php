<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Logbook;
use App\Models\Presentasi;
use App\Models\Judulprojek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreJudulprojekRequest;
use App\Http\Requests\UpdateJudulprojekRequest;

class JudulprojekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // admin dan koordinator
        if (auth()->user()->level_id === 4 || auth()->user()->level_id === 3) {
            return view('judulprojek.index', [
                'judulprojeks' => Judulprojek::latest()->filter(request(['search']))->paginate(5)->withQueryString()
            ]);
        }

        // mentor
        if (auth()->user()->level_id == 2) {
            return view('judulprojek.index', [
                'judulprojeks' => Judulprojek::where('pembimbing', auth()->user()->nama)->latest()->filter(request(['search']))->paginate(5)->withQueryString()
            ]);
        }

        // mahasiswa
        return view('judulprojek.index', [
            'judulprojeks' => Judulprojek::where('user_id', auth()->user()->id)->latest()->filter(request(['search']))->paginate(5)->withQueryString()
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
        $judulprojek = DB::table('judulprojeks')
            ->join('users', 'users.id', 'judulprojeks.user_id')
            ->select('judulprojeks.*', 'users.nama')
            ->get();

        $judulprojek = $judulprojek->where('id', $id)->first();

        return response()->json($judulprojek);
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
