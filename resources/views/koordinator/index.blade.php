@extends('layouts.main')
@section('content')
    <div class="col-sm-12 col-xl-12">
        <h3 class="mb-4">Koordinator</h3>

        <div class="bg-light rounded h-100 p-4">

            @if (auth()->user()->level_id === 3 || auth()->user()->level_id === 4)
                <div class="text-end mb-2">
                    <a href="/koordinator/create" class="btn btn-sm btn-outline-primary ">Tambah <i class="fa fa-plus"></i></a>
                </div>
            @endif

            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Nama Koordinator</th>
                        <th scope="col">Email</th>
                        @if (auth()->user()->level_id === 3 || auth()->user()->level_id === 4)
                            <th scope="col">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if (count($koordinators) !== 0)
                        @foreach ($koordinators as $koordinator)
                            <tr class="text-center">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $koordinator->nama }}</td>
                                <td>{{ $koordinator->email }}</td>
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
                                                    <a href="javascript:void(0)" id="show-koordinator"
                                                        data-url="{{ route('koordinator.show', $koordinator->id) }}"
                                                        class="dropdown-item"><i class="bi bi-search text-info"></i>
                                                        Show</a>
                                                </li>

                                                <li><a class="dropdown-item"
                                                        href="/koordinator/{{ $koordinator->id }}/edit"><i
                                                            class="bi bi-pencil-square text-warning"></i>
                                                        Update
                                                    </a></li>

                                                <li>
                                                    <form action="/koordinator/{{ $koordinator->id }}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Yakin ingin menghapus data ini?')"><i
                                                                class="bi bi-trash-fill text-danger"></i>
                                                            Delete</button>
                                                    </form>
                                                </li>

                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>

                                                <li>
                                                    @if ($koordinator->email_verified_at)
                                                        <p class="dropdown-item text-primary">{{ __('Account Verified') }}
                                                        </p>
                                                    @else
                                                        <form method="POST"
                                                            action="/email/verification-notification/{{ $koordinator->id }}">
                                                            @csrf
                                                            <button type="submit"
                                                                class="dropdown-item text-primary">{{ __('Send Verified Email') }}</button>.
                                                        </form>
                                                    @endif
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
        </div>

        <!-- Modal show -->
        <div class="modal fade" id="koordinatorView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
            $('body').on('click', '#show-koordinator', function() {

                let judulUrl = $(this).data('url');

                $.get(judulUrl, function(data) {
                    $('#koordinatorView').modal('show');

                    // format tanggal
                    let tanggalLahirDb = new Date(data.tanggal_lahir);

                    function formatTanggal(date) {
                        let options = {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        };
                        return date.toLocaleDateString('id-ID',
                            options); // Sesuaikan dengan preferensi lokal Anda
                    }
                    let tanggalLahir = formatTanggal(tanggalLahirDb);

                    console.log(data)
                    $('#namaMahasiswa').val(data.nama);
                    $('#tempat_lahir').val(data.tempat_lahir);
                    $('#tanggal_lahir').val(tanggalLahir);
                    $('#agama').val(data.agama);
                    $('#email').val(data.email);
                    $('#jenisKelamin').val(data.jenis_kelamin);
                    $('#alamat').val(data.alamat);
                    $('#status').val(data.status);



                })
            })
        })
    </script>
@endsection
