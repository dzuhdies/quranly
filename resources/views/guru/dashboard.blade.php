<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4cc9f0;
            --warning-color: #f72585;
        }

        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            padding: 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .header-card {
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
            color: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .header-card h5 {
            font-size: 1rem;
            opacity: 0.85;
            margin-bottom: 0.5rem;
        }

        .header-card h2 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 1.25rem;
            font-weight: 600;
        }

        .student-card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 1rem;
            transition: transform 0.2s;
        }

        .student-card:hover {
            transform: translateY(-3px);
        }

        .student-card .card-body {
            padding: 1rem;
        }

        .student-name {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .page-count {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 0.35rem 0.65rem;
            border-radius: 30px;
        }

        .status-success {
            background-color: var(--success-color);
            color: white;
        }

        .status-warning {
            background-color: var(--warning-color);
            color: white;
        }

        .btn-detail {
            background-color: var(--primary-color);
            color: white;
            border-radius: 30px;
            padding: 0.375rem 1rem;
            font-size: 0.875rem;
            border: none;
        }

        .btn-detail:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
        }

        .btn-danger {
            background-color: var(--warning-color);
            border: none;
            border-radius: 10px;
        }

        .achievement-table {
            font-size: 0.9rem;
        }

        .tab-content {
            padding-top: 1.5rem;
        }

        .nav-tabs {
            border-bottom: none;
            margin-bottom: 1rem;
        }

        .nav-tabs .nav-link {
            border: none;
            border-radius: 10px;
            padding: 0.75rem 1.25rem;
            font-weight: 500;
            color: #6c757d;
            margin-right: 0.5rem;
        }

        .nav-tabs .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }

        .tab-pane {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .circle-progress {
            position: relative;
            display: inline-block;
            width: 80px;
            height: 80px;
        }

        .progress-ring {
            transform: rotate(-90deg);
        }

        .progress-ring-circle {
            fill: transparent;
            stroke: #e0e0e0;
            stroke-width: 8;
        }

        .progress-ring-circle-progress {
            fill: transparent;
            stroke: var(--primary-color);
            stroke-width: 8;
            stroke-linecap: round;
            transition: stroke-dashoffset 0.3s;
        }

        .progress-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 1.1rem;
            font-weight: 600;
        }

        /* Mobile specific styles */
        @media (max-width: 768px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .header-card {
                padding: 1.25rem;
            }

            .header-card h2 {
                font-size: 1.5rem;
            }

            .nav-tabs .nav-link {
                padding: 0.5rem 0.75rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark mb-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center w-100">
                @isset($guru)
                <span class="navbar-brand">
                    <i class="bi bi-person-circle me-2"></i>
                    {{ $guru->nama_lengkap }}
                </span>
                @else
                <span class="navbar-brand">
                    <i class="bi bi-person-circle me-2"></i>
                    Guru
                </span>
                @endisset

                <a href="{{ route('logout') }}" class="btn btn-sm btn-light">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container mb-5 pb-3">
        <!-- Header Card -->
        <div class="header-card">
            <h5>Kelas</h5>
            <h2>{{ $nama_kelas ?? 'Tidak ada kelas' }}</h2>

            <div class="row mt-3">
                <div class="col-6">
                    <h5>Target Halaman</h5>
                    <h2>{{ $targetHalaman }} <small class="fs-6">halaman</small></h2>
                </div>
                <div class="col-6">
                    <h5>Total Halamanmu</h5>
                    <h2>{{ $totalHalamanGuru }} <small class="fs-6">halaman</small></h2>
                </div>
            </div>
        </div>

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="students-tab" data-bs-toggle="tab" data-bs-target="#students" type="button" role="tab" aria-controls="students" aria-selected="true">
                    <i class="bi bi-people-fill me-1"></i> Murid
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="achievements-tab" data-bs-toggle="tab" data-bs-target="#achievements" type="button" role="tab" aria-controls="achievements" aria-selected="false">
                    <i class="bi bi-journal-check me-1"></i> Pencapaianmu
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="dashboardTabsContent">
            <!-- Students Tab -->
            <div class="tab-pane fade show active" id="students" role="tabpanel" aria-labelledby="students-tab">
                <div class="row">
                    @foreach ($data as $item)
                    <div class="col-12">
                        <div class="student-card card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="student-name">{{ $item['murid']->nama_lengkap }}</h5>
                                        <p class="page-count mb-2">
                                            <i class="bi bi-book me-1"></i> {{ $item['total_halaman'] }} halaman
                                        </p>
                                        @if ($item['lulus_target'])
                                        <span class="status-badge status-success">
                                            <i class="bi bi-check-circle me-1"></i> Selesai
                                        </span>
                                        @else
                                        <span class="status-badge status-warning">
                                            <i class="bi bi-exclamation-circle me-1"></i> Belum Selesai
                                        </span>
                                        @endif
                                    </div>
                                    <a href="{{ route('guru.lihatDetailMurid', $item['murid']->id) }}" class="btn btn-detail">
                                        <i class="bi bi-eye me-1"></i> Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Achievements Tab -->
            <div class="tab-pane fade" id="achievements" role="tabpanel" aria-labelledby="achievements-tab">
                <!-- Add Achievement Form -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Tambah Pencapaian</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('guru.tambahHalamanGuru') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="jumlah_halaman" class="form-label">Jumlah Halaman</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </span>
                                    <input type="number" class="form-control" id="jumlah_halaman" name="jumlah_halaman" placeholder="Masukkan jumlah halaman" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-plus-circle me-2"></i> Tambah Pencapaian
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Achievement List -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Riwayat Pencapaian</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover achievement-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Halaman</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pencapaianGuru as $pencapaian)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($pencapaian->tanggal)->format('d M Y') }}</td>
                                        <td>{{ $pencapaian->jumlah_halaman }}</td>
                                        <td class="text-end">
                                            <form method="POST" action="{{ route('guru.hapusPencapaianGuru') }}" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="pencapaian_id" value="{{ $pencapaian->id }}">
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            // Get all tabs
            var triggerTabList = [].slice.call(document.querySelectorAll('#dashboardTabs button'))

            // Handle tab switching
            triggerTabList.forEach(function(triggerEl) {
                var tabTrigger = new bootstrap.Tab(triggerEl)

                triggerEl.addEventListener('click', function(event) {
                    event.preventDefault()
                    tabTrigger.show()
                })
            })
        });
    </script>
</body>

</html>