<?php
include("top.php");
include('smtp/PHPMailerAutoload.php');
// session_start();
if (isset($_GET['referral_code']) && $_GET['referral_code'] != '') {
    $_SESSION['FROM_REFERRAL_CODE'] = get_safe_value($_GET['referral_code']);
}

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
		$new_password=password_hash($password,PASSWORD_BCRYPT);
		$rand_str=rand_str();
		$referral_code=rand_str();
		if(isset($_SESSION['FROM_REFERRAL_CODE']) && $_SESSION['FROM_REFERRAL_CODE']!=''){
			$from_referral_code=$_SESSION['FROM_REFERRAL_CODE'];
		}else{
			$from_referral_code='';
		}
		mysqli_query($con,"insert into user(name,email,mobile,password,status,email_verify,added_on,rand_str,referral_code,from_referral_code) values('$name','$email','$mobile','$new_password','1','0','$added_on','$rand_str','$referral_code','$from_referral_code')");
		$id=mysqli_insert_id($con);
		unset($_SESSION['FROM_REFERRAL_CODE']);
		
		$getSetting=getSetting();
		$wallet_amt=$getSetting['wallet_amt'];
		if($wallet_amt>0){
				manageWallet($id,$wallet_amt,'in','Register');
		}
		$html=FRONT_SITE_PATH."verify/".$rand_str;
		send_email($email,$html,'Verify your email id');
		
		
		$arr=array('status'=>'success','msg'=>'Thank you for register. Please check your email id, to verify your account','field'=>'form_msg');
	}
	echo json_encode($arr);
}

if($type=='login'){
	$email=get_safe_value($_POST['user_email']);
	$password=get_safe_value($_POST['user_password']);
	
	$res=mysqli_query($con,"select * from user where email='$email'");
	$check=mysqli_num_rows($res);
	if($check>0){	
		$row=mysqli_fetch_assoc($res);
		$status=$row['status'];
		$email_verify=$row['email_verify'];
		$dbpassword=$row['password'];
		if($email_verify==1){
			if($status==1){
				if(password_verify($password,$dbpassword)){
					$_SESSION['FOOD_USER_ID']=$row['id'];
					$_SESSION['FOOD_USER_NAME']=$row['name'];
					$_SESSION['FOOD_USER_EMAIL']=$row['email'];
					$arr=array('status'=>'success','msg'=>'');
					
					if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0){
						foreach($_SESSION['cart'] as $key=>$val){
							manageUserCart($_SESSION['FOOD_USER_ID'],$val['qty'],$key);
						}
					}
					
				}else{
					$arr=array('status'=>'error','msg'=>'Please enter correct password');
				}
			}else{
				$arr=array('status'=>'error','msg'=>'Your account has been deactivated.');
			}
		}else{
			$arr=array('status'=>'error','msg'=>'Please varify your email id');
		}
	}else{
		$arr=array('status'=>'error','msg'=>'Please enter valid email id');	
	}
	echo json_encode($arr);
}

if($type=='forgot'){
	$email=get_safe_value($_POST['user_email']);
	
	$res=mysqli_query($con,"select * from user where email='$email'");
	$check=mysqli_num_rows($res);
	if($check>0){	
		$row=mysqli_fetch_assoc($res);
		$status=$row['status'];
		$email_verify=$row['email_verify'];
		$id=$row['id'];
		if($email_verify==1){
			if($status==1){
				$rand_password=rand(11111,99999);
				$new_password=password_hash($rand_password,PASSWORD_BCRYPT);
				mysqli_query($con,"update user set password='$new_password' where id='$id'");
				$html=$rand_password;
				send_email($email,$html,'New Password');
				$arr=array('status'=>'success','msg'=>'Password has been reset and send it to your email id');
				
			}else{
				$arr=array('status'=>'error','msg'=>'Your account has been deactivated.');
			}
		}else{
			$arr=array('status'=>'error','msg'=>'Please varify your email id');
		}
	}else{
		$arr=array('status'=>'error','msg'=>'Please enter valid email id');	
	}
	echo json_encode($arr);
}
?>

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
        <a href=""  class="btn">login now</a>
        <!-- <input type="submit" value="login now" class="btn"> -->
        <p>forget password? <a href="#">click here</a></p>
        <p>don't have an account? <a href="#">create one</a></p>
    </form>

</div>

<!-- <div class="login-register-area pt-95 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> login </h4>
                        </a>
                        <a data-toggle="tab" href="#lg2">
                            <h4> register </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post" id="frmLogin">
                                        <input type="email" name="user_email" placeholder="Email" required>
                                        <input type="password" name="user_password" placeholder="Password" required>
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <a href="<?php echo FRONT_SITE_PATH ?>forgot_password">Forgot Password?</a>
                                            </div>
                                            <button type="submit" id="login_submit">Login</button>
                                            <input type="hidden" name="type" value="login" />
                                            <input type="hidden" name="is_checkout" id="is_checkout" value="" />
                                            <div id="form_login_msg" class="success_field"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="lg2" class="tab-pane">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post" id="frmRegister">
                                        <input type="text" name="name" placeholder="Name" id="name" required>
                                        <input name="email" id="email" placeholder="Email" type="email" required>
                                        <div id="email_error" class="error_field"></div>
                                        <input type="password" name="password" placeholder="Password" id="password" required>
                                        <input type="text" name="mobile" placeholder="Mobile" id="mobile" required>
                                        <div class="button-box">
                                            <button type="submit" id="register_submit">Register</button>
                                        </div>
                                        <input type="hidden" name="type" value="register" />
                                        <div id="form_msg" class="success_field"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

