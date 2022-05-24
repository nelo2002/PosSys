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
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    
    <div class="limiter"> 
		<div class="container-login100">
            
			<div class="wrap-login100">
                <h1 style="padding-top: 20px; padding-left: 140px; padding-bottom: 30px; color: #2f3640;">Grocery Store POS System</h1>
				<div class="login100-pic js-tilt" data-tilt>
				<a href="index.php">	<img src="images/img-01.png" alt="IMG" ></a>
				</div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn1" type="submit" id="btn1">
                        Are you an Admin?
                    </button>
                    
                    <button class="login100-form-btn2" type="submit" id="btn2">
                        Are you an Staff?
                    </button>
                </div>
                
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
    
        $('#btn1').click(function() {
            window.location='admin.php';
        });

        $('#btn2').click(function() {
            window.location='staff_login.php';
        });
      
    </script>
</body>
</html>