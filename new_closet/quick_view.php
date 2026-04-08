
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
<title>quick-view</title>
<!---font awesome cdn link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
<!--custom css file -->
<link rel="stylesheet" href="css/style.css"> 
</head>
<body>
<!---custom link user_header--->
<?php include 'components/user_header.php'; ?> 
<!---quick view section starts --->
<section class="quick-view">

<h1 class="heading"> quick_view </h1>
<?php 
$pid = $_GET['pid'];
$select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
$select_products->execute([$pid]);
if($select_products->rowCount() > 0) {
while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
  # while loop to count items from the fetch method ...
?> 
<form action="" method="post" class="box">
<input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
<input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
<input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
<input type="hidden" name="image" value="<?= $fetch_products['image_01']; ?>">
<!---images container--->
<div class="image-container">
<div class="big-image">
<img src="uploaded_img/<?= $fetch_products['image_01']; ?>">
</div>
<!--small image content--->
<div class="small-images">
<img src="uploaded_img/<?= $fetch_products['image_01']; ?>">
<img src="uploaded_img/<?= $fetch_products['image_02']; ?>">
<img src="uploaded_img/<?= $fetch_products['image_03']; ?>">
</div>
</div>
<!---content container--->
<div class="content">
<div class="name"><?= $fetch_products['name']; ?></div>
<div class="flex">
<div class="price">R<span><?= $fetch_products['price']; ?> </span> </div>
<input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;">
</div>

<div class="details"><?= $fetch_products['details']; ?></div>
<div class="flex-btn">
<input type="submit" value="add to cart" name="add_to_cart" class="btn">
<input type="submit" value="add to wishlist" name="add_to_wishlist" class="option-btn">
</div>

</div>

</form>


<?php 
}  
}else {
  echo '<p class="empty">no product found yet!</p>';
}
?>
</section>
<!---quick view section ends --->

<!--footer link.---->
<?php include 'components/footer.php'; ?> 
<!----custom link to javascript-->
<script src="js/script.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
//subimage js content
let subImages = document.querySelectorAll('.quick-view .box .image-container .small-images img');
let mainImage = document.querySelector('.quick-view .box .image-container .big-image img');

subImages.forEach(image =>{
    image.onclick = () =>{
        let src = image.getAttribute('src');
        mainImage.src = src;
    }
});

});
</script>
</body>
</html>