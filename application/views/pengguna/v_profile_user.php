<?= $this->section('page_title') ?>Profile | <?=APP_NAME;?> <?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="pc-content">
    <div class="col-sm-12">
        <div class="card border">
            <div class="card-header">
                <h5>Pengaturan Akun</h5>
            </div>
            <form id="f_user">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-6 col-12">
                            <div class="form-group">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="hidden" name="id" value="<?=$this->auth->getUserData()->id;?>">
                                <input type="text" class="form-control" name="first_name"
                                    value="<?=$this->auth->getUserData()->first_name;?>">
                            </div>
                        </div>
                        <div class="col-xl-6 col-6 col-12">
                            <div class="form-group">
                                <label class="form-label">Panggilan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="last_name"
                                    value="<?=$this->auth->getUserData()->last_name;?>">
                            </div>
                        </div>
                        <div class="col-xl-6 col-6 col-12">
                            <div class="form-group">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" readonly
                                    value="<?=$this->auth->getUserData()->email_address;?>" name="email_address">
                            </div>
                        </div>
                        <div class="col-xl-6 col-6 col-12">
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="text" class="form-control" name="password">
                                <small class="form-text text-muted">Kosongkan jika tidak ingin diubah</small>
                            </div>
                        </div>
                        <button type="button" onclick="submitForm('f_user', 'user/add', getCallback)"
                            class="btn btn-md btn-primary col-xl-12 col-12 col-12">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function getCallback(status, data) {
    if (status) {
        location.reload();
    }
}
</script>
<?= $this->endSection() ?>
<?= $this->extend('layouts/frame_main') ?>