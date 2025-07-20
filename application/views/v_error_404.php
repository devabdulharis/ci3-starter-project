<?= $this->section('page_title') ?>404 Not Found | <?=APP_NAME;?> <?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card error-card">
            <div class="card-body">
                <div class="error-image-block">
                    <img class="image-animated img-fluid"
                        src="<?=base_url('assets/');?>images/pages/img-maintenance-bg.svg" alt="image">
                    <img src="<?=base_url('assets/');?>images/pages/img-error-text.svg" class="img-404 error-text"
                        alt="image">
                    <img src="<?=base_url('assets/');?>images/pages/img-error-primary-widget.svg"
                        class="img-404 error-primary" alt="image">
                    <img src="<?=base_url('assets/');?>images/pages/img-error-secondary-widget.svg"
                        class="img-404 puple error-secondary" alt="image">
                </div>
                <div class="text-center">
                    <h1 class="mt-4"><b>Something is wrong</b></h1>
                    <p class="mt-4 text-muted">The page you are looking was moved, removed,<br>
                        renamed, or might never exist!
                    </p>
                    <a href="<?=site_url();?>" class="btn btn-primary mb-3"><i class="ti ti-home me-2"></i>Beranda</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->extend('layouts/frame_exception') ?>