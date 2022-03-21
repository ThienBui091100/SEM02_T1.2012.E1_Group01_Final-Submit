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
	if(isset($_POST['themsanpham'])){
		$tensanpham = $_POST['tensanpham'];
		$hinhanh = $_FILES['hinhanh']['name'];
		
		$soluong = $_POST['soluong'];
		$gia = $_POST['giasanpham'];
		$giakhuyenmai = $_POST['giakhuyenmai'];
		$danhmuc = $_POST['danhmuc'];
		$chitiet = $_POST['chitiet'];
		$mota = $_POST['mota'];
		$path = '../uploads/';
		
		$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
		$sql_insert_product = mysqli_query($con,"INSERT INTO tbl_sanpham(sanpham_name,sanpham_chitiet,sanpham_mota,sanpham_gia,sanpham_giakhuyenmai,sanpham_soluong,sanpham_image,category_id) values ('$tensanpham','$chitiet','$mota','$gia','$giakhuyenmai','$soluong','$hinhanh','$danhmuc')");
		move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
	}elseif(isset($_POST['capnhatsanpham'])) {
		$id_update = $_POST['id_update'];
		$tensanpham = $_POST['tensanpham'];
		$hinhanh = $_FILES['hinhanh']['name'];
		$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
		$soluong = $_POST['soluong'];
		$gia = $_POST['giasanpham'];
		$giakhuyenmai = $_POST['giakhuyenmai'];
		$danhmuc = $_POST['danhmuc'];
		$chitiet = $_POST['chitiet'];
		$mota = $_POST['mota'];
		$path = '../uploads/';
		if($hinhanh==''){
			$sql_update_image = "UPDATE tbl_sanpham SET sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_mota='$mota',sanpham_gia='$gia',sanpham_giakhuyenmai='$giakhuyenmai',sanpham_soluong='$soluong',category_id='$danhmuc' WHERE sanpham_id='$id_update'";
		}else{
			move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
			$sql_update_image = "UPDATE tbl_sanpham SET sanpham_name='$tensanpham',sanpham_chitiet='$chitiet',sanpham_mota='$mota',sanpham_gia='$gia',sanpham_giakhuyenmai='$giakhuyenmai',sanpham_soluong='$soluong',sanpham_image='$hinhanh',category_id='$danhmuc' WHERE sanpham_id='$id_update'";
		}
		mysqli_query($con,$sql_update_image);
	}
	
