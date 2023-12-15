@extends('layouts.main')
@section('content')
    <div class="col-sm-12 col-xl-12">
        <h3 class="mb-4">List Judul Projek</h3>

        <div class="bg-light rounded h-100 p-4">

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between">
                <div class="col-md-5">
                    <form action="/judulprojek">
                        <div class="input-group mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Search"
                                value="{{ request('search') }}" autofocus>
                            <button class="btn btn-outline-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                @if (auth()->user()->level_id === 1)
                    <div class="">
                        <a href="/judulprojek/create" class="btn btn-sm btn-outline-primary ">Ajukan Judul <i
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
                        <th scope="col">Pembimbing</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($judulprojeks) !== 0)
                        @foreach ($judulprojeks as $judulprojek)
                            <tr class="text-center">
                                <th scope="row">{{ $loop->iteration }}</th>

                                @if (auth()->user()->level_id !== 1)
                                    <td>{{ $judulprojek->user->nama }}</td>
                                @endif

                                <td>{{ $judulprojek->judul }}</td>
                                <td>{{ $judulprojek->pembimbing ? $judulprojek->pembimbing : '-' }}</td>
                                <td>
                                    <p
                                        class="bg-{{ $judulprojek->status == 'diterima' ? 'success' : ($judulprojek->status == 'ditolak' ? 'danger' : 'warning') }} rounded text-white">

                                        {{ $judulprojek->status }}
                                    </p>
                                </td>
                                @if (auth()->user()->level_id === 3)
                                    <td>
                                        <!-- Example single danger button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-dark"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-list"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0)" id="show-judulprojek"
                                                        data-url="{{ route('judulprojek.show', $judulprojek->id) }}"
                                                        class="dropdown-item"><i class="bi bi-search text-info"></i>
                                                        Show</a>
                                                </li>

                                                <li><a class="dropdown-item"
                                                        href="/judulprojek/{{ $judulprojek->id }}/edit"><i
                                                            class="bi bi-pencil-square text-warning"></i>
                                                        Update
                                                    </a></li>

                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>

                                                <li>
                                                    <form action="/judulprojek/{{ $judulprojek->id }}" method="POST">
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
                                @else
                                    <td>
                                        <a href="javascript:void(0)" id="show-judulprojek"
                                            data-url="{{ route('judulprojek.show', $judulprojek->id) }}"
                                            class="btn btn-sm btn-outline-primary"><i class="bi bi-eye-fill "></i></a>
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
            <div class="d-flex justify-content-center">
                {{ $judulprojeks->links() }}
            </div>

        </div>
    </div>
    <!-- Modal show -->
    <div class="modal fade" id="judulView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                                <label for="mahasiswa" class="form-label">Nama Mahasiswa</label>
                                <input type="text" id="mahasiswa" class="form-control" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="pembimbing" class="form-label">Pembimbing</label>
                                <input type="text" id="pembimbing" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" id="judul" class="form-control" disabled>
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

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('body').on('click', '#show-judulprojek', function() {

                let judulUrl = $(this).data('url');
                $.get(judulUrl, function(data) {
                    $('#judulView').modal('show');
                    $('#judul').val(data.judul);
                    data.pembimbing !== '' ? $('#pembimbing').val(data.pembimbing) : $(
                        '#pembimbing').val('-');
                    $('#status').val(data.status);
                    $('#mahasiswa').val(data.nama);

                })
            })
        })
    </script>
@endsection
