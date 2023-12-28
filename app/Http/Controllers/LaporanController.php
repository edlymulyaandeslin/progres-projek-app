<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {

        $user = User::with(['judul' => function ($query) {
            $query->select('user_id', 'judul', 'status');
        }])->where('level_id', 1)
            ->latest()
            ->paginate(10);

        return view('report.index', [
            'mahasiswas' => $user
        ]);
    }

    public function cetakPdf(Request $request)
    {
        $tanggal_mulai = session('tanggal_mulai');
        $tanggal_selesai = session('tanggal_selesai');

        if ($tanggal_mulai != null || $tanggal_selesai != null) {
            $user = User::with(['judul' => function ($query) {
                $query->select('user_id', 'judul', 'status');
            }])
                ->whereBetween('tanggal_mulai', [$tanggal_mulai, $tanggal_selesai])
                ->whereBetween('tanggal_selesai', [$tanggal_mulai, $tanggal_selesai])
                ->where('level_id', 1)
                ->get();
        } else {
            $user = User::with(['judul' => function ($query) {
                $query->select('user_id', 'judul', 'status');
            }])
                ->where('level_id', 1)
                ->latest()
                ->get();
        }

        $data = [
            'users' => $user
        ];

        $pdf = Pdf::loadView('report.document', $data)->setPaper('A4', 'landscape');

        return $pdf->stream('document.pdf');
    }

    public function filter(Request $request)
    {
        $tanggal_mulai = $request->tanggal_mulai;
        $tanggal_selesai = $request->tanggal_selesai;

        session(['tanggal_mulai' => $tanggal_mulai]);
        session(['tanggal_selesai' => $tanggal_selesai]);

        if ($tanggal_mulai != null || $tanggal_selesai != null) {
            $user = User::with(['judul' => function ($query) {
                $query->select('user_id', 'judul', 'status');
            }])
                ->whereBetween('tanggal_mulai', [$tanggal_mulai, $tanggal_selesai])
                ->whereBetween('tanggal_selesai', [$tanggal_mulai, $tanggal_selesai])
                ->where('level_id', 1)
                ->paginate(10);
        } else {
            $user = User::with(['judul' => function ($query) {
                $query->select('user_id', 'judul', 'status');
            }])
                ->where('level_id', 1)
                ->paginate(10);
        }


        return view('report.index', [
            'mahasiswas' => $user
        ]);
    }
}
