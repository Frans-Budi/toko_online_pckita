<?php
  
  // Ambil Data Kategori dari Database
  $kategori = QueryData("SELECT * FROM kategori");


?>

<?php require_once 'head.php'; ?>
<body>
  <!-- Segmen Laptop -->
  <?php foreach($kategori as $kt): ?>
  <section class="segmen mt-4" id="<?= $kt['nama'] ?>" style="scroll-margin-block-start: 80px;">
    <div class="container p-2">
      <!-- Title Section -->
      <div class="row row-cols-auto d-flex justify-content-between align-items-center">
        <!-- Title -->
        <div class="col s-judul rounded ps-3 pe-5">
          <span class="fw-semibold fs-4"><?=  $kt['nama'] ?></span>
        </div>
        <!-- View All -->
        <div class="col rounded p-1">
          <a class="btn v-all fw-semibold fs-5" href="view_all.php?id=<?= $kt['id'] ?>" role="button">Lihat Semua</a>
        </div>
      </div>
      <!-- Content Items -->
      <div class="row">
        <!-- Item 1 -->
        <?php 
          // Ambil Id kategori
          $id_kategori = $kt['id'];
          // Ambil Data produk dari Database
          $produk = QueryData("SELECT produk.id, produk.nama, description, harga, gambar, id_kategori, kategori.nama as nama_k
          FROM produk JOIN kategori ON (kategori.id = produk.id_kategori)
          WHERE id_kategori = $id_kategori
          LIMIT 4");
        ?>
        <?php foreach($produk as $pr): ?>
        <div class="col-xl-3 col-lg-4 col-sm-6 mt-3">
          <a class="t-item" href="detail.php?id=<?= $pr['id'] ?>">
            <div class="container-fluid p-3 shadow rounded-3 border">
              <!-- Image -->
              <div class="row">
                <div class="col ratio ratio-1x1">
                  <img class="mw-100 p-4" src="Images/<?= $pr['gambar'] ?>" style="object-fit: contain;" />
                </div>
              </div>
              <!-- Title & Price -->
              <div class="row d-flex align-items-center">
                <div class=" title col fw-semibold"><?= $pr['nama'] ?></div>
                <div class="col-4 text-end fw-bold fs-5"><?= $pr['harga'] ?> $</div>
              </div>
            </div>
          </a>
        </div>
        <?php endforeach; ?>
        <!-- Item 1 -->
      </div>
    </div>
  </section>
  <?php endforeach; ?>

</body>
