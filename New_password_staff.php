<!DOCTYPE html>
<html lang="en">
<head>
	<title>Grocery Store Inventory</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/logo.png"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/resetpw.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
<?php
require 'connection.php';
if (!isset($_SESSION))
{
   session_start(); 
}
if(empty($_SESSION['mail'])){
 header("location:otp_email.php");
}
if(isset($_POST['change-password'])){
     
        $password =  $_POST['password1'];
      
            $code = 0;
            $email = $_SESSION['mail']; 
            $update_pass = "UPDATE `staff` SET code = $code, password = '$password' WHERE email = '$email'";
            $run_query = mysqli_query($conn, $update_pass);
            if($run_query){
				echo"<script>Swal.fire({
					title: 'OTP Verification',
					icon: 'success',
					text: 'Your password changed. Now you can login with your new password.',
					confirmButtonText: 'OK',
				   
				  }).then((result) => {
					if (result.isConfirmed) {
					  window.location.assign('staff_login.php')
					} 
				  })</script>";
             
              
            }else{
				echo"<script>Swal.fire({
					icon: 'warning',
					title: '',
					text: 'Failed to change your password!',
					})</script>";
              
            }
        
    }
    ?>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
                <form action="New_password_staff.php" class="form1 login100-form" id="form1" onsubmit="return validate()" method="post" >
					<span class="login100-form-title">
						New Password
					</span>
					
					<div class="formcontrol">
						<i class="fa fa-lock fa-sm icon" aria-hidden="true"></i>
						<input type="password" placeholder="New Password" id="password1" name="password1">
						<div class="fc">
							<i class="fas fa-check-circle r1"></i>
							<i class="fas fa-exclamation-circle w1"></i>
							<small class="e1" style="display: none;color: red;">password must have at least 8 characters</small>
						</div>
					</div>
					<div class="formcontrol">
						<i class="fa fa-lock fa-sm icon" aria-hidden="true"></i>
						<input type="password" placeholder="Confirm Password" id="password2" name="password2">
						<div class="fc">
							<i class="fas fa-check-circle r2"></i>
							<i class="fas fa-exclamation-circle w2"></i>
							<small class="e2" style="display: none;color: red;">Password does not match</small>
						</div>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="change-password">
						Change
						</button>
					</div>
                
			</div>
		</div>
</form>
	</div>
	<script src="js/resetpw.js"></script>



</body>
</html>