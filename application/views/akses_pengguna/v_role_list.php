<?= $this->section('page_title') ?>Akses Pengguna | <?=APP_NAME;?> <?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="pc-content">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <h5>Data Peran</h5>
                            </div>
                            <div class="col-auto">
                                <?php
                                if($this->auth->can('add-role')) {
                                    ?>
                                <button data-pc-animate="fade-in-scale" type="button" class="btn btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#modal_peran"><i
                                        class="fas fa-plus-circle"></i>
                                    Tambah</button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pc-component">
                        <div class="table-border-style">
                            <div class="dt-responsive table-responsive">
                                <table class="table table-striped table-bordered nowrap" id="data">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name Role</th>
                                            <th>Alias</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <h5>Data Izin</h5>
                            </div>
                            <div class="col-auto">
                                <?php
                                if($this->auth->can('add_permission-role')) {
                                    ?>
                                <button data-pc-animate="fade-in-scale" type="button" class="btn btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#modal_permission"><i
                                        class="fas fa-plus-circle"></i>
                                    Tambah</button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pc-component">
                        <div class="table-border-style">
                            <div class="dt-responsive table-responsive">
                                <table class="table table-striped table-bordered nowrap" id="data_permission">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Display Name</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-animate" id="modal_peran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Or Update Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <form id="f_role">
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label">Nama Role</label>
                        <div class="col-sm-9">
                            <input type="hidden" class="form-control" id="r_id" name="id">
                            <input type="text" class="form-control" id="r_name" name="name" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="display_name" class="col-sm-3 col-form-label">Alias</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="r_display_name" name="display_name" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="description" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="r_description" name="description" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" onclick="submitForm('f_role', 'role/add', getCallback)"
                        class="btn btn-primary shadow-2">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade modal-animate" id="modal_permission" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Or Update Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <form id="f_permission">
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="p_name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="hidden" class="form-control" id="p_id" name="id">
                            <input type="text" class="form-control" id="p_name" name="name"
                                placeholder="format (Method-Controller)" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="p_display_name" class="col-sm-3 col-form-label">Display Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="p_display_name" name="display_name" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="p_description" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="p_description" name="description" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="p_status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="p_status" name="status">
                                <option value="1">Aktif</option>
                                <option value="0">Non Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" onclick="submitForm('f_permission', 'role/add_permission', getCallback)"
                        class="btn btn-primary shadow-2">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="modal_akses_pengguna" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Data akses pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-border-style">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-striped table-bordered nowrap" id="data_role_permission">
                            <thead>
                                <tr>
                                    <th>Nama Izin</th>
                                    <th>Deskripsi</th>
                                    <th>Aktifkan?</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    load_data();
});

function getCallback(status, data) {
    if (status) {
        load_data();
        clearModal('modal_peran');
        clearModal('modal_permission');
    }
}

function addOrDeleteRolePermission(role_id, permission_id) {
    axiosGetDetail('role/delete_or_add_permission_role/' + role_id + '/' + permission_id,
        RespDetailUpdateRolePermission);
}

function RespDetailUpdateRolePermission(status, data) {
    if (status) {
        showToast('success', 'Berhasil', data);
    } else {
        showToast('danger', 'Gagal', data);
    }
}

function showPopupRolePermission(id) {
    if ($.fn.DataTable.isDataTable('#data_role_permission')) {
        // Jika sudah ada, hancurkan
        $('#data_role_permission').DataTable().destroy();
    }

    // Inisialisasi DataTables setelah dihancurkan atau jika belum ada
    $('#data_role_permission').DataTable({
        "processing": true,
        "bSort": true,
        "lengthMenu": [
            [5, 10, -1],
            [5, 10, "All"]
        ], // Menambahkan opsi untuk menampilkan 5, 10, atau semua entri dengan label yang sesuai
        "pageLength": 5, // Jumlah default entri per halaman
        "ajax": "<?= base_url('role/find_permission_by_role/');?>" + id,
        "columns": [{
                "data": "4"
            }, // name
            {
                "data": "5"
            }, // name
            {
                "data": "6"
            }
        ]
    });
}

function showPopupUpdate(id) {
    axiosGetDetail('role/find/' + id, respDetailRole);
}

function showPopupPermission(id) {
    axiosGetDetail('role/find_permission/' + id, respDetailPermission);
}

function respDetailPermission(status, data) {
    if (status) {
        $('#p_id').val(data.id);
        $('#p_name').val(data.name);
        $('#p_display_name').val(data.display_name);
        $('#p_description').val(data.description);
        $('#p_status').val(data.status);
    }
}

function respDetailRole(status, data) {
    if (status) {
        $('#r_id').val(data.id);
        //$('#r_id').attr('readonly', true);
        $('#r_name').val(data.name);
        $('#r_display_name').val(data.display_name);
        $('#r_description').val(data.description);
    }
}

function load_data() {
    // Cek apakah instance DataTables sudah ada untuk elemen #data

    if ($.fn.DataTable.isDataTable('#data')) {
        // Jika sudah ada, hancurkan
        $('#data').DataTable().destroy();
    }

    // Inisialisasi DataTables setelah dihancurkan atau jika belum ada
    $('#data').DataTable({
        "processing": true,
        "serverSide": true,
        "bSort": true,
        "lengthMenu": [
            [5, 10, -1],
            [5, 10, "All"]
        ], // Menambahkan opsi untuk menampilkan 5, 10, atau semua entri dengan label yang sesuai
        "pageLength": 5, // Jumlah default entri per halaman
        "ajax": {
            "url": "<?= base_url('role/roles') ?>",
            "type": "POST"
        },
        "columns": [{
                "data": "0"
            },
            {
                "data": "1"
            }, // name
            {
                "data": "2"
            }, // name
            {
                "data": "3"
            }, // name
            {
                "data": "4"
            }, // name
            {
                "data": "5"
            }
        ]
    });

    if ($.fn.DataTable.isDataTable('#data_permission')) {
        // Jika sudah ada, hancurkan
        $('#data_permission').DataTable().destroy();
    }

    // Inisialisasi DataTables setelah dihancurkan atau jika belum ada
    $('#data_permission').DataTable({
        "processing": true,
        "serverSide": true,
        "bSort": true,
        "lengthMenu": [
            [5, 10, -1],
            [5, 10, "All"]
        ], // Menambahkan opsi untuk menampilkan 5, 10, atau semua entri dengan label yang sesuai
        "pageLength": 5, // Jumlah default entri per halaman
        "ajax": {
            "url": "<?= base_url('role/getAJaxPermissions') ?>",
            "type": "POST"
        },
        "columns": [{
                "data": "5"
            }, // name
            {
                "data": "0"
            }, // name
            {
                "data": "1"
            }, // displayname
            {
                "data": "2"
            }, // description
            {
                "data": "3"
            } // Status
            ,
            {
                "data": "4"
            } // Aksi
        ]
    });
}
</script>
<?= $this->endSection() ?>
<?= $this->extend('layouts/frame_main') ?>