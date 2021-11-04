<?php
// include('database.inc.php');
// include('function.inc.php');
// include('constant.inc.php');
include('top.php');
if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "add":
            if(!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
                $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
                
                if(!empty($_SESSION["cart_item"])) {
                    if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                                if($productByCode[0]["code"] == $k) {
                                    if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                        $_SESSION["cart_item"][$k]["quantity"] = 0;
                                    }
                                    $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                                }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
        break;
        case "remove":
            if(!empty($_SESSION["cart_item"])) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                        if($_GET["code"] == $k)
                            unset($_SESSION["cart_item"][$k]);				
                        if(empty($_SESSION["cart_item"]))
                            unset($_SESSION["cart_item"]);
                }
            }
        break;
        case "empty":
            unset($_SESSION["cart_item"]);
        break;	
    }
    }
?>

        <!-- <div class="slider-area">
            <div class="slider-active owl-dot-style owl-carousel">
                <?php
				$banner_res=mysqli_query($con,"select * from banner where status='1' order by order_number");
				while($banner_row=mysqli_fetch_assoc($banner_res)){
				?>
				<div class="single-slider pt-210 pb-220 bg-img" style="background-image:url(<?php echo SITE_BANNER_IMAGE.$banner_row['image']?>);">
                    <div class="container">
                        <div class="slider-content slider-animated-1">
                            <h1 class="animated"><?php echo $banner_row['heading']?></h1>
                            <h3 class="animated"><?php echo $banner_row['sub_heading']?></h3>
                            <div class="slider-btn mt-90">
                                <a class="animated" href="<?php echo $banner_row['link']?>"><?php echo $banner_row['link_txt']?></a>
                            </div>
                        </div>
                    </div>
                </div>
				<?php } ?>
            </div>
        </div> -->

<!-- search-form  -->

<section class="search-form-container">

    <form action="">
        <input type="search" name="" placeholder="search here..." id="search-box">
        <label for="search-box" class="fas fa-search"></label>
    </form>

</section>
<!-- search-form End -->
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
        <div class="box">
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
        </div>
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

<!-- login-form  -->
<div class="login-form-container">

    <form action="">
        <h3>login form</h3>
        <input type="email" name="" placeholder="enter your email" id="" class="box">
        <input type="password" name="" placeholder="enter your password" id="" class="box">
        <div class="remember">
            <input type="checkbox" name="" id="remember-me">
            <label for="remember-me">remember me</label>
        </div>
        <!-- <a href=""  class="btn">login now</a> -->
        <input type="submit" value="login now" class="btn">
        <p>forget password? <a href="#">click here</a></p>
        <p>don't have an account? <a href="#" id="register-btn">create one</a></p>
    </form>

</div>
<!-- login-form End-->

<!-- Register-form  -->
<div class="register-form-container">

    <form action="">
        <h3>register form</h3>
        <input type="text" name="" placeholder="enter your name" id="" class="box">
        <input type="phone" name="" placeholder="enter your phone" id="" class="box">
        
        <input type="email" name="" placeholder="enter your email" id="" class="box">
       
        <input type="password" name="" placeholder="enter your password" id="" class="box">
        <input type="text" name="" placeholder="enter confirm password" id="" class="box">
        <div class="remember">
            <input type="checkbox" name="" id="terms-me">
            <label for="terms-me">Agree Terms & Conditions</label>
        </div>
        <!-- <a href=""  class="btn">login now</a> -->
        <input type="submit" value="register now" class="btn">
       <p>do you have an account? <a href="#" id="login-btn">login now</a></p>
    </form>

</div>
<!-- Register-form End-->

<!-- home section starts  -->

<section class="home" id="home">

    <div class="content">
        <span>welcome foodies</span>
        <h3>different spices for the different tastes 😋</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis unde dolores temporibus hic quam debitis tenetur harum nemo.</p>
        <!-- <a href="#" class="btn">order now</a> -->
    </div>

    <div class="image">
        <img src="image/home-img.png" alt="" class="home-img">
        <img src="image/home-parallax-img.png" alt="" class="home-parallax-img">
    </div>

</section>

<!-- home section ends  -->

<!-- category section starts  -->
<?php 
function getCategory($id){
    echo $id;
}
?>
<section class="category">
    <?php 
    global $con;
	$sql="SELECT id,category,category_image FROM category where status=1 ORDER BY order_number";
	$res=mysqli_query($con,$sql);
	
	while($row=mysqli_fetch_assoc($res)){
		?>
        <a href="#" class="box"  onclick="getCategory(<?php echo $row['id']?>)">
        <img src="image/cat_img/<?php echo ($row['category_image']); ?>" alt="Category Image">       
        <h3><?php echo $row['category']?></h3>
        </a> 
	<?php } ?>
</section>

<!-- category section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <div class="image">
        <img src="image/about-img.png" alt="">
    </div>

    <div class="content">
        <span>why choose us?</span>
        <h3 class="title">what's make our food delicious!</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos ut explicabo, numquam iusto est a ipsum assumenda tempore esse corporis?</p>
        <a href="#" class="btn">read more</a>
        <div class="icons-container">
            <div class="icons">
                <img src="image/serv-1.png" alt="">
                <h3>fast delivery</h3>
            </div>  
            <div class="icons">
                <img src="image/serv-2.png" alt="">
                <h3>fresh food</h3>
            </div>   
            <div class="icons">
                <img src="image/serv-3.png" alt="">
                <h3>best quality</h3>
            </div>  
            <div class="icons">
                <img src="image/serv-4.png" alt="">
                <h3>24/7 support</h3>
            </div>           
        </div>
    </div>

</section>

<!-- about section ends -->

        <!-- popular section starts  -->

<section class="popular" id="popular">

<div class="heading">
    <span>popular food</span>
    <h3>our special dishes</h3>
</div>

<div class="box-container">

<?php 
    global $con;
	$sql="SELECT dish.id,dish.category_id,dish.dish,dish.image,dish.type,dish_details.attribute,dish_details.price FROM dish,dish_details where dish.id=dish_details.dish_id AND dish.status=1 and dish_details.status=1 ORDER BY dish.added_on DESC LIMIT 8";
	$res=mysqli_query($con,$sql);
	
	while($row=mysqli_fetch_assoc($res)){
		?>
             <div class="box">
        <a href="#" class="fas fa-heart"></a>
        <div class="image">
            <img src="image/dish_img/<?php echo ($row['image']); ?>" alt="Dish Image">
        </div>
        <div class="content">
            <h3><?php echo $row['dish']?><?php echo '('.$row['attribute'].')'?></h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span> (50) </span>
            </div>
            <div class="price">₹<?php echo $row['price']?>.00<span>₹500.00</span></div>
            <a href="#" class="btn">add to cart</a>
        </div>
    </div>
        <?php } ?>
</div>

</section>

<!-- popular section ends -->
        <script src="assets/js/vendor/jquery-1.12.0.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="assets/js/isotope.pkgd.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script> 
<?php 
include('footer.php');
?>

    
<!-- Comment -->