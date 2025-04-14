<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kelas</title>
    <!-- Link ke Bootstrap dan FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>

            <!-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKelasModal">
                <i class="fas fa-plus me-2"></i>Tambah Kelas
            </button> -->
        </div>

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="20%">Nama Kelas</th>
                                <th width="25%">Murid</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kelas as $kelasItem)
                            <tr>
                                <td>
                                    <strong>{{ $kelasItem->nama_kelas }}</strong>
                                    <div class="text-muted small">ID: {{ $kelasItem->id }}</div>
                                </td>
                                <!-- <td>
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
                                </td> -->
                                <td>
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
                                <!-- <td>
                                    <form class="d-flex align-items-center gap-2" action="{{ route('admin.aturTarget', $kelasItem->id) }}" method="POST">
                                        @csrf
                                        <input type="number" class="form-control form-control-sm" name="target_halaman"
                                            value="{{ $kelasItem->target_halaman ?? 0 }}" min="0" style="width: 80px;">
                                        <button type="submit" class="btn btn-sm btn-success" title="Simpan Target">
                                            <i class="fas fa-save"></i>
                                        </button>
                                    </form>
                                </td> -->
                                <!-- <td>
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
                                </td> -->
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">Belum ada kelas terdaftar</td>
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
        <div class="modal-dialog">
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
        <div class="modal-dialog">
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
                                <option value="{{ $guru->id }}">{{ $guru->nama_lengkap }}</option>
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
        <div class="modal-dialog">
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
                                <option value="{{ $murid->id }}">{{ $murid->nama_lengkap }}</option>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2-multiple').select2({
                placeholder: "Pilih murid",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
</body>

</html>