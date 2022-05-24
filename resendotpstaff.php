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
<div class="container-login100">
<?php
require 'connection.php';
if (!isset($_SESSION))
{
   session_start(); 
}
if(empty($_SESSION['mail'])){
 header("location:index.php");
}

if(isset($_GET['id']))
 {
 $code=rand(999999,111111);
 $sql ="UPDATE `staff` SET `code`='$code' WHERE email='$_SESSION[mail]'";
 if ($conn->query($sql) === TRUE) 
 {
            $to_email=$_SESSION['mail'];
            $subject = "Password Reset Code";
            $body =  "Your password reset code is $code";
            $headers = "From:majeedkhan.mlp@gmail.com";
                if (mail($to_email, $subject, $body, $headers))
                 {
                    echo"<script>Swal.fire({
                        title: 'OTP',
                        icon: 'success',
                        text: 'successfully send the otp verification code',
                        confirmButtonText: 'OK',
                       
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.assign('StaffOTPEnter.php')
                        } 
                      })</script>";
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
        text: 'code not updated!',
        })</script>";
}     
}
?>
</div>
</body>
</html>