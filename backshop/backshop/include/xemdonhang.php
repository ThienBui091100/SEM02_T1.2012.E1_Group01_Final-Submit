<?php
	if(isset($_GET['huydon'])&& isset($_GET['magiaodich'])){
		$huydon = $_GET['huydon'];
		$magiaodich = $_GET['magiaodich'];
	}else{
		$huydon = '';
		$magiaodich = '';
	}
	$sql_update_donhang = mysqli_query($con,"UPDATE tbl_donhang SET huydon='$huydon' WHERE mahang='$magiaodich'");
	$sql_update_giaodich = mysqli_query($con,"UPDATE tbl_giaodich SET huydon='$huydon' WHERE magiaodich='$magiaodich'");
?>
<!-- top Products -->
	<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">Order detail</h3>
			<!-- //tittle heading -->
			<div class="row">
				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">
						<!-- first section -->
						
							<div class="row">
								<?php
								if(isset($_SESSION['dangnhap_home'])){
									//echo 'Order : '.$_SESSION['dangnhap_home'];
									echo '<p style="color:#000;">Order : '.$_SESSION['dangnhap_home'].'<a href="index.php?quanly=logout">  Logout</a></p>';
								} 
								?>
							<div class="col-md-12">
								
								<?php
								if(isset($_GET['khachhang'])){
									$id_khachhang = $_GET['khachhang'];
								}else{
									$id_khachhang = '';
								}
								$sql_select = mysqli_query($con,"SELECT magiaodich,ngaythang,SUM(amount) AS amount,tinhtrangdon,huydon FROM tbl_giaodich WHERE tbl_giaodich.khachhang_id='$id_khachhang' GROUP BY tbl_giaodich.magiaodich"); 
								?> 
								<table class="table table-bordered ">
									<tr>
										<th>No.</th>
										<th>Order Id</th>
										<th>Order date</th>
										<th>Management</th>
										<th>Status</th>
										<th>Amount</th>
										<th>Note</th>
									</tr>
									<?php
									$i = 0;
									while($row_donhang = mysqli_fetch_array($sql_select)){ 
										$i++;
									?> 
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $row_donhang['magiaodich']; ?></td>
										<td><?php echo $row_donhang['ngaythang'] ?></td>
										<td><a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id'] ?>&magiaodich=<?php echo $row_donhang['magiaodich'] ?>">Details</a></td>
										<td><?php 
										if($row_donhang['tinhtrangdon']==0){
											echo 'Ordered';
										}else{
											echo 'Process | Delivering';
										}
										?></td>
										<td><?php echo number_format($row_donhang['amount']).'vnđ' ?></td>
										<td>
											<?php
											if($row_donhang['huydon']==0){ 
											?>
											<a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id'] ?>&magiaodich=<?php echo $row_donhang['magiaodich'] ?>&huydon=1">Cancel request</a>
											<?php
										}elseif($row_donhang['huydon']==1){											
											?>
											<p>Cancel</p>
											<?php
											}else{
												echo 'Cancel';
											}
											?>
										</td>
									</tr>
									 <?php
									} 
									?> 
								</table>
							</div>


							<div class="col-md-12">
								<p>Order detail</p><br>
								<?php
								if(isset($_GET['magiaodich'])){
									$magiaodich = $_GET['magiaodich'];
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
										<th>Quantity</th>
										<th>Price</th>
										<th>Amount</th>
										<th>Order date</th>
										
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

										<td><?php echo $row_donhang['soluong']; ?></td>

										<td><?php echo $row_donhang['sanpham_giakhuyenmai']; ?></td>

										<td><?php echo number_format($row_donhang['soluong']*$row_donhang['sanpham_giakhuyenmai']).'vnđ'; ?></td>
										
										<td><?php echo $row_donhang['ngaythang'] ?></td>
									
										
									</tr>
									 <?php
									} 
									?> 
								</table>
							</div>
							</div>

						
						<!-- //first section -->
					</div>
				</div>
				<!-- //product left -->
				<!-- product right -->
				
			</div>
		</div>
	</div>
	<!-- //top products -->