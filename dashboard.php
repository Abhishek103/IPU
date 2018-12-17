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

?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>USMS | Dashboard</title>
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
                  <?php echo $user['name'];?> - Web Developer
                  <small>Member since Nov. 2012</small>
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
              </li> -->
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
            <li class="active"><a href="dashboard.php"><i class="fa fa-user-o"></i> Profile</a></li>
            <li><a href="events.php"><i class="fa fa-files-o"></i> Events</a></li>
            <li><a href="settings.php"><i class="fa fa-cogs"></i> Settings</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
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
        Dashboard
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

<div class="row">
  <div class="col-md-3">

    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="<?php  if(array_key_exists('user_pers_summary', $user['usermeta'])) echo $user_pers_summary['profile_pic']; else echo "assets/img/user2-160x160.jpg";?>" alt="User profile picture">

        <h3 class="profile-username text-center"><?php echo $user['name'];?></h3>

        <p class="text-muted text-center"><?php  if(array_key_exists('user_prof_summary', $user['usermeta'])) echo $user_prof_summary['user_current_desg']; else echo "";?></p>
        <p class="text-muted text-center"><?php  if(array_key_exists('user_prof_summary', $user['usermeta'])) echo $user_prof_summary['user_current_org']; else echo "";?></p>

        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Course Type</b> <a class="pull-right"><?php if($user['course_type'] == 'mba_gen') echo "MBA (GEN)"; else echo "MBA (FM)";?></a>
          </li>
          <li class="list-group-item">
            <b>Major</b> <a class="pull-right"><?php echo $user['usermeta']['user_major']; ?></a>
          </li>
          <li class="list-group-item">
            <b>Minor</b> <a class="pull-right"><?php echo $user['usermeta']['user_minor']; ?></a>
          </li>
          <li class="list-group-item">
            <b>Batch</b> <a class="pull-right"><?php echo $user['batch']; ?></a>
          </li>
          <li class="list-group-item">
            <b>Email</b> <a class="pull-right"><?php echo $user['email']; ?></a>
          </li>
          <li class="list-group-item">
            <b>Phone Number</b> <a class="pull-right"><?php echo $user['number']; ?></a>
          </li>
        </ul>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
 
  </div>
  <div class="col-md-9">
     <!-- About Me Box -->
     <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">About Me</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <!-- <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
        <p class="text-muted">
        <?php  if(array_key_exists('user_prof_summary', $user['usermeta'])) echo $user_prof_summary['user_current_desg']; else echo "";?>
        </p> 
        <hr>
        -->
        <strong><i class="fa fa-calendar margin-r-5"></i> Birthday </strong>

        <p class="text-muted"><?php  if(array_key_exists('user_pers_summary', $user['usermeta'])) echo $user_pers_summary['dob']; else echo "";?></p>

        <hr>
        <strong><i class="fa fa-building margin-r-5"></i> Current Organisation</strong>

        <p class="text-muted"><?php  if(array_key_exists('user_prof_summary', $user['usermeta'])) echo $user_prof_summary['user_current_org']; else echo "";?></p>

        <hr>
        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

        <p class="text-muted"><?php  if(array_key_exists('user_prof_summary', $user['usermeta'])) echo $user_prof_summary['user_ofc_loc']; else echo "";?></p>

        <hr>

        <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

        <p>
          <?php if($skills != "") {
                foreach($skills as $skill){
          ?>
          <span class="label label-danger"><?php echo $skill;?></span>
          <?php } } ?>
        </p>

        <hr>

        <strong><i class="fa fa-file-text-o margin-r-5"></i> Professional Summary </strong>

        <p><?php  if(array_key_exists('user_prof_summary', $user['usermeta'])) echo $user_prof_summary['user_prof_notes']; else echo "";?></p>
        <hr>

        <strong><i class="fa fa-file-text-o margin-r-5"></i> Personal Summary </strong>

        <p><?php  if(array_key_exists('user_pers_summary', $user['usermeta'])) echo $user_pers_summary['user_pers_notes']; else echo "";?></p>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  </div>  
<!-- /.row -->

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
