<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="bootstrap dist/css/bootstrap.min.css">
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="jquery.min.js"></script>
  <script src="popper.min.js"></script>
  <script src="bootstrap dist/js/bootstrap.min.js"></script>
  <title>KoKeRu - Kontrol Kebersihan Ruangan</title>
</head>
<style>
 
.login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form button {
  text-transform: uppercase;
  outline: 0;
  background: #007fff;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: #5d8aa8;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}
.form .register-form {
  display: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
body {
  background: #a1caf1; /* fallback for old browsers */
  background: -webkit-linear-gradient(right, #7a1caf1, #21abcd);
  background: -moz-linear-gradient(right, #a1caf1, #21abcd);
  background: -o-linear-gradient(right, #a1caf1, #21abcd);
  background: linear-gradient(to left, #a1caf1, #21abcd);
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;      
}
</style>
<body class="mt-5">

<?php
require_once('db_login.php');

if(isset($_POST["submit"])){
	$valid = TRUE; //flag validasi
	//cek validasi email
	$email = test_input(isset($_POST['email']) ? $_POST['email'] : '');
	if ($email == ''){
		$error_email = "Email is required";
		$valid = FALSE;
	}
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$error_email = "Invalid email format";
		$valid = FALSE;
	}
	//cek validasi password
	$password = test_input(isset($_POST['password']) ? $_POST['password'] : '');
	if ($password == ''){
		$error_password = "Password is required";
		$valid = FALSE;
	}
	
	//cek validasi
	if($valid){
		$login = mysqli_query($db, "SELECT * FROM user WHERE email='".$email."' AND password='".$password."'");
		$cek = mysqli_num_rows($login);
		if(!$login){
			die ("Could not query the database: <br />". $db->error);
		}
		else{
			if ($cek > 0){ //login berhasil
				session_start();
				$data = mysqli_fetch_assoc($login);
				if($data['role']=="1"){
					// buat session login dan username
					$_SESSION['username'] = $email;
					$_SESSION['role'] = "1";
					header("location:index_manajer.php");
				}else if($data['role']=="2"){
					// buat session login dan username
					$_SESSION['username'] = $email;
					$_SESSION['role'] = "2";
					header("location:index_cs.php");
				}
			}
			else{
				$error_akun = "Combination of username and password are not correct.";
			}
		}
	//close db connection
	$db->close();
	}

}
?>

<div class="login-page">
  <div class="form">
  <h5>LOGIN KOKERU</h5>
	<form method="POST" autocomplete="on" action="">
		<div class="form-group">	
			<label for="username">Email :</label>
			<input type="email" class="form-control" id="email" name="email" size="30" value="<?php if (isset($email)) {echo $email;}?>">
			<div class="error" style="color:red"><?php if (isset($error_email)) echo $error_email;?></div>
		</div>
		<div class="form-group">
			<label for="password">Password :</label>
			<input type="password" class="form-control" id="password" name="password" size="30" value="">
			<div class="error" style="color:red"><?php if (isset($error_password)) echo $error_password;?></div>
		</div>
		<button type="submit" class="btn btn-primary" name="submit" value="submit">Login</button>
		<div class="error" style="color:red"><?php if (isset($error_akun)) echo '<br>'.$error_akun;?></div>
		<hr>
		<a href="index.php">Cancel</a>
	</form>
  </div>
</div>


</body>
</html>