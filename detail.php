<?php
require_once 'function.php';

// Ambil data user yang login
$username = $_SESSION['username'];
$id_konsumen = QueryData("SELECT * FROM konsumen WHERE username = '$username'")[0]['id'];

// Tangkap ID dari Url (Id Produk)
$id = (int) $_GET['id'];
// Ambil Data Produk berdasarkan kategori
$produk = QueryData("SELECT produk.id, produk.nama, description, harga, gambar, id_kategori, kategori.nama as nama_k
FROM produk JOIN kategori ON (kategori.id = produk.id_kategori)
WHERE produk.id = $id")[0];

// Jika tombol keranjang ditekan
if(isset($_POST['keranjang'])){
    // Function Tambah keranjang
    if(tambah_keranjang($_POST) > 0){
        echo "<script>
            alert('Berhasil Menambahkan 1 barang ke Keranjang');
            window.location.href='keranjang.php';
        </script>";
    } else {
        echo "<script>
            alert('Terjadi Kesalahan, Gagal Menambahkan barang ke Keranjang');
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once 'head.php'; ?>
<body>
    <?php require_once 'Widget/header.php'; ?>

    <section style="padding-top: 40px;">
        <div class="container">
            <div class="row d-flex align-items-start">
                <!-- Image -->
                <div class="col-xl col-lg ratio ratio-1x1">
                    <img src="<?= 'Images/' . $produk['gambar'] ?>" style="object-fit: contain;">
                </div>
                <!-- Detail -->
                <div class="col-xl-5 col-lg-7 p-4">
                    <h3 class="fw-semibold fs-3"><?= $produk['nama'] ?></h3>
                    <h4 class="fs-1 fw-bold"><?= $produk['harga'] ?> $</h4>
                    <textarea class="fs-5 w-100 p-3" name="deskripsi" id="deskripsi" rows="12" style="background-color: white; border: none;" disabled
                    ><?= $produk['description'] ?></textarea>
                    <!-- <p class="fs-5"></p> -->
                </div>
                <!-- Action -->
                <div class="col-xl-3 col-lg-5 p-3">
                    <div class="container">
                        <!-- Quantity -->
                        <div class="row mb-3">
                            <div class="col fs-5 fw-semibold">Kuantitas</div>
                        </div>
                        <!-- Tombol Kuantitas -->
                        <div class="row mb-3" style="width: fit-content;">
                            <!-- Decrement -->
                            <div class="col">
                                <button type="button" class="btn btn-outline-dark fs-5 fw-bolder" onclick="decrement()">-</button>
                            </div>
                            <!-- Number -->
                            <div class="col">
                                <span id="kuantitas" class="num fs-3 fw-semibold"></span>
                            </div>
                            <!-- Increment -->
                            <div class="col">
                                <button type="button" class="btn btn-outline-dark fs-5 fw-bolder" onclick="increment()">+</button>
                            </div>
                        </div>
                        <!-- Harga Satuan -->
                        <div class="row mb-2 fs-5">
                            <div class="col">Harga</div>
                            <div class="col text-end fw-bold"><?= $produk['harga'] ?> $</div>
                        </div>
                        <!-- Total -->
                        <div class="row mb-4 fs-5">
                            <div class="col">Total</div>
                            <div class="col text-end fw-bold"><span id="total"><?= $produk['harga'] ?></span> $</div>
                        </div>
                        <!-- Tombol -->
                        <div class="row mb-3">
                            <div class="col">
                                <form action="" method="POST">
                                    <div class="d-grid gap-2">
                                        <!-- Id Produk -->
                                        <input type="hidden" name="id_produk" value="<?= $id ?>">
                                        <!-- Id Konsumen -->
                                        <input type="hidden" name="id_konsumen" value="<?= $id_konsumen ?>">
                                        <!-- Kuantitas -->                                        
                                        <input id="kuan_input" type="hidden" name="kuantitas" value="">
                                        <!-- Sub Total -->
                                        <input id="sub_total" type="hidden" name="sub_total" value="">
                                        <!-- Keranjang -->
                                        <button name="keranjang" class="btn tombol mb-1" type="submit">+ Keranjang</button>
                                        <!-- Beli Langsung -->
                                        <button name="keranjang" class="btn btn-outline-primary" type="submit">Beli Langsung</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Akhir Tombol -->
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <script>
        var kuantitas = 1;
        document.getElementById('kuantitas').innerText = kuantitas;
        var c_total = document.getElementById('total').innerText;
        var total = c_total;
        document.getElementById('kuan_input').value =kuantitas;
        document.getElementById('sub_total').value = total;


        function decrement()
        {
            if(kuantitas > 1){
                kuantitas--;
                total = +total - +c_total; 
            }
            document.getElementById('kuantitas').innerText = kuantitas;
            document.getElementById('total').innerText = total.toLocaleString();
            document.getElementById('kuan_input').value = kuantitas;
            document.getElementById('sub_total').value = total;
        }
        
        function increment()
        {
            kuantitas++;
            document.getElementById('kuantitas').innerText = kuantitas;
            total = +total + +c_total;
            document.getElementById('total').innerText = total.toLocaleString();
            document.getElementById('kuan_input').value = kuantitas;
            document.getElementById('sub_total').value = total;
        }

    </script>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>