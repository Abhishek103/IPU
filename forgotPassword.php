<?php 
require_once('includes/functions.php');
$err='';
if(isset($_POST['submit']))
{
	$email = $_POST['email'];
	$result = getConfCode($email);

	if($result == -1)
	{
		$err = 'error';
	}
	else{
		header('Location: emailVerification.php?id='.$result);
	}
}
?>
<html>
<head>
  <meta charset="utf-8">
  <title>Forgot Password | USMS</title>
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
					<form id="login-form" method="post" action="forgotPassword.php" role="form">
						<legend>Reset the Password</legend>
						<?php if ($err == 'error') { ?>
							<div class="alert alert-danger text-center"><?php echo "Invalid Email! "; ?></div>
						<?php } ?>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-question-sign"></i></span>
							<input type="email" name="email" placeholder="Verify your email" required class="form-control" />
						</div>
						<div class="form-group">
								<input type="submit" name="submit" value="Verify" class="btn btn-primary btn-block" />
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
</body>
</html>
