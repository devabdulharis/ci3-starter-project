# 📘 Dokumentasi Penggunaan Script JavaScript

Script ini digunakan untuk menangani berbagai interaksi dalam aplikasi berbasis jQuery, Bootstrap modal, dan Axios (untuk HTTP request), termasuk validasi input, reset form, notifikasi, dan pengambilan data dari server.

---

## 📌 1. Inisialisasi Dokumen

```javascript
$(document).ready(function () {
    ...
});
```

### ✅ Fitur:

- Mereset semua form (kecuali `#f_rekap`) saat modal ditutup.
- Mereset preview gambar ke placeholder default.
- Validasi input angka (`.numeric-input`), hanya memperbolehkan angka dan maksimal satu titik desimal.

---

## 📌 2. Fungsi: `showToast(type, title, body)`

### Fungsi untuk menampilkan notifikasi toast.

```javascript
showToast("success", "Sukses", "Data berhasil disimpan");
```

### Parameter:

- `type` : `'success'`, `'warning'`, `'danger'`
- `title` : Judul notifikasi
- `body` : Pesan notifikasi

---

## 📌 3. Fungsi: `submitForm(formId, endpoint, callback)`

### Submit form menggunakan `axios.post` dengan `FormData`.

```javascript
submitForm("myForm", "endpoint/url", function (success, response) {
  if (success) {
    // lanjutkan proses
  }
});
```

### Proses:

- Kirim form dengan method `POST`
- Tampilkan notifikasi sesuai response
- Reset form jika berhasil

---

## 📌 4. Fungsi: `axiosPostData(endpoint, formData, callback)`

### Kirim `FormData` secara manual menggunakan `axios`.

```javascript
const formData = new FormData();
formData.append('key', 'value');

axiosPostData('endpoint/url', formData, function (success, resp) {
    ...
});
```

---

## 📌 5. Fungsi: `axiosGetDelete(endPoint, message)`

### Konfirmasi dan hapus data dengan method `GET`.

```javascript
axiosGetDelete("delete/item/123", "Yakin ingin menghapus item ini?");
```

### Proses:

- Tampilkan dialog konfirmasi (SweetAlert)
- Jika dikonfirmasi, lakukan `GET` request
- Tampilkan dialog informasi dan reload data

---

## 📌 6. Fungsi: `axiosGetDetail(endPoint, callback)`

### Mendapatkan detail data dari endpoint.

```javascript
axiosGetDetail("get/detail/123", function (success, data) {
  if (success) {
    // tampilkan data
  }
});
```

### Catatan:

- Akan memanggil `showToast()` jika gagal dan error bukan "not found".

---

## 📌 7. Fungsi: `clearModal(targetId)`

### Menutup modal dengan ID tertentu.

```javascript
clearModal("editModal");
```

---

## 📌 8. Fungsi: `showConfirmationDialog(message, onConfirm)`

### Menampilkan dialog konfirmasi dengan SweetAlert.

```javascript
showConfirmationDialog("Yakin hapus?", function () {
  // lanjutkan penghapusan
});
```

---

## 📌 9. Fungsi: `showInformationDialog(message, isSuccess)`

### Menampilkan informasi berhasil/gagal.

```javascript
showInformationDialog("Data berhasil dihapus", true);
```

### Parameter:

- `message`: isi pesan
- `isSuccess`: default `true`, jika `false` akan menampilkan dialog gagal

---

## 📎 Dependencies

- jQuery
- Bootstrap (modal)
- Axios
- SweetAlert2

---

## 📝 Catatan Tambahan

- `baseUrl` harus sudah didefinisikan secara global.
- Pastikan ID form dan elemen lainnya konsisten dengan penggunaan di HTML.

---

> Simpan file ini sebagai `USAGE.md` atau `README.md` untuk referensi pengembang lain.
