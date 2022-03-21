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
	if(isset($_POST['themdanhmuc'])){
		$tendanhmuc = $_POST['danhmuc'];
		$sql_insert = mysqli_query($con,"INSERT INTO tbl_category(category_name) values ('$tendanhmuc')");
	}elseif(isset($_POST['capnhatdanhmuc'])){
		$id_post = $_POST['id_danhmuc'];
		$tendanhmuc = $_POST['danhmuc'];
		$sql_update = mysqli_query($con,"UPDATE tbl_category SET category_name='$tendanhmuc' WHERE category_id='$id_post'");
		header('Location:xulydanhmuc.php');
	}
	if(isset($_GET['xoa'])){
		$id= $_GET['xoa'];
		$sql_xoa = mysqli_query($con,"DELETE FROM tbl_category WHERE category_id='$id'");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Categories</title>
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
					<?php
					if(isset($_GET['quanly'])=='capnhat'){
						$id_capnhat = $_GET['id'];
						$sql_capnhat = mysqli_query($con,"SELECT * FROM tbl_category WHERE category_id='$id_capnhat'");
						$row_capnhat = mysqli_fetch_array($sql_capnhat);
						?>
						<div class="col-md-4">
						<h4>Update Categories</h4>
						<label>Categories Name</label>
						<form action="" method="POST">
							<input type="text" class="form-control" name="danhmuc" value="<?php echo $row_capnhat['category_name'] ?>"><br>
							<input type="hidden" class="form-control" name="id_danhmuc" value="<?php echo $row_capnhat['category_id'] ?>">

							<input type="submit" name="capnhatdanhmuc" value="Update Categories" class="btn btn-default">
						</form>
						</div>
					<?php
					}else{
						?>
						<div class="col-md-4">
						<h4>Add Categories</h4>
						<label>Categories Name</label>
						<form action="" method="POST">
							<input type="text" class="form-control" name="danhmuc" placeholder="Add Categories"><br>
							<input type="submit" name="themdanhmuc" value="Add Categories" class="btn btn-success">
						</form>
						</div>
						<?php
					} 
					
						?>
					<div class="col-md-8">
						<h4>List Categories</h4>
						<?php
						$sql_select = mysqli_query($con,"SELECT * FROM tbl_category ORDER BY category_id DESC"); 
						?>
						<table class="table table-bordered ">
							<tr>
								<th>No.</th>
								<th>Categories Name</th>
								<th>Management</th>
							</tr>
							<?php
							$i = 0;
							while($row_category = mysqli_fetch_array($sql_select)){ 
								$i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $row_category['category_name'] ?></td>
								<td><a onclick="return checkDelete()" href="?xoa=<?php echo $row_category['category_id'] ?>">Delete</a> || <a href="?quanly=capnhat&id=<?php echo $row_category['category_id'] ?>">Update</a></td>
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

<script src="giaodien/vendors/js/vendor.bundle.base.js"></script>
<script src="giaodien/js/hoverable-collapse.js"></script>
<script src="giaodien/js/template.js"></script>
</body>
</html>
