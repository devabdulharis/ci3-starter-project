<?= $this->section('page_title') ?>Konfigurasi Sistem | <?=APP_NAME;?> <?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="pc-content row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <h5 class="mb-2">Pengaturan Sistem</h5>
            </div>
            <div class="card-body">
            <div class="row g-4">
                <div class="col-sm-3">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-bs-toggle="tab" href="#list-home" role="tab" aria-controls="list-home">REST API</a>
                    <!-- <a class="list-group-item list-group-item-action active" id="list-profile-list" data-bs-toggle="tab" href="#list-profile" role="tab" aria-controls="list-profile">Profile </a>
                    <a class="list-group-item list-group-item-action" id="list-messages-list" data-bs-toggle="tab" href="#list-messages" role="tab" aria-controls="list-messages">Messages </a>
                    <a class="list-group-item list-group-item-action" id="list-settings-list" data-bs-toggle="tab" href="#list-settings" role="tab" aria-controls="list-settings">Settings</a> -->
                </div>
                </div>
                    <div class="col-sm-9">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                            <p align="right">
                                <div class="btn-toolbar d-flex flex-wrap gap-2" role="toolbar" aria-label="Basic example"><button onclick="showModal()" type="button" class="btn btn-outline-primary d-inline-flex"><i class="fa fa-plus"></i>&nbsp;Api Key</button> <a type="button" class="btn btn-outline-warning d-inline-flex" href="https://siber-satpolpp.cirebonkab.go.id/filemanager/download/1" target="_blank"><i class="fa fa-download"></i>&nbsp;Dokumentasi</a></div>
                            </p>
                            <div class="table-border-style">
                                <div class="dt-responsive table-responsive">
                                    <table id="partnersTable" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Instansi</th>
                                                <th>Kontak</th>
                                                <th>Email</th>
                                                <th>API Key</th>
                                                <th>Dibuat</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Data will be loaded via AJAX -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
    <!-- Modal for Add/Edit -->
    <div class="modal fade" id="partnerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add New Partner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="partnerForm">
                    <div class="modal-body">
                        <input type="hidden" id="user_id" name="user_id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Instansi *</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact" class="form-label">Kontak</label>
                            <input type="text" class="form-control" id="contact" name="contact">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="generate_key" name="generate_key">
                                <label class="form-check-label" for="generate_key">
                                    Generate API Key
                                </label>
                            </div>
                        </div>
                        <div class="mb-3" id="ipAddressField" style="display: none;">
                            <label for="ip_addresses" class="form-label">IP Addresses (Pisahkan dengan koma)</label>
                            <input type="text" class="form-control" id="ip_addresses" name="ip_addresses" placeholder="192.168.1.1, 203.0.113.45">
                        </div>
                        <div id="keyDisplay" class="mb-3" style="display: none;">
                            <label class="form-label">API Key</label>
                            <div class="key-display" id="keyValue"></div>
                            <small class="text-muted">Copy this key as it won't be shown again</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah kamu yakin ingin menghapus data ini?</p>
                    <input type="hidden" id="delete_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        let dataTable;
        let modal = new bootstrap.Modal(document.getElementById('partnerModal'));
        let deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

        $(document).ready(function() {
            initializeDataTable();
            
            // Toggle IP address field based on generate key checkbox
            $('#generate_key').change(function() {
                if(this.checked) {
                    $('#ipAddressField').show();
                } else {
                    $('#ipAddressField').hide();
                }
            });

            // Form submission
            $('#partnerForm').submit(function(e) {
                e.preventDefault();
                savePartner();
            });
        });

        function initializeDataTable() {
            dataTable = $('#partnersTable').DataTable({
                ajax: {
                    url: '<?= site_url('partner_keys/ajax_list') ?>',
                    dataSrc: function(json) {
                        console.log('Received data:', json); // Cek struktur data
                        return json.data;
                    },
                    error: function(xhr, error, thrown) {
                        console.log('Ajax error:', error, thrown);
                    }
                },
                columns: [
                    { data: 'user_id' },
                    { data: 'name' },
                    { data: 'contact' },
                    { data: 'email' },
                    { 
                        data: 'key',
                        render: function(data, type, row) {
                            return data ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-secondary">No</span>';
                        }
                    },
                    { 
                        data: 'created_at',
                        render: function(data) {
                            return data ? new Date(data).toLocaleString() : '-';
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                                <div class="action-btns">
                                    <button class="btn btn-sm btn-warning" onclick="editPartner(${row.user_id})">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="showDeleteModal(${row.user_id})">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            `;
                        },
                        orderable: false
                    }
                ],
                responsive: true
            });
        }

        function showModal() {
            resetForm();
            $('#modalTitle').text('Add New Partner');
            $('#generate_key').prop('checked', false);
            $('#ipAddressField').hide();
            $('#keyDisplay').hide();
            modal.show();
        }

        function editPartner(user_id) {
            $.ajax({
                url: '<?= site_url('partner_keys/ajax_get/') ?>' + user_id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if(response.status) {
                        $('#modalTitle').text('Edit Partner');
                        $('#user_id').val(response.data.user_id);
                        $('#name').val(response.data.name);
                        $('#contact').val(response.data.contact);
                        $('#email').val(response.data.email);
                        $('#description').val(response.data.description);
                        
                        if(response.data.key) {
                            $('#generate_key').prop('checked', true).prop('disabled', true);
                            $('#ipAddressField').show();
                            $('#ip_addresses').val(response.data.ip_addresses);
                            $('#keyDisplay').show();
                            $('#keyValue').text(response.data.key);
                        } else {
                            $('#generate_key').prop('checked', false);
                            $('#ipAddressField').hide();
                            $('#keyDisplay').hide();
                        }
                        
                        modal.show();
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                }
            });
        }

        function savePartner() {
            const formData = $('#partnerForm').serialize();
            const url = $('#user_id').val() ? '<?= site_url('partner_keys/ajax_update') ?>' : '<?= site_url('partner_keys/ajax_create') ?>';
            
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if(response.status) {
                        Swal.fire('Success', response.message, 'success');
                        dataTable.ajax.reload();
                        modal.hide();
                        
                        if(response.generated_key) {
                            $('#keyDisplay').show();
                            $('#keyValue').text(response.generated_key);
                        }
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function(xhr) {
                    Swal.fire('Error', 'An error occurred while processing your request', 'error');
                }
            });
        }

        function showDeleteModal(user_id) {
            $('#delete_id').val(user_id);
            deleteModal.show();
        }

        function confirmDelete() {
            const user_id = $('#delete_id').val();
            
            $.ajax({
                url: '<?= site_url('partner_keys/ajax_delete/') ?>' + user_id,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if(response.status) {
                        Swal.fire('Deleted', response.message, 'success');
                        dataTable.ajax.reload();
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                    deleteModal.hide();
                }
            });
        }

        function resetForm() {
            $('#partnerForm')[0].reset();
            $('#user_id').val('');
            $('#keyDisplay').hide();
            $('#generate_key').prop('disabled', false);
        }
    </script>
<?= $this->endSection() ?>
<?= $this->extend('layouts/frame_main') ?>