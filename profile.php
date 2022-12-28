<?php
  require_once 'function.php';

  $username = $_SESSION['username'];

  $profile = QueryData("SELECT * FROM konsumen
        JOIN profile ON (konsumen.id = profile.id)
        WHERE username = '$username'")[0];
  
  // Cek Jika Tombol Submit ditekan
  if(isset($_POST['submit'])){
    // Function ubah_profile
    if(ubah_profile($_POST) > 0){
      echo "<script>
          alert('Berhasil Update Profile');
          window.location.href = 'index.php';
      </script>";
    } else {
      echo "<script>
          alert('Terjadi Kesalahan, Gagal Update Profile');
      </script>";
    }
  }

  // Cek Jika Tombol hapus ditekan
  if(isset($_POST['hapus'])){
    if(hapus_profile($profile['id']) > 0){
      echo "<script>
          alert('Berhasil Hapus Profile');
          window.location.href = 'index.php';
      </script>";
    } else {
      echo "<script>
          alert('Terjadi Kesalahan, Gagal Update Profile');
      </script>";
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
  <?php
  require_once 'head.php';
  ?>

  <body>
    <?php 
     require_once 'Widget/header.php'; 
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
    <section style="padding-top: 120px">
      <div class="container-md w-75 p-4 rounded-4 border shadow">
        <div class="row">
          <!-- Gambar Profile -->
          <div class="col-md-5 text-center">
            <div class="gambar ratio ratio-1x1">
              <img class="rounded" src="<?= ($profile['gambar'] != '') ? 'Images/' . $profile['gambar'] : 'Assets/profile.jpg' ?> " alt="Gambar Profile" style="object-fit: cover" />
            </div>
            <?php if($profile['gambar'] != ''): ?>
              <div class="mt-3">
                <button class="btn tombol-2 fw-semibold" name="hapus" type="submit">Hapus</button>
              </div>
            <?php endif; ?>
            <div class="mt-3">
              <input class="form-control" name="gambar" type="file" id="formFile" />
            </div>
          </div>
          <!-- Biodata -->
          <div class="col">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Username</label>
              <input type="text" class="form-control" value="<?= $username ?>" id="exampleFormControlInput1" disabled />
            </div>
            <!-- <form action="" method="POST"> -->
              <!-- Id -->
              <input type="hidden" name="id" value="<?= $profile['id'] ?>">
              <!-- Gambar Lama -->
              <input type="hidden" name="gambarLama" value="<?= $profile['gambar'] ?>">
              <!-- Nama -->
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" value="<?= $profile['nama'] ?>" id="exampleFormControlInput1" />
              </div>
              <!-- Tanggal Lahir -->
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tgl_lahir" value="<?= $profile['tgl_lahir'] ?>" id="exampleFormControlInput1" />
              </div>
              <!-- Jenis Kelamin -->
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin</label>
                <select class="form-select" name="jk" aria-label="Default select example">
                  <?php if($profile['jenis_kelamin'] == ''): ?>
                    <option selected>Pilih</option>
                  <?php endif; ?>
                  <option <?= ($profile['jenis_kelamin'] == 'pria' ? 'selected' : '') ?> value="pria">Laki-Laki</option>
                  <option <?= ($profile['jenis_kelamin'] == 'wanita' ? 'selected' : '') ?>  value="wanita">Perempuan</option>
                </select>
              </div>
              <!-- Tombol -->
              <div class="pt-3 container">
                <div class="row">
                  <!-- Update -->
                  <div class="col text-end">
                    <button class="btn tombol pe-3 ps-3 fw-semibold" name="submit" type="submit">Ubah</button>
                  </div>
                  <!-- LogOut -->
                  <div class="col text-start">
                    <a class="btn tombol-2 pe-3 ps-3 fw-semibold" href="Logic/c-logout.php" role="button">Keluar</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
