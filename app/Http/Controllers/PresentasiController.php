<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Logbook;
use App\Models\Presentasi;
use App\Models\Judulprojek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
            ]);
        }


        $presents = Presentasi::with('judul')->where('user_id', auth()->user()->id)->filter(request(['search']))->paginate(5)->withQueryString();

        // users / mahasiswa
        return view('presentasi.index', [
            'presents' => $presents,
            'status' =>  Logbook::where('user_id', auth()->user()->id)->where('status', 'diterima')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $this->authorize('mahasiswa');

        return view('presentasi.create', [
            'juduls' => Judulprojek::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('mahasiswa');

        $validateData = $request->validate([
            'judul_id' => 'required',
        ]);

        $validateData['user_id'] = auth()->user()->id;

        Presentasi::create($validateData);

        Alert::success('Success!', 'Presentasi Telah Diajukan, Mohon Menunggu Konfirmasi Pembimbing atau Koordinator');

        return redirect('/presentasi');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $present = DB::table('presentasis')
            ->join('users', 'users.id', 'presentasis.user_id')
            ->select('presentasis.*', 'users.nama')
            ->where('presentasis.id', $id)
            ->first();

        return response()->json($present);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('pemXkoor');
        try {
            return view('presentasi.edit', [
                'present' => Presentasi::findOrFail($id)
            ]);
        } catch (ModelNotFoundException $error) {
            return view('errors.404');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize('pemXkoor');

        $rules = [
            'judul_id' => 'required',
            'status' => 'string'
        ];

        if ($request->input('tanggal')) {
            $rules['tanggal'] = 'required';
        }

        if ($request->input('jam')) {
            $rules['jam'] = 'required';
        }

        $validateData = $request->validate($rules);

        Presentasi::where('id', $id)->update($validateData);

        Alert::success('Success!', 'Presentasi Berhasil diupdate');

        return redirect('/presentasi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('pemXkoor');

        Presentasi::destroy($id);

        Alert::success('Success!', 'Presentasi Berhasil dihapus');


        return redirect('/presentasi');
    }
}
