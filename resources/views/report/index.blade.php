@extends('layouts.main')
@section('content')
    <div class="col-sm-12 col-xl-12">
        <h3 class="mb-4">Report Data Mahasiswa</h3>

        <div class="bg-light rounded h-100 p-4">

            <div class="container mb-3">

                <div class="row">
                    <div class="col-md-7">
                        <form action="/laporan/filter" method="get" class="d-flex gap-2">
                            @csrf
                            <div>
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control"
                                    id="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
                            </div>

                            <div>
                                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control"
                                    id="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
                            </div>

                            <div class="d-flex align-items-end">
                                <button class="btn btn-sm btn-primary" type="submit"><i class="bi bi-funnel-fill"></i>
                                    Filter</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-md d-flex align-items-end justify-content-end">
                        <a href="/laporan/downloadPdf" class="btn btn-sm btn-danger"><i class="bi bi-file-earmark-text"></i>
                            Cetak</a>
                    </div>
                </div>

            </div>

            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Judul Projek</th>
                        <th scope="col">Tanggal Mulai Magang</th>
                        <th scope="col">Tanggal Selesai Magang</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @if ($mahasiswas->count() != 0)
                        @foreach ($mahasiswas as $key => $mahasiswa)
                            <tr class="text-center">
                                <td>{{ $mahasiswas->firstItem() + $key }}</td>
                                <td>{{ $mahasiswa->nama }}</td>
                                <td>{{ $mahasiswa->email }}</td>

                                @if ($mahasiswa->judul->count() !== 0)
                                    @foreach ($mahasiswa->judul as $key => $judul)
                                        @if ($judul->status == 'diterima' && $key == 0)
                                            <td>{{ $judul->judul }}</td>
                                        @endif
                                    @endforeach
                                @else
                                    <td>{{ '-' }}</td>
                                @endif

                                <td>
                                    {{ $mahasiswa->tanggal_mulai ? \Carbon\Carbon::parse($mahasiswa->tanggal_mulai)->format('j F Y') : '-' }}
                                </td>

                                <td>
                                    {{ $mahasiswa->tanggal_selesai ? \Carbon\Carbon::parse($mahasiswa->tanggal_selesai)->format('j F Y') : '-' }}
                                </td>

                                <td>{{ $mahasiswa->status }}</td>
                                <td>
                                    <a href="javascript:void(0)" id="show-mahasiswa"
                                        data-url="{{ route('mahasiswa.show', $mahasiswa->id) }}"
                                        class="btn btn-sm btn-outline-primary"><i class="bi bi-eye-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td colspan="8" class="text-center">No Data</td>
                    @endif

                </tbody>
            </table>

            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    Show
                    {{ $mahasiswas->firstItem() }}
                    to
                    {{ $mahasiswas->lastItem() }}
                    of
                    {{ $mahasiswas->total() }}
                    Entries
                </div>
                {{ $mahasiswas->links() }}
            </div>
        </div>

        <!-- Modal show -->
        <div class="modal fade" id="mahasiswaView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="namaMahasiswa" class="form-label">Nama Mahasiswa</label>
                                    <input type="text" id="namaMahasiswa" class="form-control" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" id="tempat_lahir" class="form-control" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="text" id="tanggal_lahir" class="form-control" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="agama" class="form-label">Agama</label>
                                    <input type="text" id="agama" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" id="email" class="form-control" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                                    <input type="text" id="jenisKelamin" class="form-control" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control" rows="5" readonly></textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="tanggalMulai" class="form-label">Tanggal Mulai</label>
                                    <input type="text" id="tanggalMulai" class="form-control" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" id="judul" class="form-control" disabled>
                                </div>

                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="tanggalSelesai" class="form-label">Tanggal Selesai</label>
                                    <input type="text" id="tanggalSelesai" class="form-control" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <input type="text" id="status" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('body').on('click', '#show-mahasiswa', function() {

                let judulUrl = $(this).data('url');

                $.get(judulUrl, function(data) {
                    $('#mahasiswaView').modal('show');

                    // format tanggal
                    let tanggalLahirDb = new Date(data.tanggal_lahir);
                    let tanggalMulaiDb = new Date(data.tanggal_mulai);
                    let tanggalSelesaiDb = new Date(data.tanggal_selesai);

                    function formatTanggal(date) {
                        let options = {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        };
                        return date.toLocaleDateString('id-ID',
                            options);
                    }
                    let tanggalLahir = formatTanggal(tanggalLahirDb);
                    let tanggalMulai = formatTanggal(tanggalMulaiDb);
                    let tanggalSelesai = formatTanggal(tanggalSelesaiDb);

                    $('#namaMahasiswa').val(data.nama);
                    $('#tempat_lahir').val(data.tempat_lahir);
                    $('#tanggal_lahir').val(tanggalLahir);
                    $('#agama').val(data.agama);
                    $('#email').val(data.email);
                    $('#jenisKelamin').val(data.jenis_kelamin);
                    $('#alamat').val(data.alamat);
                    $('#status').val(data.status);

                    data.tanggal_mulai ? $('#tanggalMulai').val(tanggalMulai) : $(
                        '#tanggalMulai').val('-');
                    data.tanggal_selesai ? $('#tanggalSelesai').val(tanggalSelesai) : $(
                        '#tanggalSelesai').val('-');

                    const judul = $.map(data.judul, function(value) {
                        if (value.status == 'diterima') {
                            return value['judul']
                        }
                    });

                    $('#judul').val(judul[0] ? judul[0] : '-');
                })
            })



        })
    </script>
@endsection
