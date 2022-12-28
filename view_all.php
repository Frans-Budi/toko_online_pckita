<?php
require_once 'function.php';
// Ambil Dari dari url
$id = $_GET['id'];
// Ambil Data Produk berdasarkan kategori
$produk = QueryData("SELECT produk.id, produk.nama, description, harga, gambar, id_kategori, kategori.nama as nama_k
FROM produk JOIN kategori ON (kategori.id = produk.id_kategori)
WHERE id_kategori = $id");
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once 'head.php'; ?>
<body>
<?php require_once 'Widget/header.php'; ?>

<section style="padding-top: 80px;">
  <div class="container">
    <div class="row row-cols-auto">
      <div class="col s-judul rounded ps-3 pe-5">
        <span class="fw-semibold fs-4"><?=  $produk[0]['nama_k'] ?></span>
      </div>
    </div>
    <div class="row">
      <?php foreach($produk as $pr): ?>
        <div class="col-xl-3 col-lg-4 col-sm-6 mt-4">
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
    </div>
  </div>
</section>
<?php require_once 'Widget/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>