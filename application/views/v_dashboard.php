<?= $this->section('page_title') ?>Dashboard | <?= APP_NAME; ?> <?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="pc-content">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">Selamat Datang di <?= APP_NAME; ?> 👮</h4>
                <p><strong>Selamat datang di fitur Patroli SIBER!</strong> Fitur ini memantau dan menganalisis aktivitas operator tiap bidang secara real-time untuk meningkatkan produktivitas dan menjaga kualitas kerja.</p>
                <hr>
                <h5>📢 INFO </h5>
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
<?= $this->extend('layouts/frame_main') ?>
