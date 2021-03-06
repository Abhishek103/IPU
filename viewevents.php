<?php
require_once("includes/functions.php"); 
session_start();
if(!isset($_SESSION["user_id"]))
{
  header('Location: login.php');
}
if(!isset($_SESSION["admin"]))
{
  header('Location: login.php');
}
if(isset($_POST['deleteEvent']))
{
  deleteEvent($_POST['deleteEvent']);
}
$user_count = countusers();
$year =  date("Y");
$events = getEventDetails();

?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>USMS| Events</title>
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
  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
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
              <img src="assets/img/avatar.png" class="user-image" alt="User Image">
              <span class="hidden-xs">Admin</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="assets/img/avatar.png" class="img-circle" alt="User Image">
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div align="center">
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
          <img src="assets/img/avatar.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Admin</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="admin.php" class="active"><i class="fa fa-user"></i> Admin View</a></li>
          </ul>
        </li>
        <li class="treeview ">
          <a href="#">
            <i class="fa fa-server"></i> <span>Batches</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php for($year_start = 1998; $year_start<=$year; $year_start++) { $year_end = $year_start + 2;?>
              <li><a href="batch.php?batch=<?php echo $year_start."-".$year_end?>" ><i class="fa fa-calendar"></i>
                <?php echo $year_start."-".$year_end;?></a>
              </li>
						<?php } ?>
          </ul>
        </li>
        <li class="treeview active menu-open">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Events</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="viewevents.php"><i class="fa fa-circle-o"></i> View Events</a></li>
            <li><a href="createevents.php"><i class="fa fa-circle-o"></i> Set Events</a></li>
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
        Events List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Events</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
  <!-- /.col -->
  <div class="col-sm-12">
    <div class="box box-solid">
      <div class="box-header with-border">
        <!-- <h3 class="box-title">Carousel</h3> -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
            <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
          </ol>
          <div class="carousel-inner">
            <div class="item active">
              <img src="http://placehold.it/1200x200/39CCCC/ffffff&text=USMS" alt="First slide">
              <div class="carousel-caption">
                First Slide
              </div>
            </div>
            <div class="item">
              <img src="http://placehold.it/1200x200/3c8dbc/ffffff&text=EVENTS" alt="Second slide">
              <div class="carousel-caption">
                Second Slide
              </div>
            </div>
            <div class="item">
              <img src="http://placehold.it/1200x200/f39c12/ffffff&text=ALUMNI+MEET" alt="Third slide">
              <div class="carousel-caption">
                Third Slide
              </div>
            </div>
          </div>
          <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="fa fa-angle-left"></span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="fa fa-angle-right"></span>
          </a>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
      <div class="row">
        <div class="col-xs-12">
  
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Events</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>Description</th>
                          <th>Start of the event</th>
                          <th>End of the event</th>
                          <?php if(isset($_SESSION['admin'])) { echo "<th>Action</th>";}?>
                      </tr>
                  </thead>
                  <tbody>
                      <?php foreach($events as $event){ ?>
                      <tr>
                        <td><?php echo $event['event_name'];?></td>
                        <td><?php echo $event['event_description'];?></td>
                        <td><?php echo $event['event_start'];?></td>
                        <td><?php echo $event['event_end'];?></td> 
                      <?php if(isset($_SESSION['admin'])) {?><td><button type="submit" align="center" class="btn btn-danger" name="deleteEvent" value="<?php echo $event['event_id'];?>">Delete events</button></td><?php } ?>                       
                      </tr>
                      <?php }?>
                  </tbody>
          
                </table>  							
              </form>  
            </div>
          <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
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
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'pageLength', 'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
    } );
} );

</script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/js/demo.js"></script>
</body>
</html>
