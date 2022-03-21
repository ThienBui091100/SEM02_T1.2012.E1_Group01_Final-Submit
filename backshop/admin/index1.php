<?php
	session_start();
 include('../db/connect.php'); 
?>
<?php
	// session_destroy();
	// unset('dangnhap');
	if(isset($_POST['dangnhap'])) {
		$taikhoan = $_POST['taikhoan'];
		$matkhau = $_POST['matkhau'];
		if($taikhoan=='' || $matkhau ==''){
			echo '<p>Xin nhập đủ</p>';
		}else{
			$sql_select_admin = mysqli_query($con,"SELECT * FROM tbl_admin WHERE email='$taikhoan' AND password='$matkhau' LIMIT 1");
			$count = mysqli_num_rows($sql_select_admin);
			$row_dangnhap = mysqli_fetch_array($sql_select_admin);
			if($count>0){
				$_SESSION['dangnhap'] = $row_dangnhap['admin_name'];
				$_SESSION['admin_id'] = $row_dangnhap['admin_id'];
				header('Location: dashboard.php');
			}else{
				echo '<p>Account or Password incorrect</p>';
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin Login</title>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<h2 align="center">Admin Login</h2>
	<div class="col-md-6">
	<div class="form-group">
		<form action="" method="POST">
		<label>Account</label>
		<input type="text" name="taikhoan" placeholder="Email" class="form-control"><br>
		<label>Password</label>
		<input type="password" name="matkhau" placeholder="Password" class="form-control"><br>
		<input type="submit" name="dangnhap" class="btn btn-primary" value="Admin Login">
		</form>
	</div>
	</div>
</body>
</html>

