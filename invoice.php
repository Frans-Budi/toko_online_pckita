<?php
require_once 'function.php';

// Cek Apakah DATA GET dikirm atau gk
if(!isset($_GET['invoice'])){
    header('location: history.php');
    exit;
}

// Ambil Dati dari Url
$id = $_GET['invoice'];

// Ambil data user yang login
$username = $_SESSION['username'];
$id_konsumen = QueryData("SELECT * FROM konsumen WHERE username = '$username'")[0]['id'];

// Query Data Pembayaran
$pembayaran = QueryData("SELECT pembayaran.id as id, invoice, total, waktu, alat_pembayaran
    FROM pembayaran
    JOIN met_pembayaran ON (pembayaran.id_met_pembayaran = met_pembayaran.id)
    WHERE pembayaran.id = $id")[0];

// Query Data Besar
$data = QueryData(
    "SELECT id_keranjang, id_pembayaran, id_konsumen, id_produk, waktu, nama, gambar, kuantitas, sub_total, total, status, harga
    FROM kerpem
    JOIN keranjang ON (kerpem.id_keranjang = keranjang.id)
    JOIN pembayaran ON (kerpem.id_pembayaran = pembayaran.id)
    JOIN produk ON (keranjang.id_produk = produk.id)
    WHERE id_konsumen = $id_konsumen AND status = 1 AND id_pembayaran = $id"
);

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once 'head.php'; ?>
<body>
    
    <section >
        <div class="container p-4">
            <a href="history.php" class="btn tombol-2 fw-semibold fs-6 ps-3 pe-3 mb-3">Kembali</a>
            <div class="row">
                <!-- Isi Invoice -->
                <div class="col">
                    <div class="container border rounded-3 shadow-sm p-3" style="max-width: 600px;">
                        <!-- Invoice -->
                        <h1 class="text-center">Invoice</h1>
                        <hr class="m-3">
                        <!-- Nomor Invoice -->
                        <h2 class="fs-3 fw-normal">#<?= $pembayaran['invoice'] ?></h2>
                        <!-- Sedikit Informasi -->
                        <div class="row mb-3">
                            <!-- judul -->
                            <div class="col fs-5">
                                Tanggal Pembelian
                            </div>
                            <!-- Tanggal -->
                            <div class="col text-end fs-5">
                                <?=  date( 'd F Y, h:i A', strtotime($pembayaran['waktu']) ) ?>
                            </div>
                        </div>
                        <!-- Detail Produk -->
                        <h2 class="fs-3">Detail Produk</h2>
                        <!-- Informasinya -->
                        <?php foreach($data as $dt): ?>
                        <div class="row">
                            <!-- Gambar -->
                            <div class="col ratio ratio-1x1">
                                <img class="p-1" src="Images/<?= $dt['gambar'] ?>" style="object-fit: contain;">
                            </div>
                            <!-- Produk Detail -->
                            <div class="col-9">
                                <!-- Judul -->
                                <p class="fs-5 title mb-1"><?= $dt['nama'] ?></p>
                                <!-- Kuantias & Harga -->
                                <span class="fw-semibold" style="font-size: 1.2rem;"><?= $dt['kuantitas'] ?> X <?= $dt['harga'] ?> $ <i class="bi bi-arrow-right fw-semibold"></i> <?= $dt['sub_total'] ?> $</span>
                            </div>
                        </div>
                        <hr class="m-1 mb-3">
                        <?php endforeach; ?>
                        <!-- Akhir Informasi -->

                        <!-- Metode Pembayaran -->
                        <div class="row mb-1 fs-5" style="color: grey;">
                            <div class="col">Metode Pembayaran</div>
                            <div class="col text-end"><?= $pembayaran['alat_pembayaran'] ?></div>
                        </div>

                        <!-- Total Belanja -->
                        <div class="row fw-semibold fs-4">
                            <div class="col">Total Belanja</div>
                            <div class="col text-end"><?= $pembayaran['total'] ?> $</div>
                        </div>
                    </div>
                    <!-- Akhir Isi Invoice -->
                </div>
            </div>
        </div>
    </section>

</body>
</html>