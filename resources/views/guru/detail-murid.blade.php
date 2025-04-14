<!-- resources/views/guru/detail-murid.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Murid - {{ $murid->nama_lengkap }}</title>
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
        <h1>Detail Murid - {{ $murid->nama_lengkap }}</h1>

        <h3>Riwayat Pencapaian Per Hari</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Total Halaman Dibaca</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pencapaian as $p)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}</td>
                    <td>{{ $p->total_halaman }}</td>
                        </form>

                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Tambah Pencapaian</h3>
        <form method="POST" action="{{ route('guru.tambahPencapaian') }}">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">Murid</label>
                <select class="form-control" id="user_id" name="user_id" required>
                    <option value="{{ $murid->id }}">{{ $murid->nama_lengkap }}</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="jumlah_halaman" class="form-label">Jumlah Halaman</label>
                <input type="number" class="form-control" id="jumlah_halaman" name="jumlah_halaman" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Pencapaian</button>
        </form>

    </div>

</body>

</html>