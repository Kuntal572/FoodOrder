<?php 
include "top.php";
?>
<section class="popular" id="popular">

<div class="heading">
    <span>popular food</span>
    <h3>our special dishes</h3>
</div>
<div class="box-container">
<?php 
    global $con;
    $res_id=$_GET['id'];
    
	//$sql="SELECT dish.id,dish.category_id,dish.dish,dish.image,dish.type,dish_details.attribute,dish_details.price FROM dish,dish_details where dish.id=dish_details.dish_id AND dish.status=1 and dish_details.status=1 ORDER BY dish.added_on DESC LIMIT 8";
    $sql = "SELECT dish.*,dish_details.attribute,dish_details.price FROM dish_details,dish where dish.id=dish_details.dish_id and dish.r_id=8 and dish.status=1 and dish_details.status=1 ORDER BY added_on DESC";
	$res=mysqli_query($con,$sql);
	
	while($row=mysqli_fetch_assoc($res)){
		?>
        <div class="box">
            <a href="#" class="fas fa-heart"></a>
            <div class="image">
                <img src="image/dish_img/<?php echo $row['image'] ?>" alt="">
            </div>
            <div class="content">
                <h3><?php echo $row['dish']."(".$row['attribute'].")" ?></h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <span> (50) </span>
                </div>
                <div class="price">₹<?php echo $row['price'] ?><span>$50.00</span></div>
                <a href="#" class="btn">add to cart</a>
            </div>
        </div>
        <?php } ?>
</div>

</section>

<?php
include "footer.php";
?>