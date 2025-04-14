<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Murid - {{ $murid->nama_lengkap }}</title>
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
        
        .btn-back {
            background-color: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            border-radius: 10px;
            padding: 0.5rem 1rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            margin-bottom: 1rem;
            transition: all 0.2s;
        }
        
        .btn-back:hover {
            background-color: #f0f5ff;
        }
        
        .reading-history-card {
            border-radius: 10px;
            border: none;
            transition: transform 0.2s;
            margin-bottom: 0.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .reading-history-card:hover {
            transform: translateY(-2px);
        }
        
        .reading-history-date {
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .reading-history-pages {
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .stats-pill {
            background-color: #e9ecef;
            border-radius: 50px;
            padding: 0.35rem 1rem;
            font-size: 0.85rem;
            font-weight: 500;
            color: #495057;
            display: inline-flex;
            align-items: center;
            margin-right: 0.5rem;
        }
        
        .stats-icon {
            margin-right: 0.5rem;
            font-size: 1rem;
        }
        
        .tab-content {
            padding-top: 1rem;
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
            from { opacity: 0; }
            to { opacity: 1; }
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
            
            .btn-back {
                padding: 0.4rem 0.75rem;
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
        <!-- Back Button -->
        <a href="{{ route('guru.dashboard') }}" class="btn-back mb-3">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Dashboard
        </a>
        
        <!-- Header Card -->
        <div class="header-card">
            <h5>Detail Murid</h5>
            <h2>{{ $murid->nama_lengkap }}</h2>
            
            <div class="d-flex flex-wrap mt-3">
                <div class="stats-pill">
                    <i class="bi bi-book-fill stats-icon"></i>
                    <span>{{ $pencapaian->sum('total_halaman') }} Total Halaman</span>
                </div>
                <div class="stats-pill">
                    <i class="bi bi-calendar-check stats-icon"></i>
                    <span>{{ $pencapaian->count() }} Hari Aktif</span>
                </div>
            </div>
        </div>
        
        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="detailTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab" aria-controls="history" aria-selected="true">
                    <i class="bi bi-clock-history me-1"></i> Riwayat
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="add-tab" data-bs-toggle="tab" data-bs-target="#add" type="button" role="tab" aria-controls="add" aria-selected="false">
                    <i class="bi bi-plus-circle me-1"></i> Tambah
                </button>
            </li>
        </ul>
        
        <!-- Tab Content -->
        <div class="tab-content" id="detailTabsContent">
            <!-- History Tab -->
            <div class="tab-pane fade show active" id="history" role="tabpanel" aria-labelledby="history-tab">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Riwayat Pencapaian</span>
                    </div>
                    <div class="card-body p-0">
                        @if($pencapaian->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach ($pencapaian as $p)
                                <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                                    <div>
                                        <div class="reading-history-date">
                                            <i class="bi bi-calendar-event me-2"></i>
                                            {{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}
                                        </div>
                                    </div>
                                    <div class="reading-history-pages">
                                        {{ $p->total_halaman }} halaman
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-journal-x" style="font-size: 2rem; color: #ccc;"></i>
                                <p class="mt-2 text-muted">Belum ada pencapaian</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Add Tab -->
            <div class="tab-pane fade" id="add" role="tabpanel" aria-labelledby="add-tab">
                <div class="card">
                    <div class="card-header">
                        <span>Tambah Pencapaian Baru</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('guru.tambahPencapaian') }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $murid->id }}">
                            
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
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize tab functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Get all tabs
            var triggerTabList = [].slice.call(document.querySelectorAll('#detailTabs button'))
            
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