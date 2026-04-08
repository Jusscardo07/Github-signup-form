
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
  $delete_admin = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
  $delete_admin->execute([$delete_id]);
  header('location:admin_accounts.php');
  # code...
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>admins_accounts</title>
<!---font awesome cdn link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
<!--custom css file -->
<link rel="stylesheet" href="../css/admin_style.css"> 
</head>
<body>
<!--link the header page-->
<?php include '../components/admin_header.php'; ?>
<!--admin accounts section starts ---->
<section class="accounts">
 
<h1 class="heading">admin accounts</h1>
<!----admin container-->
 <div class="box-container">
<div class="box">
  <p>register new admin</p>
<a href="admin_register.php" class="option-btn">Register</a>
</div>


<?php 
$select_account = $conn->prepare("SELECT * FROM `admins`");
$select_account->execute();
if ($select_account->rowCount() > 0) {
  #while loop to fetch the admin account using fetch_assoc function
  while ($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)) {
    # code...
?>
<!---admin details box--->
<div class="box">
<p>admin id: <span><?= $fetch_accounts['id']; ?></span></p>
<p> username: <span> <?= $fetch_accounts['name']; ?> </span></p>
<!--flex-btn---->
<div class="flex-btn">
<a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" 
class="delete-btn" onclick="return confirm('delete this account?');">delete</a>
<?php
if($fetch_accounts['id'] == $admin_id) {
echo '<a href="update_profile.php" class="option-btn">update</a>';
}
?>

</div>
</div>

<?php 
 }
}else {
echo '<p class="empty">no products added yet!</p>';
}
?>

 </div>
</section>
<!--admin account section ends ---->
<!----custom link to javascript-->
<script src="../js/admin_script.js"></script>
</body>
</html>