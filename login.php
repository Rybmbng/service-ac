<?php
include_once 'config.php';
session_start();

if (isset($_SESSION['username'])) {
    if ($_SESSION['level'] == "admin") {
        header("Location: indexadmin.php");
        exit();
    } elseif ($_SESSION['level'] == "teknisi") {
        header("Location: indexteknisi.php");
        exit();
    } elseif ($_SESSION['level'] == "pelanggan") {
        header("Location: indexpelanggan.php");
        exit();
    }
}

if(isset($_POST['submit'])){
    $username_or_email = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT profile_image, username, password, level FROM login WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username_or_email, $username_or_email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($profile_image,$username, $hashed_password, $level);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $username;
            $_SESSION['level'] = $level;
            $_SESSION['profile'] = $profile_image;
            $_SESSION["success"] = 'Welcome '. ucwords($username);

            if ($level == "admin") {
                header("Location: indexadmin.php");
                exit();
            } elseif ($level == "teknisi") {
                header("Location: indexteknisi.php");
                exit();
            } elseif ($level == "pelanggan") {
                header("Location: indexpelanggan.php");
                exit();
            }
        } else {
            $_SESSION["gagal"] = 'Username or Password is incorrect';
        }
    } else {
        $_SESSION["gagal"] = 'Username or Password is incorrect';
    }
    $stmt->close();
}

$conn->close();
?>






<!DOCTYPE html>
<html lang="en">
<head>
	<title>Service Ac</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icon.jpg"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
     
<?php if(@$_SESSION['logout']){ ?>
	<script>
		Swal.fire({
		icon: 'success',
		title: 'Success',
		text: '<?php echo $_SESSION['logout']; ?>'
	}).then(function() {
		window.location = "index.php";
	});
	</script>
<?php unset($_SESSION['logout']);
}
?>

<?php if(@$_SESSION['gagal']){ ?>
        <script>
          Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: '<?php echo $_SESSION['gagal']; ?>'
        })
        </script>
    <?php unset($_SESSION['gagal']); } ?>
   
    <?php if(@$_SESSION['success'] && isset($_SESSION['level'])  == "admin"){ ?>
        <script>
          Swal.fire({
          icon: 'success',
          title: 'Welcome',
          text: '<?php echo $_SESSION['username']; ?>'
        }).then(function() {
         window.location = "indexadmin.php?page=";
        });
        </script>
    <?php unset($_SESSION['success']); } ?>
   	
	
    <?php if(@$_SESSION['success'] && isset($_SESSION['level'])  == "teknisi"){ ?>
        <script>
          Swal.fire({
          icon: 'success',
          title: 'Welcome',
          text: '<?php echo $_SESSION['username']; ?>'
        }).then(function() {
         window.location = "indexteknisi.php?page=";
        });
        </script>
    <?php unset($_SESSION['success']); } ?>
   	
	
    <?php if(@$_SESSION['success'] && isset($_SESSION['level'])  == "pelanggan"){ ?>
        <script>
          Swal.fire({
          icon: 'success',
          title: 'Welcome',
          text: '<?php echo $_SESSION['username']; ?>'
        }).then(function() {
         window.location = "indexpelanggan.php?page=";
        });
        </script>
    <?php unset($_SESSION['success']); } ?>
   	
	<div class="limiter">
		<div class="container-login100" style="background: rgb(2,0,36);
background: radial-gradient(circle, rgba(2,0,36,1) 0%, rgba(27,239,255,0.9473039215686274) 68%, rgba(0,212,255,1) 100%);">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33"  style="background-image: url('images/ac2.jpg');">
			<form class="login100-form validate-form flex-sb flex-w" method="post">
			<span class="login100-form-title p-b-53" style="font-weight: bolder;">
				Service AC Andalan 
			</span>

			<div class="p-t-31 p-b-9">
				<span class="txt1">
					Username or Email
				</span>
			</div>
			<div class="wrap-input100 validate-input" data-validate = "Username or Email is required">
				<input class="input100" type="text" name="username" >
				<span class="focus-input100"></span>
			</div>
			
			<div class="p-t-13 p-b-9">
				<span class="txt1">
					Password
				</span>

			</div>
			<div class="wrap-input100 validate-input" data-validate = "Password is required">
				<input class="input100" type="password" name="password" >
				<span class="focus-input100"></span>
			</div>

			<div class="container-login100-form-btn m-t-17">
				<button class="login100-form-btn" type="submit" name="submit">
					Login
				</button>
			</div>

			<span style="color:black; font-weight: bolder">Messi Pernah Service Disini!</span>
		</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="js/main.js"></script>

</body>
</html>