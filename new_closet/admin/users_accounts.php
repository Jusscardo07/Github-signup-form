
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
  $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
  $delete_users->execute([$delete_id]);
  $delete_order = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
  $delete_order->execute([$delete_id]);
  $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
  $delete_cart->execute([$delete_id]);
  $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
  $delete_wishlist->execute([$delete_id]);
  $delete_messages = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
  $delete_messages->execute([$delete_id]);
 
  header('location:users_accounts.php');
  # code...
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>users_accounts</title>
<!---font awesome cdn link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
<!--custom css file -->
<link rel="stylesheet" href="../css/admin_style.css"> 
</head>
<body>
<!--custom header-->
<?php include '../components/admin_header.php'; ?>
<!--admin accounts section starts ---->
<section class="accounts">
<h1 class="heading">users accounts</h1>
<!----admin container-->
 <div class="box-container">

<?php 
$select_account = $conn->prepare("SELECT * FROM `users`");
$select_account->execute();
if($select_account->rowCount() > 0) {
  #while loop to fetch the admin account using fetch_assoc function
  while ($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)) {
    # code...
?>
<!---admin details box--->
<div class="box">
<p>user id: <span><?= $fetch_accounts['id']; ?></span></p>
<p> username: <span> <?= $fetch_accounts['name']; ?> </span></p>
<a href="users_accounts.php?delete=<?= $fetch_accounts['id']; ?>" 
class="delete-btn" onclick="return confirm('delete this user?');">delete</a>

</div>

<?php 
 }
}else {
echo '<p class="empty">no users avaliable yet!</p>';
}
?>

 </div>
</section>
<!--user account section ends ---->

<!----custom link to javascript-->
<script src="../js/admin_script.js"></script>
</body>
</html>