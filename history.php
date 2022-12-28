<?php
require_once 'function.php';

// Ambil data user yang login
$username = $_SESSION['username'];
$id_konsumen = QueryData("SELECT * FROM konsumen WHERE username = '$username'")[0]['id'];

// Pembayaran
$pembayaran = QueryData(
    "SELECT DISTINCT id_pembayaran as id, id_konsumen, waktu, total, status, invoice
    FROM kerpem
    JOIN keranjang ON (kerpem.id_keranjang = keranjang.id)
    JOIN pembayaran ON (kerpem.id_pembayaran = pembayaran.id)
    JOIN produk ON (keranjang.id_produk = produk.id)
    WHERE id_konsumen = $id_konsumen AND status = 1
    ORDER BY waktu DESC
");

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once 'head.php'; ?>
<body>
    <?php require_once 'Widget/header.php'; ?>

    <?php if($pembayaran == null): ?>
        <div class="container text-center" style="padding-top: 60px;">
            <div class="row d-flex justify-content-center">
                <img style="max-width: 650px;" src="https://img.freepik.com/free-vector/business-team-looking-new-people-allegory-searching-ideas-staff-woman-with-magnifier-man-with-spyglass-flat-illustration_74855-18236.jpg?t=st=1672129854~exp=1672130454~hmac=b911673561d283da72385310f635c42a9cdbd2af9e937e7c4ca9f06c7148b260">
            </div>
            <div class="row mt-3">
                <h1 class="text-center">Belum Ada Transaksi</h1>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <?php exit; endif; ?>

    <section style="padding-top: 20px;">
      <div class="container p-3">
        <h1>Riwayat Belanja</h1>
        <div class="row mt-4">
            <!-- Item 1 -->
            <?php foreach($pembayaran as $pem): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="container p-4 shadow rounded-3 border">
                    <!-- Head -->
                    <div class="row">
                        <!-- Detail -->
                        <div class="col d-flex">
                            <!-- Icon -->
                            <i class="bi bi-bag-check fs-4"></i>
                            <div class="box ps-3">
                                <!-- Judul -->
                                <h6 class="m-0">Belanja</h6>
                                <!-- Tanggal -->
                                <span class=""><?=  date( 'd M Y', strtotime($pem['waktu']) ) ?></span>
                            </div>
                        </div>
                    </div>
                    <hr class="m-0 mt-2">
                    <!-- Body -->
                    <?php
                        $id_pembayaran = $pem['id'];
                        $data = QueryData(
                            "SELECT id_keranjang, id_pembayaran, id_konsumen, id_produk, waktu, nama, gambar, kuantitas, sub_total, total, status
                            FROM kerpem
                            JOIN keranjang ON (kerpem.id_keranjang = keranjang.id)
                            JOIN pembayaran ON (kerpem.id_pembayaran = pembayaran.id)
                            JOIN produk ON (keranjang.id_produk = produk.id)
                            WHERE id_konsumen = $id_konsumen AND status = 1 AND id_pembayaran = $id_pembayaran"
                        );
                    ?>
                    <?php foreach($data as $dt): ?>
                    <div class="row p-1">
                        <!-- Gambar -->
                        <div class="col ratio ratio-1x1">
                            <img src="Images/<?= $dt['gambar'] ?>" style="object-fit: contain;">
                        </div>
                        <!-- Detail -->
                        <div class="col-10 ps-3">
                            <!-- Judul -->
                            <h4 class="title fs-6 fw-semibold m-1"><?= $dt['nama'] ?></h4>
                            <!-- Kuantitas -->
                            <span style="color: grey;"><?= $dt['kuantitas'] ?> Barang</span>
                            <!-- Sub Total -->
                            <h5 class="fw-semibold pt-1 ps-1" style="font-size: 1.1rem;">Sub Total: <?= $dt['sub_total'] ?> $</h5>
                        </div>
                    </div>
                    <hr class="m-0">
                    
                    <?php endforeach; ?>
                    <!-- Footer -->
                    <div class="row d-flex align-items-end mt-2">
                        <!-- Total -->
                        <div class="col">
                            <span>Total Belanja</span>
                            <h5 class="fw-bold"><?= $pem['total'] ?> $</h5>
                        </div>
                        <!-- Action -->
                        <form action="invoice.php" method="GET" class="col text-end">
                            <button type="submit" name="invoice" value="<?= $pem['id'] ?>" class="btn tombol ps-4 pe-4 pt-1 pb-1 shadow-sm">
                                Invoice
                            </button>
                        </form>
                    </div>
                    <!-- Akhir Footer -->
                </div>
            </div>
            <?php endforeach; ?>
            <!-- Akhir Item 1 -->
        </div>
    </div>
    </section>
    
    <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>