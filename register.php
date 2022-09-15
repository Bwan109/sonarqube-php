<?php 
	session_start();
	include('core/init.php');
	include('includes/header.php');

?>

<div class="container-fluid p-2">
	<div class="card">
		<div class="card-header">
			<h3 class="h3-responsive p-2 text-center">Registration Form</h3>
		</div>
		<div class="card-body">
			<div class="container-fluid">
				<form class="p-3 grey-text" method="post" action="register.php">
					<div class="row">					
						<div class="col-md-6">
							<div class="md-form form-sm"> <i class="fa fa-user prefix"></i>
				              <input type="text" id="fullname" class="form-control form-control-sm" name="fullname" placeholder="FullName" required>
				            </div>
				            <div class="md-form form-sm"> <i class="fa fa-envelope prefix"></i>
				              <input type="email" id="email" class="form-control form-control-sm" name="email" placeholder="Email" required>
				            </div>
				            <div class="md-form form-sm"> <i class="fa fa-lock prefix"></i>
				              <input type="password" id="password" class="form-control form-control-sm" name="password" placeholder="Password" required>
				            </div>
				            <div class="md-form form-sm"> <i class="fas fa-map prefix"></i>
				              <input type="text" id="address1" class="form-control form-control-sm" name="address1" placeholder="Address 1" required>
				            </div>
							<div class="md-form form-sm"> <i class="fa fa-map-marker prefix"></i>
				              <input type="text" id="address2" class="form-control form-control-sm" name="address2" placeholder="Address2" required>
				            </div>
						</div>
						<div class="col-md-6">
				            <div class="md-form form-sm"> <i class="fa fa-map-marker-alt prefix"></i>
				              <input type="text" id="city" class="form-control form-control-sm" name="city" placeholder="City" required>
				            </div>
				            <div class="md-form form-sm"> <i class="fa fa-map-marker-alt prefix"></i>
				              <input type="text" id="state" class="form-control form-control-sm" name="state" placeholder="State" required>
				            </div>
				            <div class="md-form form-sm"> <i class="fa fa-map-marker-alt prefix"></i>
				              <input type="text" id="zipcode" class="form-control form-control-sm" name="zipcode" placeholder="Zipcode" required>
				            </div>
				            <div class="md-form form-sm"> <i class="fa fa-phone prefix"></i>
				              <input type="text" id="phone" class="form-control form-control-sm" name="phone" placeholder="Phone" required>
				            </div>
				            <div class="md-form form-sm"> <i class="fa fa-map-marker-alt prefix"></i>
				              <input type="text" id="country" class="form-control form-control-sm" name="country" placeholder="Country" required>
				            </div>
						</div>
						<div class="text-center mt-4">
			              	<button class="btn btn-default" type="submit" name="submit">Submit <i class="fa fa-paper-plane-o ml-1"></i></button>
			            </div>					
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
	if(isset($_POST['submit'])){
		$ip = getIp();
		$fullname = sanitize($_POST['fullname']);
		$email = sanitize($_POST['email']);
		$password = sanitize($_POST['password']);
		$address1 = sanitize($_POST['address1']);
		$address2 = sanitize($_POST['address2']);
		$city = sanitize($_POST['city']);
		$state = sanitize($_POST['state']);
		$zipcode = sanitize($_POST['zipcode']);
		$phone = sanitize($_POST['phone']);
		$country = sanitize($_POST['country']);

		$insertCus = "INSERT INTO customers (ip,fullname,email,password,address1,address2,city,state,zipcode,phone,country) VALUES ('$ip','$fullname','$email','$password','$address1','$address2','$city','$state','$zipcode','$phone','$country')";
		$db->query($insertCus);

		// $sel_cart = "SELECT * FROM cart WHERE ip_add = '$ip'";
		// $run_cart = $db->query($sel_cart);
		// $check_cart = mysqli_num_rows($run_cart);
		// if($check_cart == 0){
		// 	$_SESSION['email'] = $email;

		// 	echo "<script>alert('Account has been created successfully')</script>";
		// 	echo "<script>window.open('myaccount.php','_self')</script>";
		// }else{
			$_SESSION['email'] = $email;

			echo "<script>alert('Account has been created successfully')</script>";
			echo "<script>window.open('index.php','_self')</script>";
	//	}
	}
?>

<?php include('includes/footer.php'); ?>