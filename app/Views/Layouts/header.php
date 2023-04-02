<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed">

<head>
  <meta charset="utf-8" />
  <title> <?= $this->renderSection("title") ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?= site_url("public/assets/img/favicon/icon.png") ?>" />
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="<?= site_url("public/assets/vendor/fonts/boxicons.css") ?>" />
  <!-- Core CSS -->
  <link rel="stylesheet" href="<?= site_url("public/assets/vendor/css/core.css") ?>" />
  <link rel="stylesheet" href="<?= site_url("public/assets/vendor/css/theme-default.css") ?>" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?= site_url("public/assets/css/demo.css") ?>" />
  <link rel="stylesheet" href="<?= site_url("public/assets/css/icofont.css") ?>" />
  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css") ?>" />
  <link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/apex-charts/apex-charts.css") ?>" />
  <!-- Page CSS -->
  <?= $this->renderSection("PageCss") ?>
  <!-- Helpers -->
  <script src="<?= site_url("public/assets/vendor/js/helpers.js") ?>"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="<?= site_url("public/assets/js/config.js") ?>"></script>
  <!-- Custom Css -->
  <link rel="stylesheet" href="<?= site_url("public/assets/css/custom.css") ?>">
  <style>
    /* The loader styles */
    .loader-container {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 9999;
      background-color: rgba(0, 0, 0, 0.5);
      display: none;
    }

    .loader {
      border: 0.5rem solid #f3f3f3;
      border-top: 0.5rem solid #3333A3;
      border-radius: 50%;
      width: 3rem;
      height: 3rem;
      animation: spin 2s linear infinite;
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }
  </style>
</head>

<body>