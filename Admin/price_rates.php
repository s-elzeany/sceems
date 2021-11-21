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

<body onload = "loadDataPriceRates()" class="hold-transition skin-blue sidebar-mini">
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
            <li><a href="budget_set.php"><i class="fa fa-link"></i> <span>Budget Set</span></a></li>
            <li><a href="power_switch.php"><i class="fa fa-link"></i> <span>Power Switch</span></a></li>
            <li class="active"><a href="price_rates.php"><i class="fa fa-link"></i> <span>Price Rates</span></a></li>
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
            Price Rates
            <small>SCEEMS Users</small>
          </h1>

          <a href="#" data-toggle="modal" data-target="#add_Price_Rates_Modal"> Add new Price Rate</a>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Price Rates Data Table</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Price Rates ID</th>
                        <th>Account Type</th>
                        <th>Rate Name</th>
                        <th>Rate</th>
                        <th>Rate Date Inserted</th>
                        <th>Rate Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id ="Price_rates_table">

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
    <!-- Modal add start-->
    <div id="add_Price_Rates_Modal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><b>Add a new Price Rate</b></h4>
          </div>
          <div class="modal-body">
            <form id ="add_Price_Rates_form" enctype="multipart/form-data">
              <label style = "color:#000;">Rate Name:</label>
              <input type = "text" class= "form-control" name ="rate_name"/>
              <label style = "color:#000;">Rate:</label>
              <input type = "text" class= "form-control" name = "rate"/>
              <label style = "color:#000;">Account Type:</label>
              <select class="form-control" name="account_type_name" >
                <?php
                include "connection.php";
                $sqlaccType = "SELECT name FROM account_type;";
                $resultaccType = $conn ->query($sqlaccType);
                while($row = $resultaccType->fetch_assoc()){
                  ?>
                  <option> <?php echo $row['name'];?></option>
                <?php } ?>
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
    <!-- Modal end-->

    <?php
    include "connection.php";
    $sql = "SELECT PR.price_rates_id, PR.rate_name, PR.rate, PR.rate_date, PR.rate_status, AcT.name AS 'account_type_name' FROM price_rates PR JOIN account_type AcT ON PR.account_type_id = AcT.account_type_id;";
    $result = $conn ->query($sql);
    while($row = $result->fetch_assoc()){
      ?>
      <!-- Update Modal Start-->
      <div id="update_Price_Rates_modal<?php echo $row['price_rates_id'];?>" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content" >
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><b>Update Price Rate</b></h4>
            </div>
            <div class="modal-body">
              <form id ="update_Price_Rates_form<?php echo $row['price_rates_id'];?>" enctype="multipart/form-data">
                <input type = "hidden" class= "form-control" name ="price_rates_id" value ="<?php echo $row['price_rates_id'];?>" readonly/>
                <label style = "color:#000;">Rate Name:</label>
                <input type = "text" class= "form-control" name ="rate_name" value ="<?php echo $row['rate_name'];?>"/>
                <label style = "color:#000;">Rate:</label>
                <input type = "text" class= "form-control" name = "rate" value ="<?php echo $row['rate'];?>"/>
                <label style = "color:#000;">Account Type:</label>
                <select class="form-control" name="account_type_name" >
                  <option> <?php echo $row['account_type_name'];?></option>
                  <?php
                  include "connection.php";
                  $sqlaccType = "SELECT name FROM account_type;";
                  $resultaccType = $conn ->query($sqlaccType);
                  while($row = $resultaccType->fetch_assoc()){
                    ?>
                    <option> <?php echo $row['name'];?></option>
                  <?php } ?>
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
$('#add_Price_Rates_form').on('submit',(function(e) {
  e.preventDefault();
  var formData = new FormData(this);

  $.ajax({
    type:'POST',
    url: "dist/api/add_price_rates.php",
    data:formData,
    cache:false,
    contentType: false,
    processData: false,
    success:function(data){
      console.log("success");
      console.log(data);
    loadDataPriceRates();
      //window.location.href = "gaming_admin.php";
    },
    error: function(data){
      console.log("error");
      console.log(data);
    }
  });
}));
<?php
include "connection.php";
$sql = "SELECT PR.price_rates_id, PR.rate_name, PR.rate, PR.rate_date, PR.rate_status, AcT.name AS 'account_type_name' FROM price_rates PR JOIN account_type AcT ON PR.account_type_id = AcT.account_type_id;";
$result = $conn ->query($sql);
while($row = $result->fetch_assoc()){
  ?>
$('#update_Price_Rates_form<?php echo $row['price_rates_id'];?>').on('submit',(function(e) {
  e.preventDefault();
  var formData = new FormData(this);

  $.ajax({
    type:'POST',
    url: "dist/api/update_price_rates.php",
    data:formData,
    cache:false,
    contentType: false,
    processData: false,
    success:function(data){
      console.log("success");
      console.log(data);
      loadDataPriceRates();
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
