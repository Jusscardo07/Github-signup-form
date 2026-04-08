
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
$email = $_POST['email'];
$email = filter_var($email, FILTER_SANITIZE_STRING);
$pass = sha1($_POST['pass']);
$pass = filter_var($pass, FILTER_SANITIZE_STRING);
//SQL Query
$select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? ");
$select_user->execute([$email, $pass]);
#session user method
$row = $select_user->fetch(PDO::FETCH_ASSOC);
//if statement 
if($select_user->rowCount() > 0) {
$_SESSION['user_id'] = $row['id'];
header('location:home.php');
}else{
$message[] = 'incorrect email or password!';

}

}   


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>user_login</title>
<!---font awesome cdn link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
<!--custom css file -->
<link rel="stylesheet" href="css/style.css"> 
</head>
<body>
<!---custom link user_header--->
<?php include 'components/user_header.php'; ?> 
<!---user dashboard --->

<!-----login section forms starts---->
<section class="form-container">
<form action="" method="POST">
<h3>login now</h3>
<input type="email" name="email" maxlength="50" required placeholder="enter your email" class="box"
 oninput="this.value = this.value.replace(/\s/g, '')">
<input type="password" name="pass" maxlength="20" required placeholder="enter your password" class="box" 
 oninput="this.value = this.value.replace(/\s/g, '')">
<input type="submit" value="login now" name="submit" class="btn">
<p>don't have an account?</p>
<a href="user_register.php" class="option-btn">register now!</a>
</form>
</section>


<!-----login section forms ends---->
<!--footer link.---->
<?php include 'components/footer.php'; ?> 

<!----custom link to javascript-->
<script src="js/script.js"></script>
</body>
</html>