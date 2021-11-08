<?php
include('database.inc.php');
include('function.inc.php');
include('constant.inc.php');
include('smtp/PHPMailerAutoload.php');
$name=get_safe_value($_POST['name']);
	$email=get_safe_value($_POST['email']);
	$mobile=get_safe_value($_POST['mobile']);
	$password=get_safe_value($_POST['password']);
    $type=get_safe_value($_POST['type']);
    $added_on=date('Y-m-d h:i:s');
    if($type=='register'){
        $check=mysqli_num_rows(mysqli_query($con,"select * from user where email='$email'"));
        if($check>0){
            $arr=array('status'=>'error','msg'=>'Email id already registered','field'=>'email_error');
            
        }else{
            $rand_str=rand_str();
            mysqli_query($con,"insert into user(name,email,mobile,password,status,email_verify,added_on,rand_str) values('$name','$email','$mobile','$password','0','0','$added_on','$rand_str')");
            $id=mysqli_insert_id($con);
            $html=FRONT_SITE_PATH."verify.php?id=".$rand_str;
            send_email($email,$html,'Verify your email id');

            $arr=array('status'=>'success','msg'=>'Thank you for register. Please 
            check your email id, to verify your account','field'=>'form_msg');
        }
        echo json_encode($arr);
    }
?>