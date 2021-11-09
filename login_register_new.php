<?php
session_start();
include('database.inc.php');
include('function.inc.php');
include('constant.inc.php');
include('smtp/PHPMailerAutoload.php');

    $type=get_safe_value($_POST['type']);
    $added_on=date('Y-m-d h:i:s');

    if($type=='register'){
    $name=get_safe_value($_POST['name']);
	$email=get_safe_value($_POST['email']);
	$mobile=get_safe_value($_POST['mobile']);
	$password=get_safe_value($_POST['password']);
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

    if($type=='login'){
    
	    $email=get_safe_value($_POST['user_email']);
		$password=get_safe_value($_POST['user_password']);

        $res=mysqli_query($con,"select * from user where email='$email' and password='$password'");
        $check=mysqli_num_rows($res);
        if($check>0){
            $row=mysqli_fetch_assoc($res);
            $status=$row['status'];
            $email_verify=$row['email_verify'];
            if($email_verify==1){
                if($status==1){
                    $_SESSION['FOOD_USER_ID']=$row['id'];
                    $_SESSION['FOOD_USER_NAME']=$row['name'];
                    $arr=array('status'=>'success','msg'=>'');
                }else{
                    $arr=array('status'=>'error','msg'=>'Your account has been deactivated.');
                }

            }else{
                $arr=array('status'=>'error','msg'=>'Please varify your email id');
            }
        }else{
            $arr=array('status'=>'error','msg'=>'Please enter valid login details');
        }
        echo json_encode($arr);
    }
?>