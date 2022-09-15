<?php 
	include('core/init.php');
    include 'includes/header.php'; 
?>

<div class="container-fluid p-2">
	<div class="card">
		<div class="card-header">
			<h3 class="h3-responsive p-2 text-center">Enter Email to change password</h3>
		</div>
		<div class="card-body">
			<div class="container-fluid">
				<form class="p-3 grey-text" method="post" action="" enctype="multipart/form-data">
					<div class="md-form form-sm"> <i class="fa fa-email"></i>
		              	<input type="email" id="email" class="form-control form-control-sm" name="email" placeholder="Email" required>
		            </div>
                    <div class="text-center mt-4">
		              	<button class="btn btn-default" type="submit" name="email_verify">Proceed to change password<i class="fa fa-paper-plane-o ml-1"></i></button>
			        </div>	
				</form>
			</div>
		</div>
	</div>
</div>


<?php
	if(isset($_POST['email_verify'])){
		//$ip = getIp();
		$email = $_POST['email'];

		$sqlPass = "SELECT * FROM customers WHERE email = '$email'";
		$runPass = $db->query($sqlPass);
		$verifyEmail = mysqli_num_rows($runPass);
		if($verifyEmail == 0){
			echo "<script>alert('Your current email is not registered')</script>";
			exit();
		}
	
		else{
			echo "<script>alert('Email correct!')</script>";
			echo "<script>window.open('forgetpassword.php','_self')</script>";
		}
	}
?>
