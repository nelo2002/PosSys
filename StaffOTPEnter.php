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
	<link rel="stylesheet" type="text/css" href="css/staffentry.css">
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
if(isset($_POST['check-reset-otp'])){


	$otp1 = $_POST['otp1'];
	$otp2 = $_POST['otp2'];
	$otp3 = $_POST['otp3'];
	$otp4 = $_POST['otp4'];
	$otp5 = $_POST['otp5'];
	$otp6 = $_POST['otp6'];
	$otp  = $otp1;
	$otp .= $otp2;
	$otp .= $otp3;
	$otp .= $otp4;
	$otp .= $otp5;
	$otp .= $otp6;
	$check_code = "SELECT * FROM `staff` WHERE code='$otp'";
	$code_res = mysqli_query($conn, $check_code);
	if(mysqli_num_rows($code_res) > 0){
		$fetch_data = mysqli_fetch_assoc($code_res);
		$email = $fetch_data['email'];
		echo"<script>Swal.fire({
			title: 'OTP Verification',
			icon: 'success',
			text: 'Please create a new password that you dont use on any other site.',
			confirmButtonText: 'OK',
		   
		  }).then((result) => {
			if (result.isConfirmed) {
			  window.location.assign('New_password_staff.php')
			} 
		  })</script>";
		
	}else{
		echo"<script>Swal.fire({
			title: 'OTP Verification',
			icon: 'error',
			text: 'Youve entered incorrect code!',
			confirmButtonText: 'OK',
		   
		  }).then((result) => {
			if (result.isConfirmed) {
			  window.location.assign('StaffOTPEnter.php')
			} 
		  })</script>";
	}
}
?>
		<div class="container-login100">
		<form action="StaffOTPEnter.php" method="post">
                <div id="app">
                    <div class="container height-100 d-flex justify-content-center align-items-center">
                        <div class="position-relative">
                            <div class="card p-2 text-center">
                                <h5>Verify your email</h5>
                                <h6>Please enter the one time password <br> </h6>
                                <div> <span> sent to</span> <b><?php echo $_SESSION['mail'];?></b> </div>
                                <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2"> 
									
                                    <input class="m-2 text-center form-control rounded" type="text" id="input1" onkeyup='tabChange(1)'  maxlength="1" name="otp1" required/> 
                                    <input class="m-2 text-center form-control rounded" onkeyup='tabChange(2)'  type="text" id="input2" maxlength="1" name="otp2"  required/> 
                                    <input class="m-2 text-center form-control rounded"  onkeyup='tabChange(3)'  type="text" id="input3" maxlength="1" name="otp3" required /> 
                                    <input class="m-2 text-center form-control rounded"  onkeyup='tabChange(4)'  type="text" id="input4" maxlength="1" name="otp4" required/>
                                    <input class="m-2 text-center form-control rounded" onkeyup='tabChange(5)'  type="text" id="input4" maxlength="1" name="otp5" required/> 
                                    <input class="m-2 text-center form-control rounded"  onkeyup='tabChange(6)'  type="text" id="input4" maxlength="1" name="otp6" required /> 
                                </div>
                                <div class="mt-4"> <button class="btn btn-danger px-4 validate" name="check-reset-otp" type="submit">Validate</button> </div>
								
								<div class="mt-3 content d-flex justify-content-center align-items-center"> <span>Didn't get the code ?<a href="resendotpstaff.php?id='send'" class="text-decoration-none ms-3"><b>Resend</b></a></span> </div>
                            </div>
                        </div>
                    </div>
                </div>
</form>
		
		</div>
	
	<script src="js/main.js"></script>

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>

<script>
	let tabChange = function(val){
    let ele = document.querySelectorAll('input');
    if(ele[val-1].value != ''){
      ele[val].focus()
    }else if(ele[val-1].value == ''){
      ele[val-2].focus()
    }   
 }


</script>
</body>
</html>