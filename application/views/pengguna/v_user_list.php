<?= $this->section('page_title') ?>Data Pengguna | <?=APP_NAME;?> <?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="pc-content">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h5>Data Pengguna</h5>
                    </div>
                    <div class="col-auto">
                        <?php
                        if($this->auth->can('add-user')) {
                            ?>
                        <button data-pc-animate="fade-in-scale" type="button" class="btn btn-primary"
                            data-bs-toggle="modal" data-bs-target="#animateModal"><i class="fas fa-plus-circle"></i>
                            Tambah Baru</button>
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
                                    <th>Nama Lengkap</th>
                                    <th>Panggilan</th>
                                    <th>Email</th>
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
<div class="modal fade modal-animate" id="animateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Tambah / Update User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <form id="f_insert">
                <div class="modal-body">
                    <div class="row mb-3">
                        <input type="hidden" name="id">
                        <label for="first_name" class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="last_name" class="col-sm-3 col-form-label">Panggilan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email_address" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email_address" name="email_address" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status" required>
                                <option value="0">Non Aktifkan</option>
                                <option value="1">Aktif</option>
                                <option value="2">Blok</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-3 col-form-label">Sebagai</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="role" required>
                                <?php
                                foreach($roles as $role) {
                                    echo '<option value="'.$role->id.'">'.strtoupper($role->name).'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <?php
                    if($this->auth->can('add-user') || $this->auth->can('update-user')) {
                    ?>
                    <button type="button" onclick="submitForm('f_insert', 'user/add', getCallback)"
                        class="btn btn-primary shadow-2">Simpan Perubahan</button>
                    <?php
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    load_data();
});

function showPopupUpdate(user_id) {
    axiosGetDetail('user/find/' + user_id, respDetail)
}

function respDetail(status, data) {
    console.log(status + " " + data);
    if (status) {
        $('input[name=id]').val(data.id);
        $('input[name=first_name]').val(data.first_name);
        $('input[name=last_name]').val(data.last_name);
        $('input[name=email_address]').val(data.email_address);
        $('input[name=password]').removeAttr('required');
        $('select[name=status]').val(data.status);
        $('select[name=role]').val(data.role);
    }
}

function getCallback(status, data) {
    if (status) {
        load_data();
        clearModal('animateModal');
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
        "ajax": {
            "url": "<?= base_url('user/getUsers') ?>",
            "type": "POST"
        },
        "columns": [{
                "data": "1"
            }, // First Name
            {
                "data": "2"
            }, // Last Name
            {
                "data": "3"
            }, // Email
            {
                "data": "4"
            } // Status
            ,
            {
                "data": "5"
            } // Aksi
        ]
    });
}
</script>
<?php if ($this->session->flashdata('titleFlash')) : ?>
<script>
showToast('<?= $this->session->flashdata('colorFlash'); ?>',
    '<?= $this->session->flashdata('titleFlash'); ?>',
    '<?= $this->session->flashdata('captionFlash'); ?>');
</script>
<?php endif ?>
<?= $this->endSection() ?>
<?= $this->extend('layouts/frame_main') ?>