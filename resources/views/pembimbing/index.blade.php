@extends('layouts.main')
@section('content')
    <div class="col-sm-12 col-xl-12">
        <h3 class="mb-4">Pembimbing</h3>

        <div class="bg-light rounded h-100 p-4">

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (auth()->user()->level_id === 3 || auth()->user()->level_id === 4)
                <div class="text-end mb-2">
                    <a href="/pembimbing/create" class="btn btn-sm btn-outline-primary ">Tambah <i
                            class="fa fa-plus"></i></a>
                </div>
            @endif

            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Nama Pembimbing</th>
                        <th scope="col">Email</th>
                        @if (auth()->user()->level_id === 3 || auth()->user()->level_id === 4)
                            <th scope="col">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if (count($pembimbings) !== 0)
                        @foreach ($pembimbings as $pembimbing)
                            <tr class="text-center">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $pembimbing->nama }}</td>
                                <td>{{ $pembimbing->email }}</td>
                                @if (auth()->user()->level_id === 3 || auth()->user()->level_id === 4)
                                    <td>
                                        <!-- Example single danger button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-dark"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-list"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#JudulView" data-id="{{ $pembimbing->id }}"><i
                                                            class="bi bi-search text-info"></i>
                                                        Show</button>
                                                </li>

                                                <li><a class="dropdown-item"
                                                        href="/pembimbing/{{ $pembimbing->id }}/edit"><i
                                                            class="bi bi-pencil-square text-warning"></i>
                                                        Update
                                                    </a></li>

                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>

                                                <li>
                                                    <form action="/pembimbing/{{ $pembimbing->id }}" method="POST">
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
            {{-- ajukan presentasi --}}
            @if (auth()->user()->level_id == 1 && count($status) >= 2)
                <a href="/presentasi" class="btn btn-sm btn-primary"><i class="bi bi-box-arrow-in-right"></i> Ajukan
                    Presentasi </a>
            @endif
        </div>

        <!-- Modal show -->
        <div class="modal fade" id="JudulView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="pembimbing" class="form-label">Pembimbing</label>
                                    <input type="text" id="pembimbing" class="form-control" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <input type="text" id="status" class="form-control" disabled>
                                    {{-- value="{{ $judul->status === 1 ? 'Disetujui' : 'Belum disetujui' }}"> --}}
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

<!-- resources/views/data/index.blade.php -->

<!-- Tambahkan ini di bagian bawah file blade template -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    // $(document).ready(function() {
    //     $('#JudulView').on('show.bs.modal', function(e) {
    //         var dataId = $(e.relatedTarget).data('id');

    //         // Lakukan AJAX request ke server
    //         $.ajax({
    //             url: '/judulprojek/' + dataId,
    //             type: 'GET',
    //             dataType: 'json',
    //             success: function(data) {
    //                 // Setel data ke dalam modal
    //                 $('#modalTitle').text(data.judul);
    //                 $('#modalDescription').text(data.deskripsi);
    //             },
    //             error: function(error) {
    //                 console.log(error);
    //             }
    //         });
    //     });
    // });
</script>
