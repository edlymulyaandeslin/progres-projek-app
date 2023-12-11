@extends('layouts.main')
@section('content')
    <div class="col-sm-12 col-xl-6">
        <div class="bg-light rounded h-100 p-4">
            <h4 class="mb-4">Ajukan Presentasi</h4>

            <form action="/presentasi" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <select class="form-select form-select-sm mb-3 @error('judul_id') is-invalid @enderror" name="judul_id"
                        id="judul_id" aria-label=".form-select-sm example">
                        <option selected disabled>Pilih Judul</option>
                        @foreach ($juduls as $judul)
                            @if ($judul->status === 'diterima')
                                <option value="{{ $judul->id }}">{{ $judul->judul }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('judul_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal"
                        class="form-control @error('tanggal')
                        is-invalid
                    @enderror">
                    @error('tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jam" class="form-label">Jam</label>
                    <input type="time" name="jam" id="jam"
                        class="form-control @error('jam')
                        is-invalid
                    @enderror">
                    @error('jam')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select form-select-sm mb-3" name="status" id="status"
                        aria-label=".form-select-sm example">
                        <option selected disabled>Pilih Status</option>
                        <option value="diterima">Diterima</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div> --}}

                <button type="submit" class="btn btn-outline-primary">Tambah</button>
            </form>
        </div>
    </div>
@endsection
