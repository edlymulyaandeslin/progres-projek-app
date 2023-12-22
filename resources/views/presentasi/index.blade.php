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

                @if (count($status) >= 2 && auth()->user()->level_id === 1)
                    <div class="text-end mb-2">
                        <a href="/presentasi/create" class="btn btn-sm btn-outline-primary ">Ajukan Presentasi <i
                                class="fa fa-plus"></i></a>
                    </div>
                @endif
            </div>

            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        @if (auth()->user()->level_id !== 1)
                            <th scope="col">Ketua Tim</th>
                        @endif
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

                                @if (auth()->user()->level_id === 2)
                                    <td>{{ $present->nama }}</td>
                                @elseif (auth()->user()->level_id !== 1)
                                    <td>{{ $present->nama }}</td>
                                @endif

                                @if (auth()->user()->level_id == 1)
                                    <td>{{ $present->judul->judul }}</td>
                                @else
                                    <td>{{ $present->judul }}</td>
                                @endif

                                <td>
                                    <p
                                        class="px-1 bg-{{ $present->status == 'diterima' ? 'success' : ($present->status == 'ditolak' ? 'danger' : ($present->status == 'selesai' ? 'primary' : 'warning')) }} rounded text-white">
                                        {{ $present->status }}
                                    </p>
                                </td>

                                @if (auth()->user()->level_id === 3 || auth()->user()->level_id === 2)
                                    <td>
                                        <!-- Example single danger button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-dark"
                                                data-bs-toggle="dropdown" aria-expanded="false">
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
                                @endif

                                @if (auth()->user()->level_id == 1 || auth()->user()->level_id == 4)
                                    <td>
                                        <a href="javascript:void(0)" id="show-presentasi"
                                            data-url="{{ route('presentasi.show', $present->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye-fill"></i></a>
                                    </td>
                                @endif
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
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Congratulations Presentasi Anda Diterima
                            <i class="bi bi-star-fill text-warning"></i>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <p>
                                Jadwal Presentasi Anda
                            </p>
                            <table class="mx-2">
                                <tbody>
                                    <tr>
                                        <th>Ketua Tim</th>
                                        <td>:</td>
                                        <td id="ketua"></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td>:</td>
                                        <td id="tanggal"></td>
                                    </tr>
                                    <tr>
                                        <th>Jam</th>
                                        <td>:</td>
                                        <td id="jam"></td>
                                    </tr>
                                </tbody>
                            </table>
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
            $('body').on('click', '#show-presentasi', function() {

                let judulUrl = $(this).data('url');

                $.get(judulUrl, function(data) {
                    $('#presentView').modal('show');

                    if (data.status === 'diterima') {

                        // format tanggal
                        let dateFromDatabase = new Date(data.tanggal);

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

                        $('#ketua').text(data.nama);
                        $('#tanggal').text(formattedDate);
                        $('#jam').text(data.jam + ' WIB');
                    } else if (data.status === 'ditolak') {
                        $('.modal-title').text('Maaf Presentasi Ditolak');
                        $('.modal-body').html(
                            "<p class='text-center'>Silahkan Ajukan Presentasi Kembali!!</p>"
                        );
                    } else if (data.status === 'selesai') {
                        $('.modal-title').text('Selamat Presentasi Anda Telah Selesai');
                        $('.modal-body').html(
                            "<p class='text-center'>LULUS!!</p>" +
                            "<p class='text-center'><i class='bi bi-star-fill text-warning'></i> <i class='bi bi-star-fill text-warning'></i> <i class='bi bi-star-fill text-warning'> </i><i class='bi bi-star-fill text-warning'> </i><i class='bi bi-star-fill text-warning'></i></p>"
                        );
                    } else {
                        $('.modal-title').text('Presentasi Belum Diterima');
                        $('.modal-body').html(
                            "<p class='text-center'>Tidak Ada Jadwal Presentasi</p>");
                    }


                })
            })
        })
    </script>
@endsection
