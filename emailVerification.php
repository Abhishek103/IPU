<?php 
require_once('includes/functions.php');
$err = '';

$user_id = $_REQUEST['id'];

if(isset($_POST['submit']))
{
	$conf_code = $_POST['confCode'];
	$password = md5($_POST['password']);

	$update_password =  updatePassword($conf_code, $user_id, $password);
	if($update_password == -1)
	{
		$err = 'error';
	}
	if($update_password > 0)
	{
		$err = 'success';
	}
}
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Password Reset | USMS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/thirdparty/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/thirdparty/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/css/skins/_all-skins.min.css">
	
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<link rel="stylesheet" href="assets/css/usms.css">
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="container" style="margin-top: 150px;">
		<div class="col-sm-6 col-sm-offset-3">
			<div class="panel panel-default">
				<div class="panel-body">
					<form id="login-form" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?id='.$user_id;?>" role="form">
						<legend>Reset the Password</legend>
						<?php if ($err == 'error') { ?>
							<div class="alert alert-danger text-center"><?php echo "Invalid confirmation Code"; ?></div>
						<?php } elseif ($err == 'success'){?>
							<div class="alert alert-success text-center"><?php echo "Password is  reset. Please log in with new password"; ?></div>
						<?php } ?>
						<div class="" id="divCheckPasswordMatch"></div>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-question-sign"></i></span>
							<input type="number" name="confCode" placeholder="Enter the confirmation code" required class="form-control" />
						</div>
                        <div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input type="password" name="password" placeholder="Password"  class="form-control" required id="txtNewPassword" />
						</div>
                        <div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input type="Password" id="txtConfirmPassword" name="repeatPassword" placeholder="Repeat Password" required class="form-control"/>
						</div>
						<div class="form-group">
							<input type="submit" name="submit" value="Reset" class="btn btn-primary btn-block" onClick='return validate();' />
						</div>
						<div class="form-group">
							<hr/>
							<div class="col-sm-6" style="padding: 0;">New user ? <a href="signUp.php">Sign Up here</a></div>
							<div class="col-sm-6 text-right" style="padding: 0;">Existing User ? <a href="login.php">Click here</a></div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
			
  <!-- Left side column. contains the logo and sidebar -->
 
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="assets/thirdparty/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="assets/thirdparty/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/thirdparty/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>
<script>
function validate() {
    var password = $("#txtNewPassword").val();
    var confirmPassword = $("#txtConfirmPassword").val();
	
	if (password != confirmPassword)
	{
		$("#divCheckPasswordMatch").addClass('alert alert-danger alert-dismissible text-center'); 
		$("#divCheckPasswordMatch").html("Passwords do not match!");
		return false;
	}	
    else
        return true;
}
</script>
</body>
</html>
