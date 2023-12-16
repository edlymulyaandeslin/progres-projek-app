<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Logbook;
use App\Models\Presentasi;
use App\Models\Judulprojek;
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

        if (auth()->user()->level_id == 2) {
            $user = DB::table('users')
                ->join('judulprojeks', 'judulprojeks.user_id', 'users.id')
                ->select('users.*', 'judulprojeks.pembimbing')
                ->get();

            $user = $user->where('pembimbing', auth()->user()->nama);

            return view('mahasiswa.index', [
                'mahasiswas' => $user
            ]);
        }

        return view('mahasiswa.index', [
            'mahasiswas' => User::where('level_id', 1)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'tempat_lahir' => 'required|min:5',
            'tanggal_lahir' => 'required',
            'alamat' => 'required|min:5',
            'agama' => 'required',
            'jenis_kelamin' =>  'required',
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
        $mahasiswa = User::find($id);

        return response()->json($mahasiswa);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('mahasiswa.edit', [
            'mahasiswa' => User::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nama' => 'required',
            'email' => 'required|email',
            'tempat_lahir' => 'required|min:5',
            'tanggal_lahir' => 'required',
            'alamat' => 'required|min:5',
            'agama' => 'required',
            'jenis_kelamin' =>  'required',
            'pekerjaan' => 'required|min:5',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'status' => 'required'
        ];

        if ($request->input('password')) {
            $rules['password'] = 'required|min:8';
        }

        $validateData = $request->validate($rules);;

        if ($request->input('password')) {
            $validateData['password'] = bcrypt($request->input('password'));
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
        User::destroy($id);

        Judulprojek::where('user_id', $id)->delete();

        Logbook::where('user_id', $id)->delete();

        Presentasi::where('user_id', $id)->delete();

        Alert::success('Success!', 'Data Mahasiswa Berhasil Dihapus');

        return redirect('/mahasiswa');
    }
}
