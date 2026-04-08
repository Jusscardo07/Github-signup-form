
<?php 
include 'components/connect.php';
session_start();

if(isset($_SESSION['user_id'])) {   
$user_id = $_SESSION['user_id'];

}else{
    $user_id = '';
    header('location:home.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>orders</title>
<!---font awesome cdn link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
<!--custom css file -->
<link rel="stylesheet" href="css/style.css"> 
</head>
<body>
<!---custom link user_header--->
<?php include 'components/user_header.php'; ?> 
<!---order section starts--->
<section class="show-orders">
<h1 class="heading">your orders</h1>
 <div class="box-container">
<?php 
$show_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
$show_orders->execute([$user_id]);
if($show_orders->rowCount() > 0) {
while ($fetch_orders = $show_orders->fetch(PDO::FETCH_ASSOC)) {
   #declaring code
?>
<div class="box">
<p>placed on <span><?= $fetch_orders['placed_on']; ?></span></p>
<p>name: <span><?= $fetch_orders['name']; ?></span></p>
<p>number: <span><?= $fetch_orders['number']; ?></span></p>
<p>email: <span><?= $fetch_orders['email']; ?></span></p>
<p>address: <span><?= $fetch_orders['address']; ?></span></p>
<p> your order: <span><?= $fetch_orders['total_products']; ?></span></p>
<p>total price: <span>R<?= $fetch_orders['total_price']; ?></span></p>
<p>payment method: <span><?= $fetch_orders['method']; ?></span></p>
<p>payment status: <span style="color: <?php if($fetch_orders['payment_status']){
echo 'red';}else{echo 'green';}
?>;" ><?= $fetch_orders['payment_status']; ?></span></p>

</div>
<?php 
}
}else {
    
}

?>

 </div>




</section>











<!-----order section ends---->
<!--footer link.---->
<?php include 'components/footer.php'; ?> 

<!----custom link to javascript-->
<script src="js/script.js"></script>
</body>
</html>