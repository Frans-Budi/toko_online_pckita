<?php
  require_once '../function.php';

  // Cek Data Url harus dikirim
  if(!isset($_GET['id'])){
    header('location: all_products.php');
  }
  // Tangkap ID dari URL
  $id = $_GET['id'];

  // Ambil Data Kategori Dari Database
  $catagory = QueryData("SELECT * FROM kategori");
   // Ambil Data Produk Dari Database
  $produk = QueryData("SELECT produk.id, produk.nama, description, harga, gambar, id_kategori 
                      FROM produk JOIN kategori ON (kategori.id = produk.id_kategori) WHERE produk.id = $id;")[0];

  // Update Function
  if(isset($_POST['ubah'])){
    // Cek Ubah produk Berhasil / tidak
    if(ubah_produk($_POST) > 0){
      echo "<script>
        alert('Berhasil Mengubah Produk!');
        window.location.href = 'all_products.php';
      </script>";
    }else{
      echo "<script>
        alert('Terjadi Kesalahan, Gagal Mengubah Produk!');
      </script>";
    }
  }

  // Delete Function
  if(isset($_POST['hapus'])){
    // Cek Hapus produk berhasil / tidak
    if(hapus_produk($id) > 0){
      echo "<script>
        alert('Berhasil Mengubah Produk!');
        window.location.href = 'all_products.php';
      </script>";
    } else {
      echo "<script>
        alert('Terjadi Kesalahan, Gagal Menghapus Produk!');
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
            <a href="all_products.php" class="btn tombol-2 fs-6 fw-semibold">Kembali</a>
          </div>
        </div>
        <h1 class="text-center">Ubah Data Produk</h1>
        <hr />
        <div class="row p-2">
          <div class="col">
            <form action="" method="POST" enctype="multipart/form-data">
              <!-- ID -->
              <input type="hidden" name="id" value="<?= $id ?>">
              <!-- Gambar Lama -->
              <input type="hidden" name="gambarLama" value="<?= $produk['gambar'] ?>">
              <!-- Judul -->
              <div class="mb-3">
                <label for="judul" class="form-label fs-6 fw-semibold">Judul</label>
                <input type="text" class="form-control" name="judul" id="judul" aria-describedby="emailHelp" value="<?= $produk['nama'] ?>" required />
              </div>
              <!-- Deskripsi -->
              <div class="mb-3">
                <label for="desciption" class="form-label fs-6 fw-semibold">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="desciption" cols="30" rows="8" required><?= $produk['description'] ?></textarea>
              </div>
              <!-- Harga -->
              <div class="mb-3">
                <label for="harga" class="form-label fs-6 fw-semibold">Harga</label>
                <input type="number" name="harga" class="form-control" id="harga" aria-describedby="emailHelp" value="<?= $produk['harga'] ?>" required />
              </div>
              <!-- Kategori -->
              <div class="mb-3">
                <label for="kategori" class="form-label fs-6 fw-semibold">Kategori</label>
                <select class="form-select" name="kategori" aria-label="Default select example">
                  <?php foreach($catagory as $cat): ?>
                      <option value="<?= $cat['id'] ?>" <?= ($produk['id_kategori'] == $cat['id'])? 'selected' : '' ?> ><?= $cat['nama'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <!-- Gambar -->
              <label for="formFile" class="form-label fs-6 fw-semibold">Gambar Produk</label>
              <div class="mb-3">
                <div class="w-25 ratio ratio-1x1 mb-3">
                  <img src="../Images/<?= $produk['gambar'] ?>" class="pb-1 rounded" style="object-fit: contain;" />
                </div>
                <input class="form-control" name="gambar" type="file" id="formFile" />
              </div>
              <!-- Tombol Kirim -->
              <div class="pt-2 text-center">
                <button type="submit" name="ubah" class="btn tombol fs-5 pe-4 ps-4 me-2 mb-3">Kirim</button>
                <button type="submit" name="hapus" class="btn tombol-2 fs-5 pe-4 ps-4 ms-2 mb-3" onclick="confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')">Hapus</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
