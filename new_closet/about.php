
<?php 
session_start();
include 'components/connect.php';
if(isset($_SESSION['user_id'])) {   
$user_id = $_SESSION['user_id'];

}else{
    $user_id = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>about.</title>
<!---custom link swiper js--->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"/>
<!---font awesome cdn link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
<!--custom css file -->
<link rel="stylesheet" href="css/style.css"> 
</head>
<body>
<!---custom link user_header--->
<?php include 'components/user_header.php'; ?> 
<!---about section starts--->
<section class="about">
<h1 class="heading">about us</h1>
<div class="row">
<div class="image">
    <img src="images/about-img.svg" alt="">
</div>

<div class="content">
<h3>why choose unity closet</h3>
<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam itaque suscipit aut, 
iusto veniam tempora incidunt neque fugiat cupiditate nesciunt iste assumenda faci </p>
<a href="contact.php" class="btn">contact us</a>
</div>

</div>
</section>

<!---about section ends--->
<!---reviews section ends--->
<section class="reviews">

<h1 class="heading">client's reviews</h1>

 <div class="swiper reviews-slider">

 <div class="swiper-wrapper">
<!--slide 1--->
<div class="swiper-slide slide">
<img src="images/pic-1.png" alt="">
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat esse eveniet, illum eius maxime perspiciati</p>
<div class="stars">
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star-half-alt"></i>
</div>
<h3>Leon Mhlongo</h3>
</div>
<!---slide 2-->
<div class="swiper-slide slide">
<img src="images/pic-2.png" alt="">
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat esse eveniet, illum eius maxime perspiciati</p>
<div class="stars">
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star-half-alt"></i>
</div>
<h3>Leon Mhlongo</h3>
</div>
<!---slide 3-->
<div class="swiper-slide slide">
<img src="images/pic-3.png" alt="">
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat esse eveniet, illum eius maxime perspiciati</p>
<div class="stars">
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star-half-alt"></i>
</div>
<h3>Leon Mhlongo</h3>
</div>
<!---slide 4--->
<div class="swiper-slide slide">
<img src="images/pic-4.png" alt="">
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat esse eveniet, illum eius maxime perspiciati</p>
<div class="stars">
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
   <i class="fas fa-star-half-alt"></i>
</div>
<h3>Leon Mhlongo</h3>
</div>
<!---slide 5--->
<div class="swiper-slide slide">
<img src="images/pic-5.png" alt="">
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat esse eveniet, illum eius maxime perspiciati</p>
<div class="stars">
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star-half-alt"></i>
</div>
<h3>Leon Mhlongo</h3>
</div>
<!---slide 6--->
<div class="swiper-slide slide">
<img src="images/pic-6.png" alt="">
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat esse eveniet, illum eius maxime perspiciati</p>
<div class="stars">
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star-half-alt"></i>
</div>
<h3>Leon Mhlongo</h3>
</div>

</div>
<div class="swiper-pagination"></div>

</div> 

</section>
<!---reviews section ends--->

<!--footer link.---->
<?php include 'components/footer.php'; ?> 
<!--custom js script swiper---->
<script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
<!----custom link to javascript-->
<script src="js/script.js"></script>

<script>
var swiper = new Swiper(".reviews-slider", {
loop:true,
grabCursor:true,
spaceBetween: 20,
pagination: {
el: ".swiper-pagination",
}, 
breakpoints: {      
550: {
slidesPerView: 2, 
},
768: {
slidesPerView: 2,
},
1024: {
slidesPerView: 3,
},
},

});

</script>
</body>
</html>