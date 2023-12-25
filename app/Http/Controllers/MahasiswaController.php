<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Logbook;
use App\Models\Presentasi;
use App\Models\Judulprojek;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->authorize('!mahasiswa');

        if (auth()->user()->level_id == 2) {
            $user = DB::table('users')
                ->join('judulprojeks', 'judulprojeks.user_id', 'users.id')
                ->select('users.*', 'judulprojeks.pembimbing')
                ->where('pembimbing', auth()->user()->nama)
                ->paginate(10);

            return view('mahasiswa.index', [
                'mahasiswas' => $user
            ]);
        }

        return view('mahasiswa.index', [
            'mahasiswas' => User::where('level_id', 1)->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('adXkoor');

        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('adXkoor');

        $validateData = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'tempat_lahir' => 'required|min:5',
            'tanggal_lahir' => 'required',
            'alamat' => 'required|min:5',
            'agama' => 'required',
            'jenis_kelamin' => 'required',
            'pekerjaan' => 'required|min:5',
        ]);

        $validateData['password'] = bcrypt($validateData['password']);

        $validateData['level_id'] = 1;

        User::create($validateData);

        Alert::success('Success!', 'Mahasiswa Berhasil Ditambahkan');

        return redirect('/mahasiswa');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mahasiswa = User::with('judul')->find($id);

        return response()->json($mahasiswa);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('adXkoor');

        return view('mahasiswa.edit', [
            'mahasiswa' => User::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->authorize('adXkoor');

        $rules = [
            'nama' => 'required',
            'email' => 'required|email',
            'tempat_lahir' => 'required|min:5',
            'tanggal_lahir' => 'required',
            'alamat' => 'required|min:5',
            'agama' => 'required',
            'jenis_kelamin' =>  'required',
            'pekerjaan' => 'required|min:5',
            'status' => 'required'
        ];


        if ($request->input('password')) {
            $rules['password'] = 'required|min:8';
        }

        if ($request->input('tanggal_mulai')) {
            $rules['tanggal_mulai'] = 'required';
        }

        if ($request->input('tanggal_selesai')) {
            $rules['tanggal_selesai'] = 'required';
        }

        $validateData = $request->validate($rules);;

        if ($request->input('password')) {
            $validateData['password'] = bcrypt($request->input('password'));
        }

        if ($request->input('status') == 'deactive') {
            $validateData['email_verified_at'] = null;
        }

        User::where('id', $id)->update($validateData);

        Alert::success('Success!', 'Data Mahasiswa Berhasil Diperbarui');

        return redirect('/mahasiswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('adXkoor');

        User::destroy($id);

        Judulprojek::where('user_id', $id)->delete();

        Logbook::where('user_id', $id)->delete();

        Presentasi::where('user_id', $id)->delete();

        Alert::success('Success!', 'Data Mahasiswa Berhasil Dihapus');

        return redirect('/mahasiswa');
    }
}
