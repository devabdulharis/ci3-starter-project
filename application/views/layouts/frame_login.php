<?php if ($this->auth->is_logged()) {
    redirect('dashboard');
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $this->renderSection('page_title') ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?= APP_META; ?>">
    <meta name="keywords" content="<?= APP_KEYWORDS; ?>">
    <meta name="author" content="<?= APP_DEV_NAME; ?>">

    <script>
        var baseUrl = '<?php echo base_url(); ?>';
    </script>

    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/'); ?>images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/'); ?>images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/'); ?>images/favicon-16x16.png">
    <link rel="manifest" href="<?= base_url('assets/'); ?>images/site.webmanifest">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap"
        id="main-font-link">

    <link rel="stylesheet" href="<?= base_url('assets/'); ?>fonts/tabler-icons.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/'); ?>fonts/feather.css">

    <link rel="stylesheet" href="<?= base_url('assets/'); ?>fonts/fontawesome.css">

    <link rel="stylesheet" href="<?= base_url('assets/'); ?>fonts/material.css">

    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/style.css" id="main-style-link">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/style-preset.css">
    <script src="<?= base_url('assets/'); ?>js/plugins/bootstrap.min.js"></script>
</head>

<body>

    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 99999">
        <div id="toastify" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="<?= base_url('assets/'); ?>images/icon.svg" class="img-fluid m-r-5" alt="images"
                    style="width: 17px; margin-right:5px;">
                <strong class="me-auto" id="toast_title"></strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toast_body"></div>
        </div>
    </div>

    <script>
        function showToast(type, title, body) {
            let f = document.getElementById('toastify');
            let a = new bootstrap.Toast(f);
            document.getElementById('toast_title').innerText = title;
            document.getElementById('toast_body').innerText = body;
            a.show();
        }
    </script>

    <?= $this->renderSection('content') ?>

    <script src="<?= base_url('assets/'); ?>js/plugins/popper.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/plugins/simplebar.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/fonts/custom-font.js"></script>
    <script src="<?= base_url('assets/'); ?>js/pcoded.js"></script>
    <script src="<?= base_url('assets/'); ?>js/plugins/feather.min.js"></script>
    <script>
        font_change("Roboto");
    </script>
    <script>
        layout_rtl_change('false');
    </script>
</body>

</html>
