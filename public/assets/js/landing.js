let ost = 0;
layout_change('light');
layout_rtl_change('false');
preset_change("preset-7");

// Menu hide/show on scroll
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

// Initialize WOW.js
var wow = new WOW({
    animateClass: 'animated',
});
wow.init();

// Initialize DataTable
$('#base-style').DataTable({
    "processing": true,
    "serverSide": true,
    "bSort": true,
    "ajax": {
        "url": baseUrl+"user/getUsers",
        "type": "POST"
    },
    "columns": [{
            "data": "0"
        }, // Username
        {
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
    ]
});

// Function to show chart for Pegawai by action
function showChartPegawaiByAction(act, data, targetId) {
    let options;
    switch (act) {
        case "status":
            options = {
                series: [data.series],
                chart: {
                    width: 380,
                    type: 'pie',
                },
                labels: [data.labels],
                colors: [data.colors],
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
                var kecamatanNames = data.kecamatanName;
                var dataPegawai = data.dataPegawai;

                // Array untuk menyimpan dataset untuk setiap kecamatan
                var datasets = [];

                // Loop melalui setiap kecamatan
                for (var i = 0; i < kecamatanNames.length; i++) {
                    var kecamatanName = kecamatanNames[i];
                    var jumlahPegawai = dataPegawai[i];

                    // Ambil warna acak
                    var color = generateRandomColor();

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
            // Your chart options for desa
            break;
    }
}
