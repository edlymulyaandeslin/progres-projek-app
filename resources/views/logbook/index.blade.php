@extends('layouts.main')
@section('content')
    <div class="col-sm-12 col-xl-12">
        <h3 class="mb-4">Log Book</h3>

        <div class="bg-light rounded h-100 p-4">

            <div class="d-flex justify-content-between">

                <div class="col-md-5">
                    <form action="/logbook">
                        <div class="input-group mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Search"
                                value="{{ request('search') }}" autofocus>
                            <button class="btn btn-outline-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>

                @if (auth()->user()->level_id === 1)
                    <div class="text-end mb-2">
                        <a href="/logbook/create" class="btn btn-sm btn-outline-primary ">Isi Logbook <i
                                class="fa fa-plus"></i></a>
                    </div>
                @endif
            </div>

            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        @if (auth()->user()->level_id !== 1)
                            <th scope="col">Mahasiswa</th>
                        @endif
                        <th scope="col">Judul</th>
                        <th scope="col">Description</th>
                        <th scope="col">Tanggal Bimbingan</th>
                        <th scope="col">Status</th>
                        @if (auth()->user()->level_id === 2)
                            <th scope="col">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if (count($logbooks) !== 0)
                        @foreach ($logbooks as $key => $logbook)
                            <tr class="text-center">

                                <th scope="row">{{ $logbooks->firstItem() + $key }}</th>
                                @if (auth()->user()->level_id !== 1)
                                    <td>{{ $logbook->nama }}</td>
                                @endif

                                @if (auth()->user()->level_id === 1)
                                    <td>{{ $logbook->judul->judul }}</td>
                                @else
                                    <td>{{ $logbook->judul }}</td>
                                @endif

                                <td>{{ $logbook->description }}</td>

                                <td>
                                    {{ \Carbon\Carbon::parse($logbook->created_at)->format('j F Y') }}
                                </td>

                                <td>
                                    <p
                                        class="px-1 bg-{{ $logbook->status == 'diterima' ? 'success' : ($logbook->status == 'ditolak' ? 'danger' : 'warning') }} rounded text-white">
                                        {{ $logbook->status }}
                                    </p>
                                </td>

                                @if (auth()->user()->level_id === 2)
                                    <td>
                                        <!-- Example single danger button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-dark"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-list"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0)" id="show-logbook"
                                                        data-url="{{ route('logbook.show', $logbook->id) }}"
                                                        class="dropdown-item"><i class="bi bi-search text-info"></i>
                                                        Show</a>
                                                </li>

                                                <li><a class="dropdown-item" href="/logbook/{{ $logbook->id }}/edit"><i
                                                            class="bi bi-pencil-square text-warning"></i>
                                                        Update
                                                    </a></li>

                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>

                                                <li>
                                                    <form action="/logbook/{{ $logbook->id }}" method="POST">
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
                <div class="pt-2">
                    Show
                    {{ $logbooks->firstItem() }}
                    to
                    {{ $logbooks->lastItem() }}
                    of
                    {{ $logbooks->total() }}
                    Entries
                </div>

                <div>
                    {{ $logbooks->links() }}
                </div>

                {{-- ajukan presentasi --}}
                @if (auth()->user()->level_id == 1 && $status->count() >= 2)
                    <div class="pt-1">
                        <a href="/presentasi" class="btn btn-sm btn-primary"><i class="bi bi-box-arrow-in-right"></i> Ajukan
                            Presentasi </a>
                    </div>
                @endif

            </div>

        </div>

        <!-- Modal show -->
        <div class="modal fade" id="logbookView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" id="judul" class="form-control" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea id="description" class="form-control" rows="4" disabled style="resize: none"></textarea>
                                </div>
                            </div>

                            <div class="col">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Bimbingan</label>
                                    <input type="text" id="tanggal" class="form-control" disabled>
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
            $('body').on('click', '#show-logbook', function() {

                let judulUrl = $(this).data('url');

                $.get(judulUrl, function(data) {
                    $('#logbookView').modal('show');

                    // format tanggal
                    let dateFromDatabase = new Date(data.created_at);

                    function formatTanggal(date) {
                        let options = {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        };
                        return date.toLocaleDateString('id-ID',
                            options); // Sesuaikan dengan preferensi lokal Anda
                    }
                    let formattedDate = formatTanggal(dateFromDatabase);

                    $('#judul').val(data.judul);
                    $('#tanggal').val(formattedDate);
                    $('#description').val(data.description);
                    $('#status').val(data.status);

                })
            })
        })
    </script>
@endsection
