<?php
session_start();

if(isset($_SESSION['login'])){
  header('location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
  <?php require 'head.php' ?>

  <body style="background-color: lightgray">
    <div class="container-md c-login bg-light rounded-3" style="margin-top: 150px; margin-bottom: 150px">
      <!-- Row -->
      <div class="row">
        <!-- Col -->
        <div class="col-xl-4 rounded-start bg-login p-5">
          <span class="h3 fw-bold fs-4"> <span class="pc">PC</span>KITA </span>
          <h1 class="h1 fw-bold" style="font-size: 4.2rem"><span class="pc">Log</span>in</h1>
          <p class="text-wrap mt-3">Shop the best of electronic, Grab the deals, offers and more.</p>
        </div>
        <!-- col -->
        <div class="col-md d-flex justify-content-center align-items-center p-5">
          <form action="Logic/c-login.php" method="POST" class="login d-flex flex-column align-items-center">
            <!-- Username -->
            <div class="mb-4">
              <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username" required />
            </div>
            <!-- Password -->
            <div class="mb-3">
              <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required />
            </div>
            <!-- Remember Me -->
            <div class="mb-4 form-check align-self-start">
              <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1" />
              <label class="form-check-label" for="exampleCheck1">Ingat Saya</label>
            </div>
            <!-- Masuk -->
            <button type="submit" name="submit" class="btn tombol pe-4 ps-4 fs-6">Masuk</button>
            <p class="text-center mt-3 fw-light">--------- Atau ---------</p>
            <h4 class="h6 fw-normal text-center">Belum Punya Akun? Daftar Sekarang!</h4>
            <!-- Daftar -->
            <a class="btn tombol-2 mt-3 pe-4 ps-4 fs-6" href="signup.php" role="button">Daftar</a>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
