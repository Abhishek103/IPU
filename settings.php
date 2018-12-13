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
if(isset($_POST['orgSubmit']))
{
  $user_prof_summary = array(
    'user_current_desg' => $_POST['inputDesg'],
    'user_current_org' => $_POST['inputOrg'],
    'user_ofc_loc' => $_POST['inputLoc'],
    'user_ofc_no' => $_POST['inputOfcPhn'],
    'user_ofc_email' => $_POST['inputOfcEmail'],
    'user_skills' => $_POST['inputSkills'],
    'user_prof_notes' => $_POST['inputProfExperience']
  );
  updateUsermeta($usermetaName='user_prof_summary', json_encode($user_prof_summary), $user_id);
}
$user = json_decode(getUserById($user_id), true);
if(array_key_exists('user_prof_summary', $user['usermeta']))
{
  $user_prof_summary = json_decode($user['usermeta']['user_prof_summary'], true);
}  
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
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
              <img src="assets/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $user['name'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $user['name'];?> - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
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
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
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
          <img src="assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
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
            <li><a href="dashboard.php"><i class="fa fa-user-o"></i> Profile</a></li>
            <li><a href="events.php"><i class="fa fa-files-o"></i> Events</a></li>
            <li class="active"><a href="settings.php"><i class="fa fa-cogs"></i> Settings</a></li>
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
<div class="col-md-offset-1 col-md-10">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <!-- <li><a href="#activity" data-toggle="tab">Activity</a></li> -->
        <li class="active"><a href="#organisations" data-toggle="tab">Professional Information</a></li>
        <li><a href="#settings" data-toggle="tab">Personal Informaton</a></li>
        <li><a href="#password" data-toggle="tab">Security</a></li>
      </ul>
      <div class="tab-content">
        <!-- <div class="tab-pane" id="activity">
        
          <div class="post">
            <div class="user-block">
              <img class="img-circle img-bordered-sm" src="assets/img/user1-128x128.jpg" alt="user image">
                  <span class="username">
                    <a href="#">Jonathan Burke Jr.</a>
                    <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                  </span>
              <span class="description">Shared publicly - 7:30 PM today</span>
            </div>
           
            <p>
              Lorem ipsum represents a long-held tradition for designers,
              typographers and the like. Some people hate it and argue for
              its demise, but others ignore the hate as they create awesome
              tools to help create filler text for everyone from bacon lovers
              to Charlie Sheen fans.
            </p>
            <ul class="list-inline">
              <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
              <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
              </li>
              <li class="pull-right">
                <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                  (5)</a></li>
            </ul>

            <input class="form-control input-sm" type="text" placeholder="Type a comment">
          </div>
          
          <div class="post clearfix">
            <div class="user-block">
              <img class="img-circle img-bordered-sm" src="assets/img/user7-128x128.jpg" alt="User Image">
                  <span class="username">
                    <a href="#">Sarah Ross</a>
                    <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                  </span>
              <span class="description">Sent you a message - 3 days ago</span>
            </div>
       
            <p>
              Lorem ipsum represents a long-held tradition for designers,
              typographers and the like. Some people hate it and argue for
              its demise, but others ignore the hate as they create awesome
              tools to help create filler text for everyone from bacon lovers
              to Charlie Sheen fans.
            </p>

            <form class="form-horizontal">
              <div class="form-group margin-bottom-none">
                <div class="col-sm-9">
                  <input class="form-control input-sm" placeholder="Response">
                </div>
                <div class="col-sm-3">
                  <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send</button>
                </div>
              </div>
            </form>
          </div>
         

       
          <div class="post">
            <div class="user-block">
              <img class="img-circle img-bordered-sm" src="assets/img/user6-128x128.jpg" alt="User Image">
                  <span class="username">
                    <a href="#">Adam Jones</a>
                    <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                  </span>
              <span class="description">Posted 5 photos - 5 days ago</span>
            </div>
        
            <div class="row margin-bottom">
              <div class="col-sm-6">
                <img class="img-responsive" src="assets/img/photo1.png" alt="Photo">
              </div>
      
              <div class="col-sm-6">
                <div class="row">
                  <div class="col-sm-6">
                    <img class="img-responsive" src="assets/img/photo2.png" alt="Photo">
                    <br>
                    <img class="img-responsive" src="assets/img/photo3.jpg" alt="Photo">
                  </div>
                  <div class="col-sm-6">
                    <img class="img-responsive" src="assets/img/photo4.jpg" alt="Photo">
                    <br>
                    <img class="img-responsive" src="assets/img/photo1.png" alt="Photo">
                  </div>
                  
                </div>
                
              </div>
              
            </div>
            

            <ul class="list-inline">
              <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
              <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
              </li>
              <li class="pull-right">
                <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                  (5)</a></li>
            </ul>

            <input class="form-control input-sm" type="text" placeholder="Type a comment">
          </div>
        
        </div> -->
        <!-- /.tab-pane -->
        <div class="active tab-pane" id="organisations">
        <form class="form-horizontal" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <div class="form-group">
              <label for="inputOrg" class="col-sm-2 control-label"> Organisation</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputOrg" name="inputOrg" placeholder="Current Organisation" value="<?php  if(array_key_exists('user_prof_summary', $user['usermeta'])) echo $user_prof_summary['user_current_org']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputOrg" class="col-sm-2 control-label"> Current Designation</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputOrg" name="inputDesg" placeholder="Current Designation" value="<?php  if(array_key_exists('user_prof_summary', $user['usermeta'])) echo $user_prof_summary['user_current_desg']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputOfcPhn" class="col-sm-2 control-label">Office Number</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="inputOfcPhn" name="inputOfcPhn" placeholder="Office Phone Number" value="<?php  if(array_key_exists('user_prof_summary', $user['usermeta'])) echo $user_prof_summary['user_ofc_no']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputOfcEmail" class="col-sm-2 control-label">Office Email</label>
              <div class="col-sm-10">
                <input class="form-control" id="inputOfcEmail" name="inputOfcEmail" placeholder="Office Email" value="<?php  if(array_key_exists('user_prof_summary', $user['usermeta'])) echo $user_prof_summary['user_ofc_email']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputLoc" class="col-sm-2 control-label">Location</label>
              <div class="col-sm-10">
                <textarea type="text" class="form-control" id="inputLoc" name="inputLoc" placeholder="Current Location"><?php  if(array_key_exists('user_prof_summary', $user['usermeta'])) echo $user_prof_summary['user_ofc_loc']; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputSkills" class="col-sm-2 control-label">Skills</label>
              <div class="col-sm-10">
                <textarea type="text" class="form-control" id="inputSkills" name="inputSkills" placeholder="Skills"><?php  if(array_key_exists('user_prof_summary', $user['usermeta'])) echo $user_prof_summary['user_skills']; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputProfExperience" class="col-sm-2 control-label">Professional Summary</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="inputProfExperience" name="inputProfExperience" placeholder="Professional Summary" ><?php  if(array_key_exists('user_prof_summary', $user['usermeta'])) echo $user_prof_summary['user_prof_notes']; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger" name="orgSubmit">Submit</button>
              </div>
            </div>
          </form>
          
        </div>
        <!-- /.tab-pane -->

        <div class="tab-pane" id="settings">
          <form class="form-horizontal">
            <div class="form-group">
              <label for="inputName"  class="col-sm-2 control-label">Name</label>
              <div class="col-sm-10">
                <input type="text" disabled class="form-control" value="<?php echo $user['name'];?>" id="inputName" placeholder="Name">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="email" disabled class="form-control" value="<?php echo $user['email'];?>" id="inputEmail" placeholder="Email">
              </div>
            </div>
            <div class="form-group">
              <label for="dob" class="col-sm-2 control-label">Date Of Birth</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="datemask" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
              </div>
            </div>
            <div class="form-group">
              <label for="inputNum" class="col-sm-2 control-label">Phone Number</label>
              <div class="col-sm-10">
                <input type="Number" class="form-control" id="inputName" placeholder="Number">
              </div>
            </div>
            <div class="form-group">
              <label for="homeAddress" class="col-sm-2 control-label">Home Address</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="homeAddress" placeholder="Home Address"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPerExperience" class="col-sm-2 control-label">Personal Summary</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="inputPerExperience" placeholder="Personal Summary"></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label>
                    <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Submit</button>
              </div>
            </div>
          </form>
        </div>
        <div class="tab-pane" id="password">
          <form class="form-horizontal">
            <div class="" id="divCheckPasswordMatch"></div>
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">Change password</label>

              <div class="col-sm-10">
              <input type="password" name="password" placeholder="Password"  class="form-control" required id="txtNewPassword" />
              </div>
            </div>
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">Repeat Password</label>

              <div class="col-sm-10">
              <input type="Password" id="txtConfirmPassword" name="repeatPassword" placeholder="Repeat Password" required class="form-control"/>
              </div>
            </div>            
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-2">
              <button type="submit" name="submit" id="submit" value="Sign Up" class="btn btn-primary btn-block" onClick="return validate();"/>Change Password</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
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
<script src="assets/js/adminlte.js"></script>
<!-- InputMask -->
<script src="assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
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
<script>
   $(function () {
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
   })
</script>  
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