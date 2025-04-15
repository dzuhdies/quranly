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
    <!-- Tambahkan jQuery sebelum Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
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
                                    <button class="btn btn-sm btn-outline-primary mt-2 tambah-murid-btn" 
                                            data-kelas-id="{{ $kelasItem->id }}" 
                                            data-kelas-nama="{{ $kelasItem->nama_kelas }}">
                                        <i class="fas fa-plus me-1"></i> Tambah Murid
                                    </button>
                                </td>
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

    <!-- Bottom Sheet Tambah Murid -->
    <div id="bottomSheetOverlay" class="position-fixed top-0 start-0 end-0 bottom-0 bg-dark bg-opacity-50 d-none" style="z-index: 1040;"></div>
    
    <div id="bottomSheet" class="position-fixed bottom-0 start-0 end-0 bg-white shadow-lg rounded-top-3 p-4 d-none" style="z-index: 1050; max-height: 80vh; overflow-y: auto; transition: transform 0.3s ease-out; transform: translateY(100%);">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0" id="bottomSheetTitle">Tambah Murid</h5>
            <button class="btn btn-sm btn-outline-secondary" onclick="closeBottomSheet()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="bottomSheetForm" method="POST">
            @csrf
            <div class="mb-3">
                <label for="murid_id" class="form-label">Pilih Murid</label>
                <select class="form-select select2-multiple" id="murid_id" name="murid_id[]" multiple required>
                    @foreach ($muridTersedia as $murid)
                    <option value="{{ $murid->id }}">{{ $murid->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-2" onclick="closeBottomSheet()">Batal</button>
                <button type="submit" class="btn btn-primary">Tambah Murid</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2
            $('.select2-multiple').select2({
                placeholder: "Pilih murid",
                allowClear: true,
                width: '100%'
            });
            
            // Event handler untuk tombol tambah murid
            $(document).on('click', '.tambah-murid-btn', function() {
                const kelasId = $(this).data('kelas-id');
                const kelasNama = $(this).data('kelas-nama');
                openBottomSheet(kelasId, kelasNama);
            });
            
            // Tutup bottom sheet saat klik overlay
            $('#bottomSheetOverlay').click(function() {
                closeBottomSheet();
            });
        });

        function openBottomSheet(kelasId, namaKelas) {
            // Tampilkan overlay dan bottom sheet
            $('#bottomSheetOverlay').removeClass('d-none');
            $('#bottomSheet').removeClass('d-none');
            
            // Update judul & action form
            $('#bottomSheetTitle').text(`Tambah Murid ke ${namaKelas}`);
            $('#bottomSheetForm').attr('action', `/admin/kelas/${kelasId}/tambah-murid`);
            
            // Reset select2
            $('#murid_id').val(null).trigger('change');
            
            // Animasikan muncul
            setTimeout(() => {
                $('#bottomSheet').css('transform', 'translateY(0)');
            }, 10);
        }

        function closeBottomSheet() {
            // Animasikan hilang
            $('#bottomSheet').css('transform', 'translateY(100%)');
            
            // Sembunyikan setelah animasi selesai
            setTimeout(() => {
                $('#bottomSheet').addClass('d-none');
                $('#bottomSheetOverlay').addClass('d-none');
            }, 300);
        }
    </script>
</body>

</html>