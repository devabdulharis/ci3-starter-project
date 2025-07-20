<?= $this->section('page_title') ?>Login | <?=APP_NAME;?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="auth-main">
    <div class="auth-wrapper v3">
        <div class="auth-form">
            <div class="card my-5">
                <div class="card-body">
                    <a href="#" class="d-flex justify-content-center">
                        <img src="<?=base_url('assets/'); ?>images/logo-dark.svg" alt="image"
                            class="img-fluid brand-logo">
                    </a>
                    <h4 class="my-2 d-flex justify-content-center"><?=APP_DESC;?> (<?=APP_NAME;?>)</h4>
                    <p class="my-1 d-flex justify-content-center">Login Untuk Memulai..</p>
                    <?php echo form_open('login/auth_process'); ?>
                    <div class="my-3 form-floating mb-3">
                        <?php
                        echo form_input(array(
                            'name' => 'inputEmail',
                            'id' => 'floatingInput',
                            'class' => 'form-control',
                            'required' => true,
                            'placeholder' => 'Email address / Username',
                            'value' => set_value('inputEmail')
                        ));
                        ?>
                        <label for="floatingInput">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <?php
                        echo form_password(array(
                            'name' => 'inputPassword',
                            'id' => 'floatingInput1',
                            'required' => true,
                            'class' => 'form-control',
                            'placeholder' => 'Password'
                        ));
                        ?>
                        <label for="floatingInput1">Password</label>
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="mb-3 form-check">
                        <?php
                        echo form_checkbox(array(
                            'name' => 'rememberMe',
                            'id' => 'rememberMe',
                            'class' => 'form-check-input',
                            'value' => '1'
                        ));
                        ?>
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>

                    <div class="d-grid mt-4 mb-2">
                        <?php
                        echo form_submit('submit', 'MASUK', array(
                            'class' => 'btn btn-secondary'
                        ));
                        ?>
                    </div>
                    <?php echo form_close(); ?>
                    <p align="center"><a href="<?=site_url();?>">Kembali</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ($this->session->flashdata('titleFlash')) : ?>
<script>
showToast('<?= $this->session->flashdata('colorFlash'); ?>', '<?= $this->session->flashdata('titleFlash'); ?>',
    '<?= $this->session->flashdata('captionFlash'); ?>');
</script>
<?php endif ?>
<?= $this->endSection() ?>
<?= $this->extend('layouts/frame_login') ?>