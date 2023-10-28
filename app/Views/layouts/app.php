<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('./assets/CSS/style.css'); ?>">
</head>
<body>
<div class="navbar">
        <div class="navbar-container">
            <a class="brand" href="#">
                <img src="https://drive.google.com/uc?id=1jPPaKCLavSTLcfcpwCh1JBgmdfWnbvmb" alt="Logo" /> Universitas Lampung
            </a>
            <ul>
                <li><a href="<?= base_url('/') ?>"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="<?= base_url('/user') ?>"><i class="fa fa-users"></i> List Users</a></li>
                <li><a href="<?= base_url('/kelas') ?>"><i class="fa fa-list"></i> List Kelas</a></li>
            </ul>
        </div>
    </div>
    <?= $this->renderSection('content')?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>