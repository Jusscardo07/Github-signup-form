<?php 
include '../components/connect.php';
session_start();
$admin_id = $_SESSION['admin_id']; 

if(!isset($admin_id)) {
  header('location:admin_login.php');
};

if(isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  //sql query to delete the order
  $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
  $delete_message->execute([$delete_id]);
  header('location: messages.php');
  # code...
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>message</title>  
<!---font awesome cdn link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
<!--custom css file -->
<link rel="stylesheet" href="../css/admin_style.css">    
</head>
<body>
  <!--custom link for admin-header-->   
<?php include '../components/admin_header.php'; ?>
<!---messages section starts----->
<section class="messages">
<h1 class="heading">new messages</h1>

<div class="box-container">
 <?php 
 $select_messages = $conn->prepare("SELECT * FROM `messages`");
 $select_messages->execute();
if($select_messages->rowCount() > 0) {
 while($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)) {

 ?>
<div class="box">
<p> user id : <span> <?= $fetch_messages['user_id']; ?></span></p>
<p> name : <span> <?= $fetch_messages['name']; ?></span></p>
<p> email : <span> <?= $fetch_messages['email']; ?></span></p>
<p> number : <span> <?= $fetch_messages['number']; ?></span></p>
<p> message : <span> <?= $fetch_messages['message']; ?></span></p>
<a href="messages.php?delete=<?= $fetch_messages['id']; ?>" 
class="delete-btn" onclick="return confirm('delete this message?');">delete</a>

</div>

<?php 
 }
}else{
  echo '<p class="empty">no messages avaliable yet!</p>';
}
 
?>

</div>

</section>
<!---messages section ends----->
<!----custom link to javascript-->
<script src="../js/admin_script.js"></script>
</body>
</html>

