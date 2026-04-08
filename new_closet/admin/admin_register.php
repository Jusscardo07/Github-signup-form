
<?php 
include '../components/connect.php';
session_start();
$admin_id = $_SESSION['admin_id']; 
if(!isset($admin_id)) {
  header('location:admin_login.php');
};

if(isset($_POST['submit'])) {
#declaring variables...  
$name = $_POST['name'];
$name = filter_var($name, FILTER_SANITIZE_STRING);
$pass =  sha1($_POST['pass']);
$pass = filter_var($pass, FILTER_SANITIZE_STRING);
$cpass =  sha1($_POST['cpass']);
$cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
//sql queries
$select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ?");
$select_admin->execute([$name]);
//if statement to rowcount users and validate inputs
if($select_admin->rowCount() > 0) {
$message[] = 'username already exists'; 
}else{
if($pass != $cpass) {
  $message[] = ' confirm password do not match!';
}else{
$insert_admin = $conn->prepare("INSERT INTO `admins`(name, password) VALUES(?,?)");
$insert_admin->execute([$name, $cpass]);
$message[] = 'new admin registered';
}

}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>admin_register</title>
<!---font awesome cdn link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
<!--custom css file -->
<link rel="stylesheet" href="../css/admin_style.css"> 
</head>
<body>
<?php include '../components/admin_header.php'; ?> 
<!---register admin section starts--->   
<section class="form-container">
<form action="" method="post">
<h3>register now</h3>
<input type="text" name="name" id="" maxlength="20" required placeholder="enter username" class="box" 
oninput="this.value = this.value.replace(/\s/g,'')">
<input type="password" name="pass" id="" maxlength="20" required placeholder="enter password" class="box" 
oninput="this.value = this.value.replace(/\s/g,'')">
<input type="password" name="cpass" id="" maxlength="20" required placeholder="confirm password" class="box"
oninput="this.value = this.value.replace(/\s/g,'')">
<input type="submit" value="register now" name="submit" class="btn">
</form>
</section>
<!--register admin section ends--->
<!----custom link to javascript-->
<script src="../js/admin_script.js"></script>
</body>
</html>