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
<?php 
if(isset($_POST['capnhatdonhang'])){
	$xuly = $_POST['xuly'];
	$mahang = $_POST['mahang_xuly'];
	$sql_update_donhang = mysqli_query($con,"UPDATE tbl_donhang SET tinhtrang='$xuly' WHERE mahang='$mahang'");
	$sql_update_giaodich = mysqli_query($con,"UPDATE tbl_giaodich SET tinhtrangdon='$xuly' WHERE magiaodich='$mahang'");
}

?>
<?php
	if(isset($_GET['xoadonhang'])){
		$mahang = $_GET['xoadonhang'];
		$sql_delete = mysqli_query($con,"DELETE FROM tbl_donhang WHERE mahang='$mahang'");
		header('Location:xulydonhang.php');
	} 
	if(isset($_GET['xacnhanhuy'])&& isset($_GET['mahang'])){
		$huydon = $_GET['xacnhanhuy'];
		$magiaodich = $_GET['mahang'];
	}else{
		$huydon = '';
		$magiaodich = '';
	}
	$sql_update_donhang = mysqli_query($con,"UPDATE tbl_donhang SET huydon='$huydon' WHERE mahang='$magiaodich'");
	$sql_update_giaodich = mysqli_query($con,"UPDATE tbl_giaodich SET huydon='$huydon' WHERE magiaodich='$magiaodich'");

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
			<div class="container-fluid">
				<div class="row">
					<?php
					if(isset($_GET['quanly'])=='xemdonhang'){
						$mahang = $_GET['mahang'];
						$sql_chitiet = mysqli_query($con,"SELECT * FROM tbl_donhang,tbl_sanpham WHERE tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id AND tbl_donhang.mahang='$mahang'");
						?>
						<div class="col-md-7">
						<h4>Order Detail</h4>
					<form action="" method="POST">
						<table class="table table-bordered ">
							<tr>
								<th>No.</th>
								<th>Product ID </th>
								<th>Product Name</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Amount</th>
								<th>Order Date</th>

								
								<!-- <th>Quản lý</th> -->
							</tr>
							<?php
							$i = 0;
							while($row_donhang = mysqli_fetch_array($sql_chitiet)){ 
								$i++;
							?> 
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $row_donhang['mahang']; ?></td>
								
								<td><?php echo $row_donhang['sanpham_name']; ?></td>
								<td><?php echo $row_donhang['soluong']; ?></td>
								<td><?php echo $row_donhang['sanpham_giakhuyenmai']; ?></td>
								<td><?php echo number_format($row_donhang['soluong']*$row_donhang['sanpham_giakhuyenmai']).'vnđ'; ?></td>
								
								<td><?php echo $row_donhang['ngaythang'] ?></td>
								<input type="hidden" name="mahang_xuly" value="<?php echo $row_donhang['mahang'] ?>">

								<!-- <td><a href="?xoa=<?php echo $row_donhang['donhang_id'] ?>">Xóa</a> || <a href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['mahang'] ?>">Order details</a></td> -->
							</tr>
							<?php
							} 
							?> 
						</table>

						<select class="form-control" name="xuly">
							<option value="1">Processed | Delivery</option>
							<option value="0">No Process</option>
						</select><br>

						<input type="submit" value="Update order" name="capnhatdonhang" class="btn btn-success">
						<br><br>
					</form>
						</div>  
					<?php
					}else{
						?> 
						
						<div class="col-md-4">
							<p>Order</p>
							<hr>
						</div>  
						<?php
					} 
					
						?> 
					
					<div class="col-md-10">
						<h4>Order List</h4>
						<?php
						$sql_select = mysqli_query($con,"SELECT * FROM tbl_sanpham,tbl_khachhang,tbl_donhang WHERE tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id AND tbl_donhang.khachhang_id=tbl_khachhang.khachhang_id GROUP BY mahang "); 
						?> 
						<table class="table table-bordered ">
							<tr>
								<th>No.</th>
								<th>Id:</th>
								<th>Order Status</th>
								<th>Customer Name</th>
								<th>Order date</th>
								<th>Pay</th>
								<th>Order Cancel</th>
								<th>Management</th>
							</tr>
							<?php
							$i = 0;
							while($row_donhang = mysqli_fetch_array($sql_select)){ 
								$i++;
							?> 
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $row_donhang['mahang']; ?></td>
								<td><?php
									if($row_donhang['tinhtrang']==0){
										echo 'No process';
									}else{
										echo 'Processed';
									}
								?></td>
								<td><?php echo $row_donhang['name']; ?></td>
								<td><?php echo $row_donhang['ngaythang'] ?></td>
								<td><?php
									if($row_donhang['thanhtoan']==0){
										echo 'Unpaid';
									}else{
										echo 'Paid';
									}
								?></td>

								<td><?php if($row_donhang['huydon']==0){ }elseif($row_donhang['huydon']==1){
									echo '<a href="xulydonhang.php?quanly=xemdonhang&mahang='.$row_donhang['mahang'].'&xacnhanhuy=2">Confirm Cancel</a>';
								}else{
									echo 'Cancel';
								} 
								?></td>

								<td><a onclick="return checkDelete()" href="?xoadonhang=<?php echo $row_donhang['mahang'] ?>">Delete</a> || <a href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['mahang'] ?>">Detail </a></td>
							</tr>
							<?php
							} 
							?> 
						</table>
					</div>
				</div>
		</div>
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
