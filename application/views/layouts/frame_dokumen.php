<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $this->renderSection('page_title') ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?=APP_META;?>">
    <meta name="keywords" content="<?=APP_KEYWORDS;?>">
    <meta name="author" content="<?=APP_DEV_NAME;?>">

    <script>
    baseUrl = '<?=base_url();?>';
    </script>

    <link rel="icon" href="<?=base_url('assets/');?>images/icon.svg" type="image/x-icon">
    <link href="<?=base_url('assets/');?>css/plugins/animate.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700&display=swap"
        id="main-font-link">
    <link rel="stylesheet" href="<?=base_url('assets/');?>css/plugins/datatables.min.css">
    <link rel="stylesheet" href="<?=base_url('assets/');?>css/plugins/style.css">
    <link rel="stylesheet" href="<?=base_url('assets/');?>fonts/tabler-icons.min.css">
    <link rel="stylesheet" href="<?=base_url('assets/');?>fonts/feather.css">
    <link rel="stylesheet" href="<?=base_url('assets/');?>fonts/fontawesome.css">
    <link rel="stylesheet" href="<?=base_url('assets/');?>fonts/material.css">
    <link rel="stylesheet" href="<?=base_url('assets/');?>css/style.css" id="main-style-link">
    <link rel="stylesheet" href="<?=base_url('assets/');?>css/style-preset.css">
    <link rel="stylesheet" href="<?=base_url('assets/');?>css/landing.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?=base_url('assets/');?>js/plugins/jquery.dataTables.min.js"></script>
    <script src="<?=base_url('assets/');?>js/plugins/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
    #hero-docs {
        position: relative;
        padding: 100px 0;
        color: white;
        text-align: center;
        overflow: hidden;
    }

    #hero-docs::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('https://img.freepik.com/premium-vector/background-squares-abstract-design-notebook-texture_689723-59.jpg?w=1000') repeat;
        background-size: contain;
        opacity: 0.3; /* Ganti sesuai kebutuhan */
        z-index: 0;
    }

    #hero-docs .container {
        position: relative;
        z-index: 1; /* Supaya teks tampil di atas background */
    }
    </style>
    <body class="landing-page">
        <div class="loader-bg">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>

        <nav class="navbar navbar-expand-md navbar-light default">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="<?=base_url('assets/');?>images/logo-dark.svg" width="55%" alt="logo"
                        class="img-fluid brand-logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
                    aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-dark active" href="<?=site_url();?>#home">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="<?=site_url();?>#latar_belakang">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark me-2" href="<?=site_url();?>#publik">Publik</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark me-2" href="<?=site_url('landing/dokumen');?>">Dokumen</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-secondary" href="https://play.google.com/store/apps/details?id=com.cirebonkab.laporpraja"
                            target="_blank">LAPOR</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="hero-docs">
            <div class="container">
                <h1 style="font-size: 3rem; font-weight: 700; margin-bottom: 20px;">Dokumen</h1>
                <p style="font-size: 1.25rem; max-width: 600px; margin: 0 auto;color:black;">
                    Akses mudah terhadap dokumen penting sebagai wujud komitmen terhadap keterbukaan informasi publik.
                </p>
            </div>
        </div>
        <div style="background:var(--bs-body-bg);">
            <?= $this->renderSection('content') ?>
        </div>
        <footer class="footer bg-secondary">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-4 col-lg-12 col-xl-5 my-1">
                        <img src="<?=base_url('assets/');?>images/logo-white.svg" style="margin-left:-10px;" alt="logo"
                            class="img-fluid">
                        <p class="text-white mt-3"><?=APP_META;?></p>
                    </div>
                    <div class="col-md-4 col-lg-12 col-xl-3 my-1">
                        <h4 class="text-white">Menu Navigasi</h4>
                        <ul class="list-unstyled text-white mt-3">
                            <li class="mt-2"><a href="#home" style="text-decoration:none" class="text-white">Beranda</a>
                            </li>
                            <li class="mt-2"><a href="#latar_belakang" style="text-decoration:none"
                                    class="text-white">Tentang</a>
                            </li>
                            <li class="mt-2"><a href="#publik" style="text-decoration:none" class="text-white">Publik</a>
                            </li>
                            <li class="mt-2"><a href="#dokumen" style="text-decoration:none" class="text-white">Dokumen</a>
                            </li>
                            <!-- <li class="mt-2"><a href="#instansi" style="text-decoration:none" class="text-white">Instansi
                                    Terkait</a></li> -->
                        </ul>
                    </div>
                    <div class="col-md-4 col-lg-12 col-xl-3 my-1">
                        <h4 class="text-white">Kontak Kami</h4>
                        <table>
                            <tr>
                                <td style="vertical-align: top; padding:5px;"><i class="fa fa-map m-r-10 text-warning"></td>
                                <td><a href="https://maps.app.goo.gl/Uc4AQP7BRL3TZBpD9" target="_blank"
                                        class="text-white">Jl. Sunan Giri No. 4 Komplek
                                        Pemda Sumber Cirebon Jawa Barat, Indonesia</a></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding:5px;"><i class="fas fa-phone m-r-10 text-warning">
                                </td>
                                <td class="text-white">0231-320052</td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding:5px;"><i
                                        class="fas fa-envelope m-r-10 text-warning"></td>
                                <td> <a href="mailto:satpolpp@cirebonkab.go.id" target="_blank"
                                        class="text-white">satpolpp@cirebonkab.go.id</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="sub-footer">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col">
                            <a class="mb-0 text-white">Hak Cipta <?=date("Y");?> <?=APP_DEV_NAME;?></a>
                        </div>
                        <div class="col-auto">
                            <a class="mb-0 text-white">Waktu Load {elapsed_time} Detik</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    <script src="<?=base_url('assets/');?>js/plugins/popper.min.js"></script>
    <script src="<?=base_url('assets/');?>js/plugins/simplebar.min.js"></script>
    <script src="<?=base_url('assets/');?>js/plugins/bootstrap.min.js"></script>
    <script src="<?=base_url('assets/');?>js/fonts/custom-font.js"></script>
    <script src="<?=base_url('assets/');?>js/pcoded.js"></script>
    <script src="<?=base_url('assets/');?>js/plugins/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.0.0/countUp.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"
        integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    layout_change('light');
    </script>
    <script>
    layout_rtl_change('false');
    </script>
    <script>
    preset_change("preset-7");
    </script>
    <script>
    // Start [ Menu hide/show on scroll ]
    let ost = 0;
    document.addEventListener('scroll', function() {
        let cOst = document.documentElement.scrollTop;
        if (cOst == 0) {
            document.querySelector(".navbar").classList.add("top-nav-collapse");
        } else if (cOst > ost) {
            document.querySelector(".navbar").classList.add("top-nav-collapse");
            document.querySelector(".navbar").classList.remove("default");
        } else {
            document.querySelector(".navbar").classList.add("default");
            document.querySelector(".navbar").classList.remove("top-nav-collapse");
        }
        ost = cOst;
    });
    // End [ Menu hide/show on scroll ]
    var wow = new WOW({
        animateClass: 'animated',
    });
    wow.init();
    </script>
    </script>
</body>

</html>