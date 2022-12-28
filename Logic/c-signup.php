<?php
  require_once '../function.php';

  if(isset($_POST['submit'])){

    if(register($_POST) > 0){
      echo "<script>
        alert('Selamat!, Anda Berhasil Register');
        window.location.href='../login.php';
      </script>";
    }else{
      echo "<script>
        alert('Terjadi Kesalahan, Anda Gagal Register');
        window.location.href='../signup.php';
      </script>";
    }
  }

?>