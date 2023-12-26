<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Logbook;
use App\Models\Presentasi;
use App\Models\Judulprojek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\confirm;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
                'judulprojeks' => Judulprojek::with('user')->latest()->filter(request(['search']))->paginate(5)->withQueryString()
            ]);
        }

        // mentor
        if (auth()->user()->level_id == 2) {
            return view('judulprojek.index', [
                'judulprojeks' => Judulprojek::with('user')->where('pembimbing', auth()->user()->nama)->latest()->filter(request(['search']))->paginate(5)->withQueryString()
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

        $this->authorize('mahasiswa');

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
        $this->authorize('mahasiswa');

        $validateData = $request->validate([
            'judul' => 'required',
            'pembimbing' => 'string',
            'status' => 'string'
        ]);

        $validateData['user_id'] = auth()->user()->id;

        Judulprojek::create($validateData);

        Alert::success('Success!', 'Judul Berhasil Diajukan, Mohon Menunggu Acc Koordinator');

        return redirect('/judulprojek');
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
        $this->authorize('koordinator');

        try {
            $judulprojek = Judulprojek::findOrFail($id);
            $dataPembimbing = User::where('level_id', 2)->get();

            return view('judulprojek.edit', [
                'judulprojek' => $judulprojek,
                'users' => $dataPembimbing,
            ]);
        } catch (ModelNotFoundException $error) {
            return view('errors.404');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {

        $this->authorize('koordinator');

        $validateData = $request->validate([
            'judul' => 'required',
            'pembimbing' => 'string',
            'status' => 'string'
        ]);

        Judulprojek::where('id', $id)->update($validateData);

        Alert::success('Success!', 'Judul Berhasil Diupdate');

        return redirect('/judulprojek');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $this->authorize('koordinator');

        Judulprojek::destroy($id);

        Logbook::where('judul_id', $id)->delete();

        Presentasi::where('judul_id', $id)->delete();

        Alert::success('Success!', 'Judul Berhasil Dihapus');

        return redirect('/judulprojek');
    }
}
