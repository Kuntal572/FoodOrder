<?php 
include('top.php');
$msg="";
$category="";
$order_number="";
$id="";
$category_image="";

if(isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($_GET['id']);
	$row=mysqli_fetch_assoc(mysqli_query($con,"select * from category where id='$id'"));
	$category=$row['category'];
	$order_number=$row['order_number'];
	$category_image=$row['category_image'];
}

if(isset($_POST['submit'])){
	$category=get_safe_value($_POST['category']);
	$order_number=get_safe_value($_POST['order_number']);
	$added_on=date('Y-m-d h:i:s');
	$filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
    $folder = "image/cat_img/".basename($filename) ;

	if($id==''){
		$sql="select * from category where category='$category'";
	}else{
		$sql="select * from category where category='$category' and id!='$id'";
	}	
	if(mysqli_num_rows(mysqli_query($con,$sql))>0){
		$msg="Category already added";
	}else{
		if($id==''){

			mysqli_query($con,"insert into category(category,order_number,status,added_on,category_image) values('$category','$order_number',1,'$added_on','$filename')");

			// Now let's move the uploaded image into the folder: image
			if (move_uploaded_file($tempname, $folder))  {
				$msg = "Image uploaded successfully";
			}else{
				$msg = "Failed to upload image";
		  }
		}else{
			mysqli_query($con,"update category set category='$category', order_number='$order_number',category_image='$filename' where id='$id'");
			if (move_uploaded_file($tempname, $folder))  {
				$msg = "Image uploaded successfully";
			}else{
				$msg = "Failed to upload image";
		  }
		}
		
		redirect('category.php');
	}
}
?>
<div class="row">
			<h1 class="grid_title ml10 ml15">Manage Category</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">Category</label>
                      <input type="text" class="form-control" placeholder="Category" name="category" required value="<?php echo $category?>">
					  <div class="error mt8"><?php echo $msg?></div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3" required>Order Number</label>
                      <input type="textbox" class="form-control" placeholder="Order Number" name="order_number"  value="<?php echo $order_number?>">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail3" required>Category Image</label>
                      <input type="file" class="form-control" name="uploadfile" accept="image/png,image/jpeg,image/jpg" />
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>
            
		 </div>
        
<?php include('footer.php');?>