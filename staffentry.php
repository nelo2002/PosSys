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
require('connection.php');
$shops = '';
$query = "SELECT * FROM shops";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result))
{
 $shops .= '<option value="'.$row["id"].'">'.$row["name"].'</option>';
}


?>
<?php
require 'connection.php';
if(isset($_POST['register']))
{
	$shop=$_POST['shop'];
	$lastename=$_POST['lastname'];
  $email=$_POST['mail'];
  $username=$_POST['username'];
  $phoneno=$_POST['phone'];
  $dob=$_POST['dob'];
  $gender=$_POST['gender'];
  $married=$_POST['married'];
  $address=$_POST['address'];
  $city=$_POST['city'];
  $province=$_POST['pro'];
  $password=$_POST['password1'];


  $sql1="SELECT * FROM `employee` WHERE EmployeeEmail='$email' and shopid='$shop'";
    $result1=mysqli_query($conn, $sql1);
    if ($result1->num_rows > 0)
    {
	$sql="SELECT * FROM `staff` WHERE email='$email'";
	$result=mysqli_query($conn, $sql);

	if($result->num_rows <1 )
	{
		$sql2="SELECT * FROM `staff` WHERE username='$username'";
		$result2=mysqli_query($conn,$sql2);
		if($result2->num_rows < 1)
		{

      $code=rand(999999,111111);
      $state="notVerified";
    
          
      $to_email=$email;
      $subject = "Email Verification Code";
      $body =  "Your verification code is $code";
      $headers = "From:majeedkhan.mlp@gmail.com";
          if (mail($to_email, $subject, $body, $headers))
                 {
                  $query="INSERT INTO `staff`(`shopid`, `fullname`, `email`, `username`, `phoneno`, `dob`, `gender`, `status`, `address`, `city`, `province`, `password`, `code`, `is_active`) VALUES ('$shop','$lastename','$email','$username','$phoneno','$dob','$gender','$married','$address','$city','$province','$password','$code','$state')";
                  session_start();
                  $ins=mysqli_query($conn,$query);
                  $_SESSION['mail']=$email;
                  header('location:otp_verf.php');
                 } 
              else 
                {
                  echo"<script>Swal.fire({
                    icon: 'warning',
                    title: '',
                    text: 'mail not sended!',
                    })</script>";
               }
		}
		else
		{
			echo"<script>Swal.fire({
				icon: 'warning',
				title: '',
				text: 'This username is already taken!',
			  })</script>";
		}
		
	}
	else
	{
		echo"<script>Swal.fire({
			icon: 'warning',
			title: '',
			text: 'This email is already registered!',
		  })</script>";
		
	}
}
else
{
  echo"<script>Swal.fire({
    icon: 'warning',
    title: '',
    text: 'check your email and shop!',
    })</script>";
  
}
	

}

