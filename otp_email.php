
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
	<link rel="stylesheet" typ e="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" ty pe="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/staffentry.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
<?php
require 'connection.php';
if(isset($_POST['check-email'])){
        $email =$_POST['email'];
        $check_email = "SELECT * FROM `admin` WHERE email='$email'";
        $run_sql = mysqli_query($conn, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE `admin` SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($conn, $insert_code);
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: majeedkhan.mlp@gmail.com";
                if(mail($email, $subject, $message, $sender)){
					session_start();
					$_SESSION['mail']=$email;

					echo"<script>Swal.fire({
						title: 'OTP Verfication',
						icon: 'success',
						text: 'We sent a passwrod reset otp to your email',
						confirmButtonText: 'OK',
					  }).then((result) => {
						if (result.isConfirmed) {
						  window.location.assign('adminOTPEnter.php');
						} 
					  })</script>";
                
                }else{
					echo"<script>Swal.fire({
						icon: 'warning',
						title: '',
						text: 'Failed while sending code!',
						})</script>";
                  
                }
            }else{
				echo"<script>Swal.fire({
					icon: 'warning',
					title: '',
					text: 'Something went wrong!',
					})</script>";
               
            }
        }else{
			echo"<script>Swal.fire({
				icon: 'warning',
				title: '',
				text: 'This email address does not exist!',
				})</script>";

        }
    }
	?>
	<div class="limiter">
		<div class="container-login100">
			<form action="otp_email.php" onsubmit="return email()" method="post">
                <div id="app">
                    <div class="container height-100 d-flex justify-content-center align-items-center">
                        <div class="position-relative">
                            <div class="card p-2 text-center">
                                <h5>Verify your email</h5>
                                <h6>Please enter Your email <br></h6>
                                  <b>Example@gmail.com</b>
                                <div id="otp" class="d-flex flex-row justify-content-center mt-2"> 
                                    <input  type="email" class="form-control" id="inputEmail4" name="email" onkeyup="myFunction()">
									<div class="fc5">
										<i class="fas fa-check-circle rig"></i>
										<i class="fas fa-exclamation-circle wron"></i>
										<small class="error" style="display:none;color: red;">Invalid Mail</small>
									  </div>
                                </div>
                                <div class="mt-4"> <button class="btn btn-danger px-4 " type="submit" id="btn3" name="check-email">Send code</button> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
		</div>
	</div>
	<script src="js/email.js"></script>

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
        
</body>
</html>