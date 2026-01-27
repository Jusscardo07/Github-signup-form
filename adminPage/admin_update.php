<?php
@include 'config.php';
 $id = $_GET['edit'];

if(isset($_POST['update_product'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'img/' .$product_image;
   
   if(empty($product_name) || empty($product_price)|| empty($product_image)){
   $message[] = 'please fill all out';  
   
   }else{
      $update = "UPDATE products SET name='$product_name',price='$product_price',image='$product_image'
      WHERE id = '$id'"; 
      $upload = mysqli_query($conn, $update);
      if ($upload){
         move_uploaded_file($product_image_tmp_name,$product_image_folder);
         $message[] = 'new product updated successfully';
      }else{
       $message[] = 'could not add the product';
      }
   }
   };
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_update_page</title>
     <!--link to style--->
     <link rel="stylesheet" href="css/style.css">
   <!---link to boxicon-->   
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!--favicon--->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
 <!---Message Content--->
<?php
if (isset($message)){
 foreach($message as $message){
    echo'<span class="message">'.$message.'</span>';
 }   
}
?> 
<!---container to update the product--->
<div class="container">
  <!--admin -product container for the update products--->
<div class="admin-product-form-container centered">
    <?php
    $select = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
    while ($row = mysqli_fetch_assoc($select)){ 
    ?>
    <!---form to update -->
 <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
  <h3>update new product</h3>  
  <input type="text" name="product_name" value="<?php $row['name'];?>" placeholder="enter product name" class="box">
  <input type="number" name="product_price" value="<?php $row['price'];?>" placeholder="enter product price" class="box">
  <input type="file" name="product_image" id="" accept="image/jpeg, image/png, image/jpg" class="box">
 <input type="submit" class="btn" name="update_product" value="update product">
  <a href="index.php" class="btn">go back</a> 
  </form> 
  <?php }; ?>
 </div>  
</div>  
</body>
</html>