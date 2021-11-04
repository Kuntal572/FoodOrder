<?php
session_start();
include('database.inc.php');
include('function.inc.php');
include('constant.inc.php');
$totalPrice=0;
$getSetting=getSetting();
$userid;
$website_close=$getSetting['website_close'];
$website_close_msg=$getSetting['website_close_msg'];
$cart_min_price=$getSetting['cart_min_price'];
$cart_min_price_msg=$getSetting['cart_min_price_msg'];

getDishCartStatus();

if(isset($_POST['update_cart'])){
	foreach($_POST['qty'] as $key=>$val){
		if(isset($_SESSION['FOOD_USER_ID'])){
			if($val[0]==0){
				mysqli_query($con,"delete from dish_cart where dish_detail_id='$key' and user_id=".$_SESSION['FOOD_USER_ID']);
			}else{
				mysqli_query($con,"update dish_cart set qty='".$val[0]."' where dish_detail_id='$key' and user_id=".$_SESSION['FOOD_USER_ID']);	
			}
		}else{
			if($val[0]==0){
				unset($_SESSION['cart'][$key]['qty']);
			}else{
				$_SESSION['cart'][$key]['qty']=$val[0];	
			}
		}
	}
}

$cartArr=getUserFullCart();


$totalPrice=getcartTotalPrice();
$totalCartDish=count($cartArr);

$getWalletAmt=0;
if(isset($_SESSION['FOOD_USER_ID'])){
	$getWalletAmt=getWalletAmt($_SESSION['FOOD_USER_ID']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo FRONT_SITE_NAME?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link rel="stylesheet" href="assets/css/app.css">
        <link rel="stylesheet" href="assets/css/slick.css">
        <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="/js/script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- header section starts  -->

<header class="header">

<a href="#" class="logo"> <i class="fas fa-utensils"></i> food </a>

<nav class="navbar">
    <a href="index.php">home</a>
    <a href="#about">about</a>
    <a href="#popular">popular</a>
    <a href="#menu">menu</a>
    <a href="#order">order</a>
    <a href="#blogs">blogs</a>
</nav>

<div class="icons">
    <a href=""><div id="menu-btn" class="fas fa-bars"></div></a>
    <a href="search.php"><div id="search-btn" class="fas fa-search"></div></a>
    <a href="cart.php"><div id="cart-btn" class="fas fa-shopping-cart"></div></a>
    <a href="login_register.php"><div id="login-btn" class="fas fa-user"></div></a>
    
</div>

</header>

<!-- header section ends  -->
