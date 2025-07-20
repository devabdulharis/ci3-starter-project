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
                        <a class="nav-link text-dark active" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#latar_belakang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark me-2" href="#publik">Publik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark me-2" href="#dokumen">Dokumen</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link text-dark me-2" href="#instansi">Instansi Terkait</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="btn btn-secondary" href="<?=base_url('login');?>">LOGIN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header id="home">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-sm-12 col-lg-7 col-xl-5">
                    <h1 class="mt-sm-3 mb-sm-4 f-w-600 wow fadeInDown" data-wow-delay="0.9s"><span
                            class="text-primary">Apa itu <?=APP_NAME;?>?</span></h1>
                    <h4 class="mb-sm-4 text-muted leading-10 wow fadeInDown" style="line-height:25px;"
                        data-wow-delay="0.4s"><?=APP_NAME;?>
                        (<?=APP_DESC;?>)
                        adalah platform inovatif untuk meningkatkan kualitas pelayanan publik di Kabupaten
                        Cirebon. Fokusnya adalah mengoptimalkan kinerja Satpol PP dan Sub Bagian Perencanaan, Evaluasi,
                        serta Pelaporan. Siber juga berperan sebagai bank data pelanggar peraturan daerah.
                    </h4>
                </div>
                <div class="col-sm-12 col-lg-7 m-sm-auto m-xl-0">
                    <div class="hero-image text-center">
                        <img src="<?=base_url('assets/');?>images/1.png" alt="image"
                            class="img-fluid img-bg wow fadeInDown" data-wow-delay="0.5s">
                        <div class="img-widget-1"><img src="<?=base_url('assets/');?>images/2.png" alt="image"
                                class="img-fluid wow fadeInDown" data-wow-delay="0.6s"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?= $this->renderSection('content') ?>

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
                                    class="text-white">JL. Sunan Giri
                                    No. 4 Kompleks
                                    Pemda Sumber Cirebon Jawa Barat, Indonesia</a></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding:5px;"><i class="fas fa-phone m-r-10 text-warning">
                            </td>
                            <td class="text-white">0231-350-052</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding:5px;"><i
                                    class="fas fa-envelope m-r-10 text-warning"></td>
                            <td class="text-white">polpp@cirebonkab.go.id</td>
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
    <script src="<?=base_url('assets/');?>js/plugins/apexcharts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    $(document).ready(function() {
        showChartPegawaiByAction('status', null, 'status-pegawai-chart');
    });

    function generateRandomColor() {
        return '#' + Math.floor(Math.random() * 16777215).toString(16);
    }

    function load_data_tibum() {
        // Cek apakah instance DataTables sudah ada untuk elemen #data
        if ($.fn.DataTable.isDataTable('#data_tibum')) {
            // Jika sudah ada, hancurkan
            $('#data_tibum').DataTable().destroy();
        }

        // Inisialisasi DataTables setelah dihancurkan atau jika belum ada
        $('#data_tibum').DataTable({
            "processing": true,
            "serverSide": true,
            "bSort": true,
            "ajax": {
                "url": "<?= base_url('kegiatan/data') ?>", // Sesuaikan dengan URL untuk memuat data dari server
                "type": "POST"
            },
            "columns": [{
                    "data": "0"
                }, // Kolom 0
                {
                    "data": "1"
                }, // Kolom 1
                {
                    "data": "2"
                }, // Kolom 2
                {
                    "data": "3"
                }, // Kolom 2
                {
                    "data": "4"
                }, // Kolom 2
                {
                    "data": "5"
                }, // Kolom 2
                {
                    "data": "6"
                }, // Kolom 2
                {
                    "data": "7"
                }, // Kolom 2
                {
                    "data": "8"
                }
            ],
            "dom": '<"top"Bfrt>lrt<"bottom"ip><"clear">', // Memposisikan tombol di atas Show entries
            "buttons": [{
                extend: 'pdfHtml5',
                text: 'PDF',
                orientation: 'landscape',
                pageSize: 'A4',
                className: 'btn btn-sm btn-outline-primary d-inline-flex', // Tambahkan kelas ke tombol PDF
                exportOptions: {
                    columns: ':visible:not(:nth-child(10))'
                }
            }]
        });
    }

    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    function showChartPegawaiByAction(act, data, targetId) {
        let options;
        switch (act) {
            case "status":
                options = {
                    series: [<?php 
            $series = array();
            foreach ($status_counts as $status_count) {
                $series[] = $status_count['series'];
            }
            echo implode(',', $series);
        ?>],
                    chart: {
                        width: 380,
                        type: 'pie',
                    },
                    labels: [<?php 
            $labels = array();
            foreach ($status_counts as $status_count) {
                $labels[] = "'" . $status_count['labels'] . "'";
            }
            echo implode(',', $labels);
        ?>],
                    colors: [<?php 
            $random_colors = array();
            foreach ($status_counts as $status_count) {
                $random_colors[] = "generateRandomColor()";
            }
            echo implode(',', $random_colors);
        ?>],
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 400
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };
                var chart = new ApexCharts(document.querySelector("#" + targetId), options);
                chart.render();
                break;
            case "kecamatan":
                var canvas = document.querySelector("#" + targetId);
                var ctx = canvas.getContext('2d');

                // Data kecamatan dan jumlah pegawai
                var kecamatanNames = <?php echo json_encode($pegawai['kecamatan_names']); ?>;
                var dataPegawai = <?php echo json_encode($pegawai['dataPegawai']); ?>;

                // Array untuk menyimpan dataset untuk setiap kecamatan
                var datasets = [];

                // Loop melalui setiap kecamatan
                for (var i = 0; i < kecamatanNames.length; i++) {
                    var kecamatanName = kecamatanNames[i];
                    var jumlahPegawai = dataPegawai[i];

                    // Ambil warna acak
                    var color = getRandomColor();

                    // Buat dataset baru untuk setiap kecamatan
                    var dataset = {
                        label: kecamatanName,
                        data: [jumlahPegawai],
                        backgroundColor: color,
                        borderColor: color,
                        borderWidth: 1
                    };

                    // Tambahkan dataset ke array datasets
                    datasets.push(dataset);
                }

                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Jumlah Pegawai'], // Label sumbu X
                        datasets: datasets // Gunakan array datasets untuk menyimpan semua dataset
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Jumlah Pegawai'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'bottom' // Atur posisi legend ke bawah
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        // Mengembalikan label kecamatan dan jumlah pegawai
                                        return context.dataset.label + ': ' + context.parsed.y;
                                    }
                                }
                            }
                        }
                    }
                });
                break;
            case "desa":

                break;
        }
    }

    function showChartLinmasByAction(act, data, targetId) {
        let options;
        switch (act) {
            case "kecamatan":
                var canvas = document.querySelector("#" + targetId);
                var ctx = canvas.getContext('2d');

                // Data kecamatan dan jumlah pegawai
                var kecamatanNames = <?php echo json_encode($linmas['kecamatan_names']); ?>;
                var dataPegawai = <?php echo json_encode($linmas['dataLinmas']); ?>;

                // Array untuk menyimpan dataset untuk setiap kecamatan
                var datasets = [];

                // Loop melalui setiap kecamatan
                for (var i = 0; i < kecamatanNames.length; i++) {
                    var kecamatanName = kecamatanNames[i];
                    var jumlahPegawai = dataPegawai[i];

                    // Ambil warna acak
                    var color = getRandomColor();

                    // Buat dataset baru untuk setiap kecamatan
                    var dataset = {
                        label: kecamatanName,
                        data: [jumlahPegawai],
                        backgroundColor: color,
                        borderColor: color,
                        borderWidth: 1
                    };

                    // Tambahkan dataset ke array datasets
                    datasets.push(dataset);
                }

                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Jumlah Sebaran Aparat Linmas'], // Label sumbu X
                        datasets: datasets // Gunakan array datasets untuk menyimpan semua dataset
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Jumlah Linmas'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'bottom' // Atur posisi legend ke bawah
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        // Mengembalikan label kecamatan dan jumlah pegawai
                                        return context.dataset.label + ': ' + context.parsed.y;
                                    }
                                }
                            }
                        }
                    }
                });
                break;
        }
    }

    function showChartSiskamlingByAction(act, data, targetId) {
        switch (act) {
            case "kecamatan":
                var canvas = document.querySelector("#" + targetId);

                // Data kecamatan dan jumlah pegawai
                var kecamatanNames = <?php echo json_encode($siskamling['kecamatan_names']); ?>;
                var dataPegawai = <?php echo json_encode($siskamling['dataSiskamling']); ?>;

                // Array untuk menyimpan data pegawai
                var pegawaiData = [];

                // Loop melalui setiap kecamatan
                for (var i = 0; i < kecamatanNames.length; i++) {
                    var kecamatanName = kecamatanNames[i];
                    var jumlahPegawai = dataPegawai[i];

                    // Tambahkan data ke array pegawaiData
                    pegawaiData.push(jumlahPegawai);
                }

                var options = {
                    series: [{
                        name: 'Total ', // Nama series
                        data: pegawaiData // Data jumlah pegawai
                    }],
                    chart: {
                        type: 'bar',
                        height: 800
                    },
                    plotOptions: {
                        bar: {
                            barHeight: '100%',
                            distributed: true,
                            horizontal: true,
                            dataLabels: {
                                position: 'bottom'
                            },
                        }
                    },
                    // colors: colors,
                    dataLabels: {
                        enabled: true,
                        textAnchor: 'start',
                        style: {
                            colors: ['#000']
                        },
                        formatter: function(val, opt) {
                            return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                        },
                        offsetX: 0,
                        dropShadow: {
                            enabled: true
                        }
                    },
                    legend: {
                        show: false
                    },
                    xaxis: {
                        categories: kecamatanNames,
                    },
                    yaxis: {
                        labels: {
                            show: false
                        }
                    },
                    title: {
                        text: 'Total Siskamling <?=$siskamling['total'];?>',
                        align: 'center',
                        floating: true
                    },
                    tooltip: {
                        theme: 'dark',
                        x: {
                            show: false
                        },
                        y: {
                            title: {
                                formatter: function() {
                                    return ''
                                }
                            }
                        }
                    }
                };

                var chart = new ApexCharts(canvas, options);
                chart.render();

                break;
        }
    }

    function load_perda(tipe) {
        // Cek apakah instance DataTables sudah ada untuk elemen #data
        if ($.fn.DataTable.isDataTable('#data_' + tipe)) {
            // Jika sudah ada, hancurkan
            $('#data_' + tipe).DataTable().destroy();
        }

        // Inisialisasi DataTables setelah dihancurkan atau jika belum ada
        $('#data_' + tipe).DataTable({
            "processing": true,
            "serverSide": true,
            "bSort": true,
            "ajax": {
                "url": "<?=base_url('perda/data_landing/');?>" +
                    tipe, // Sesuaikan dengan URL untuk memuat data dari server
                "type": "POST"
            },
            "columns": [{
                    "data": "0"
                }, // Kolom 0
                {
                    "data": "1"
                }, // Kolom 1
                {
                    "data": "2"
                }, // Kolom 2
                {
                    "data": "3"
                }, // Kolom 3
                {
                    "data": "4"
                }, // Kolom 4
                {
                    "data": "5"
                }
            ],
            "dom": '<"top"Bfrt>lrt<"bottom"ip><"clear">', // Memposisikan tombol di atas Show entries
            "buttons": [{
                    extend: 'copyHtml5',
                    text: 'Copy',
                    className: 'btn btn-sm btn-outline-primary d-inline-flex', // Tambahkan kelas ke tombol Copy
                    exportOptions: {
                        columns: ':visible:not(:nth-child(7))'
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    className: 'btn btn-sm btn-outline-primary d-inline-flex', // Tambahkan kelas ke tombol Excel
                    exportOptions: {
                        columns: ':visible:not(:nth-child(7))'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    pageSize: 'A4',
                    orientation: 'potrait',
                    className: 'btn btn-sm btn-outline-primary d-inline-flex', // Tambahkan kelas ke tombol PDF
                    exportOptions: {
                        columns: ':visible:not(:nth-child(7))'
                    }
                }
            ]
        });
    }

    var dataSuratMasuk = <?php echo json_encode($dataSuratMasuk); ?>;

    var ctx = document.getElementById('suratMasukChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Object.keys(dataSuratMasuk), // Menjadi array dari jenis surat
            datasets: [{
                    label: 'Selesai',
                    data: Object.values(dataSuratMasuk).map(item => item
                        .selesai), // Mengambil jumlah surat selesai
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Proses',
                    data: Object.values(dataSuratMasuk).map(item => item
                        .proses), // Mengambil jumlah surat proses
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }
            ]
        }
    });
    </script>
</body>

</html>