<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
            padding-bottom: 70px;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary), #6366F1);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 16px 0;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.1rem;
            color: white;
        }

        .logout-btn {
            border-radius: 8px;
            padding: 6px 16px;
            font-weight: 500;
            background-color: transparent;
            border: 1px solid rgba(255, 255, 255, 0.6);
            transition: all 0.2s;
            color: white;
        }

        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: none;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
            padding: 16px 20px;
        }

        .btn-primary {
            background-color: var(--primary);
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background-color: #4338CA;
        }

        .btn-sm {
            padding: 6px 14px;
            font-size: 13px;
            border-radius: 6px;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 10px 14px;
            border: 1px solid #CBD5E1;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .alert {
            border-radius: 12px;
            margin-bottom: 20px;
            padding: 16px;
            font-weight: 500;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            z-index: 1000;
        }

        .bottom-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #64748B;
            text-decoration: none;
            font-size: 12px;
            padding: 5px 0;
        }

        .bottom-nav-item.active {
            color: var(--primary);
        }

        .bottom-nav-item i {
            font-size: 18px;
            margin-bottom: 4px;
        }

        .class-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 16px;
            background: white;
        }

        .class-header {
            padding: 16px;
            background: rgba(79, 70, 229, 0.05);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .class-title {
            font-weight: 600;
            font-size: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .class-content {
            padding: 0 16px;
        }

        .class-section {
            padding: 16px 0;
            border-bottom: 1px solid #F1F5F9;
        }

        .class-section:last-child {
            border-bottom: none;
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 500;
            font-size: 14px;
            color: #64748B;
            margin-bottom: 10px;
        }

        .user-item {
            display: flex;
            align-items: center;
            padding: 8px 0;
            margin-bottom: 4px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--primary-light);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 12px;
            font-size: 14px;
        }

        .target-form {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .target-input {
            flex-grow: 1;
            text-align: center;
        }

        .badge {
            font-weight: 500;
            padding: 6px 10px;
        }

        .collapsible-section {
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.3s ease-out;
        }

        .collapsible-section.open {
            max-height: 500px;
        }

        .toggle-btn {
            background: none;
            border: none;
            color: var(--primary);
            font-size: 16px;
            cursor: pointer;
            padding: 0;
            transition: transform 0.2s;
        }

        .toggle-btn.rotated {
            transform: rotate(180deg);
        }

        .empty-state {
            padding: 16px 0;
            text-align: center;
            color: #94A3B8;
        }

        .empty-state i {
            font-size: 24px;
            margin-bottom: 8px;
            opacity: 0.5;
        }

        .fab-button {
            position: fixed;
            right: 20px;
            bottom: 80px;
            width: 56px;
            height: 56px;
            border-radius: 28px;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
            border: none;
            font-size: 24px;
            z-index: 900;
            transition: all 0.2s;
        }

        .fab-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(79, 70, 229, 0.4);
        }

        /* Select2 Mobile Styling */
        .select2-container--default .select2-selection--multiple {
            border-radius: 8px;
            border: 1px solid #CBD5E1;
            min-height: 42px;
            padding: 2px 6px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: rgba(79, 70, 229, 0.1);
            border: 1px solid rgba(79, 70, 229, 0.2);
            border-radius: 4px;
            color: var(--primary);
            padding: 3px 8px;
            font-size: 13px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: var(--primary);
            margin-right: 5px;
        }

        /* Account section styles */
        .account-section {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #E2E8F0;
        }

        .account-card {
            background: white;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .account-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .account-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-light);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 12px;
            font-size: 16px;
        }

        .account-info {
            flex-grow: 1;
        }

        .account-name {
            font-weight: 600;
            margin-bottom: 2px;
        }

        .account-username {
            font-size: 13px;
            color: #64748B;
        }

        .account-role {
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 4px;
            background-color: #E2E8F0;
            color: #334155;
        }

        .account-role.admin {
            background-color: #FEE2E2;
            color: #B91C1C;
        }

        .account-role.guru {
            background-color: #FEF3C7;
            color: #92400E;
        }

        .account-role.murid {
            background-color: #D1FAE5;
            color: #065F46;
        }

        .search-box {
            position: relative;
            margin-bottom: 16px;
        }

        .search-box input {
            padding-left: 40px;
            border-radius: 8px;
            background-color: white;
        }

        .search-box i {
            position: absolute;
            left: 14px;
            top: 12px;
            color: #94A3B8;
        }

        /* Modal Account Detail */
        .account-detail-item {
            margin-bottom: 16px;
        }

        .account-detail-label {
            font-size: 13px;
            color: #64748B;
            margin-bottom: 4px;
        }

        .account-detail-value {
            font-size: 15px;
            font-weight: 500;
            color: #334155;
            padding: 8px 12px;
            background-color: #F8FAFC;
            border-radius: 8px;
        }

        /* Mobile specific styles */
        @media (max-width: 768px) {
            .card-header {
                padding: 14px 16px;
            }

            .container {
                padding-left: 12px;
                padding-right: 12px;
            }

            .modal-footer {
                flex-direction: column;
            }

            .modal-footer .btn {
                width: 100%;
                margin-left: 0 !important;
                margin-bottom: 8px;
            }

            .modal-footer .btn:last-child {
                margin-bottom: 0;
            }
        }
    </style>