?> 
<?php
	if(isset($_GET['xoa'])){
		$id= $_GET['xoa'];
		$sql_xoa = mysqli_query($con,"DELETE FROM tbl_sanpham WHERE sanpham_id='$id'");
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
						<?php
					if(isset($_GET['quanly'])=='capnhat'){
						$id_capnhat = $_GET['capnhat_id'];
						$sql_capnhat = mysqli_query($con,"SELECT * FROM tbl_sanpham WHERE sanpham_id='$id_capnhat'");
						$row_capnhat = mysqli_fetch_array($sql_capnhat);
						$id_category_1 = $row_capnhat['category_id'];
						?>
						<div class="col-md-4">
						<h4>Update Product</h4>
						
						<form action="" method="POST" enctype="multipart/form-data">
							<label>Product Name</label>
							<input type="text" class="form-control" name="tensanpham" value="<?php echo $row_capnhat['sanpham_name'] ?>"><br>
							<input type="hidden" class="form-control" name="id_update" value="<?php echo $row_capnhat['sanpham_id'] ?>">
							<label>Picture</label>
							<input type="file" class="form-control" name="hinhanh"><br>
							<img src="../uploads/<?php echo $row_capnhat['sanpham_image'] ?>" height="80" width="80" ><br>
							<label>Price</label>
							<input type="text" class="form-control" name="giasanpham" value="<?php echo $row_capnhat['sanpham_gia'] ?>"><br>
							<label>Price after sales</label>
							<input type="text" class="form-control" name="giakhuyenmai" value="<?php echo $row_capnhat['sanpham_giakhuyenmai'] ?>"><br>
							<label>Quantity</label>
							<input type="text" class="form-control" name="soluong" value="<?php echo $row_capnhat['sanpham_soluong'] ?>"><br>
							<label>Description</label>
							<textarea class="form-control" rows="10" name="mota"><?php echo $row_capnhat['sanpham_mota'] ?></textarea><br>
							<label>Detail</label>
							<textarea class="form-control" rows="10" name="chitiet"><?php echo $row_capnhat['sanpham_chitiet'] ?></textarea><br>
							<label>Categories</label>
							<?php
							$sql_danhmuc = mysqli_query($con,"SELECT * FROM tbl_category ORDER BY category_id DESC"); 
							?>
							<select name="danhmuc" class="form-control">
								<option value="0">-----Select Categories-----</option>
								<?php
								while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
									if($id_category_1==$row_danhmuc['category_id']){
								?>
								<option selected value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
								<?php 
									}else{
								?>
								<option value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
								<?php
									}
								}
								?>
							</select><br>
							<input type="submit" name="capnhatsanpham" value="Update Product" class="btn btn-success">
						</form>
						</div>
					<?php
					}else{
						?> 
						<div class="col-md-3">
						<h4>Add Product</h4>
						
						<form action="" method="POST" enctype="multipart/form-data">
							<label>Product name</label>
							<input type="text" class="form-control" name="tensanpham" placeholder="Product name"><br>
							<label>Picture</label>
							<input type="file" class="form-control" name="hinhanh"><br>
							<label>Price</label>
							<input type="text" class="form-control" name="giasanpham" placeholder="Price"><br>
							<label>Price after sales</label>
							<input type="text" class="form-control" name="giakhuyenmai" placeholder="Price after sales"><br>
							<label>Quantity</label>
							<input type="text" class="form-control" name="soluong" placeholder="Quantity"><br>
							<label>Description</label>
							<textarea class="form-control" name="mota"></textarea><br>
							<label>Detail</label>
							<textarea class="form-control" name="chitiet"></textarea><br>
							<label>Categories</label>
							<?php
							$sql_danhmuc = mysqli_query($con,"SELECT * FROM tbl_category ORDER BY category_id DESC"); 
							?>
							<select name="danhmuc" class="form-control">
								<option value="0">-----Select Categories-----</option>
								<?php
								while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
								?>
								<option value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
								<?php 
								}
								?>
							</select><br>
							<input type="submit" name="themsanpham" value="Add Product" class="btn btn-success">
						</form>
						</div>
						<?php
					} 
					
						?>
					<div class="col-md-6">
						<h4>List Product</h4>
						<?php
						$sql_select_sp = mysqli_query($con,"SELECT * FROM tbl_sanpham,tbl_category WHERE tbl_sanpham.category_id=tbl_category.category_id ORDER BY tbl_sanpham.sanpham_id DESC"); 
						?> 
						<table class="table table-bordered ">
							<tr>
								<th>No.</th>
								<th>Product name</th>
								<th>Picture</th>
								<th>Quantity</th>
								<th>Categories</th>
								<th>Price</th>
								<th>Price after sales</th>
								<th>Management</th>
							</tr>
							<?php
							$i = 0;
							while($row_sp = mysqli_fetch_array($sql_select_sp)){ 
								$i++;
							?> 
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $row_sp['sanpham_name'] ?></td>
								<td><img src="../uploads/<?php echo $row_sp['sanpham_image'] ?>" height="100" width="80"></td>
								<td><?php echo $row_sp['sanpham_soluong'] ?></td>
								<td><?php echo $row_sp['category_name'] ?></td>
								<td><?php echo number_format($row_sp['sanpham_gia']).'vnđ' ?></td>
								<td><?php echo number_format($row_sp['sanpham_giakhuyenmai']).'vnđ' ?></td>
								<td><a href="?xoa=<?php echo $row_sp['sanpham_id'] ?>">Delete</a> || <a href="xulysanpham.php?quanly=capnhat&capnhat_id=<?php echo $row_sp['sanpham_id'] ?>">Update</a></td>
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

