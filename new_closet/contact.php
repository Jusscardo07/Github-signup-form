
<?php 
include 'components/connect.php';
session_start();
if(isset($_SESSION['user_id'])) {   
$user_id = $_SESSION['user_id'];

}else{
    $user_id = '';
    header('location:home.php');
};
if(isset($_POST['send'])) {
#declaring input variables    
$name = $_POST['name'];
$name = filter_var($name, FILTER_SANITIZE_STRING);
$email = $_POST['email'];
$email = filter_var($email, FILTER_SANITIZE_STRING);
$number = $_POST['number'];
$number = filter_var($number, FILTER_SANITIZE_STRING);
$msg = $_POST['msg'];
$msg = filter_var($msg, FILTER_SANITIZE_STRING);
//SQL QUERIES TO SELECT THE MESSAGE AND INSERT
$select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");   
$select_message->execute([$name, $email, $number, $msg]);
//if statement to count messages row
if($select_message->rowCount() > 0) {
$message[] = 'message sent already!';
}else{
$send_message = $conn->prepare("INSERT INTO `messages`(name, email, number, message) VALUES(?,?,?,?)");
$send_message->execute([$name, $email, $number, $msg]);
$message[] = 'message sent successfully!';

    
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>contact</title>
<!---font awesome cdn link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
<!--custom css file -->
<link rel="stylesheet" href="css/style.css"> 
</head>
<body>
<!---custom link user_header--->
<?php include 'components/user_header.php'; ?> 
<!-- contact section starts--->
<section class="form-container">
<h1 class="heading">contact us</h1>
<form method="POST" class="box">
<h3>send us a message</h3>
<input type="text" name="name" placeholder="enter your name" required maxlength="20" class="box">
<input type="number" name="number" min="0"
class="box" maxlength="999999999" onkeypress="if(this.value.length == 10) return false;" required placeholder="enter your number">
<input type="email" name="email" placeholder="enter your email" required maxlength="50" class="box">
<textarea name="msg" placeholder="enter your message" cols="30" rows="10"  required class="box"></textarea>
<input type="submit" value="send message" name="send" class="btn">
</form>

</section>

<!---contact form section ends---->
<!--footer link.---->
<?php include 'components/footer.php'; ?> 

<!----custom link to javascript-->
<script src="js/script.js"></script>
</body>
</html>