</head>
<!-- Tambahkan ini sebelum </body> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2-multiple').select2({
            dropdownParent: $(this).closest('.modal') // ini opsional kalau dropdownnya bermasalah dalam modal
        });
    });
</script>

<body>
    <nav class="navbar navbar-dark mb-3">
        <div class="container">
            <span class="navbar-brand">Manajemen Kelas</span>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-light logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>

        </div>
    </nav>


    <div class="container mb-4">
        @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
        </div>
        @endif

        <div class="mb-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Kelas</h5>
        </div>

        @foreach ($kelas as $item)
        <div class="class-card">
            <div class="class-header">
                <div class="class-title">
                    <span>{{ $item->nama_kelas }}</span>
                    <form action="{{ route('admin.hapusKelas', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="class-content">
                <div class="class-section">
                    <div class="section-title">
                        <span>Target Halaman</span>
                    </div>
                    <form class="target-form" action="{{ route('admin.aturTarget', $item->id) }}" method="POST">
                        @csrf
                        <input type="number" class="form-control target-input" name="target_halaman" value="{{ $item->target_halaman ?? 0 }}" min="0">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-save"></i>
                        </button>
                    </form>
                </div>

                <div class="class-section">
                    <div class="section-title">
                        <span>Guru</span>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahGuruModal{{ $item->id }}">
                            <i class="fas fa-plus me-1"></i> Tambah
                        </button>
                    </div>
                    @forelse ($item->guru as $guru)
                    <div class="user-item">
                        <div class="user-avatar">{{ substr($guru->nama_lengkap, 0, 1) }}</div>
                        <div>
                            <div style="font-size: 14px;">{{ $guru->nama_lengkap }}</div>
                            <small class="text-muted" style="font-size: 12px;">{{ $guru->username }}</small>
                        </div>
                    </div>
                    @empty
                    <div class="empty-state">
                        <i class="fas fa-user-slash d-block"></i>
                        <p class="mb-0" style="font-size: 13px;">Belum ada guru</p>
                    </div>
                    @endforelse
                </div>

                <div class="class-section">
                    <div class="section-title">
                        <span>Murid</span>
                        <!-- <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahMuridModal{{ $item->id }}">
                            <i class="fas fa-plus me-1"></i> Tambah
                        </button> -->
                    </div>
                    <div id="muridSection{{ $item->id }}" class="collapsible-section {{ count($item->murid) <= 3 ? 'open' : '' }}">
                        @forelse ($item->murid as $murid)
                        <div class="user-item">
                            <div class="user-avatar">{{ substr($murid->nama_lengkap, 0, 1) }}</div>
                            <div>
                                <div style="font-size: 14px;">{{ $murid->nama_lengkap }}</div>
                                <small class="text-muted" style="font-size: 12px;">{{ $murid->username }}</small>
                            </div>
                        </div>
                        @empty
                        <div class="empty-state">
                            <i class="fas fa-user-slash d-block"></i>
                            <p class="mb-0" style="font-size: 13px;">Belum ada murid</p>
                        </div>
                        @endforelse
                    </div>
                    @if (count($item->murid) > 3)
                    <div class="text-center mt-2">
                        <button type="button" class="toggle-btn" onclick="toggleMurid({{ $item->id }})">
                            <i id="toggleIcon{{ $item->id }}" class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach

        @if(count($kelas) == 0)
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-school mb-3" style="font-size: 48px; color: #CBD5E1;"></i>
                <h5>Belum Ada Kelas</h5>
                <p class="text-muted">Tambahkan kelas baru untuk memulai</p>
            </div>
        </div>
        @endif

        <!-- Account Section -->
        <div class="account-section">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Daftar Akun</h5>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahAkunModal">
                    <i class="fas fa-plus me-1"></i> Tambah Akun
                </button>
            </div>

            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchAccount" class="form-control" placeholder="Cari akun...">
            </div>

            <div id="accountList">
                @foreach($users as $user)
                <div class="account-card">
                    <div class="account-avatar">{{ substr($user->nama_lengkap, 0, 1) }}</div>
                    <div class="account-info">
                        <div class="account-name">{{ $user->nama_lengkap }}</div>
                        <div class="account-username">{{ $user->username }}</div>
                        <div class="account-password">Password : {{ $user->password }}</div>

                        <!-- Form untuk mengubah role -->
                        <form action="{{ route('admin.ubahRole', $user->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="account-role">
                                <select class="form-select form-select-sm" name="role" onchange="this.form.submit()">
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="guru" {{ $user->role == 'guru' ? 'selected' : '' }}>Guru</option>
                                    <option value="murid" {{ $user->role == 'murid' ? 'selected' : '' }}>Murid</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>


    @if(count($users) == 0)
    <div class="empty-state">
        <i class="fas fa-user-slash d-block"></i>
        <p class="mb-0" style="font-size: 13px;">Belum ada akun</p>
    </div>
    @endif
    </div>
    </div>

    <!-- FAB Button -->
    <button class="fab-button" data-bs-toggle="modal" data-bs-target="#tambahKelasModal">
        <i class="fas fa-plus"></i>
    </button>

    <!-- Bottom Navigation -->
    <div class="bottom-nav">
        <a href="{{ route('admin.dashboard') }}" class="bottom-nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.kelas') }}" class="bottom-nav-item {{ request()->is('admin/kelas') ? 'active' : '' }}">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Kelas</span>
        </a>
        <a href="{{ route('admin.lihatAkun') }}" class="bottom-nav-item {{ request()->is('admin/akun') ? 'active' : '' }}">
            <i class="fas fa-users"></i>
            <span>Akun</span>
        </a>
    </div>

    <!-- Modal Tambah Kelas -->
    <div class="modal fade" id="tambahKelasModal" tabindex="-1" aria-labelledby="tambahKelasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.tambahKelas') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahKelasModalLabel">Tambah Kelas Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_kelas" class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" required>
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
    @foreach ($kelas as $item)
    <div class="modal fade" id="tambahGuruModal{{ $item->id }}" tabindex="-1" aria-labelledby="tambahGuruModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.tambahGuruKeKelas', $item->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahGuruModalLabel">Tambah Guru ke Kelas {{ $item->nama_kelas }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="guru_id{{ $item->id }}" class="form-label">Pilih Guru</label>
                            <select class="form-select" name="guru_id" id="guru_id{{ $item->id }}" required>
                                <option value="">-- Pilih Guru --</option>
                                @foreach ($users->where('role', 'guru') as $user)
                                <option value="{{ $user->id }}">{{ $user->nama_lengkap }} ({{ $user->username }})</option>
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

    <!-- Modal Tambah Akun -->
    <div class="modal fade" id="tambahAkunModal" tabindex="-1" aria-labelledby="tambahAkunModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.buatAkunBaru') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahAkunModalLabel">Tambah Akun Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" name="role" id="role" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="admin">Admin</option>
                                <option value="guru">Guru</option>
                                <option value="murid">Murid</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kelas_id" class="form-label">Kelas (Opsional)</label>
                            <select class="form-select" name="kelas_id" id="kelas_id">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
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

    <!-- Modal Detail Akun -->
    <div class="modal fade" id="accountDetailModal" tabindex="-1" aria-labelledby="accountDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accountDetailModalLabel">Detail Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="accountDetailContent">
                    <!-- Content will be loaded via AJAX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 untuk multiple select
            $('.select2-multiple').select2({
                placeholder: "Pilih murid",
                allowClear: true,
                width: '100%',
                dropdownParent: $('.select2-multiple').closest('.modal')
            });

            // Tampilkan notifikasi sukses
            @if(session('success'))
            setTimeout(function() {
                $('.alert-success').fadeOut('slow');
            }, 5000);
            @endif

            @if(session('error'))
            setTimeout(function() {
                $('.alert-danger').fadeOut('slow');
            }, 5000);
            @endif

            // Search functionality
            $('#searchAccount').on('keyup', function() {
                const searchText = $(this).val().toLowerCase();
                $('#accountList .account-card').each(function() {
                    const name = $(this).find('.account-name').text().toLowerCase();
                    const username = $(this).find('.account-username').text().toLowerCase();
                    if (name.includes(searchText) || username.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });

        // Toggle murid list
        function toggleMurid(classId) {
            const section = document.getElementById('muridSection' + classId);
            const icon = document.getElementById('toggleIcon' + classId);

            section.classList.toggle('open');
            icon.classList.toggle('fa-chevron-down');
            icon.classList.toggle('fa-chevron-up');
        }

        // Show account detail
        function showAccountDetail(userId) {
            // You can load the detail via AJAX or use data attributes
            // Here's a simple example using data attributes (you'll need to modify your controller to provide this data)

            // For now, we'll just show a simple modal
            $.get(`/admin/akun/${userId}`, function(data) {
                $('#accountDetailContent').html(`
                    <div class="account-detail-item">
                        <div class="account-detail-label">Nama Lengkap</div>
                        <div class="account-detail-value">${data.nama_lengkap}</div>
                    </div>
                    <div class="account-detail-item">
                        <div class="account-detail-label">Username</div>
                        <div class="account-detail-value">${data.username}</div>
                    </div>
                    <div class="account-detail-item">
                        <div class="account-detail-label">Role</div>
                        <div class="account-detail-value">${data.role}</div>
                    </div>
                    <div class="account-detail-item">
                        <div class="account-detail-label">Kelas</div>
                        <div class="account-detail-value">${data.kelas ? data.kelas.nama_kelas : '-'}</div>
                    </div>
                    <div class="account-detail-item">
                        <div class="account-detail-label">Alamat</div>
                        <div class="account-detail-value">${data.alamat || '-'}</div>
                    </div>
                `);
                $('#accountDetailModal').modal('show');
            });
        }
    </script>
</body>

</html>