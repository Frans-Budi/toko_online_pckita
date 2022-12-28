<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "pckita");

function QueryData($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }

    return $rows;
}

function register($data)
{
    global $conn;

    // Deklarasi
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);

    // Username bersifat insensiftive
    $username = strtolower(stripslashes($username));
    $password = mysqli_real_escape_string($conn, $password);

    // Cek Username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT * FROM konsumen WHERE username = '$username'");

    if(mysqli_fetch_assoc($result)){
        echo "<script>
        alert('Username Sudah Terdaftar!');
      </script>";
      return false;
    }

    // Enkripsi Password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Tambahkan User Terbaru Ke Database
    $query = "INSERT INTO konsumen VALUES ('', '$username', '$password')";
    mysqli_query($conn, $query);

    // Ambil Id dari table Konsumen
    $id = (int) QueryData("SELECT * FROM konsumen WHERE username = '$username'")[0]['id'];

    // Insert Table Profile (id)
    ;
    $query = "INSERT INTO profile VALUES ($id, '', '', '', '')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tempName = $_FILES['gambar']['tmp_name'];

    // Cek Apakah Gambar sudah diupload
    if($error === 4){
        echo "<script>
            alert('Gambar tidak boleh Kosong');
        </script>";
        return false;
    }

    // Cek yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'png', 'jpeg'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
            alert('File yang Anda masukkan bukan gambar (Ekstensi yang diizinkan: .jpg .png .jpeg)');
        </script>";
        return false;
    }

    // Cek Apakah Ukuran Gambar yang diupload lebih dari 2mb
    if($ukuranFile > 2000000){
        echo "<script>
            alert('Ukuran Gambar harus kurang dari 2MB!');
        </script>";
        return false;
    }

    // Jika Lolos dari semua seleksi
    // Generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tempName, '../Images/' . $namaFileBaru);

    return $namaFileBaru;
}

function upload_profile()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tempName = $_FILES['gambar']['tmp_name'];

    // Cek Apakah Gambar sudah diupload
    if($error === 4){
        echo "<script>
            alert('Gambar tidak boleh Kosong');
        </script>";
        return false;
    }

    // Cek yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'png', 'jpeg'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "<script>
            alert('File yang Anda masukkan bukan gambar (Ekstensi yang diizinkan: .jpg .png .jpeg)');
        </script>";
        return false;
    }

    // Cek Apakah Ukuran Gambar yang diupload lebih dari 2mb
    if($ukuranFile > 2000000){
        echo "<script>
            alert('Ukuran Gambar harus kurang dari 2MB!');
        </script>";
        return false;
    }

    // Jika Lolos dari semua seleksi
    // Nama Diambil dari username
    $username = $_SESSION['username'];
    $namaFileBaru = $username;
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tempName, 'Images/' . $namaFileBaru);

    return $namaFileBaru;
}

