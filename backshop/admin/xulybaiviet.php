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
	if(isset($_POST['thembaiviet'])){
		$tenbaiviet = $_POST['tenbaiviet'];
		$hinhanh = $_FILES['hinhanh']['name'];
		$danhmuc = $_POST['danhmuc'];
		$chitiet = $_POST['chitiet'];
		$mota = $_POST['mota'];
		$path = '../uploads/';
		
		$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
		$sql_insert_product = mysqli_query($con,"INSERT INTO tbl_baiviet(tenbaiviet,tomtat,noidung,danhmuctin_id,baiviet_image) values ('$tenbaiviet','$mota','$chitiet','$danhmuc','$hinhanh')");
		move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
		}elseif(isset($_POST['capnhatbaiviet'])) {
		$id_update = $_POST['id_update'];
		$tenbaiviet = $_POST['tenbaiviet'];
		$hinhanh = $_FILES['hinhanh']['name'];
		$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
	
		$danhmuc = $_POST['danhmuc'];
		$chitiet = $_POST['chitiet'];
		$mota = $_POST['mota'];
		$path = '../uploads/';
		if($hinhanh==''){
			$sql_update_image = "UPDATE tbl_baiviet SET tenbaiviet='$tenbaiviet',noidung='$chitiet',tomtat='$mota',danhmuctin_id='$danhmuc' WHERE baiviet_id='$id_update'";
		}else{
			move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
			$sql_update_image = "UPDATE tbl_baiviet SET tenbaiviet='$tenbaiviet',noidung='$chitiet',tomtat='$mota',danhmuctin_id='$danhmuc',baiviet_image='$hinhanh' WHERE baiviet_id='$id_update'";
		}
		mysqli_query($con,$sql_update_image);
	}
	
?> 
<?php
	if(isset($_GET['xoa'])){
		$id= $_GET['xoa'];
		$sql_xoa = mysqli_query($con,"DELETE FROM tbl_baiviet WHERE baiviet_id='$id'");
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
							$sql_capnhat = mysqli_query($con,"SELECT * FROM tbl_baiviet WHERE baiviet_id='$id_capnhat'");
							$row_capnhat = mysqli_fetch_array($sql_capnhat);
							$id_category_1 = $row_capnhat['danhmuctin_id'];
							?>
					<div class="col-md-4">
						<h4>Update Post</h4>
				
						<form action="" method="POST" enctype="multipart/form-data">
							<label>Post Name</label>
							<input type="text" class="form-control" name="tenbaiviet" value="<?php echo $row_capnhat['tenbaiviet'] ?>"><br>
							<input type="hidden" class="form-control" name="id_update" value="<?php echo $row_capnhat['baiviet_id'] ?>">
							<label>Picture</label>
							<input type="file" class="form-control" name="hinhanh"><br>
							<img src="../uploads/<?php echo $row_capnhat['baiviet_image'] ?>" height="80" width="80"><br>
							
						
							<label>Description</label>
							<textarea class="form-control" rows="10" name="mota"><?php echo $row_capnhat['tomtat'] ?></textarea><br>
							<label>Detail</label>
							<textarea class="form-control" rows="10" name="chitiet"><?php echo $row_capnhat['noidung'] ?></textarea><br>
							<label>Categories</label>
							<?php
							$sql_danhmuc = mysqli_query($con,"SELECT * FROM tbl_danhmuc_tin ORDER BY danhmuctin_id DESC"); 
							?>
							<select name="danhmuc" class="form-control">
								<option value="0">-----Select Categories-----</option>
								<?php
								while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
									if($id_category_1==$row_danhmuc['danhmuctin_id']){
								?>
								<option selected value="<?php echo $row_danhmuc['danhmuctin_id'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
								<?php 
									}else{
								?>
								<option value="<?php echo $row_danhmuc['danhmuctin_id'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
								<?php
									}
								}
								?>
							</select><br>
							<input type="submit" name="capnhatbaiviet" value="Update Post" class="btn btn-default">
						</form>
					</div> <!--col-md-4 -->
					<?php
					}else{
					?> 
					<div class="col-md-4">
						<h4>Add Post</h4>
				
						<form action="" method="POST" enctype="multipart/form-data">
							<label>Post Name</label>
							<input type="text" class="form-control" name="tenbaiviet" placeholder="Post Name"><br>
							<label>Picture</label>
							<input type="file" class="form-control" name="hinhanh"><br>

							<label>Description</label>
							<textarea class="form-control" name="mota"></textarea><br>
							<label>Detail</label>
							<textarea class="form-control" name="chitiet"></textarea><br>
							<label>Categories</label>
							<?php
							$sql_danhmuc = mysqli_query($con,"SELECT * FROM tbl_danhmuc_tin ORDER BY danhmuctin_id DESC"); 
							?>
							<select name="danhmuc" class="form-control">
								<option value="0">-----Select Categories-----</option>
								<?php
								while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
								?>
								<option value="<?php echo $row_danhmuc['danhmuctin_id'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
								<?php 
								}
								?>
							</select><br>
							<input type="submit" name="thembaiviet" value="Add Post" class="btn btn-success">
						</form>
					</div><!--col-md-4 -->
						<?php
					} 
					
						?>
					<div class="col-md-8">
						<h4>List Post</h4>
						<?php
						$sql_select_bv = mysqli_query($con,"SELECT * FROM tbl_baiviet,tbl_danhmuc_tin WHERE tbl_baiviet.danhmuctin_id=tbl_danhmuc_tin.danhmuctin_id ORDER BY tbl_baiviet.baiviet_id DESC"); 
						?> 
						<table class="table table-bordered ">
						<tr>
							<th>No.</th>
							<th>Product Name</th>
							<th>Picture</th>
						
							<th>Categories</th>
							
							<th>Management</th>
						</tr>
						<?php
						$i = 0;
						while($row_bv = mysqli_fetch_array($sql_select_bv)){ 
							$i++;
						?> 
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $row_bv['tenbaiviet'] ?></td>
							<td><img src="../uploads/<?php echo $row_bv['baiviet_image'] ?>" height="100" width="80"></td>

							<td><?php echo $row_bv['tendanhmuc'] ?></td>
							
							<td><a onclick="return checkDelete()" href="?xoa=<?php echo $row_bv['baiviet_id'] ?>">Delete</a> || <a href="xulybaiviet.php?quanly=capnhat&capnhat_id=<?php echo $row_bv['baiviet_id'] ?>">Update</a></td>
						</tr>
						<?php
						} 
						?> 
						</table>
					</div> <!--col-md-8-->
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
