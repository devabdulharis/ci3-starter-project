$(document).ready(function () {
    // Reset forms ketika modal ditutup
    $('.modal').on('hidden.bs.modal', function () {
        $('form').each(function () {
            if ($(this).attr('id') !== 'f_rekap') {
                this.reset();
                $(this).find('input[type=hidden]').val('');
            }
        });

        // Reset foto preview jika ada
        const preview = $('#foto_preview');
        if (preview.length) {
            preview.attr('src', baseUrl + 'assets/images/image_placeholder.jpeg');
        }
    });

    // Validasi input angka
    $('.numeric-input').on('input', function () {
        let value = $(this).val().replace(/[^0-9.]/g, '');
        const dotCount = (value.match(/\./g) || []).length;
        if (dotCount > 1) {
            value = value.substring(0, value.lastIndexOf('.'));
        }
        $(this).val(value);
    });
});

function showToast(type, title, body) {
    const icons = {
        warning: "medium_priority",
        success: "ok",
        danger: "high_priority"
    };
    const imgIcon = icons[type] || "info";
    notifier.show(title, body, type, ${baseUrl}assets/images/notif/${imgIcon}-48.png, 4000);
}

function submitForm(formId, endpoint, callback) {
    const formData = new FormData(document.getElementById(formId));
    axios.post(${baseUrl}${endpoint}, formData)
        .then((resp) => {
            if (resp.data.rc === "00") {
                showToast('success', 'Sukses', resp.data.data);
                callback(true, resp.data);
                document.getElementById(formId).reset();
            } else {
                showToast('danger', 'Gagal', resp.data.data);
                callback(false, resp.data);
            }
        })
        .catch((error) => {
            callback(false, error);
        });
}

function axiosPostData(endpoint, formData, callback) {
    axios.post(${baseUrl}${endpoint}, formData)
        .then((resp) => {
            if (resp.data.rc === "00") {
                callback(true, resp.data);
            } else {
                callback(false, resp.data);
            }
        })
        .catch((error) => {
            callback(false, error);
        });
}

function axiosGetDelete(endPoint, message) {
    showConfirmationDialog(message, function () {
        axios.get(${baseUrl}${endPoint})
            .then((resp) => {
                if (resp.data.rc === "00") {
                    showInformationDialog(resp.data.data, true);
                    load_data();
                } else {
                    showInformationDialog(resp.data.data, false);
                }
            })
            .catch((error) => {
                showToast('danger', 'Error', error.message);
            });
    });
}

function axiosGetDetail(endPoint, callback) {
    axios.get(${baseUrl}${endPoint})
        .then((resp) => {
            if (resp.data.rc === "00") {
                callback(true, resp.data.data);
            } else {
                if (!resp.data.data.includes("found")) {
                    showToast('danger', 'Gagal', resp.data.data);
                }
                callback(false, resp.data.data);
            }
        })
        .catch((error) => {
            callback(false, error);
        });
}

function clearModal(targetId) {
    $(#${targetId}).modal('hide');
}

function showConfirmationDialog(message, onConfirm) {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            onConfirm();
        }
    });
}

function showInformationDialog(message, isSuccess = true) {
    Swal.fire({
        title: isSuccess ? 'Sukses!' : 'Gagal!',
        text: message,
        icon: isSuccess ? 'success' : 'error',
        confirmButtonText: 'Ya'
    });
}
