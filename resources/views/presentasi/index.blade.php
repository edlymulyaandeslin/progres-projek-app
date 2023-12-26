@extends('layouts.main')
@section('content')
    <div class="col-sm-12 col-xl-12">
        <h3 class="mb-4">Presentasi</h3>

        <div class="bg-light rounded h-100 p-4">

            <div class="d-flex justify-content-between">

                <div class="col-md-5">
                    <form action="/presentasi">
                        <div class="input-group mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Search"
                                value="{{ request('search') }}" autofocus>
                            <button class="btn btn-outline-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>

                @can('mahasiswa')
                    @if (count($status) >= 2)
                        <div class="text-end mb-2">
                            <a href="/presentasi/create" class="btn btn-sm btn-outline-primary ">Ajukan Presentasi <i
                                    class="fa fa-plus"></i></a>
                        </div>
                    @endif
                @endcan

            </div>

            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        @can('!mahasiswa')
                            <th scope="col">Ketua Tim</th>
                        @endcan
                        <th scope="col">Judul</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($presents) !== 0)
                        @foreach ($presents as $key => $present)
                            <tr class="text-center">
                                <th scope="row">{{ $presents->firstItem() + $key }}</th>

                                @can('!mahasiswa')
                                    <td>{{ $present->nama }}</td>
                                @endcan

                                @can('mahasiswa')
                                    <td>{{ $present->judul->judul }}</td>
                                @endcan

                                @can('!mahasiswa')
                                    <td>{{ $present->judul }}</td>
                                @endcan

                                <td>
                                    <p
                                        class="px-1 bg-{{ $present->status == 'diterima' ? 'success' : ($present->status == 'ditolak' ? 'danger' : ($present->status == 'selesai' ? 'primary' : 'warning')) }} rounded text-white">
                                        {{ $present->status }}
                                    </p>
                                </td>

                                @can('pemXkoor')
                                    <td>
                                        <!-- Example single danger button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="bi bi-list"></i>
                                            </button>
                                            <ul class="dropdown-menu">

                                                <li>
                                                    <a href="javascript:void(0)" id="show-presentasi"
                                                        data-url="{{ route('presentasi.show', $present->id) }}"
                                                        class="dropdown-item"><i class="bi bi-search text-info"></i>
                                                        Show</a>
                                                </li>

                                                <li><a class="dropdown-item" href="/presentasi/{{ $present->id }}/edit"><i
                                                            class="bi bi-pencil-square text-warning"></i>
                                                        Update
                                                    </a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>

                                                <li>
                                                    <form action="/presentasi/{{ $present->id }}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Yakin ingin menghapus data ini?')"><i
                                                                class="bi bi-trash-fill text-danger"></i>
                                                            Delete</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                @endcan

                                @can('adXmah')
                                    <td>
                                        <a href="javascript:void(0)" id="show-presentasi"
                                            data-url="{{ route('presentasi.show', $present->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye-fill"></i></a>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">No Data</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            {{-- pagination --}}
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    Show
                    {{ $presents->firstItem() }}
                    to
                    {{ $presents->lastItem() }}
                    of
                    {{ $presents->total() }}
                    Entries
                </div>
                {{ $presents->links() }}
            </div>

        </div>

        <!-- Modal show -->
        <div class="modal fade" id="presentView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        {{--  --}}
                    </div>
                    <div class="modal-body">
                        {{-- --}}
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
            $('body').on('click', '#show-presentasi', function() {

                let judulUrl = $(this).data('url');

                let data = $.get(judulUrl, function(data) {
                    $('#presentView').modal('show');

                    if (data.status == 'diajukan') {
                        $('.modal-header').html(
                            `<h1 class="modal-title fs-5">Presentasi Belum Diterima
                            </h1>`
                        );

                        $('.modal-body').html(
                            "<p class='text-center'>Tidak Ada Jadwal Presentasi</p>");
                        console.log('diajukan');
                    }

                    if (data.status == 'diterima') {
                        console.log('diterima');
                        // format tanggal
                        let dateFromDatabase = new Date(data.tanggal);
                        var dayName = dateFromDatabase.toLocaleDateString('id-ID', {
                            weekday: 'long'
                        });


                        function formatTanggal(date) {
                            let options = {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            };
                            return date.toLocaleDateString('id-ID',
                                options);
                        }
                        let formattedDate = formatTanggal(dateFromDatabase);

                        $('.modal-header').html(
                            `<h1 class="modal-title fs-5">Congratulations Presentasi Anda Diterima
                            <i class="bi bi-star-fill text-warning"></i>
                            </h1>`
                        );

                        $('.modal-body').html(
                            `<div class="row">
                            <p>
                                Jadwal Presentasi Anda
                            </p>
                            <table class="mx-2">
                                <tbody>
                                    <tr>
                                        <th>Ketua Tim</th>
                                        <td>:</td>
                                        <td>${data.nama}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td>:</td>
                                        <td>${dayName}, ${formattedDate}</td>
                                    </tr>
                                    <tr>
                                        <th>Jam</th>
                                        <td>:</td>
                                        <td>${data.jam} WIB</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>`
                        );
                    }

                    if (data.status == 'ditolak') {
                        console.log('ditolak');
                        $('.modal-header').html(
                            `<h1 class="modal-title fs-5">Presentasi Ditolak
                            </h1>`
                        );
                        $('.modal-body').html(
                            "<p class='text-center'>Silahkan Ajukan Presentasi Kembali!!</p>"
                        );
                    }


                    if (data.status == 'selesai') {
                        console.log('selesai');

                        $('.modal-header').html(
                            `<h1 class="modal-title fs-5">Selamat Presentasi Anda Telah Selesai
                            </h1>`
                        );
                        $('.modal-body').html(
                            "<p class='text-center'>LULUS!!</p>" +
                            "<p class='text-center'><i class='bi bi-star-fill text-warning'></i> <i class='bi bi-star-fill text-warning'></i> <i class='bi bi-star-fill text-warning'> </i><i class='bi bi-star-fill text-warning'> </i><i class='bi bi-star-fill text-warning'></i></p>"
                        );
                    }
                })


            })
        })
    </script>
@endsection
