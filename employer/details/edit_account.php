<?php 
	include('../core/init.php');
?>

<?php
	$email = $_SESSION['email'];
	$sql = "SELECT * FROM employer WHERE email = '$email'";
    $result = $db->query($sql);
    while ($row_pro = mysqli_fetch_array($result)) {
          $emp_id = $row_pro['id'];
          $emp_name = $row_pro['nameOfCompany'];
          $emp_about = $row_pro['aboutCompany'];
          $emp_email = $row_pro['email'];
          $emp_address1 = $row_pro['address1'];
          $emp_address2 = $row_pro['address2'];
          $emp_city = $row_pro['city'];
          $emp_state = $row_pro['state'];
          $emp_zipcode = $row_pro['zipcode'];
          $emp_phone = $row_pro['phone'];
          $emp_country = $row_pro['country'];
    }
?>

<div class="container-fluid p-2">
	<div class="card">
		<div class="card-header">
			<h3 class="h3-responsive p-2 text-center">Edit Account</h3>
		</div>
		<div class="card-body">
			<div class="container-fluid">
				<form class="p-3 grey-text" method="post" action="" enctype="multipart/form-data">
					<div class="row">					
						<div class="col-md-6">
							<div class="md-form form-sm"> <i class="fa fa-user prefix"></i>
				              <input type="text" id="nameOfCompany" class="form-control form-control-sm" name="nameOfCompany" placeholder="Name Of Company" value="<?php echo $emp_name;?>">
				              <label for="nameOfCompany"></label>
				            </div>
				            <div class="md-form form-sm"> <i class="fa fa-user prefix"></i>
				              <input type="text" id="aboutCompany" class="form-control form-control-sm" name="aboutCompany" placeholder="About Company" value="<?php echo $emp_about;?>">
				              <label for="aboutCompany"></label>
				            </div>
				            <div class="md-form form-sm"> <i class="fa fa-envelope prefix"></i>
				              <input type="email" id="email" class="form-control form-control-sm" name="email" placeholder="Email" value="<?php echo $emp_email;?>">
				              <label for="email"></label>
				            </div>
				            <div class="md-form form-sm"> <i class="fa fa-map prefix"></i>
				              <input type="text" id="address1" class="form-control form-control-sm" name="address1" placeholder="Address 1" value="<?php echo $emp_address1;?>">
				              <label for="address1"></label>
				            </div>
							<div class="md-form form-sm"> <i class="fa fa-map-marker prefix"></i>
				              <input type="text" id="address2" class="form-control form-control-sm" name="address2" placeholder="Address 2" value="<?php echo $emp_address2;?>">
				              <label for="address2"></label>
				            </div>
						</div>
						<div class="col-md-6">
				            <div class="md-form form-sm"> <i class="fa fa-map-marker prefix"></i>
				              <input type="text" id="city" class="form-control form-control-sm" name="city" placeholder="City" value="<?php echo $emp_city;?>">
				              <label for="city"> </label>
				            </div>
				            <div class="md-form form-sm"> <i class="fa fa-map-marker prefix"></i>
				              <input type="text" id="state" class="form-control form-control-sm" name="state" placeholder="State" value="<?php echo $emp_state;?>">
				              <label for="state"> </label>
				            </div>
				            <div class="md-form form-sm"> <i class="fa fa-map-marker prefix"></i>
				              <input type="text" id="zipcode" class="form-control form-control-sm" name="zipcode" placeholder="Zipcode" value="<?php echo $emp_zipcode;?>">
				              <label for="zipcode"> </label>
				            </div>
				            <div class="md-form form-sm"> <i class="fa fa-phone prefix"></i>
				              <input type="text" id="phone" class="form-control form-control-sm" name="phone" placeholder="Phone" value="<?php echo $emp_phone;?>">
				              <label for="phone"> </label>
				            </div>
				            <div class="md-form form-sm"> <i class="fa fa-map-marker prefix"></i>
				              <input type="text" id="country" class="form-control form-control-sm" name="country" placeholder="Country" value="<?php echo $emp_country;?>">
				              <label for="country"> </label>
				            </div>
						</div>
						<div class="text-center mt-4">
			              	<button class="btn btn-default" type="submit" name="update">Update <i class="fa fa-paper-plane-o ml-1"></i></button>
			            </div>					
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<?php
	if(isset($_POST['update'])){
	//	$ip = getIp();
		$empployer_id = $emp_id;
		$emp_name = $_POST['nameOfCompany'];
		$emp_about = $_POST['aboutCompany'];
		$emp_email = $_POST['email'];
		$emp_address1 = $_POST['address1'];
		$emp_address2 = $_POST['address2'];
		$emp_city = $_POST['city'];
		$emp_state = $_POST['state'];
		$emp_zipcode = $_POST['zipcode'];
		$emp_phone = $_POST['phone'];
		$emp_country = $_POST['country'];

		$updateEmp = "UPDATE employer SET nameOfCompany = '$emp_name', aboutCompany = '$emp_about', email = '$emp_email', address1 = '$emp_address1', address2 = '$emp_address2', city = '$emp_city', state = '$emp_state', zipcode = '$emp_zipcode', phone = '$emp_phone', country = '$emp_country' WHERE id = '$emp_id'";
		$run_query = $db->query($updateEmp);
		if($run_query){
			echo "<script>alert('Your account has been successfully updated')</script>";
			echo "<script>window.open('myaccount.php','_self')</script>";
		}
	}
?>