<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Murid</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <span class="navbar-brand">Halo, {{ $user->nama_lengkap }}</span>
            <a href="{{ route('logout') }}" class="btn btn-outline-light">Logout</a>
        </div>
    </nav>

    <div class="container">
        <h1>Quranly</h1>

        {{-- Notifikasi --}}
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Informasi Target --}}
        <div class="mb-4">
            <p><strong>Total Halaman Dibaca:</strong> {{ $totalHalaman }}</p>
            <p><strong>Target Kelas:</strong> {{ $targetHalaman }}</p>
            <p>
                <strong>Status:</strong>
                @if ($sudahMencapaiTarget)
                <span class="badge bg-success">✔️ Sudah mencapai target</span>
                @else
                <span class="badge bg-danger">❌ Belum mencapai target</span>
                @endif
            </p>

            {{-- Progress Bar --}}
            @php
            $persentase = min(100, ($targetHalaman > 0 ? ($totalHalaman / $targetHalaman * 100) : 0));
            @endphp

            <div class="progress my-3" style="height: 30px;">
                <div class="progress-bar {{ $sudahMencapaiTarget ? 'bg-success' : 'bg-warning' }}"
                    role="progressbar"
                    style="width: {{ $persentase }}%;">
                    {{ round($persentase) }}%
                </div>
            </div>


            {{-- Tambah Pencapaian --}}
            <h3>Tambah Pencapaian Baru</h3>
            <form method="POST" action="{{ url('/murid/pencapaian/tambah') }}">
                @csrf
                <div class="mb-3">
                    <label for="jumlah_halaman" class="form-label">Jumlah Halaman</label>
                    <input type="number" class="form-control" id="jumlah_halaman" name="jumlah_halaman" required min="1">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>

            <hr>

            {{-- Tabel Pencapaian Sendiri --}}
            <h3 class="mt-4">Riwayat Pencapaian</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jumlah Halaman</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pencapaian as $p)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y') }}</td>
                        <td>{{ $p->jumlah_halaman }}</td>
                        <td>
                            <form method="POST" action="{{ url('/murid/pencapaian/hapus/' . $p->id) }}" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">Belum ada pencapaian.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Tabel Teman Sekelas --}}
            <hr>
            <h3 class="mt-4">Total Pencapaian Teman Sekelas</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Total Halaman</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($temanSekelas as $teman)
                    <tr>
                        <td>{{ $teman->nama_lengkap }}</td>
                        <td>{{ $teman->total_halaman }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2">Belum ada data teman sekelas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>


        </div>

</body>

</html>