function insert_produk($data)
{
    global $conn;
    
    // Deklarasi
    $judul = htmlspecialchars($data['judul']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $harga = htmlspecialchars($data['harga']);
    $kategori = htmlspecialchars($data['kategori']);
    // Upload
    $gambar = upload();

    // Cek Jika Gambar Gagal diupload
    if(!$gambar){
        return false;
    }

    $query = "INSERT INTO produk VALUES 
        ('', '$judul', '$deskripsi', '$harga', '$gambar', '$kategori')
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubah_produk($data)
{
    global $conn;

    // Ambil Ada dan Deklarasi
    $id = $data['id'];
    $judul = htmlspecialchars($data['judul']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $harga = htmlspecialchars($data['harga']);
    $kategori = htmlspecialchars($data['kategori']);
    $gambarLama = htmlspecialchars($data['gambarLama']);

    // Cek Apakah Gambar diupload atau gk
    if($_FILES['gambar']['error'] === 4){
        $gambar = $gambarLama;
    }else{
        $gambar = upload();
    }

    // Lakukan Update
    $query = "UPDATE produk SET 
            nama = '$judul',
            description = '$deskripsi',
            harga = '$harga',
            gambar = '$gambar',
            id_kategori = '$kategori'
        WHERE id = $id
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus_produk($id)
{
    global $conn;

    // Perintah Hapus
    $query = "DELETE FROM produk WHERE id = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubah_profile($data)
{
    global $conn;

    // Ambil Ada dan Deklarasi
    $id = $data['id'];
    $nama = htmlspecialchars($data['nama']);
    $tgl_lahir = htmlspecialchars($data['tgl_lahir']);
    $jk = htmlspecialchars($data['jk']);
    $gambarLama = htmlspecialchars($data['gambarLama']);

    // Cek Apakah Gambar diupload atau gk
    if($_FILES['gambar']['error'] === 4){
        $gambar = $gambarLama;
    }else{
        $gambar = upload_profile();
    }

    // Lakukan Update
    $query = "UPDATE profile SET 
            nama = '$nama',
            tgl_lahir = '$tgl_lahir',
            jenis_kelamin = '$jk',
            gambar = '$gambar'
        WHERE id = $id
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus_profile($id)
{
    global $conn;

    // Perintah Hapus
    $query = "UPDATE profile SET
            gambar = ''
        WHERE id = $id
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambah_keranjang($data)
{
    global $conn;

    // Ambil Data
    $id_konsumen = $data['id_konsumen'];
    $id_produk = $data['id_produk'];
    $kuantitas = $data['kuantitas'];
    $sub_total = $data['sub_total'];
    $status = 0;

    // Tambahkan Ke Database
    $query = "INSERT INTO keranjang VALUES 
            ('', '$id_konsumen', '$id_produk', '$kuantitas', '$sub_total', $status)";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus_keranjang($id_konsumen, $id_produk)
{
    global $conn;

    // Perintah Hapus
    $query = "DELETE FROM keranjang
            WHERE id_konsumen = $id_konsumen AND id_produk = $id_produk
            LIMIT 1";
    mysqli_query($conn, $query);
    // Refresh Halaman
    header("Refresh:0");
}

function bayar($data, $total)
{
    global $conn;

    // Siapkan Data untuk Pembayaran
    $invoice = uniqid();
    $id_met_pembayaran = $data['met_pembayaran'];

    date_default_timezone_set('Asia/Jakarta');
    $waktu = date('Y-m-d H:i:s');

    // INSERT pembayaran
    $query = "INSERT INTO pembayaran VALUES ('', '$invoice', '$total', '$id_met_pembayaran', '$waktu')";
    mysqli_query($conn, $query);

    // Ambil data user yang login
    $username = $_SESSION['username'];
    $id_konsumen = QueryData("SELECT * FROM konsumen WHERE username = '$username'")[0]['id'];

    // Ambil Id Keranjang
    $keranjang = QueryData(
        "SELECT keranjang.id as id_keranjang
        FROM keranjang
        JOIN konsumen ON (keranjang.id_konsumen = konsumen.id)
        JOIN produk ON (keranjang.id_produk = produk.id)
        WHERE id_konsumen = $id_konsumen AND status = 0"
    );

    // Ambil Id Pembayaran
    $id_pembayaran = QueryData("SELECT * FROM pembayaran WHERE invoice = '$invoice'")[0]['id'];

    // INSERT kerpem
    foreach($keranjang as $kr){
        // INSERT pembayaran
        $id_keranjang = $kr['id_keranjang'];

        $query = "INSERT INTO kerpem VALUES ('$id_keranjang', '$id_pembayaran')";
        mysqli_query($conn, $query);
    }

    // Update status di Keranjang menjadi 1
    $query = "UPDATE keranjang SET status = 1
            WHERE id_konsumen = $id_konsumen";
    mysqli_query($conn, $query);

    header("Refresh:0");

    return [mysqli_affected_rows($conn), $id_pembayaran];
}




























