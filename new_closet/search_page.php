
<?php 
session_start();
include 'components/connect.php';
if(isset($_SESSION['user_id'])) {   
$user_id = $_SESSION['user_id'];

}else{
    $user_id = '';
}
include 'components/wishlist_cart.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>search page</title>
<!---font awesome cdn link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
<!--custom css file -->
<link rel="stylesheet" href="css/style.css"> 
</head>
<body>
<!---custom link user_header--->
<?php include 'components/user_header.php'; ?>

<section class="search-form">
<form action="" method="post">
<input type="text" name="search_box" maxlength="100" 
placeholder="search items here" required class="box">
<button type="submit" class="fas fa-search" name="search_btn"></button>
 </form>

</section>

<!---product section starts--->
<section class="products" style="padding-top: 0; min-height:50vh;">

<div class="box-container">
<?php 
if(isset($_POST['search_btn'])) {
$search_box = $_POST['search_box'];
$search_box = filter_var($search_box, FILTER_SANITIZE_STRING);
$select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE ? OR details = ?");
$select_products->execute(["%$search_box%", "%search_box%"]);
if($select_products->rowCount() > 0){
while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
 #while loop to count items from the fetch method ...
?> 
<form action="" method="post" class="box">
<input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
<input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
<input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
<input type="hidden" name="image" value="<?= $fetch_products['image_01']; ?>">
<button type="submit" name="add_to_wishlist" class="fas fa-heart"></button>
<a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
<img src="uploaded_img/<?= $fetch_products['image_01']; ?>" class="image">
<div class="name"><?= $fetch_products['name']; ?></div>
<div class="flex">
<div class="price">R<span><?= $fetch_products['price']; ?> </span> </div>
<input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;"> 
</div>
<input type="submit" value="add to cart" name="add_to_cart" class="btn">
</form>
<?php 
}  
}else {
  echo '<p class="empty">No Results found!!</p>';
}
}
?>
</div>
</section>    
<!--- Product section ends --->



<!--footer link.---->
<?php include 'components/footer.php'; ?> 

<!----custom link to javascript-->
<script src="js/script.js"></script>
</body>
</html>