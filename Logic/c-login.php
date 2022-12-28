<?php
require_once '../function.php';

if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    // Deklarasi
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // Ambil Username berdasarkan Id
    $result = mysqli_query($conn, "SELECT * FROM konsumen WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);

    if($key == hash('sha256', $row['username'])){
        $_SESSION['login'] == true;
    }
}

if(isset($_POST['submit'])){
    // Deklarasi
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Username bersifat insensiftive
    $username = strtolower(stripslashes($username));
    $password = mysqli_real_escape_string($conn, $password);

    // Cek Username & Password Admin
    if($username == 'admin'){
        // Cek Password Bener atau salah
        if($password == 123){
            $_SESSION['admin'] = true;

            header("Location: ../Admin/admin.php");
            exit;
        }else{
            echo "<script>
                alert('Password Admin yang Anda Masukkan Salah!');
                window.location.href='../login.php';
            </script>";
        }
    }

    // Cek Username apakah ada atau gak
    $query = "SELECT * FROM konsumen WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    // Jika username ada
    if(mysqli_num_rows($result) === 1){
        // Cek Password
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])){
            // Set Session
            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;
            // Cek Remember Me
            if(isset($_POST['remember'])){
                // SetCookie
                setcookie('id', $row['id'], time() + 3600);
                setcookie('key', hash('sha256', $row['username']), time() + 3600);
            }
            header("Location: ../index.php");
            exit;
        }
    }
    
}
?>

<script>
    alert('Username atau Passwor yang Anda Masukkan Salah!');
    window.location.href='../login.php';
</script>