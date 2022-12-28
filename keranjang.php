<?php
require_once 'function.php';

// Ambil data user yang login
$username = $_SESSION['username'];
$id_konsumen = QueryData("SELECT * FROM konsumen WHERE username = '$username'")[0]['id'];

// Ambil Semua Data keranjang dengan semua REferensinya
$keranjang = QueryData(
    "SELECT keranjang.id as id_keranjang, id_produk, kuantitas, sub_total, nama as nama_produk, harga, gambar
    FROM keranjang
    JOIN konsumen ON (keranjang.id_konsumen = konsumen.id)
    JOIN produk ON (keranjang.id_produk = produk.id)
    WHERE id_konsumen = $id_konsumen AND status = 0"
);

// Ambil Total Harga
$total = QueryData("SELECT SUM(sub_total) as total
    FROM keranjang
    WHERE id_konsumen = $id_konsumen AND status = 0"
)[0]['total'];

// Ambil Data Metode Pembayaran
$met_pembayaran = QueryData("SELECT * FROM met_pembayaran");

// Hapus
if(isset($_GET['hapus'])){
    $id_produk = $_GET['hapus'];
    // Function Hapus
    hapus_keranjang($id_konsumen, $id_produk);
    header('location: keranjang.php');
}

// Bayar
if(isset($_POST['beli'])){
    // Ambil Data
    $met_pembayaran = $_POST['met_pembayaran'];
    // Cek Apakah Metode Pembayaran sudah dipilih atau belum
    if($met_pembayaran == 'pilih'){
        echo "<script>
            alert('Pilih Metode Pembayaran Terlebih Dahulu!');
        </script>";
        header("Refresh:0");
    } else {
        // Function Bayar
        if(bayar($_POST, $total) > 0){
            echo "<script>
                alert('Selamat! Anda Berhasil Melakukan Pembayaran');
                window.location.href='invoice.php';
            </script>";
        } else {
            echo "<script>
                alert('Terjadi Kesalahan! Gagal Melakukan Pembayaran');
            </script>";
            header("Refresh:0");
        }
        
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once 'head.php'; ?>
<body>
    <?php require_once 'Widget/header.php'; ?>

    <?php if($keranjang == null): ?>
        <div class="container text-center" style="padding-top: 60px;">
            <div class="row d-flex justify-content-center">
                <img style="max-width: 650px;" src="https://img.freepik.com/free-vector/business-team-looking-new-people-allegory-searching-ideas-staff-woman-with-magnifier-man-with-spyglass-flat-illustration_74855-18236.jpg?t=st=1672129854~exp=1672130454~hmac=b911673561d283da72385310f635c42a9cdbd2af9e937e7c4ca9f06c7148b260">
            </div>
            <div class="row mt-3">
                <h1 class="text-center">Keranjang Masih Kosong</h1>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <?php exit; endif; ?>

    <section style="padding-top: 30px;">
        <div class="container">
            <div class="row">
                <!-- Column Keranjang -->
                <div class="col-lg-8">
                    <h1 class="fs-3">Keranjang</h1>
                    <!-- Item Keranjang -->
                    <?php foreach($keranjang as $kr): ?>
                    <div class="container p-2">
                        <div class="row d-flex align-items-center p-0">
                            <!-- Gambar -->
                            <div class="col-3 ration ratio-1x1 p-2">
                                <img class="mw-100" src="Images/<?= $kr['gambar'] ?>">
                            </div>
                            <!-- Detail -->
                            <div class="col p-2">
                                <div class="container">
                                    <!-- Judul -->
                                    <div class="row title text-start">
                                        <p class="fs-5">
                                            <a href="detail.php?id=<?= $kr['id_produk'] ?>"><?= $kr['nama_produk'] ?></a>
                                        </p>
                                    </div>
                                    <!-- Harga -->
                                    <div class="row pt-2">
                                        <div class="col">
                                            <h4 class="fw-bold"><?= $kr['harga'] ?> $</h4>
                                        </div>
                                    </div>
                                    <!-- Hapus & Kuantitas -->
                                    <form action="" method="GET">
                                    <div class="row f-flex align-items-center">
                                        <!-- Hapus -->
                                            <div class="col-md-8 col-sm col-6 text-end">
                                                <button name="hapus" value="<?= $kr['id_produk'] ?>" onclick="confirm('Apakah Anda Yakin?')" class="btn btn-outline-secondary fw-semibold shadow-sm" role="button" type="submit">Hapus</button>
                                            </div>
                                            <!-- Kuantitas -->
                                            <div class="col-md-4 col-sm-5 col-6 text-end fs-5 fw-semibold">
                                                Kuantitas: <?= $kr['kuantitas'] ?>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Akhir Hapus & Kuantitas -->
                                </div>
                            </div>
                            <!-- Akhir Detail -->
                        </div>
                    </div>
                    <hr class="m-1" style="border-top: 5px solid grey; border-radius: 5px;">
                    <?php endforeach; ?>
                    <!-- Item Keranjang --> 
                </div>
                <!-- Column Beli -->
                <form class="col-lg-4 " action="" method="POST">
                    <div class="container p-4 shadow-sm rounded-3 border mt-3">
                        <!-- Metode Pembayaran -->
                        <div class="row mb-3">
                            <div class="col">
                                <label for="" class="mb-2 fw-semibold fs-5">Metode Pembayaran</label>
                                <select name="met_pembayaran" class="form-select" aria-label="Default select example">
                                    <!-- Belum Pilih -->
                                    <option value="pilih">Pilih Metode Pembayaran</option>
                                    <!-- Pilihannya -->
                                    <?php foreach($met_pembayaran as $mp): ?>
                                        <option value="<?= $mp['id'] ?>"><?= $mp['alat_pembayaran'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <!-- Total Harga -->
                        <div class="row ">
                            <div class="col ">
                                <h5>Total Harga</h5>
                            </div>
                            <div class="col text-end">
                                <h5 class="fw-bold"><?= number_format($total) ?> $</h5>
                            </div>
                        </div>
                        <!-- Beli & Bayar -->
                        <div class="row mt-2">
                            <div class="col">
                                <button name="beli" type="submit" class="btn tombol w-100 fw-semibold fs-5">Beli & Bayar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Akhir Column Beli -->
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>