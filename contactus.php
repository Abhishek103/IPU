<?php 
require_once("includes/functions.php");
session_start();
if(!isset($_SESSION["user_id"]))
{
  header('Location: login.php');
}
elseif(isset($_SESSION["admin"]))
{
  header('Location: login.php');
}
else{
$user_id = $_SESSION['user_id'];

}
$user = json_decode(getUserById($user_id), true);
$skills = "";
if(array_key_exists('user_prof_summary', $user['usermeta']))
{
  $user_prof_summary = json_decode($user['usermeta']['user_prof_summary'], true);
  $skills = explode(",", $user_prof_summary['user_skills']);
}
if(array_key_exists('user_pers_summary', $user['usermeta']))
{
  $user_pers_summary = json_decode($user['usermeta']['user_pers_summary'], true);
}
if(isset($_POST['messageSubmit']))
{
    $message = $_POST['message'];
    sendmail($user['email'], $message);
    
}
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>USMS | Contact us</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/thirdparty/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/thirdparty/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/thirdparty/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="assets/thirdparty/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b></b>USMS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>USMS</b> ALUMNI</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
      
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php  if(array_key_exists('user_pers_summary', $user['usermeta'])) echo $user_pers_summary['profile_pic']; else echo "assets/img/user2-160x160.jpg";?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $user['name'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php  if(array_key_exists('user_pers_summary', $user['usermeta'])) echo $user_pers_summary['profile_pic']; else echo "assets/img/user2-160x160.jpg";?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $user['name'];?>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Option 1</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Option 2</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Option </a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="dashboard.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="login.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php  if(array_key_exists('user_pers_summary', $user['usermeta'])) echo $user_pers_summary['profile_pic']; else echo "assets/img/user2-160x160.jpg";?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['name'];?></p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
        <br>
        <br>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview menu-open">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="dashboard.php"><i class="fa fa-user-o"></i> Profile</a></li>
            <li><a href="events.php"><i class="fa fa-files-o"></i> Events</a></li>
            <li><a href="settings.php"><i class="fa fa-cogs"></i> Settings</a></li>
            <li class="active"><a href="contactus.php"><i class="fa fa-envelope"></i> Contact us</a></li>
          </ul>
        </li>  
         
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Contact Us
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Contact Us</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
        <div class="col-sm-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <!-- <h3 class="box-title">Carousel</h3> -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div> 
        <form class="form-horizontal" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <div class="form-group">
              <label for="inputOrg" class="col-sm-2 control-label">Message</label>
              <div class="col-sm-10">
                <textarea required class="form-control" rows="20"  id="message" name="message" placeholder="Write Your Query" ></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info" name="messageSubmit">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
        </div>  
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="#"></a>.</strong> All rights
    reserved.
  </footer>
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="assets/thirdparty/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/thirdparty/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="assets/thirdparty/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="assets/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="assets/thirdparty/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="assets/thirdparty/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="assets/thirdparty/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/js/demo.js"></script>
</body>
</html>
