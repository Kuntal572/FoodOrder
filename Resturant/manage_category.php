<?php 
include('top.php');
$msg="";
$category="";
$order_number="";
$id="";

if(isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($_GET['id']);
	$row=mysqli_fetch_assoc(mysqli_query($con,"select * from category where id='$id'"));
	$category=$row['category'];
	$order_number=$row['order_number'];
}

if(isset($_POST['submit'])){
	$category=get_safe_value($_POST['category']);
	$order_number=get_safe_value($_POST['order_number']);
	$added_on=date('Y-m-d h:i:s');
	// Get file info 
	$fileName = basename($_FILES["category_image"]['name']); 
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
	// Allow certain file formats 
	$allowTypes = array('jpg','png','jpeg'); 

	if(in_array($fileType, $allowTypes)){ 
		$image = $_FILES['category_image']['tmp_name']; 
        $imgContent = addslashes(file_get_contents($image)); 

		if($id==''){
			$sql="select * from category where category='$category'";
		}else{
			$sql="select * from category where category='$category' and id!='$id'";
		}	
		if(mysqli_num_rows(mysqli_query($con,$sql))>0){
			$msg="Category already added";
		}else{
			if($id==''){
				mysqli_query($con,"insert into category(category,order_number,status,added_on,r_id,category_image) values('$category','$order_number',1,'$added_on','$Res_Id','$imgContent')");
			}else{
				mysqli_query($con,"update category set category='$category', order_number='$order_number',category_image='$imgContent' where id='$id'");
			}
			
			redirect('category.php');
		}
	}
	else{ 
            $statusMsg = 'Sorry, only JPG, JPEG & PNG files are allowed to upload.'; 
        } 
	// if(!empty($_FILES["image"]["name"])) { 
        
        
         
    //     // Allow certain file formats 
    //     $allowTypes = array('jpg','png','jpeg'); 
    //     if(in_array($fileType, $allowTypes)){ 
    //         $image = $_FILES['image']['tmp_name']; 
    //         $imgContent = addslashes(file_get_contents($image)); 
         
    //         // Insert image content into database 
    //         $insert = $db->query("INSERT into images (image, uploaded) VALUES ('$imgContent', NOW())"); 
             
    //         if($insert){ 
    //             $status = 'success'; 
    //             $statusMsg = "File uploaded successfully."; 
    //         }else{ 
    //             $statusMsg = "File upload failed, please try again."; 
    //         }  
    //     }else{ 
    //         $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
    //     } 
    // }else{ 
    //     $statusMsg = 'Please select an image file to upload.'; 
    // } 
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
						<label>Select Category Image :</label>
						<input type="file" class="form-control" name="category_image" accept=".png,.jpg,.jpeg">
					</div>
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>
            
		 </div>
        
<?php include('footer.php');?>