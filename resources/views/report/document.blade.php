<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document PDF</title>

        <style>
            .page-break {
                page-break-after: always;
            }

            .text-center {
                text-align: center;
            }

            .px {
                padding-top: 4px;
                padding-bottom: 4px;
                padding-left: 4px;
                padding-right: 4px;
            }
        </style>

    </head>

    <body>

        <div class="container">

            <h1 style="text-align: center">Data Mahasiswa Magang PT Garuda Cyber Indonesia</h1>
            <table class="table" border="1" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col" class="px">No</th>
                        <th scope="col" class="px">Nama</th>
                        <th scope="col" class="px">Email</th>
                        <th scope="col" class="px">Tempat Lahir</th>
                        <th scope="col" class="px">Tanggal Lahir</th>
                        <th scope="col" class="px">Alamat</th>
                        <th scope="col" class="px">Agama</th>
                        <th scope="col" class="px">Jenis Kelamin</th>
                        <th scope="col" class="px">Judul Projek</th>
                        <th scope="col" class="px">Tanggal Mulai</th>
                        <th scope="col" class="px">Tanggal Selesai</th>
                        <th scope="col" class="px">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users->count() != 0)

                        @foreach ($users as $mahasiswa)
                            <tr style="text-align: center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mahasiswa->nama }}</td>
                                <td>{{ $mahasiswa->email }}</td>
                                <td>{{ $mahasiswa->tempat_lahir }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->format('j F Y') }}
                                </td>

                                <td>{{ $mahasiswa->alamat }}</td>
                                <td>{{ $mahasiswa->agama }}</td>
                                <td>{{ $mahasiswa->jenis_kelamin }}</td>

                                @if ($mahasiswa->judul->count() !== 0)
                                    @foreach ($mahasiswa->judul as $judul)
                                        @if ($judul->status == 'diterima')
                                            <td>{{ $judul->judul }}</td>
                                        @elseif ($judul->status !== 'diterima')
                                            <td>{{ '-' }}</td>
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
                            </tr>
                        @endforeach
                    @else
                        <td colspan="12" class="text-center">No Data</td>
                    @endif

                </tbody>

            </table>
        </div>

    </body>

</html>
