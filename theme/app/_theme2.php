<?php

use Source\Models\Candidaturas;

$url = URL_BASE;
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Transdoni - Mobile Template</title>
    <link rel="stylesheet" href="<?= url("assets/app/assets/css/style.css") ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="description" content="Finapp HTML Mobile Template">
    <meta name="keywords" content="bootstrap, mobile template, cordova, phonegap, mobile, html, responsive" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/logo-icon.png">
    <link rel="icon" type="image/png" href="assets/img/logo-icon.png" sizes="32x32">
    <link rel="shortcut icon" href="<?= url("assets/app/assets/img/logo-icon.png") ?>">

</head>


<body>

    <!-- loader -->
    <div id="loader">
        <img src="<?= url("assets/app/assets/img/logo-icon.png") ?>" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->

    <!-- App Capsule -->
    <div id="appCapsule">
        <?= $this->section("content") ?>
    </div>
    <!-- * App Capsule -->

    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <!-- Jquery -->
    <script src="<?= url("assets/app/assets/js/lib/jquery-3.4.1.min.js") ?>"></script>
    <!-- Bootstrap-->
    <script src="<?= url("assets/app/assets/js/lib/popper.min.js") ?>"></script>
    <script src="<?= url("assets/app/assets/js/lib/bootstrap.min.js") ?>"></script>
    <!-- Ionicons -->
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="<?= url("assets/app/assets/js/plugins/owl-carousel/owl.carousel.min.js") ?>"></script>
    <!-- Base Js File -->
    <script src="<?= url("assets/app/assets/js/base.js") ?>"></script>

</body>

</html>