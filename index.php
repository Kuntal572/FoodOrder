<?php
// include('database.inc.php');
// include('function.inc.php');
// include('constant.inc.php');
include('top.php');
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