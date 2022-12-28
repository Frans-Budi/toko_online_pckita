<?php
  require_once '../function.php';
  
  // Ambil Data Kategori Dari Database
  $catagory = QueryData("SELECT * FROM kategori");

  // Jika Tombol Kirim ditekan
  if(isset($_POST['kirim'])){
    // Cek Insert Produk
    if(insert_produk($_POST) > 0){
      echo "<script>
        alert('Data Produk Berhasil Disimpan!');
      </script>";
    }else{
      echo "<script>
        alert('Terjadi Kesalahan, Data Produk Gagal Disimpan!');
      </script>";
    }
    
  }
?>

<!DOCTYPE html>
<html lang="en">
  <?php require_once 'head_admin.php' ?>
  <body>
    <section class="" style="padding-top: 60px">
      <div class="container border rounded-4 shadow-lg c-admin bg-light p-4">
        <!-- Navbar Tombol -->
        <div class="row pb-3">
          <!-- Tombol Back -->
          <div class="col">
            <a href="../login.php" class="btn tombol-2 fs-6 fw-semibold">Kembali</a>
          </div>
          <!-- Tombol Lihat Semua -->
          <div class="col text-end">
            <a href="all_products.php" class="btn btn-outline-secondary fs-6 fw-semibold">Lihat Semua</a>
          </div>
        </div>
        <h1 class="text-center">Selamat Datang Admin</h1>
        <hr />
        <div class="row p-2">
          <div class="col">
            <form action="" method="POST" enctype="multipart/form-data">
              <!-- Judul -->
              <div class="mb-3">
                <label for="judul" class="form-label fs-6 fw-semibold">Judul</label>
                <input type="text" class="form-control" name="judul" id="judul" aria-describedby="emailHelp" required />
              </div>
              <!-- Deskripsi -->
              <div class="mb-3">
                <label for="desciption" class="form-label fs-6 fw-semibold">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="desciption" cols="30" rows="8" required></textarea>
              </div>
              <!-- Harga -->
              <div class="mb-3">
                <label for="judul" class="form-label fs-6 fw-semibold">Harga</label>
                <input type="number" name="harga" class="form-control" id="judul" aria-describedby="emailHelp" required />
              </div>
              <!-- Kategory -->
              <div class="mb-3">
                <label for="judul" class="form-label fs-6 fw-semibold">Kategori</label>
                <select class="form-select" name="kategori" aria-label="Default select example">
                  <?php foreach($catagory as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= $cat['nama'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <!-- Gambar -->
              <div class="mb-3">
                <label for="formFile" class="form-label fs-6 fw-semibold">Gambar Produk</label>
                <input class="form-control" name="gambar" type="file" id="formFile" required />
              </div>
              <!-- Tombol Kirim -->
              <div class="pt-2 text-center">
                <button type="submit" name="kirim" class="btn tombol fs-5 pe-5 ps-5">Kirim</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
