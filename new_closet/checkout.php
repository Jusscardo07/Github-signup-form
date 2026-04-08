
<?php 
include 'components/connect.php';
session_start();

if(isset($_SESSION['user_id'])) {   
$user_id = $_SESSION['user_id'];

}else{
    $user_id = '';
    header('location:user_login.php');
}
if(isset($_POST['order'])) {
#verify variables.
$name = $_POST['name'];
$name = filter_var($name, FILTER_SANITIZE_STRING);
$number = $_POST['number'];
$number = filter_var($number, FILTER_SANITIZE_STRING);
$email = $_POST['email'];
$email = filter_var($email, FILTER_SANITIZE_STRING);
$method = $_POST['method'];
$method = filter_var($method, FILTER_SANITIZE_STRING);
$address = $_POST['flat'].', '.$_POST['street'].', '.$_POST['city'].', '.$_POST['state'].', '.$_POST['province'].' - '.$_POST['pin_code'];
$address = filter_var($address, FILTER_SANITIZE_STRING);
$total_products = $_POST['total_products'];
$total_products = filter_var($total_products, FILTER_SANITIZE_STRING);
$total_price = $_POST['total_price'];
$total_price = filter_var($total_price, FILTER_SANITIZE_STRING);
//SQL QUERY
$check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
$check_cart->execute([$user_id]);

if($check_cart->rowCount() > 0) {
 //insert the row if user's
$insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) 
 VALUES(?,?,?,?,?,?,?,?)");
$insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]); 
$message[] = 'order placed successfully!';
$delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
$delete_cart->execute([$user_id]);

}else {
  $message[] = '';
}



}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>checkout</title>
<!---font awesome cdn link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
<!--custom css file -->
<link rel="stylesheet" href="css/style.css"> 
</head>
<body>
<!---custom link user_header--->
<?php include 'components/user_header.php'; ?> 
<!---checkout section starts--->
<section class="checkout">  
<h1 class="heading">order info.</h1>

<div class="display-orders">
<?php 
$grand_total =  0;
$cart_items[] = '';
$select_cart= $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
$select_cart->execute([$user_id]);
if($select_cart->rowCount() > 0) {
while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
$grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
$cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['quantity'].')-';
$total_products = implode($cart_items);
?>
<p><?= $fetch_cart['name'];?> <span>R <?= $fetch_cart['price']; ?>/- x <?= $fetch_cart['quantity']; ?></span></p>
<?php   
}
}else {
  echo '<p class="empty">your cart is empty</p>';
}
?>
</div>
<input type="hidden" name="total_products" value="<?= $total_products; ?>">
<input type="hidden" name="total_price" value="<?= $grand_total; ?>">
<p class="grand-total">grand total:<span> R <?=$grand_total; ?> </span> </p>

<!--form content to place the order---->
<form action="" method="POST">  
<h1 class="heading">place orders</h1>
<input type="hidden" name="total_products" value="<?= $total_products; ?>">
<input type="hidden" name="total_price" value="<?= $grand_total; ?>">

<div class="flex">  
  <!--name input--->   
<div class="inputBox">
  <span>your name: </span>
  <input type="text" name="name" class="box" placeholder="enter your name" maxlength="20" required> 
</div>
<!--number input--->   
<div class="inputBox">
  <span>your number: </span>
  <input type="number" name="number" class="box"
   placeholder="enter mobile number" min="0" max="9999999999" onkeypress="if(this.value.length == 10)return false;" required>
</div>    
<!--email input--->   
<div class="inputBox">
  <span>your email: </span>
  <input type="email" name="email" class="box" placeholder="kane12@gmail.com" maxlength="50" required>
</div> 
<!--payment input--->
<div class="inputBox">
<span>payment method</span> 
<select name="method" class="box">  
<option value="cash on delivery">cash on delivery</option> 
<option value="credit card">credit card</option>   
<option value="paypal">paypal </option>
<option value="payatm">payatm</option>
</select>
</div>
<!-- address 01 input  --->   
<div class="inputBox">
  <span>address line 01 :</span>
<input type="text"  class="box" placeholder=" enter flat name" name="flat" required maxlength="50">
</div>
<!--address 02 input--->   
<div class="inputBox">
  <span>street name :</span>
<input type="text" class="box" placeholder="e.g 21 mullin street" required name="street" 
   maxlength="50">
</div>
<!--address 03 input--->   
<div class="inputBox">
  <span>city:</span>
  <input type="text" name="city" class="box" placeholder="city" required
  name="city"  maxlength="50">
</div>

<!--address 04 input--->   
<div class="inputBox">
  <span>State:</span>
  <input type="text" name="state" class="box" placeholder="e.g state" required
  name="state"  maxlength="50">
</div>
<!--address 05 Input--->   
<div class="inputBox">
  <span>province:</span>
  <input type="text" name="province" class="box" placeholder="e.g Gauteng" required
  name="province"  maxlength="50">
</div>

<!--address 06 Input--->   
<div class="inputBox">
<span>pin code:</span>
<input type="number" name="pin_code" class="box" placeholder="1632" required
min="0" max="999999" onkeypress="if(this.value.length == 6)return false;">
</div>

</div>
<input type="submit" value="place order" class="btn <?=($grand_total > 1)?'':'disabled'; ?> " name="order">

</form>

</section>


<!---checkout section ends --->
<!--footer link.---->
<?php include 'components/footer.php'; ?> 

<!----custom link to javascript-->
<script src="js/script.js"></script>
</body>
</html>