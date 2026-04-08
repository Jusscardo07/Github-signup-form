
<?php 
session_start();
include 'components/connect.php';
if(isset($_SESSION['user_id'])) {   
$user_id = $_SESSION['user_id'];

}else{
    $user_id = '';
}
if(isset($_POST['submit'])) {
 # declaring the variable...
$name = $_POST['name'];
$name = filter_var($name, FILTER_SANITIZE_STRING);
$email = $_POST['email'];
$email = filter_var($email, FILTER_SANITIZE_STRING);
$pass = sha1($_POST['pass']);
$pass = filter_var($pass, FILTER_SANITIZE_STRING);
$cpass = sha1($_POST['cpass']);
$cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
//SQL Query
$select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
$select_user->execute([$email]);
$row = $select_user->fetch(PDO::FETCH_ASSOC);
if($select_user->rowCount() > 0) {
$message[] = 'user already exist!';
}else{
//if statement to verify the password match!
if($pass != $cpass){
$message[] = 'passwords do not match!'; 
}else{
$insert_user = $conn->prepare("INSERT INTO `users`(name, email, password) VALUES(?,?,?);");
$insert_user->execute([$name, $email, $cpass]);
$message[] = 'registered successfully, please login now!';
//header('location:user_login.php');
}

}

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>register</title>
<!---font awesome cdn link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
<!--custom css file -->
<link rel="stylesheet" href="css/style.css"> 
</head>
<body>
<!---custom link user_header--->
<?php include 'components/user_header.php'; ?> 

<!-----register section forms starts---->
<section class="form-container">
<form action="" method="POST">
<h3>register here</h3>
<input type="text" name="name" maxlength="20" required placeholder="enter your username" class="box" 
 oninput="this.value = this.value.replace(/\s/g, '')">
<input type="email" name="email" maxlength="50" required placeholder="enter your email" class="box"
 oninput="this.value = this.value.replace(/\s/g, '')">
<input type="password" name="pass" maxlength="20" required placeholder="enter your password" class="box" 
 oninput="this.value = this.value.replace(/\s/g, '')">
<input type="password" name="cpass" maxlength="20" required placeholder="confirm your password" class="box" 
 oninput="this.value = this.value.replace(/\s/g, '')">
 <input type="submit" value="register now" name="submit" class="btn">
<p>already have an account?</p>
<a href="user_login.php" class="option-btn">login now!</a>

</form>
</section>
<!---register-form section ends--->



<!--footer link.---->
<?php include 'components/footer.php'; ?> 

<!----custom link to javascript-->
<script src="js/script.js"></script>
</body>
</html>