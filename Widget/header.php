<?php
  require_once 'function.php';

  // Ambil data user yang login
  $username = $_SESSION['username'];
  $id_konsumen = QueryData("SELECT * FROM konsumen WHERE username = '$username'")[0]['id'];

  // Data Jumlah Keranjang
  $jml_keranjang = QueryData("SELECT SUM(kuantitas) AS jml_keranjang FROM keranjang WHERE id_konsumen = $id_konsumen AND status = 0")[0]['jml_keranjang'];
  var_dump($jml_keranjang);

?>

<nav class="header navbar navbar-expand-lg bg-white p-3 fixed-top">
  <div class="container">
    <span class="navbar-brand mb-0 h1 me-4 fw-bold"> <span class="pc">PC</span>KITA </span>

    <!-- Responsive Button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Home -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item me-2">
          <a class="btn btn-light p-2 pt-0 pb-0" href="index.php" role="button"><i class="bi bi-house-door-fill fs-5"></i></a>
        </li>
      </ul>
      <!-- Search -->
      <form class="d-flex w-100" role="search">
        <input class="form-control ms-1 me-3 btn-outline-primary" type="search" placeholder="Search . . ." aria-label="Search" />
      </form>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- Profile -->
        <li class="nav-item me-2">
          <a class="btn btn-light p-2 pt-0 pb-0" href="profile.php" role="button"><i class="bi bi-person fs-4"></i></a>
        </li>
        <!-- Riwayat -->
        <li class="nav-item me-2">
          <a class="btn btn-light p-2 pt-0 pb-0" href="history.php" role="button"><i class="bi bi-clock-history fs-4"></i></a>
        </li>
        <!-- Keranjang -->
        <li class="nav-item">
          <a class="btn btn-light p-2 pt-0 pb-0 position-relative" href="keranjang.php" role="button">
            <i class="bi bi-cart fs-4"></i>
            <!-- Notif -->
            <?php if($jml_keranjang > 0): ?>
              <span class="notif position-absolute top-0 start-100 translate-middle badge"> <?= $jml_keranjang ?> </span>
            <?php endif; ?>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
