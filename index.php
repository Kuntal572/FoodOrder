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

}
?>
<section class="category">


    <a href="#" class="box">
        <img src="image/cat-1.png" alt="">
        <h3>combo</h3>
    </a>
               
    <a href="#" class="box">
        <img src="image/cat-2.png" alt="">
        <h3>pizza</h3>
    </a>

    <a href="#" class="box">
        <img src="image/cat-3.png" alt="">
        <h3>burger</h3>
    </a>

    <a href="#" class="box">
        <img src="image/cat-4.png" alt="">
        <h3>chicken</h3>
    </a>

    <a href="#" class="box">
        <img src="image/cat-5.png" alt="">
        <h3>dinner</h3>
    </a>

    <a href="#" class="box">
        <img src="image/cat-6.png" alt="">
        <h3>coffee</h3>
    </a>
    <?php 
    global $con;
	$sql="SELECT id,category,category_image FROM category where status=1 ORDER BY order_number";
	$res=mysqli_query($con,$sql);
	
	while($row=mysqli_fetch_assoc($res)){
		?>
        <a href="#" class="box"  onclick="getCategory(<?php echo $row['id']?>)">
        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['category_image']); ?>" alt="Category Image">       
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

    <div class="box">
        <a href="#" class="fas fa-heart"></a>
        <div class="image">
            <img src="image/food-1.png" alt="">
        </div>
        <div class="content">
            <h3>delicious food</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span> (50) </span>
            </div>
            <div class="price">$40.00 <span>$50.00</span></div>
            <a href="#" class="btn">add to cart</a>
        </div>
    </div>

    <div class="box">
        <a href="#" class="fas fa-heart"></a>
        <div class="image">
            <img src="image/food-2.png" alt="">
        </div>
        <div class="content">
            <h3>delicious food</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span> (50) </span>
            </div>
            <div class="price">$40.00 <span>$50.00</span></div>
            <a href="#" class="btn">add to cart</a>
        </div>
    </div>

    <div class="box">
        <a href="#" class="fas fa-heart"></a>
        <div class="image">
            <img src="image/food-3.png" alt="">
        </div>
        <div class="content">
            <h3>delicious food</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span> (50) </span>
            </div>
            <div class="price">$40.00 <span>$50.00</span></div>
            <a href="#" class="btn">add to cart</a>
        </div>
    </div>

    <div class="box">
        <a href="#" class="fas fa-heart"></a>
        <div class="image">
            <img src="image/food-4.png" alt="">
        </div>
        <div class="content">
            <h3>delicious food</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span> (50) </span>
            </div>
            <div class="price">$40.00 <span>$50.00</span></div>
            <a href="#" class="btn">add to cart</a>
        </div>
    </div>

    <div class="box">
        <a href="#" class="fas fa-heart"></a>
        <div class="image">
            <img src="image/food-5.png" alt="">
        </div>
        <div class="content">
            <h3>delicious food</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span> (50) </span>
            </div>
            <div class="price">$40.00 <span>$50.00</span></div>
            <a href="#" class="btn">add to cart</a>
        </div>
    </div>

    <div class="box">
        <a href="#" class="fas fa-heart"></a>
        <div class="image">
            <img src="image/food-6.png" alt="">
        </div>
        <div class="content">
            <h3>delicious food</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span> (50) </span>
            </div>
            <div class="price">$40.00 <span>$50.00</span></div>
            <a href="#" class="btn">add to cart</a>
        </div>
    </div>

    <div class="box">
        <a href="#" class="fas fa-heart"></a>
        <div class="image">
            <img src="image/food-7.png" alt="">
        </div>
        <div class="content">
            <h3>delicious food</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span> (50) </span>
            </div>
            <div class="price">$40.00 <span>$50.00</span></div>
            <a href="#" class="btn">add to cart</a>
        </div>
    </div>

    <div class="box">
        <a href="#" class="fas fa-heart"></a>
        <div class="image">
            <img src="image/Chowmein.jpg" alt="">
        </div>
        <div class="content">
            <h3>delicious food</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span> (50) </span>
            </div>
            <div class="price">$40.00 <span>$50.00</span></div>
            <a href="#" class="btn">add to cart</a>
        </div>
    </div>

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
<script>
    function categor() {
        $(".categor").click(function () {

        });
    }
    $(document).ready(function () {

    });
</script>
    
