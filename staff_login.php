
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
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<body>
<?php
require 'connection.php';
if(isset($_POST['login']))
{
	$username=$_POST['username'];
	$passwprd=$_POST['password'];

	$sql="SELECT * FROM `staff` WHERE username='$username'";
	$result=mysqli_query($conn, $sql);

	if($result->num_rows >0 )
	{
		$sql2="SELECT * FROM `staff` WHERE username='$username' AND password='$passwprd' AND is_active='verified'";
		$result2=mysqli_query($conn,$sql2);
		if($result2->num_rows > 0)
		{
			$user = mysqli_fetch_assoc($result2);
			$shop ="SELECT * FROM `shops` WHERE  id='$user[shopid]'";
			$shopd=mysqli_query($conn,$shop);
			$user1 = mysqli_fetch_assoc($shopd);
			$exdate=strtotime($user1['date']);
			$today=strtotime(date("d-m-Y"));

			if($exdate<$today)
			{
				$sql ="UPDATE `shops` SET `status`='deactivate' WHERE  id='$user[shopid]'";
 				$result=$conn->query($sql);
			}
			else{
				$sql ="UPDATE `shops` SET `status`='Active' WHERE  id='$user[shopid]'";
 				$result=$conn->query($sql);
			}
			$result3=mysqli_query($conn,$shop);
			$user2 = mysqli_fetch_assoc($result3);

			if($user2['status']=="Active")
			{		 session_start();	
				$_SESSION['staff_id'] = $user['id'];
				$_SESSION['shop_id'] = $user['shopid'];
				echo"<script>Swal.fire({
					title: 'You are successfully logged in',
					icon: 'success',
					text: 'Thanks for using our web site',
					confirmButtonText: 'OK',
				   
				  }).then((result) => {
					if (result.isConfirmed) {
					  window.location.assign('staff/')
					} 
				  })</script>";
			}else{
				echo"<script>Swal.fire({
					title: 'Subscription',
					icon: 'warning',
					text: ' subscription  date is over',
					confirmButtonText: 'OK',
				   
				  }).then((result) => {
					if (result.isConfirmed) {
					  window.location.assign('staff_login.php')
					} 
				  })</script>";
			}
		
			
			
		}
		else
		{
			echo"<script>Swal.fire({
				icon: 'warning',
				title: '',
				text: 'you entered the wrong password!',
			  })</script>";
		}
		
	}
	else
	{
		echo"<script>Swal.fire({
			icon: 'warning',
			title: '',
			text: 'this username does not exist!',
		  })</script>";
		
	}
	

}

?>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
				<a href="index.php">	<img src="images/img-01.png" alt="IMG" ></a>
				</div>
				<form action="staff_login.php" class="form1 login100-form validate-form" id="form1" onsubmit="return validate()" method="post" >
					<span class="login100-form-title">
					POS Staff Login
						
					</span>
					
					<div class="formcontrol">
						<i class="fas fa-user fa-sm icon" aria-hidden="true"></i>
						<input type="text" placeholder="Username" id="username" name="username"> 
						<div class="fc">
							<i class="fas fa-check-circle r"></i>
							<i class="fas fa-exclamation-circle w"></i>
							<small class="e1" style="display: none;color: red;">username must have at least 5 characters</small>
						</div>
					</div>
					<div class="formcontrol">
						<i class="fa fa-lock fa-sm icon" aria-hidden="true"></i>
						<input type="password" placeholder="Password" id="password" name="password">
						<div class="fc">
							<i class="fas fa-check-circle r1"></i>
							<i class="fas fa-exclamation-circle w1"></i>
							<small class="e2" style="display: none;color: red;">password must have at least 8 characters</small>
						
						</div>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="login">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="otp_email_staff.php" style="text-decoration: none;">
							<b>Username / Password?</b>	
						</a>
					</div>
					<div class="text-center p-t-12">
						<span class="txt1">
							I don't have an account?
						</span>
						<a class="txt2" href="staffentry.php" style="text-decoration: none;">
							<b>Create</b>
						</a>
					</div>

				</form>
			</div>
		</div>
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
function myFunction() {
  alert("hello");
</script>

</body>
</html>