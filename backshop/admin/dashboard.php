<?php 
    include_once('../db/connect.php'); 
    if (session_id()==='') {session_start();}
    if (isset($_SESSION["MyID"])) {
        $username = $_SESSION['MyID'];
    }else{
        $username = "";
    }
    //---
    if (isset($_SESSION["MyFullname"])) {
        $fullname = $_SESSION['MyFullname'];
    }else{
        $fullname = "";
    }
    //---
    if ($username=="") {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Backshop Admin </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="giaodien/vendors/feather/feather.css">
  <link rel="stylesheet" href="giaodien/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="giaodien/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="giaodien/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="giaodien/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="giaodien/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="giaodien/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="giaodien/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="giaodien/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="giaodien/images/favicon.png" />
</head>
<body>

	<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php
    include "giaodien/top-nav.php";
    ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
    <?php include "giaodien/left-bar.php"; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <?php include "giaodien/main.php"; ?>
        </div>
      </div>
      <!-- content-wrapper ends -->
      <!-- partial:partials/_footer.html -->
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="giaodien/vendors/js/vendor.bundle.base.js"></script>

  <!-- inject:js -->
  <script src="giaodien/js/hoverable-collapse.js"></script>
  <script src="giaodien/js/template.js"></script>
  
</body>
</html>