<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin - SCEEMS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
  page. However, you can choose any other skin. Make sure you
  apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

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
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<!-- REQUIRED JS SCRIPTS -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/custom_api.js"></script>

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<body onload = "loadDataBudgetSet()" class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b> S C E E M S</span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Tables</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="index.php"><i class="fa fa-link"></i> <span>User Account</span></a></li>
            <li><a href="bill_cycle.php"><i class="fa fa-link"></i> <span>Bill Cycle</span></a></li>
            <li class="active"><a href="budget_set.php"><i class="fa fa-link"></i> <span>Budget Set</span></a></li>
            <li><a href="power_switch.php"><i class="fa fa-link"></i> <span>Power Switch</span></a></li>
            <li><a href="price_rates.php"><i class="fa fa-link"></i> <span>Price Rates</span></a></li>
          </ul>
          <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Budget Set
            <small>SCEEMS Users</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">User Budget Set Data Table</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Budget Set ID</th>
                        <th>Account ID</th>
                        <th>Budget Set</th>
                        <th>Budget Consumed</th>
                        <th>Kilowatts Consumed</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Budget Set Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id ="Budget_set_table">

                    </tbody>

                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          Anything you want
        </div>
        <!-- Default to the left -->

      </footer>

      <!-- Add the sidebar's background. This div must be placed
      immediately after the control sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php
    include "connection.php";
    $sql = "SELECT * FROM budget_set;";
    $result = $conn ->query($sql);
    while($row = $result->fetch_assoc()){
      ?>
      <!-- Update Modal Start-->
      <div id="update_Budget_Set_Modal<?php echo $row['budget_set_id'];?>" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><b>Update Budget Set status</b></h4>
            </div>
            <div class="modal-body">
              <form id ="update_Budget_Set_form<?php echo $row['budget_set_id'];?>" enctype="multipart/form-data">
                <label style = "color:#000;">Budget Set ID:</label>
                <input type = "text" class= "form-control" name ="budget_set_id" value ="<?php echo $row['budget_set_id'];?>" readonly/>
                <label style = "color:#000;">Account ID:</label>
                <input type = "text" class= "form-control" name ="account_id" value ="<?php echo $row['account_id'];?>" readonly/>
                <label style = "color:#000;">Budget Set:</label>
                <input type = "text" class= "form-control" name = "budget_set" value ="<?php echo $row['budget_set'];?> " readonly />
                <label style = "color:#000;">Budget Consumed:</label>
                <input type = "text" class= "form-control" name = "budget_consumed" value ="<?php echo $row['budget_consumed'];?> " readonly/>
                <label style = "color:#000;">  Kilowatts Consumed:</label>
                <input type = "text" class= "form-control" name = "kilowatts_consumed" value ="<?php echo $row['kilowatts_consumed'];?> " readonly/>
                <label style = "color:#000;">Month:</label>
                <select class="form-control" name="month" readonly >
                  <option><?php echo $row['month'];?></option>
                  <option>January</option>
                  <option>February</option>
                  <option>March</option>
                  <option>April</option>
                  <option>May</option>
                  <option>June</option>
                  <option>July</option>
                  <option>August</option>
                  <option>September</option>
                  <option>October</option>
                  <option>November</option>
                  <option>December</option>
                </select>
                <label style = "color:#000;">Year:</label>
                <input type = "text" class= "form-control" name = "year" value ="<?php echo $row['year'];?>" readonly/>
                <label style = "color:#000;">Budget Set status:</label>
                <select class="form-control" name="budget_set_status" >
                  <option><?php echo $row['budget_set_status'];?></option>
                  <option>Active</option>
                  <option>Deactive</option>
                </select>
              </div>
              <div class="modal-footer">

                <button type="submit" class="btn">Save</button>
                <button type="button" class="btn" data-dismiss="modal">Close</button>
              </form>
            </div>
          </div>

        </div>
      </div>
    <?php } ?>
    <!-- Update Modal End-->




    <!-- Optionally, you can add Slimscroll and FastClick plugins.
    Both of these plugins are recommended to enhance the
    user experience. -->
  </body>
  </html>

<script>
$('#add_Budget_Set_form').on('submit',(function(e) {
  e.preventDefault();
  var formData = new FormData(this);

  $.ajax({
    type:'POST',
    url: "dist/api/add_budget_set.php",
    data:formData,
    cache:false,
    contentType: false,
    processData: false,
    success:function(data){
      console.log("success");
      console.log(data);
    loadDataBudgetSet();
      //window.location.href = "gaming_admin.php";
    },
    error: function(data){
      console.log("error");
      console.log(data);
    }
  });
}));
<?php
$sql = "SELECT * FROM budget_set;";
$result = $conn ->query($sql);
while($row = $result->fetch_assoc()){
  ?>
$('#update_Budget_Set_form<?php echo $row['budget_set_id'];?>').on('submit',(function(e) {
  e.preventDefault();
  var formData = new FormData(this);

  $.ajax({
    type:'POST',
    url: "dist/api/update_budget_set.php",
    data:formData,
    cache:false,
    contentType: false,
    processData: false,
    success:function(data){
      console.log("success");
      console.log(data);
      loadDataBudgetSet();
      //window.location.href = "gaming_admin.php";
    },
    error: function(data){
      console.log("error");
      console.log(data);
    }
  });
}));
<?php } ?>
</script>
