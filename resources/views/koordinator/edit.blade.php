@extends('layouts.main')
@section('content')
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light rounded h-100 p-4">
            <h4 class="mb-4">Update Data Pembimbing</h4>

            <form action="/koordinator/{{ $koordinator->id }}" method="post">
                @method('put')
                @csrf
                <div class="row">

                    <div class="col">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" value="{{ old('nama', $koordinator->nama) }}">
                            @error('nama')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                id="tempat_lahir" name="tempat_lahir"
                                value="{{ old('tempat_lahir', $koordinator->tempat_lahir) }}">
                            @error('tempat_lahir')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                id="tanggal_lahir" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir', $koordinator->tanggal_lahir) }}">
                            @error('tanggal_lahir')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis kelamin</label>
                            <div class="form-check d-flex gap-3">
                                @if (old('jenis_kelamin', $koordinator->jenis_kelamin) == 'laki-laki')
                                    <div class="m-2">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="jenis_kelamin" value="laki-laki" checked>
                                        <label class="form-check-label" for="jenis_kelamin">
                                            Laki Laki
                                        </label>
                                    </div>
                                    <div class="m-2">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="jenis_kelamin" value="perempuan">
                                        <label class="form-check-label" for="jenis_kelamin">
                                            Perempuan
                                        </label>
                                    </div>
                                @elseif (old('jenis_kelamin', $koordinator->jenis_kelamin) == 'perempuan')
                                    <div class="m-2">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="jenis_kelamin" value="laki-laki">
                                        <label class="form-check-label" for="jenis_kelamin">
                                            Laki Laki
                                        </label>
                                    </div>
                                    <div class="m-2">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="jenis_kelamin" value="perempuan" checked>
                                        <label class="form-check-label" for="jenis_kelamin">
                                            Perempuan
                                        </label>
                                    </div>
                                @endif
                            </div>

                            @error('jenis_kelamin')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="level_id" class="form-label">Level</label>
                            <select name="level_id" id="level_id"
                                class="form-control @error('level_id') is-invalid @enderror">
                                <option selected disabled>Pilih Level</option>
                                @foreach ($levels as $level)
                                    @if (old('level_id', $koordinator->level_id) == $level->id)
                                        <option value="{{ $level->id }}" selected>{{ $level->name }}</option>
                                    @else
                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('level_id')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- col 2 --}}
                    <div class="col">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email', $koordinator->email) }}">
                            @error('email')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                name="alamat" value="{{ old('alamat', $koordinator->alamat) }}">
                            @error('alamat')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            <select name="agama" id="agama"
                                class="form-control @error('agama')
                            is-invalid
                        @enderror">
                                <option selected disabled>Pilih agama</option>
                                @if (old('agama', $koordinator->agama) == 'islam')
                                    <option value="islam" selected>Islam</option>
                                    <option value="kristen">Kristen</option>
                                    <option value="hindu">Hindu</option>
                                    <option value="budha">Budha</option>
                                @elseif (old('agama', $koordinator->agama) == 'kristen')
                                    <option value="islam">Islam</option>
                                    <option value="kristen" selected>Kristen</option>
                                    <option value="hindu">Hindu</option>
                                    <option value="budha">Budha</option>
                                @elseif (old('agama', $koordinator->agama) == 'hindu')
                                    <option value="islam">Islam</option>
                                    <option value="kristen">Kristen</option>
                                    <option value="hindu" selected>Hindu</option>
                                    <option value="budha">Budha</option>
                                @elseif (old('agama', $koordinator->agama) == 'budha')
                                    <option value="islam">Islam</option>
                                    <option value="kristen">Kristen</option>
                                    <option value="hindu">Hindu</option>
                                    <option value="budha" selected>Budha</option>
                                @else
                                    <option value="islam">Islam</option>
                                    <option value="kristen">Kristen</option>
                                    <option value="hindu">Hindu</option>
                                    <option value="budha">Budha</option>
                                @endif
                            </select>
                            @error('agama')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror"
                                id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $koordinator->pekerjaan) }}">
                            @error('pekerjaan')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror"
                                name="password" id="password">
                            @error('password')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>
        </div>

    </div>
@endsection
