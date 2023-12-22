<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function laporan()
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

    public function viewPdf()
    {
        $users = User::where('level_id', 1)->latest()->get();

        $data = [
            'users' => $users
        ];

        $pdf = Pdf::loadView('report.document', $data)->setPaper('A4', 'landscape');


        return $pdf->stream('document.pdf');
    }

    public function laporanFilter(Request $request)
    {
        $tanggal_mulai = $request->tanggal_mulai;
        $tanggal_selesai = $request->tanggal_selesai;

        $user = User::with(['judul' => function ($query) {
            $query->select('user_id', 'judul', 'status');
        }])
            ->whereDate('tanggal_mulai', '>=', $tanggal_mulai)
            ->whereDate('tanggal_selesai', '<=', $tanggal_selesai)
            ->where('level_id', 1)
            ->paginate(10);

        return view('report.index', [
            'mahasiswas' => $user
        ]);
    }
}
