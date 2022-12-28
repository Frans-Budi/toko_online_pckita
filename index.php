<?php
require_once 'function.php';

if(!isset($_SESSION['login'])){
    header('location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<?php require 'head.php' ?>

<body>
    
    <?php 
        require_once 'Widget/header.php'; 
        require_once 'Widget/catagory.php';
        require_once 'Widget/carousel.php';
        require_once 'Widget/content.php';
        require_once 'Widget/footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>