<?php if (!$this->auth->is_logged()) {
    log_message('error', 'login first');
    redirect('login');
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
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/plugins/dropzone.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/plugins/datatables.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/plugins/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/plugins/notifier.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>fonts/tabler-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>fonts/feather.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>fonts/fontawesome.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>fonts/material.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/style.css" id="main-style-link">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/style-preset.css">

    <script src="<?= base_url('assets/'); ?>js/plugins/popper.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/plugins/simplebar.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/fonts/custom-font.js"></script>

    <script src="<?= base_url('assets/'); ?>js/pcoded.js"></script>
    <script src="<?= base_url('assets/'); ?>js/plugins/feather.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/plugins/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/plugins/notifier.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/plugins/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/plugins/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/plugins/sweetalert.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/plugins/bouncher.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/plugins/choices.min.js"></script>
    <!-- DATATABLES -->
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= base_url('assets/'); ?>js/main.js"></script>
</head>

<body data-pc-preset="preset-7" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr"
    data-pc-theme="light">
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
    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="<?= base_url('dashboard'); ?>" class="b-brand text-primary">
                    <img src="<?= base_url('assets/images/logo-dark.svg'); ?>" class="logo logo-lg" width="90%">
                </a>
            </div>
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item pc-caption">
                        <label>Dashboard</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item <?= $this->auth->pageActive("dashboard"); ?>">
                        <a href="<?= base_url('dashboard'); ?>" class="pc-link"><span class="pc-micon"><i
                                    class="ti ti-dashboard"></i></span><span class="pc-mtext">Informasi</span></a>
                    </li>
                    <li class="pc-item pc-caption">
                        <label>Bank Data</label>
                        <i class="ti ti-apps"></i>
                    </li>
                    <?php
                    if ($this->auth->can('read-pegawai')) {
                    ?>
                        <li class="pc-item <?= $this->auth->pageActive("pegawai"); ?>">
                            <a href="<?= base_url('pegawai'); ?>" class="pc-link"><span class="pc-micon"><i
                                        class="ti ti-user"></i></span><span class="pc-mtext">Pegawai</span></a>
                        <?php
                    }
                        ?>
                        </li>
                        <?php
                        if ($this->auth->can('read-sarana')) {
                        ?>
                            <li class="pc-item <?= $this->auth->pageActive("sarana"); ?>">
                                <a href="<?= base_url('sarana/read'); ?>" class="pc-link"><span class="pc-micon"><i
                                            class="ti ti-building"></i></span><span class="pc-mtext">Sarana Prasarana</span></a>
                            </li>
                        <?php
                        }
                        ?>
                        <!-- <li class="pc-item">
                        <a href="../elements/bc_typography.html" class="pc-link"><span class="pc-micon"><i
                                    class="ti ti-shirt"></i></span><span class="pc-mtext">Perlengkapan
                                Atribut</span></a>
                    </li> -->
                        <?php
                        if ($this->auth->can('read-kegiatan')) {
                        ?>
                            <li class="pc-item <?= $this->auth->pageActive("kegiatan"); ?>">
                                <a href="<?= base_url('kegiatan/read'); ?>" class="pc-link"><span class="pc-micon"><i
                                            class="fas fa-suitcase"></i></span><span class="pc-mtext">Kegiatan</span></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php
                        if ($this->auth->can('read-surat')) {
                        ?>
                            <li class="pc-item <?= $this->auth->pageActive("surat"); ?>">
                                <a href="<?= base_url('surat/read'); ?>" class="pc-link"><span class="pc-micon"><i
                                            class="ti ti-mail"></i></span><span class="pc-mtext">Surat Masuk</span></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php
                        if ($this->auth->can('read-bap')) {
                        ?>
                            <li class="pc-item <?= $this->auth->pageActive("bap"); ?>">
                                <a href="<?= base_url('bap/read'); ?>" class="pc-link"><span class="pc-micon"><i
                                            class="ti ti-notes"></i></span><span class="pc-mtext">Berita Acara (BAP)</span></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php
                        if ($this->auth->can('read-linmas')) {
                        ?>
                            <li class="pc-item <?= $this->auth->pageActive("linmas"); ?>">
                                <a href="<?= base_url('linmas/read'); ?>" class="pc-link"><span class="pc-micon"><i
                                            class="ti ti-shield-check"></i></span><span class="pc-mtext">Aparat
                                        Linmas</span></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php
                        if ($this->auth->can('read-siskamling')) {
                        ?>
                            <li class="pc-item <?= $this->auth->pageActive("siskamling"); ?>">
                                <a href="<?= base_url('siskamling/read'); ?>" class="pc-link"><span class="pc-micon"><i
                                            class="ti ti-home-2"></i></span><span class="pc-mtext">Pos
                                        Siskamling</span></a>
                            </li>
                        <?php
                        }
                        ?>
                        <!-- <li class="pc-item pc-hasmenu">
                        <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-apps"></i></span><span
                                class="pc-mtext">Basic</span><span class="pc-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="pc-submenu">
                            <li class="pc-item"><a class="pc-link" href="../elements/bc_alert.html">Alert</a></li>
                        </ul>
                    </li> -->
                        <li class="pc-item pc-caption">
                            <label>Dokumen</label>
                            <i class="ti ti-folders"></i>
                        </li>
                        <?php
                        if ($this->auth->can('add-filemanager')) {
                        ?>
                            <li class="pc-item <?= $this->auth->pageActive("filemanager"); ?>">
                                <a href="<?= base_url('filemanager'); ?>" class="pc-link"><span class="pc-micon"><i
                                            class="ti ti-file"></i></span><span class="pc-mtext">File manager</span></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php
                        if ($this->auth->can('read-perda')) {
                        ?>
                            <li class="pc-item <?= $this->auth->pageActive("perda"); ?>">
                                <a href="<?= base_url('perda/read'); ?>" class="pc-link"><span class="pc-micon"><i
                                            class="ti ti-certificate"></i></span><span class="pc-mtext">Data Perda</span></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php
                        if ($this->auth->can('read-sop')) {
                        ?>
                            <li class="pc-item <?= $this->auth->pageActive("sop"); ?>">
                                <a href="<?= base_url('sop/read'); ?>" class="pc-link"><span class="pc-micon"><i
                                            class="ti ti-vocabulary"></i></span><span class="pc-mtext">Data SOP</span></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php
                        if ($this->auth->can('index-rekap')) {
                        ?>
                            <li class="pc-item <?= $this->auth->pageActive("rekap"); ?>">
                                <a href="<?= base_url('rekap'); ?>" class="pc-link"><span class="pc-micon"><i
                                            class="ti ti-filter"></i></span><span class="pc-mtext">Data Rekap</span></a>
                            </li>
                        <?php
                        }
                        ?>
                        <li class="pc-item pc-caption">
                            <label>Pengaturan Sistem</label>
                            <i class="ti ti-folders"></i>
                        </li>
                        <?php
                        if ($this->auth->can('read-sistem')) {
                        ?>
                            <li class="pc-item <?= $this->auth->pageActive("sistem"); ?>">
                                <a href="<?= base_url('sistem'); ?>" class="pc-link"><span class="pc-micon"><i
                                            data-feather="settings"></i></span><span class="pc-mtext">Pengaturan Sistem</span></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php
                        if ($this->auth->can('read-user')) {
                        ?>
                            <li class="pc-item <?= $this->auth->pageActive("user"); ?>">
                                <a href="<?= base_url('user/read'); ?>" class="pc-link"><span class="pc-micon"><i
                                            class="ti ti-users"></i></span><span class="pc-mtext">Pengguna</span></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php
                        if ($this->auth->can('read-role')) {
                        ?>
                            <li class="pc-item <?= $this->auth->pageActive("role"); ?>">
                                <a href="<?= base_url('role/read'); ?>" class="pc-link"><span class="pc-micon"><i
                                            class="ti ti-accessible"></i></span><span class="pc-mtext">Akses Pengguna</span></a>
                            </li>
                        <?php
                        }
                        ?>
            </div>
    </nav>

    <header class=" pc-header">
        <div class="header-wrapper">
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <li class="pc-h-item header-mobile-collapse">
                        <a href="#" class="pc-head-link head-link-secondary ms-0" id="sidebar-hide">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link head-link-secondary ms-0" id="mobile-collapse">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="ms-auto">
                <ul class="list-unstyled">
                    <?php
                    $id_sesi = $this->session->userdata('id_sesi');
                    if (!empty($id_sesi)) {
                    ?>
                        <li class="dropdown pc-h-item pc-mega-menu">
                            <a href="#!" class="btn btn-outline-danger btn-md dropdown-toggle arrow-none me-0"
                                data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false">
                                SESI BAP : <?= $this->session->userdata('id_sesi'); ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                                <a href="<?= base_url('bap/sesi/' . $this->session->userdata('nik')); ?>"
                                    class="dropdown-item">
                                    <span>Buka Sesi</span>
                                </a>
                                <a href="<?= base_url('bap/tutup_sesi/' . $this->session->userdata('id_sesi')); ?>"
                                    class="dropdown-item">
                                    <span>Tutup Sesi</span>
                                </a>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                    <li class=" dropdown pc-h-item header-user-profile">
                        <a class="pc-head-link head-link-primary dropdown-toggle arrow-none me-0"
                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false">
                            <img src="<?= base_url('assets/'); ?>images/avatar_default.jpg" alt="user-image"
                                class="user-avtar">
                            <span>
                                <i class="ti ti-settings"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header">
                                <h4><?= $this->auth->getUserData()->last_name; ?>
                                </h4>
                                <p class="text-muted">Anda sebagai <strong>
                                        <?php
                                        $roles = $this->auth->getRoleUser();
                                        foreach ($roles as $item) {
                                            echo $item . ",";
                                        }
                                        ?>
                                    </strong>
                                </p>
                                <a href="<?= site_url('user/profile'); ?>" class="dropdown-item">
                                    <i class="ti ti-user"></i>
                                    <span>Profile</span>
                                </a>
                                <a href="<?= site_url('login/logout'); ?>" class="dropdown-item">
                                    <i class="ti ti-logout"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <section class="pc-container">
        <?= $this->renderSection('content') ?>
    </section>

    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col-sm-6 my-1">
                    <p class="m-0"><?= APP_NAME; ?> v<?= APP_VER; ?> | <?= APP_DEV_NAME; ?>
                    </p>
                </div>
                <div class="col-sm-6 ms-auto my-1">
                    <p class="m-0" align="right">Speed <strong>{elapsed_time}</strong> detik</p>
                </div>
            </div>
        </div>
    </footer>
    <div class="pct-c-btn">
        <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_pc_layout">
            <i class="ph-duotone ph-gear-six"></i>
        </a>
    </div>
    <div class="offcanvas border-0 pct-offcanvas offcanvas-end" tabindex="-1" id="offcanvas_pc_layout">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Theme Customization</h5>
            <div class="d-inline-flex align-items-center gap-2">
                <button type="button" class="btn btn-sm rounded btn-outline-danger" id="layoutreset">Reset</button>
                <a type="button" class="avtar avtar-s btn-link-danger btn-pc-default " data-bs-dismiss="offcanvas"
                    aria-label="Close"><i class="ti ti-x f-20"></i></a>
            </div>
        </div>
        <ul class="nav nav-tabs nav-fill pct-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation" data-bs-toggle="tooltip" title="Layout Settings">
                <button class="nav-link active" id="pct-1-tab" data-bs-toggle="tab" data-bs-target="#pct-1-tab-pane"
                    type="button" role="tab" aria-controls="pct-1-tab-pane" aria-selected="true"><i
                        class="ti ti-color-swatch"></i></button>
            </li>
            <li class="nav-item" role="presentation" data-bs-toggle="tooltip" title="Font Settings">
                <button class="nav-link" id="pct-2-tab" data-bs-toggle="tab" data-bs-target="#pct-2-tab-pane"
                    type="button" role="tab" aria-controls="pct-2-tab-pane" aria-selected="false"><i
                        class="ti ti-typography"></i></button>
            </li>
        </ul>
        <div class="pct-body customizer-body">
            <div class="offcanvas-body p-0">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="pct-1-tab-pane" role="tabpanel"
                        aria-labelledby="pct-1-tab" tabindex="0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="pc-dark">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 me-3">
                                            <h5 class="mb-1">Theme Mode</h5>
                                            <p class="text-muted text-sm mb-0">Light / Dark / System</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="row g-2 theme-color theme-layout">
                                                <div class="col-4">
                                                    <div class="d-grid">
                                                        <button class="preset-btn btn active" data-value="true"
                                                            onclick="layout_change('light');" data-bs-toggle="tooltip"
                                                            title="Light">
                                                            <span
                                                                class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="d-grid">
                                                        <button class="preset-btn btn" data-value="false"
                                                            onclick="layout_change('dark');" data-bs-toggle="tooltip"
                                                            title="Dark">
                                                            <span
                                                                class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="d-grid">
                                                        <button class="preset-btn btn" data-value="default"
                                                            onclick="layout_change_default();" data-bs-toggle="tooltip"
                                                            title="Automatically sets the theme based on user's operating system's color scheme.">
                                                            <span
                                                                class="pc-lay-icon d-flex align-items-center justify-content-center">
                                                                <i class="ph-duotone ph-cpu"></i>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <h5 class="mb-1">Accent color</h5>
                                <p class="text-muted text-sm mb-2">Choose your primary theme color</p>
                                <div class="theme-color preset-color">
                                    <a href="#!" class="active" data-value="preset-1"><i class="ti ti-check"></i></a>
                                    <a href="#!" data-value="preset-2"><i class="ti ti-check"></i></a>
                                    <a href="#!" data-value="preset-3"><i class="ti ti-check"></i></a>
                                    <a href="#!" data-value="preset-4"><i class="ti ti-check"></i></a>
                                    <a href="#!" data-value="preset-5"><i class="ti ti-check"></i></a>
                                    <a href="#!" data-value="preset-6"><i class="ti ti-check"></i></a>
                                    <a href="#!" data-value="preset-7"><i class="ti ti-check"></i></a>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 me-3">
                                        <h5 class="mb-1">Sidebar Caption</h5>
                                        <p class="text-muted text-sm mb-0">Caption Hide / Show</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="row g-2 theme-color theme-nav-caption">
                                            <div class="col-6">
                                                <div class="d-grid">
                                                    <button class="preset-btn btn active" data-value="true"
                                                        onclick="layout_caption_change('true');"
                                                        data-bs-toggle="tooltip" title="Caption Show">
                                                        <span
                                                            class="pc-lay-icon"><span></span><span></span><span><span></span><span></span></span><span></span></span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-grid">
                                                    <button class="preset-btn btn" data-value="false"
                                                        onclick="layout_caption_change('false');"
                                                        data-bs-toggle="tooltip" title="Caption Hide">
                                                        <span
                                                            class="pc-lay-icon"><span></span><span></span><span><span></span><span></span></span><span></span></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="pc-rtl">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 me-3">
                                            <h5 class="mb-1">Theme Layout</h5>
                                            <p class="text-muted text-sm">LTR/RTL</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="row g-2 theme-color theme-direction">
                                                <div class="col-6">
                                                    <div class="d-grid">
                                                        <button class="preset-btn btn active" data-value="false"
                                                            onclick="layout_rtl_change('false');"
                                                            data-bs-toggle="tooltip" title="LTR">
                                                            <span
                                                                class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-grid">
                                                        <button class="preset-btn btn" data-value="true"
                                                            onclick="layout_rtl_change('true');"
                                                            data-bs-toggle="tooltip" title="RTL">
                                                            <span
                                                                class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item pc-box-width">
                                <div class="pc-container-width">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 me-3">
                                            <h5 class="mb-1">Layout Width</h5>
                                            <p class="text-muted text-sm">Full / Fixed width</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="row g-2 theme-color theme-container">
                                                <div class="col-6">
                                                    <div class="d-grid">
                                                        <button class="preset-btn btn active" data-value="false"
                                                            onclick="change_box_container('false')"
                                                            data-bs-toggle="tooltip" title="Full Width">
                                                            <span
                                                                class="pc-lay-icon"><span></span><span></span><span></span><span><span></span></span></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-grid">
                                                        <button class="preset-btn btn" data-value="true"
                                                            onclick="change_box_container('true')"
                                                            data-bs-toggle="tooltip" title="Fixed Width">
                                                            <span
                                                                class="pc-lay-icon"><span></span><span></span><span></span><span><span></span></span></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="pct-2-tab-pane" role="tabpanel" aria-labelledby="pct-2-tab"
                        tabindex="0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <h5 class="mb-1">Font Style</h5>
                                <p class="text-muted text-sm">Choose theme font</p>
                                <div class="theme-color theme-font-style">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="layout_font"
                                            id="layoutfontRoboto" checked onclick="font_change('Roboto')">
                                        <label class="form-check-label" for="layoutfontRoboto"> Roboto </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="layout_font"
                                            id="layoutfontPoppins" onclick="font_change('Poppins')">
                                        <label class="form-check-label" for="layoutfontPoppins"> Poppins </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="layout_font"
                                            id="layoutfontInter" onclick="font_change('Inter')">
                                        <label class="form-check-label" for="layoutfontInter"> Inter </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="layout_font"
                                            id="layoutfontManrope" onclick="font_change('Manrope')">
                                        <label class="form-check-label" for="layoutfontManrope"> Manrope </label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
