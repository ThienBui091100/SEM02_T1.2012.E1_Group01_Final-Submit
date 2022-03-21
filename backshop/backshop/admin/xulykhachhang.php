<?php
	include('../db/connect.php');
?>
<?php
	session_start();
	if(!isset($_SESSION['dangnhap'])){
		header('Location: index.php');
	} 
	if(isset($_GET['login'])){
 	$dangxuat = $_GET['login'];
	 }else{
	 	$dangxuat = '';
	 }
	 if($dangxuat=='dangxuat'){
	 	session_destroy();
	 	header('Location: index.php');
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
			<div class="container">
				<div class="row">
				<div class="col-md-12">
				<h4>Customer</h4>
				<?php
				$sql_select_khachhang = mysqli_query($con,"SELECT tbl_giaodich.magiaodich,tbl_giaodich.khachhang_id,tbl_giaodich.ngaythang,SUM(tbl_giaodich.amount) AS amount,tbl_khachhang.name,tbl_khachhang.phone,tbl_khachhang.address,tbl_khachhang.email FROM tbl_khachhang,tbl_giaodich WHERE tbl_khachhang.khachhang_id=tbl_giaodich.khachhang_id AND tbl_giaodich.thanhtoan>0 GROUP BY tbl_giaodich.magiaodich ORDER BY tbl_khachhang.khachhang_id DESC"); 
				?> 
				<table width="100%" class="table table-bordered ">
					<tr>
						<th>No.</th>
						<th>Customer Name</th>
						<th>Phone</th>
						<th>Address</th>
						<th>Email</th>
						<th>Management</th>
						<th>Amount</th>
					</tr>
					<?php
					$i = 0;
					while($row_khachhang = mysqli_fetch_array($sql_select_khachhang)){ 
						$i++;
					?> 
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $row_khachhang['name']; ?></td>
						<td><?php echo $row_khachhang['phone']; ?></td>
						<td><?php echo $row_khachhang['address']; ?></td>
						<td><?php echo $row_khachhang['email'] ?></td>
						<td><a href="?quanly=xemgiaodich&khachhang=<?php echo $row_khachhang['magiaodich'] ?>">View Transaction</a></td>
						<td><?php echo number_format($row_khachhang['amount']).'vnđ'; ?></td>
					</tr>
					 <?php
					} 
					?> 
				</table>
			</div>

			<div class="col-md-12">
				<h4>List Order History</h4>
				<?php
				if(isset($_GET['khachhang'])){
					$magiaodich = $_GET['khachhang'];
				}else{
					$magiaodich = '';
				}
				$sql_select = mysqli_query($con,"SELECT * FROM tbl_giaodich,tbl_khachhang,tbl_sanpham WHERE tbl_giaodich.sanpham_id=tbl_sanpham.sanpham_id AND tbl_khachhang.khachhang_id=tbl_giaodich.khachhang_id AND tbl_giaodich.magiaodich='$magiaodich' ORDER BY tbl_giaodich.giaodich_id DESC"); 
				?> 
				<table class="table table-bordered ">
					<tr>
						<th>No.</th>
						<th>Order Id</th>
						<th>Product name</th>
						<th>Order date</th>
						<th>Amount</th>
						
					</tr>
					<?php
					$i = 0;
					while($row_donhang = mysqli_fetch_array($sql_select)){ 
						$i++;
					?> 
					<tr>
						<td><?php echo $i; ?></td>
						
						<td><?php echo $row_donhang['magiaodich']; ?></td>
					
						<td><?php echo $row_donhang['sanpham_name']; ?></td>
						
						<td><?php echo $row_donhang['ngaythang'] ?></td>

						<td><?php echo number_format($row_donhang['soluong']*$row_donhang['sanpham_giakhuyenmai']).'vnđ'; ?></td>
					
					
					</tr>
					 <?php
					} 
					?> 
				</table>
			</div>
				</div> <!--close div row-->
			</div> <!--close div container-->
		</div> <!--Clode content-wrapper -->
        </div> <!--main panel-->
    </div> <!--container-fluid-->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
<script src="giaodien/vendors/js/vendor.bundle.base.js"></script>
<script src="giaodien/js/hoverable-collapse.js"></script>
<script src="giaodien/js/template.js"></script>
</body>
</html>