?>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form action="staffentry.php" class="form1 login100-form validate-form row g-3" id="form2" method="post" onsubmit="return validate()">
                    <span class="login100-form-title">
                        Staff Signup
                    </span>
                      <div class="col-md-6">
                        <label for="firstname" class="form-label">Shops</label>
                        <select class="form-select" aria-label="Default select example" id="shop" onchange="shop1()" name="shop">
                          <option value="">Select shop</option>
                          <?php echo $shops; ?>
                        </select>
                        <div class="fc">
                          <i class="fas fa-check-circle r"></i>
                          <i class="fas fa-exclamation-circle w"></i>
                          <small class="e" style="display: none;color: red;">Shop is not selected</small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="lastname" class="form-label">Fullname</label>
                        <input type="text" class="form-control" placeholder="Full  name" aria-label="Last name" id="lastname" name="lastname">
                        <div class="fc">
                          <i class="fas fa-check-circle r1"></i>
                          <i class="fas fa-exclamation-circle w1"></i>
                          <small class="e1" style="display: none;color: red;">Lastname must have atleast 5 characters</small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="mail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="mail" placeholder="Email" name="mail">
                        <div class="fc">
                          <i class="fas fa-check-circle r2"></i>
                          <i class="fas fa-exclamation-circle w2"></i>
                          <small class="e2" style="display: none;color: red;">Invalid Mail</small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Username" name="username" >
                        <div class="fc">
                          <i class="fas fa-check-circle r3"></i>
                          <i class="fas fa-exclamation-circle w3"></i>
                          <small class="e3" style="display: none;color: red;">Username must have atleast 5 characters</small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="phone" class="form-label">Phone no</label>
                        <input type="tel" class="form-control" id="phone" placeholder="0777777777" name="phone">
                        <div class="fc">
                          <i class="fas fa-check-circle r4"></i>
                          <i class="fas fa-exclamation-circle w4"></i>
                          <small class="e4" style="display: none;color: red;">Invalid Phone Number!</small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" onchange="ageCalculator()" name="dob"> 
                        <div class="fc3">
                          <i class="fas fa-check-circle r5"></i>
                          <i class="fas fa-exclamation-circle w5"></i>
                          <small class="e5" style="display: none;color: red;">Date of birth not selected</small>
                          <small class="e51" style="display: none;color: red;">are you at least 18 years old</small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="gender" class="form-label" style="padding-left: 5px;">Gender</label>
                        <select class="form-select" aria-label="Default select example" id="gender" onchange="gender1()" name="gender">
                          <option value="">Select Gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                          <option value="Not Specified">Not Specified</option>
                        </select>
                        <div class="fc3">
                          <i class="fas fa-check-circle c1"></i>
                          <i class="fas fa-exclamation-circle c2"></i>
                          <small class="e6" style="display: none;color: red;">Sex is not selected</small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="married" class="form-label" style="padding-left: 5px;">Married Status</label>
                        <select class="form-select" aria-label="Default select example" id="married" onchange="status()" name="married">
                          <option value="">Select Status</option>
                          <option value="Married">Married</option>
                          <option value="Unmarried">Unmarried</option>
                        </select>
                        <div class="fc3">
                          <i class="fas fa-check-circle r6"></i>
                          <i class="fas fa-exclamation-circle w6"></i>
                          <small class="e61" style="display: none;color: red;">Status is not selected</small>
                        </div>
                      </div>
                      <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="Address - 1234 Main St" name="address">
                        <div class="fc">
                          <i class="fas fa-check-circle r7"></i>
                          <i class="fas fa-exclamation-circle w7"></i>
                          <small class="e7" style="display: none;color: red;">Address must have atleast 5 characters</small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" placeholder="City" name="city">
                        <div class="fc">
                          <i class="fas fa-check-circle r8"></i>
                          <i class="fas fa-exclamation-circle w8"></i>
                          <small class="e8" style="display: none;color: red;">City must have atleast 4 characters</small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="province" class="form-label" style="padding-left: 5px;">Province</label>
                        <select id="pro" class="form-select"  aria-label="Default select example" onchange="province()"  name="pro">
                          <option value="">Select province</option>
                          <option value="Eastern Province">Eastern Province</option>
                          <option value="Western Province">Western Province</option>
                          <option value="Central Province">Central Province</option>
                          <option value="Southern Province">Southern Province</option>
                          <option value="Uva Province">Uva Province</option>
                          <option value="Sabaragamuwa Province">Sabaragamuwa Province</option>
                          <option value="North Western Province">North Western Province</option>
                          <option value="North Central Province">North Central Province</option>
                          <option value="Nothern Province">Nothern Province</option>
                        </select>
                        <div class="fc3">
                          <i class="fas fa-check-circle r9"></i>
                          <i class="fas fa-exclamation-circle w9"></i>
                          <small class="e9" style="display: none;color: red;">Province is not selected</small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="password1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password1" placeholder="Password"  name="password1">
                        <div class="fc">
                          <i class="fas fa-check-circle r10"></i>
                          <i class="fas fa-exclamation-circle w10"></i>
                          <small class="e10" style="display: none;color: red;">Password must have atleast 8 characters</small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="password2" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password2" placeholder="Re-Enter your Password" name="password2">
                        <div class="fc">
                          <i class="fas fa-check-circle r11"></i>
                          <i class="fas fa-exclamation-circle w11"></i>
                          <small class="e11" style="display: none;color: red;">Password does not match</small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="gridCheck" required>
                          <label class="form-check-label" for="gridCheck">
                            Confirm your details are true
                          </label>
                        </div>
                      </div>
                      <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit" name="register">
                          Register
                        </button>
                      </div>
                      <div class="text-center p-t-12">
						          Already have an account?
						          <a class="txt2" href="staff_login.php" style="text-decoration: none;">
						        	<b>login</b>
						          </a>
					          </div>
                      
				</form>
			</div>
		</div>
	</div>

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
	<script src="js/staffentry.js"></script>

</body>
</html>