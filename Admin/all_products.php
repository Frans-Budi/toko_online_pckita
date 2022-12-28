<?php
  require_once '../function.php';

   // Ambil Data Kategori Dari Database
  $catagory = QueryData("SELECT * FROM kategori");
   // Ambil Data Produk Dari Database
  $produk = QueryData("SELECT produk.id, produk.nama, description, harga, gambar, id_kategori 
                      FROM produk JOIN kategori ON (kategori.id = produk.id_kategori);")
?>

<!DOCTYPE html>
<html lang="en">
  <?php require_once 'head_admin.php'; ?>
  <body class="bg-light">
    <section>
      <div class="container p-4">
        <a class="btn tombol-2 mb-3 fw-semibold" href="admin.php" role="button">Kembali</a>
        <h1>Semua Produk</h1>
        <!-- Baris Konten -->
        <?php foreach($catagory as $ct): ?>
          <div class="row">
            <h2 class="mb-1 mt-3"><?= $ct['nama'] ?></h2>
            <?php foreach($produk as $pr): ?>
              <?php if($pr['id_kategori'] == $ct['id']): ?>
                <div class="col-xl-4 col-md-6 col-sm-12 p-3">
                  <!-- Satuan Produk -->
                  <a class="btn t-item p-0" href="ubah_produk.php?id=<?= $pr['id'] ?>" role="button">
                    <div class="container p-3 rounded border shadow-sm" style="background-color: white">
                      <div class="row">
                        <div class="col-4 text-center">
                          <div class="gambar ratio ratio-1x1">
                            <img src="../Images/<?= $pr['gambar'] ?>" class="mw-100 pb-1 rounded" style="object-fit: contain;" />
                          </div>
                          <span class="fw-bold"><?= $pr['harga'] ?> $</span>
                        </div>
                        <div class="col text-start">
                          <h3 class="fs-6"><?= $pr['nama'] ?></h3>
                        </div>
                      </div>
                    </div>
                  </a>
                  <!-- End Satuan Produk -->
                </div>
                <?php endif; ?>
              <?php endforeach; ?>
          </div>
        <?php endforeach; ?>
        <!-- Akhir Baris Konten -->
      </div>
    </section>
  </body>
</html>
