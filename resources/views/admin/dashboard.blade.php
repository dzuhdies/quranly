<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-4">
        <h1>Manajemen Kelas</h1>

        <!-- Form tambah kelas -->
        <form action="{{ route('admin.tambahKelas') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="nama_kelas">Nama Kelas</label>
                <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" required>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Tambah Kelas</button>
        </form>

        <h3>Daftar Kelas</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Kelas</th>
                    <th>Guru</th>
                    <th>Murid</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelas as $item)
                <tr>
                    <td>{{ $item->nama_kelas }}</td>
                    <td>
                        @foreach ($item->guru as $guru)
                        <span>{{ $guru->nama_lengkap }}</span><br>
                        @endforeach
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahGuruModal{{ $item->id }}">Tambah Guru</button>
                    </td>
                    <td>
                        @foreach ($item->murid as $murid)
                        <span>{{ $murid->nama_lengkap }}</span><br>
                        @endforeach
                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahMuridModal{{ $item->id }}">Tambah Murid</button>
                    </td>
                    <td>
                        <form action="{{ route('admin.hapusKelas', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Tambah Guru -->
                <div class="modal fade" id="tambahGuruModal{{ $item->id }}" tabindex="-1" aria-labelledby="tambahGuruModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('admin.tambahGuruKeKelas', $item->id) }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tambahGuruModalLabel">Tambah Guru ke Kelas {{ $item->nama_kelas }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="guru">Pilih Guru</label>
                                        <select class="form-control" name="guru_id" id="guru" required>
                                            @foreach ($users as $user)
                                            @if($user->role == 'guru')
                                            <option value="{{ $user->id }}">{{ $user->nama_lengkap }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Tambah Guru</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Tambah Murid -->
                <div class="modal fade" id="tambahMuridModal{{ $item->id }}" tabindex="-1" aria-labelledby="tambahMuridModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('admin.tambahMuridKeKelas', $item->id) }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tambahMuridModalLabel">Tambah Murid ke Kelas {{ $item->nama_kelas }}</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="murid">Pilih Murid</label>
                                        <select class="form-control" name="murid_id[]" id="murid" multiple required>
                                            @foreach ($users as $user)
                                            @if($user->role == 'murid')
                                            <option value="{{ $user->id }}">{{ $user->nama_lengkap }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Tambah Murid</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
