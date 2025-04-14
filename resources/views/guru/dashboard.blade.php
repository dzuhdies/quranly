<!-- resources/views/guru/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Guru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            @isset($guru)
            <span class="navbar-brand">Halo, {{ $guru->nama_lengkap }}</span>
            @else
            <span class="navbar-brand">Halo, Guru</span>
            @endisset

            <a href="{{ route('logout') }}" class="btn btn-outline-light">Logout</a>
        </div>
    </nav>

    <div class="container">
        <h1>Dashboard Guru</h1>
        <p><strong>Target Halaman Kelas:</strong> {{ $targetHalaman }} halaman</p>

        <!-- Menampilkan Total Halaman Guru -->
        <h3>Total Halaman Dibaca oleh Guru</h3>
        <p><strong>Total Halaman:</strong> {{ $totalHalamanGuru }}</p>

        <h3>Daftar Murid</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Murid</th>
                    <th>Total Halaman Dibaca</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item['murid']->nama_lengkap }}</td>
                    <td>{{ $item['total_halaman'] }}</td>
                    <td>
                        @if ($item['lulus_target'])
                        <span class="badge bg-success">Selesai</span>
                        @else
                        <span class="badge bg-warning">Belum Selesai</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('guru.lihatDetailMurid', $item['murid']->id) }}" class="btn btn-info btn-sm">Lihat Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <hr>

        <!-- Form untuk Menambahkan Halaman Guru -->
        <h3>Tambah Pencapaian Halaman Guru</h3>
        <form method="POST" action="{{ route('guru.tambahHalamanGuru') }}">
            @csrf
            <div class="mb-3">
                <label for="jumlah_halaman" class="form-label">Jumlah Halaman</label>
                <input type="number" class="form-control" id="jumlah_halaman" name="jumlah_halaman" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Pencapaian</button>
        </form>

        <hr>

        <!-- Form untuk Menghapus Pencapaian Guru -->
        <h3>Hapus Pencapaian Guru</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jumlah Halaman</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pencapaianGuru as $pencapaian)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($pencapaian->tanggal)->format('d M Y') }}</td>
                    <td>{{ $pencapaian->jumlah_halaman }} Halaman</td>
                    <td>
                        <form method="POST" action="{{ route('guru.hapusPencapaianGuru') }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="pencapaian_id" value="{{ $pencapaian->id }}">
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>

</body>

</html>