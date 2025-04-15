<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quranly - Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4F46E5;
            --primary-light: #818CF8;
            --dark: #1E293B;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
            --light-gray: #F1F5F9;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: #F8FAFC;
            color: #334155;
            padding-bottom: 80px;
        }

        .navbar {
            background-color: var(--primary);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 16px 0;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .logout-btn {
            border-radius: 8px;
            padding: 6px 16px;
            font-weight: 500;
            background-color: transparent;
            border: 1px solid rgba(255, 255, 255, 0.6);
            transition: all 0.2s;
        }

        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .app-title {
            text-align: center;
            margin: 10px 0 20px;
            font-weight: 700;
            color: var(--dark);
            font-size: 1.8rem;
        }

        .stats-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            padding: 24px;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }

        .total-pages {
            text-align: center;
            position: relative;
            padding: 20px 0;
        }

        .total-count {
            font-size: 60px;
            font-weight: 800;
            color: var(--primary);
            line-height: 1;
            margin: 0;
            animation: countUp 1s ease-out;
        }

        .total-label {
            font-size: 16px;
            color: #64748B;
            margin-top: 5px;
            font-weight: 500;
        }

        .target-info {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
            padding: 15px;
            background-color: var(--light-gray);
            border-radius: 12px;
            align-items: center;
        }

        .target-label {
            font-weight: 600;
            margin: 0;
        }

        .target-value {
            font-weight: 700;
            color: var(--dark);
            font-size: 22px;
            margin: 0;
        }

        .progress {
            height: 12px;
            border-radius: 6px;
            margin: 15px 0;
            background-color: #E2E8F0;
        }

        .progress-bar {
            border-radius: 6px;
            transition: width 1.2s ease;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            display: inline-block;
            margin-bottom: 15px;
        }

        .status-target-achieved {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .status-target-not-achieved {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin: 25px 0 15px;
            color: var(--dark);
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 8px;
            color: var(--primary);
        }

        .form-container {
            background: white;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .form-label {
            font-weight: 500;
            color: #475569;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #CBD5E1;
        }

        .form-control:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .btn-primary {
            background-color: var(--primary);
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background-color: #4338CA;
            transform: translateY(-1px);
        }

        .table-container {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background-color: #F1F5F9;
            color: #475569;
            font-weight: 600;
            padding: 14px 20px;
            font-size: 14px;
        }

        .table td {
            padding: 14px 20px;
            vertical-align: middle;
            font-size: 14px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #FAFAFA;
        }

        .btn-sm {
            padding: 6px 14px;
            font-size: 13px;
            border-radius: 6px;
        }

        .btn-danger {
            background-color: var(--danger);
            border: none;
        }

        .btn-danger:hover {
            background-color: #DC2626;
        }

        .alert {
            border-radius: 12px;
            margin-bottom: 20px;
            padding: 16px;
            font-weight: 500;
        }

        hr {
            margin: 30px 0;
            opacity: 0.1;
        }

        .tab-navigation {
            display: flex;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
            z-index: 100;
        }

        .tab-item {
            flex: 1;
            text-align: center;
            padding: 12px;
            color: #64748B;
            font-size: 12px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }

        .tab-item.active {
            color: var(--primary);
        }

        .tab-item i {
            display: block;
            font-size: 20px;
            margin-bottom: 4px;
        }

        @keyframes countUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Floating Action Button */
        .fab {
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            z-index: 99;
            transition: all 0.3s;
        }

        .fab:hover {
            transform: scale(1.1);
            background-color: #4338CA;
        }

        /* Hide/show sections */
        .dashboard-section {
            display: block;
        }

        .history-section {
            display: none;
        }

        @media (max-width: 576px) {
            .total-count {
                font-size: 48px;
            }

            .navbar {
                padding: 12px 0;
            }

            .app-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark">
        <div class="container">
            <span class="navbar-brand">Halo, {{ $user->nama_lengkap }}</span>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-light logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>

        </div>
    </nav>

    <div class="container">
        {{-- Dashboard Section --}}
        <div id="dashboard-section" class="dashboard-section">
            <h1 class="app-title">Quranly</h1>

            {{-- Notifikasi --}}
            @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
            @elseif (session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
            @endif

            {{-- Stats Card dengan Total Halaman yang Menonjol --}}
            <div class="stats-card">
                <div class="total-pages">
                    <h1 class="total-count">{{ $totalHalaman }}</h1>
                    <p class="total-label">Total Halaman Dibaca</p>
                </div>

                {{-- Target Info --}}
                <div class="target-info">
                    <div>
                        <p class="target-label">Target Kelas</p>
                    </div>
                    <div>
                        <p class="target-value">{{ $targetHalaman }}</p>
                    </div>
                </div>

                {{-- Status Badge --}}
                <div class="text-center">
                    @if ($sudahMencapaiTarget)
                    <span class="status-badge status-target-achieved">
                        <i class="fas fa-check-circle me-1"></i> Sudah mencapai target
                    </span>
                    @else
                    <span class="status-badge status-target-not-achieved">
                        <i class="fas fa-exclamation-circle me-1"></i> Belum mencapai target
                    </span>
                    @endif
                </div>

                {{-- Progress Bar --}}
                @php
                $persentase = min(100, ($targetHalaman > 0 ? ($totalHalaman / $targetHalaman * 100) : 0));
                @endphp

                <div class="progress">
                    <div class="progress-bar {{ $sudahMencapaiTarget ? 'bg-success' : 'bg-warning' }}"
                        role="progressbar"
                        style="width: {{ $persentase }}%;">
                    </div>
                </div>
                <div class="text-end">
                    <small class="text-muted">{{ round($persentase) }}% dari target</small>
                </div>
            </div>

            {{-- Tabel Teman Sekelas --}}
            <h3 class="section-title">
                <i class="fas fa-users"></i> Total Pencapaian Teman Sekelas
            </h3>
            <div class="table-container">
                <table class="table">
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
                            <td colspan="2" class="text-center py-4">Belum ada data teman sekelas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- History Section --}}
        <div id="history-section" class="history-section">
            <h1 class="app-title">Riwayat Pencapaian</h1>

            {{-- Tabel Pencapaian Sendiri --}}
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
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
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4">Belum ada pencapaian.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Floating Action Button untuk Tambah Pencapaian --}}
    <div class="fab" data-bs-toggle="modal" data-bs-target="#tambahPencapaianModal">
        <i class="fas fa-plus"></i>
    </div>

    {{-- Modal Tambah Pencapaian --}}
    <div class="modal fade" id="tambahPencapaianModal" tabindex="-1" aria-labelledby="tambahPencapaianModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPencapaianModalLabel">Tambah Pencapaian Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ url('/murid/pencapaian/tambah') }}" id="pencapaianForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="jumlah_halaman" class="form-label">Jumlah Halaman</label>
                            <input type="number" class="form-control" id="jumlah_halaman" name="jumlah_halaman" required min="1" placeholder="Masukkan jumlah halaman">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Bottom Navigation --}}
    <div class="tab-navigation">
        <a href="#" class="tab-item active" onclick="showSection('dashboard')">
            <i class="fas fa-home"></i>
            Dashboard
        </a>
        <a href="#" class="tab-item" onclick="showSection('history')">
            <i class="fas fa-history"></i>
            Riwayat
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi untuk menampilkan section yang dipilih
        function showSection(section) {
            if (section === 'dashboard') {
                document.getElementById('dashboard-section').style.display = 'block';
                document.getElementById('history-section').style.display = 'none';

                // Update active tab
                document.querySelectorAll('.tab-item').forEach(item => {
                    item.classList.remove('active');
                });
                document.querySelectorAll('.tab-item')[0].classList.add('active');
            } else if (section === 'history') {
                document.getElementById('dashboard-section').style.display = 'none';
                document.getElementById('history-section').style.display = 'block';

                // Update active tab
                document.querySelectorAll('.tab-item').forEach(item => {
                    item.classList.remove('active');
                });
                document.querySelectorAll('.tab-item')[1].classList.add('active');
            }
        }

        // Jika ada notifikasi sukses, tutup modal secara otomatis
        @if(session('success'))
        document.addEventListener('DOMContentLoaded', function() {
            var modal = bootstrap.Modal.getInstance(document.getElementById('tambahPencapaianModal'));
            if (modal) {
                modal.hide();
            }
        });
        @endif
    </script>
</body>

</html>