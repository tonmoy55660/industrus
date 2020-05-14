<?php
session_start();
define("BASE_URL", "http://localhost/industrus/admin/");
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?= $title ?></title>
    <link rel="icon" sizes="16x16" href="https://img.icons8.com/pastel-glyph/2x/edit.png" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= BASE_URL; ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= BASE_URL; ?>dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= BASE_URL; ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= BASE_URL; ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= BASE_URL; ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= BASE_URL; ?>plugins/toastr/toastr.min.css">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="<?= BASE_URL; ?>plugins/ekko-lightbox/ekko-lightbox.css">
    <style>
        @media print {
            @page {
                margin: 0;
            }

            body {
                margin: 1.6 cm;
            }

            .print {
                display: none;
            }
        }
    </style>
</head>