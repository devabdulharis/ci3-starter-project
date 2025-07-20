<?= $this->section('page_title') ?>
    Dokumen Publik | <?= APP_NAME; ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="container p-5">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col">
                    Dokumen Publik
                </div>
                <div class="col-auto">
                    <div class="btn-group">
                        <button class="btn btn-outline-info btn-md" onclick="toggleView('grid')"><i class="ti ti-layout-grid"></i></button>
                        <button class="btn btn-outline-info btn-md" onclick="toggleView('list')"><i class="ti ti-list"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table View -->
    <div class="card shadow-sm border-0 h-100 mt-4 p-3 d-none"  id="fileTableView">
        <div class="table-responsive">
            <table class="table table-bordered table-sm align-middle" id="fileTable">
                <thead>
                    <tr>
                        <th>Nama File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Grid View -->
    <div class="row mt-4" id="fileContainer" data-view="grid">
    </div>
    <!-- Scripts -->
    <script>

        function load_data() {
            loadGridData();
            reloadDataTable();
        }

        function loadGridData() {
            axios.get('<?= site_url('filemanager/public_read_grid') ?>')
                .then(response => {
                    const container = document.getElementById('fileContainer');
                    container.innerHTML = ''; // Bersihkan dulu kontainer

                    // Cek apakah data kosong
                    if (response.data.data.length === 0) {
                        container.innerHTML = '<div class="col-12 text-center"><p class="alert alert-warning">Belum ada data</p></div>';
                        return;
                    }

                    const iconMap = {
                        jpg: 'fas fa-file-image', jpeg: 'fas fa-file-image', png: 'fas fa-file-image',
                        gif: 'fas fa-file-image', svg: 'fas fa-file-image', webp: 'fas fa-file-image',
                        pdf: 'fas fa-file-pdf', doc: 'fas fa-file-word', docx: 'fas fa-file-word',
                        xls: 'fas fa-file-excel', xlsx: 'fas fa-file-excel', ppt: 'fas fa-file-powerpoint',
                        pptx: 'fas fa-file-powerpoint', txt: 'fas fa-file-alt', rtf: 'fas fa-file-alt',
                        zip: 'fas fa-file-archive', rar: 'fas fa-file-archive', '7z': 'fas fa-file-archive',
                        tar: 'fas fa-file-archive', gz: 'fas fa-file-archive', php: 'fas fa-file-code',
                        html: 'fas fa-file-code', css: 'fas fa-file-code', js: 'fas fa-file-code',
                        json: 'fas fa-file-code', xml: 'fas fa-file-code', sql: 'fas fa-database',
                        mp3: 'fas fa-file-audio', wav: 'fas fa-file-audio', ogg: 'fas fa-file-audio',
                        m4a: 'fas fa-file-audio', mp4: 'fas fa-file-video', mov: 'fas fa-file-video',
                        avi: 'fas fa-file-video', mkv: 'fas fa-file-video', default: 'fas fa-file'
                    };

                    response.data.data.forEach(file => {
                        const ext = file.original_name.split('.').pop().toLowerCase();
                        const icon = iconMap[ext] || iconMap['default'];
                        const statusBadge = file.is_public 
                            ? '<span class="badge bg-success">Publik</span>' 
                            : '<span class="badge bg-secondary">Privat</span>';

                        const card = `
                            <div class="col-md-3 col-sm-4 col-6 file-item">
                                <div class="card shadow-sm border-0 h-100">
                                    <div class="card-body text-center d-flex flex-column justify-content-between">
                                        <div>
                                            <div class="mb-2"><i class="${icon} fs-1 text-primary"></i></div>
                                            <h6 class="text-truncate" title="${file.description}">${file.description}</h6>
                                        </div>
                                        <div>
                                            <a href="<?= site_url('filemanager/public_download/') ?>${file.file_name}" class="btn btn-sm btn-outline-primary w-100">
                                                <i class="ti ti-download"></i> Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        container.insertAdjacentHTML('beforeend', card);
                    });
                });
        }


        function callback(status, data) {
            if (status) {
                clearModal('modalAddOrUpdate');
                load_data();
            }
        }

        function toggleView(view) {
            const grid = document.getElementById('fileContainer');
            const table = document.getElementById('fileTableView');
            if (view === 'grid') {
                grid.classList.remove('d-none');
                table.classList.add('d-none');
                loadGridData(); // Load via AJAX
            } else {
                grid.classList.add('d-none');
                table.classList.remove('d-none');
                reloadDataTable();
            }
            localStorage.setItem('viewMode', view);
        }

        document.addEventListener('DOMContentLoaded', function () {
            const savedView = localStorage.getItem('viewMode') || 'grid';
            toggleView(savedView);
        });

        $(document).ready(function () {
            // Inisialisasi DataTable
            const table = $('#fileTable').DataTable({
                processing: true,
                serverSide: false, // false karena pagination/limit dari client
                ajax: {
                    url: '<?= site_url('filemanager/public_read') ?>',
                    type: 'GET',
                    dataSrc: 'data'
                },
                columns: [
                    { data: 'description' },
                    { data: 'aksi' }
                ]
            });

            // Fungsi untuk reload DataTable setelah aksi
            function reloadDataTable() {
                table.ajax.reload(null, false); // Memuat ulang data tanpa mereset paging
            }

            // Ekspor fungsi reloadDataTable ke window agar bisa diakses di luar scope $(document).ready()
            window.reloadDataTable = reloadDataTable;
        });

    </script>
</div>
<?= $this->endSection() ?>
<?= $this->extend('layouts/frame_dokumen') ?>
