
<?php 
session_start();
include 'components/connect.php';
if(isset($_SESSION['user_id'])) {   
$user_id = $_SESSION['user_id'];

}else{
    $user_id = '';
    header('location:home.php');
}
if (isset($_POST['submit'])) {
    # declaring variable input...
$name = $_POST['name'];
$name = filter_var($name, FILTER_SANITIZE_STRING);
$email = $_POST['email'];
$email = filter_var($email, FILTER_SANITIZE_STRING);
//sql query to update the email and name
$update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
$update_profile->execute([$name, $email, $user_id]);

//empty_pass
$empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
$select_prev_pass = $conn->prepare("SELECT password FROM `users` WHERE id = ?");
$select_prev_pass->execute([$user_id]);
$fetch_prev_pass = $select_prev_pass->fetch(PDO::FETCH_ASSOC);
$prev_pass = $fetch_prev_pass['password'];
$old_pass = sha1($_POST['old_pass']);
$old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
$new_pass = sha1($_POST['new_pass']);
$new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
$confirm_pass = sha1($_POST['confirm_pass']);
$confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);
//if statements to valid the function   
if($old_pass == $empty_pass) {
  $message[] = 'please enter old password!';
}elseif($old_pass != $prev_pass) {
  $message[] = 'old password do not match!';
}elseif ($new_pass != $confirm_pass) {
  $message[] = 'confirmed password do not match!';  
}else {
if($new_pass != $empty_pass) {
//update the password
$update_pass = $conn->prepare("UPDATE `users` SET password = ?  WHERE id = ?");
$update_pass->execute([$confirm_pass, $user_id]);  
$message[] = 'password updated successfully!';
}else {
 $message[] = 'please enter new password!';       
}
}



}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>update profile</title>
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
<h3>update profile</h3>
<input type="text" name="name" maxlength="20" required placeholder="enter your username" class="box" 
 oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile['name'];?>" >
<input type="email" name="email" maxlength="50" required placeholder="enter your email" class="box"
 oninput="this.value = this.value.replace(/\s/g, '')"  value="<?= $fetch_profile['email'];?>"   >
<input type="password" name="old_pass" maxlength="20" placeholder="enter old password" class="box" 
 oninput="this.value = this.value.replace(/\s/g, '')">
<input type="password" name="new_pass" maxlength="20" placeholder="enter new password" class="box" 
 oninput="this.value = this.value.replace(/\s/g, '')">
 <input type="password" name="confirm_pass" maxlength="20" placeholder="confirm your password" class="box" 
 oninput="this.value = this.value.replace(/\s/g, '')">
 <input type="submit" value="update now" name="submit" class="btn"> 
</form>
</section>
<!---update_user -form section ends--->











<!--footer link.---->
<?php include 'components/footer.php'; ?> 

<!----custom link to javascript-->
<script src="js/script.js"></script>
</body>
</html>