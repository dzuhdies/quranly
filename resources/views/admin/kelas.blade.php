<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kelas</title>
    <!-- Link ke Bootstrap dan FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4F46E5;
            --primary-light: #818CF8;
            --primary-dark: #4338CA;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
            --light: #F8FAFC;
            --dark: #1E293B;
            --gray: #94A3B8;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #F1F5F9;
            color: #334155;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        
        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table thead th {
            background-color: var(--primary);
            color: white;
            font-weight: 600;
            padding: 16px;
            border-bottom: none;
        }
        
        .table tbody tr {
            transition: all 0.2s;
        }
        
        .table tbody tr:hover {
            background-color: rgba(241, 245, 249, 0.5);
        }
        
        .table tbody td {
            padding: 16px;
            vertical-align: middle;
            border-top: 1px solid #E2E8F0;
        }
        
        .avatar-sm {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
        }
        
        .btn-primary {
            background-color: var(--primary);
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(79, 70, 229, 0.2);
        }
        
        .btn-sm {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
        }
        
        .btn-outline-primary {
            border-color: var(--primary);
            color: var(--primary);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary);
            color: white;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 14px;
            border: 1px solid #CBD5E1;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
        
        .alert {
            border-radius: 8px;
            border: none;
        }
        
        .modal-content {
            border-radius: 12px;
            border: none;
        }
        
        .modal-header {
            border-bottom: 1px solid #E2E8F0;
        }
        
        .modal-footer {
            border-top: 1px solid #E2E8F0;
        }
        
        .text-muted {
            color: var(--gray) !important;
        }
        
        .badge {
            font-weight: 500;
            padding: 6px 10px;
            border-radius: 6px;
        }
        
        .badge-primary {
            background-color: rgba(79, 70, 229, 0.1);
            color: var(--primary);
        }
        
        .badge-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }
        
        .badge-warning {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }
        
        .badge-danger {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }
        
        .empty-state {
            padding: 40px 0;
            text-align: center;
            color: var(--gray);
        }
        
        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #F1F5F9;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }
        
        /* Select2 customization */
        .select2-container--default .select2-selection--multiple {
            border-radius: 8px !important;
            border: 1px solid #CBD5E1 !important;
            min-height: 42px !important;
            padding: 2px 6px !important;
        }
        
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: rgba(79, 70, 229, 0.1) !important;
            border: 1px solid rgba(79, 70, 229, 0.2) !important;
            border-radius: 4px !important;
            color: var(--primary) !important;
            padding: 3px 8px !important;
            font-size: 13px !important;
        }
        
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: var(--primary) !important;
            margin-right: 5px !important;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .table-responsive {
                border-radius: 0;
            }
            
            .table thead {
                display: none;
            }
            
            .table tbody tr {
                display: block;
                margin-bottom: 16px;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            }
            
            .table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-top: none;
                padding: 12px;
            }
            
            .table tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                color: var(--dark);
                margin-right: 16px;
            }
            
            .table tbody td .d-flex {
                justify-content: flex-end;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-chalkboard-teacher me-2"></i>
                Manajemen Kelas
            </a>
            <div class="d-flex align-items-center">
                <a href="{{ route('logout') }}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        <!-- Header and Add Button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Manajemen Kelas</h2>
                <p class="text-muted mb-0">Kelola data kelas, guru, dan murid</p>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKelasModal">
                <i class="fas fa-plus me-2"></i>Tambah Kelas
            </button>
        </div>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center">
                <i class="fas fa-exclamation-circle me-2"></i>
                <div>{{ session('error') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Classes Table -->
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th width="20%">Nama Kelas</th>
                                <th width="25%">Guru</th>
                                <th width="25%">Murid</th>
                                <th width="15%">Target</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kelas as $kelasItem)
                            <tr>
                                <td data-label="Nama Kelas">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3">
                                            <i class="fas fa-chalkboard"></i>
                                        </div>
                                        <div>
                                            <strong>{{ $kelasItem->nama_kelas }}</strong>
                                            <div class="text-muted small">ID: {{ $kelasItem->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Guru">
                                    @forelse ($kelasItem->guru as $guru)
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2">
                                            {{ substr($guru->nama_lengkap, 0, 1) }}
                                        </div>
                                        <div>
                                            <div>{{ $guru->nama_lengkap }}</div>
                                            <small class="text-muted">{{ $guru->username }}</small>
                                        </div>
                                    </div>
                                    @empty
                                    <span class="text-muted">Belum ada guru</span>
                                    @endforelse
                                    <button class="btn btn-sm btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#tambahGuruModal{{ $kelasItem->id }}">
                                        <i class="fas fa-plus me-1"></i> Tambah Guru
                                    </button>
                                </td>
                                <td data-label="Murid">
                                    @forelse ($kelasItem->murid as $murid)
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="avatar-sm bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-2">
                                            {{ substr($murid->nama_lengkap, 0, 1) }}
                                        </div>
                                        <div>
                                            <div>{{ $murid->nama_lengkap }}</div>
                                            <small class="text-muted">{{ $murid->username }}</small>
                                        </div>
                                    </div>
                                    @empty
                                    <span class="text-muted">Belum ada murid</span>
                                    @endforelse
                                    <button class="btn btn-sm btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#tambahMuridModal{{ $kelasItem->id }}">
                                        <i class="fas fa-plus me-1"></i> Tambah Murid
                                    </button>
                                </td>
                                <td data-label="Target">
                                    <form class="d-flex align-items-center gap-2" action="{{ route('admin.aturTarget', $kelasItem->id) }}" method="POST">
                                        @csrf
                                        <input type="number" class="form-control form-control-sm" name="target_halaman" 
                                            value="{{ $kelasItem->target_halaman ?? 0 }}" min="0" style="width: 80px;">
                                        <button type="submit" class="btn btn-sm btn-success" title="Simpan Target">
                                            <i class="fas fa-save"></i>
                                        </button>
                                    </form>
                                </td>
                                <td data-label="Aksi">
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editKelasModal{{ $kelasItem->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.hapusKelas', $kelasItem->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus kelas ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="fas fa-school"></i>
                                        <h5 class="mt-3">Belum ada kelas terdaftar</h5>
                                        <p class="text-muted">Tambahkan kelas baru untuk memulai</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kelas -->
    <div class="modal fade" id="tambahKelasModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.tambahKelas') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kelas Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_kelas" class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Guru -->
    @foreach ($kelas as $kelasItem)
    <div class="modal fade" id="tambahGuruModal{{ $kelasItem->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.tambahGuruKeKelas', $kelasItem->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Guru ke {{ $kelasItem->nama_kelas }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="guru_id{{ $kelasItem->id }}" class="form-label">Pilih Guru</label>
                            <select class="form-select" id="guru_id{{ $kelasItem->id }}" name="guru_id" required>
                                <option value="">-- Pilih Guru --</option>
                                @foreach ($guruTersedia as $guru)
                                    <option value="{{ $guru->id }}">{{ $guru->nama_lengkap }} ({{ $guru->username }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah Guru</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Modal Tambah Murid -->
    @foreach ($kelas as $kelasItem)
    <div class="modal fade" id="tambahMuridModal{{ $kelasItem->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.tambahMuridKeKelas', $kelasItem->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Murid ke {{ $kelasItem->nama_kelas }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="murid_id{{ $kelasItem->id }}" class="form-label">Pilih Murid</label>
                            <select class="form-select select2-multiple" id="murid_id{{ $kelasItem->id }}" 
                                name="murid_id[]" multiple="multiple" required>
                                @foreach ($muridTersedia as $murid)
                                    <option value="{{ $murid->id }}">{{ $murid->nama_lengkap }} ({{ $murid->username }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah Murid</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 for multiple select
            $('.select2-multiple').select2({
                placeholder: "Pilih murid",
                allowClear: true,
                width: '100%',
                dropdownParent: $('.select2-multiple').closest('.modal')
            });
            
            // Add animation to buttons
            $('.btn').on('mouseenter', function() {
                $(this).addClass('shadow-sm');
            }).on('mouseleave', function() {
                $(this).removeClass('shadow-sm');
            });
            
            // Auto-focus on modal inputs
            $('.modal').on('shown.bs.modal', function() {
                $(this).find('input[type="text"], input[type="number"], select').first().focus();
            });
        });
    </script>
</body>
</html>