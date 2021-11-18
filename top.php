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
      
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH?>css/style.css">
   
</head>
<body>
    <!-- header section starts  -->

<header class="header">

<a href="<?php echo FRONT_SITE_PATH?>index" class="logo"> <i class="fas fa-utensils"></i> food</a>

<nav class="navbar">
   <ul>
        
        <?php
    if(isset($_SESSION['FOOD_USER_NAME'])){
        ?>
       <li><a><?php echo "Welcome ".$_SESSION['FOOD_USER_NAME'];?></a></li>
        <?php } ?>

       <li><a href="#home">home</a></li>
    <li><a href="#about">about</a></li> 
    <li><a href="#popular">popular</a></li>
    <li><a href="#menu">menu</a></li>
   <li><a href="#order">order</a></li>
    <li><a href="#blogs">blogs</a></li>
    <li><a href="#blogs">setting ></a>
     <ul>
<li><a href="">Profile</a></li>
<li><a href="">Order History</a></li>
<li><a href="<?php echo FRONT_SITE_PATH?>logout">Logout</a></li>
    </ul>
</li>

    </ul>
</nav>

<div class="icons">
   <div id="menu-btn" class="fas fa-bars"></div>
   <div id="search-btn" class="fas fa-search"></div>
    <div id="cart-btn" class="fas fa-shopping-cart"></div>
    <?php
    if(!isset($_SESSION['FOOD_USER_NAME'])){
        ?>
        <div id="login-btn" class="fas fa-user"></div>
        <?php
    }
    ?>
</div>

</header>

<!-- header section ends  -->


<!-- login-form  -->
<div class="login-form-container">

    <form method="post" id="frmLogin">
        <h3>login form</h3>
        <input type="email" name="user_email" placeholder="enter your email" id="" class="box" required>
        <input type="password" name="user_password" placeholder="enter your password" id="" class="box" required>
        <div class="remember">
            <input type="checkbox" name="" id="remember-me">
            <label for="remember-me">remember me</label>
        </div>
        <!-- <a href=""  class="btn">login now</a> -->
        <input type="submit" value="login now" class="btn" id="login_submit">
      
        <p>forget password? <a href="#" id="forgot-btn">click here</a></p>
        <p>don't have an account? <a href="#" id="register-btn">create one</a></p>
        <input type="hidden" name="type" value="login"/>
        <div id="form_login_msg" class="error_field"></div>
      
    </form>

</div>
<!-- login-form End-->

<!-- Register-form  -->
<div class="register-form-container">

    <form method="post" id="frmRegister">
        <h3>register form</h3>
        <input type="text" name="name" placeholder="enter your name" id="name" class="box" required>
        <input type="email" name="email" placeholder="enter your email" id="email" class="box" required>
        <span id="email_error" class="error_field"></span>
        <input type="text" name="mobile" placeholder="enter your mobile" id="mobile" class="box" required>
        <input type="password" name="password" placeholder="enter your password" id="password" class="box" required>
        
        <div class="remember">
            <input type="checkbox" name="" id="terms-me">
            <label for="terms-me">Agree Terms & Conditions</label>
        </div>
        <!-- <a href=""  class="btn">login now</a> -->
        <input type="submit" value="register now" class="btn" id="register_submit">
       <p>do you have an account? <a href="#" id="login-btn2">login now</a></p>
       <input type="hidden" name="type" value="register"/>
       <div id="form_msg" class="error_field"></div>
    </form>

</div>
<!-- Register-form End-->

<!-- search-form  -->

<section class="search-form-container">

    <form action="">
        <input type="search" name="" placeholder="search here..." id="search-box">
        <label for="search-box" class="fas fa-search"></label>
    </form>

</section>
<!-- search-form End -->

<!-- forgot-form  -->
<div class="forgot-form-container">

    <form method="post" id="frmForgotPassword">
        <h3>Forgot Password</h3>
        <input type="email" name="user_email" placeholder="enter your email" id="" class="box" required>
        <input type="submit" value="submit" class="btn" id="forgot_submit">
        <p>do you have an account? <a href="#" id="login-btn3">login now</a></p>
       
        <input type="hidden" name="type" value="forgot"/>
        <div id="form_forgot_msg" class="error_field"></div>
      
    </form>

</div>
<!-- forgot-form End-->

<!-- shopping-cart section  -->

<section class="shopping-cart-container">

<div class="products-container">

    <h3 class="title">your products</h3>

    <div class="box-container">

        <div class="box">
            <i class="fas fa-times"></i>
            <img src="image/menu-1.png" alt="">
            <div class="content">
                <h3>delicious food</h3>
                <span> quantity : </span>
                <input type="number" name="" value="1" id="">
                <br>
                <span> price : </span>
                <span class="price"> $40.00 </span>
            </div>
        </div>

        <div class="box">
            <i class="fas fa-times"></i>
            <img src="image/menu-2.png" alt="">
            <div class="content">
                <h3>delicious food</h3>
                <span> quantity : </span>
                <input type="number" name="" value="1" id="">
                <br>
                <span> price : </span>
                <span class="price"> $40.00 </span>
            </div>
        </div>

        <div class="box">
            <i class="fas fa-times"></i>
            <img src="image/menu-3.png" alt="">
            <div class="content">
                <h3>delicious food</h3>
                <span> quantity : </span>
                <input type="number" name="" value="1" id="">
                <br>
                <span> price : </span>
                <span class="price"> $40.00 </span>
            </div>
        </div>

        <div class="box">
            <i class="fas fa-times"></i>
            <img src="image/menu-4.png" alt="">
            <div class="content">
                <h3>delicious food</h3>
                <span> quantity : </span>
                <input type="number" name="" value="1" id="">
                <br>
                <span> price : </span>
                <span class="price"> $40.00 </span>
            </div>
        </div>

        <div class="box">
            <i class="fas fa-times"></i>
            <img src="image/menu-5.png" alt="">
            <div class="content">
                <h3>delicious food</h3>
                <span> quantity : </span>
                <input type="number" name="" value="1" id="">
                <br>
                <span> price : </span>
                <span class="price"> $40.00 </span>
            </div>
        </div>
        <?php
		$cartArr=getUserFullCart();
		if(count($cartArr)>0){
            
			foreach($cartArr as $key=>$list){
										
		?>                     
        <!-- <div class="box">
            <i class="fas fa-times"></i>
            <img src="<?php echo SITE_DISH_IMAGE.$list['image']?>" alt="">
            <div class="content">
                <h3><?php echo $list['dish']?></h3>
                <span> quantity :<?php echo $list['qty']?> </span>
                <input type="number" name="" value="1" id="">
                <br>
                <span> price : </span>
                <span class="price"><?php echo $list['price']?> $40.00 </span>
            </div>
        </div> -->
            <?php } } ?>
    </div>

</div>

<div class="cart-total">

    <h3 class="title"> cart total </h3>

    <div class="box">

        <h3 class="subtotal"> subtotal : <span>$200</span> </h3>
        <h3 class="total"> total : <span>$200</span> </h3>

        <a href="#" class="btn">proceed to checkout</a>

    </div>

</div>

</section>
<!--Shoping-Cart Section End Here -->

