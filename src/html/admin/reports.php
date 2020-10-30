<?php
    session_start();
    require_once('../../database/db.php');

    if(!isset($_SESSION['id'])){
      header('Location: ../authentication-login1.php');
    }

    if($_SESSION['role']!=1 || empty($_SESSION['role'])){
      header('Location: ../error.html');
    }

    $sql = "SELECT full_name, image_url FROM user WHERE user_id=".$_SESSION['id']."";
    $query_result = mysqli_query($conn, $sql);
    while($record = mysqli_fetch_assoc($query_result)) {
      $user_info[] = $record;
    }
    $image_path=json_decode($user_info[0]['image_url'], true);
    //TOTAL PRODUCTS SOLD THIS WEEK
    $sql = "SELECT SUM(po.quantity) as total FROM product_order po, customer_order co WHERE po.order_id=co.order_id AND DATE(co.date_ordered)
    BETWEEN DATE_SUB(DATE(NOW()), INTERVAL (WEEKDAY(NOW()) - 1 + 7) % 7 DAY)
    AND DATE_ADD(DATE(NOW()), INTERVAL 6 - (WEEKDAY(NOW()) - 7 + 7) % 7 DAY);";
    $query_result = mysqli_query($conn, $sql);
    while($record = mysqli_fetch_assoc($query_result)) {
      $total_products_sold[] = $record;
    }
    $total_products_sold=$total_products_sold[0]['total'];
    //TOTAL PRODUCTS IN STOCK
    $sql = "SELECT SUM(quantity) as total FROM product";
    $query_result = mysqli_query($conn, $sql);
    while($record = mysqli_fetch_assoc($query_result)) {
      $total_products_stock[] = $record;
    }
    $total_products_stock=$total_products_stock[0]['total'];
    //TOTAL PURCHASE
    $sql = "SELECT COUNT(order_id) as total FROM customer_order WHERE DATE(date_ordered)
    BETWEEN DATE_SUB(DATE(NOW()), INTERVAL (WEEKDAY(NOW()) - 1 + 7) % 7 DAY)
    AND DATE_ADD(DATE(NOW()), INTERVAL 6 - (WEEKDAY(NOW()) - 7 + 7) % 7 DAY);";
    $query_result = mysqli_query($conn, $sql);
    while($record = mysqli_fetch_assoc($query_result)) {
      $total_purchase[] = $record;
    }
    $total_purchase=$total_purchase[0]['total'];
    //total Income
    $sql = "( SELECT p.product_id, p.image_url, SUM(po.quantity) AS quantity_sold, p.cost_price, p.price FROM product p, product_order po, customer_order co WHERE p.product_id = po.product_id AND po.order_id=co.order_id AND DATE(date_ordered) BETWEEN DATE_SUB(DATE(NOW()), INTERVAL (WEEKDAY(NOW()) - 1 + 7) % 7 DAY) AND DATE_ADD(DATE(NOW()), INTERVAL 6 - (WEEKDAY(NOW()) - 7 + 7) % 7 DAY) GROUP BY p.product_id ) UNION ( SELECT product_id, image_url, NULL, cost_price, price FROM product WHERE product_id NOT IN( SELECT p.product_id FROM product p, product_order po WHERE p.product_id = po.product_id GROUP BY product_id ) ) ORDER BY `product_id` ASC";
    $query_result = mysqli_query($conn, $sql);
    while($record = mysqli_fetch_assoc($query_result)) {
      $products_income[] = $record;
    }
    $total_income=0;
    for($i=0;$i<count($products_income);$i++){
      $quantity_sold=$products_income[$i]['quantity_sold'];
      if($quantity_sold==NULL){
        $quantity_sold=0;
      }
      $cost_price=$products_income[$i]['cost_price'];
      $price=$products_income[$i]['price'];
      $income=$price-$cost_price;
      $total=$income*$quantity_sold;
      $total_income+=$total;
    }
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--links for css print and print preview -->
    <link rel="stylesheet" type="text/css" href="../../css/print.css" />
    <link rel="stylesheet" type="text/css" href="../../css/Style.css" />
    <!-- Favicon icon -->
    <link rel="icon" href="../../assets/images/favicon.ico" />
    <title>A.F.A Printing Services & More</title>
    <!-- Custom CSS -->
    <link href="../../assets/libs/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="../../dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <!-- Logo icon -->
                        <a href="index.php">
                            <b class="logo-icon">
                                <!-- Dark Logo icon -->
                                <img src="../../assets/images/logo-icon-1.svg" alt="homepage" class="dark-logo" />
                                <!-- Light Logo icon -->
                                <img src="../../assets/images/logo-icon-1.svg" alt="homepage" class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span class="logo-text">
                                <!-- dark Logo text -->
                                <img src="../../assets/images/logo-text-1.svg" alt="homepage" class="dark-logo" />
                                <!-- Light Logo text -->
                                <img src="../../assets/images/logo-light-1.svg" class="light-logo" alt="homepage" />
                            </span>
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                      <li class="nav-item d-none d-md-block">
                          <a class="nav-link" href="javascript:void(0)">
                              <form>
                                  <div class="customize-input">
                                      <input class="form-control custom-shadow custom-radius border-0 bg-white"
                                          type="search" placeholder="Search" aria-label="Search">
                                      <i class="form-control-icon" data-feather="search"></i>
                                  </div>
                              </form>
                          </a>
                      </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <?php echo"<img src='../../assets/images/users/".$image_path['path']."' alt='user' class='rounded-circle'
                                    width='40'>"; ?>
                                <span class="ml-2 d-none d-lg-inline-block"><span>Hello,</span> <span
                                        class="text-dark"><?php echo $user_info[0]['full_name']; ?></span> <i data-feather="chevron-down"
                                        class="svg-icon"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <a class="dropdown-item" href="./profile.php"><i data-feather="user"
                                        class="svg-icon mr-2 ml-1"></i>
                                    My Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php"><i data-feather="power"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Logout</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">

                    <li class="list-divider"></li>

                    <li class="sidebar-item"> <a class="sidebar-link" href="index.php"
                            aria-expanded="false"><i data-feather="user" class="feather-icon"></i><span
                                class="hide-menu">Users</span></a>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="stock.php"
                            aria-expanded="false"><i data-feather="archive" class="feather-icon"></i><span
                                class="hide-menu">Stock</span></a>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="products.php"
                            aria-expanded="false"><i data-feather="box" class="feather-icon"></i><span
                                class="hide-menu">Products</span></a>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="reports.php"
                            aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                class="hide-menu">Reports</span></a>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="income.php"
                        aria-expanded="false"><i data-feather="trending-up" class="feather-icon"></i><span
                            class="hide-menu">Income</span></a>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="profile.php"
                        aria-expanded="false"><i data-feather="user" class="feather-icon"></i><span
                            class="hide-menu">Profile</span></a>
                    </li>

                        <li class="list-divider"></li>


                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="../logout.php"
                                aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                                    class="hide-menu">Logout</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <div class="col-12">
                <div id="printarea" class="card">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th colspan="2" scope="col">Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">Total Products Sold</td>
                                    <td><?php echo $total_products_sold; ?></td>
                                </tr>
                                <tr>
                                    <td scope="row">Total Products in Stock</td>
                                    <td><?php echo $total_products_stock; ?></td>
                                </tr>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th colspan="2" scope="col">Income</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">Total Purchase &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td><?php echo $total_purchase; ?></td>
                                </tr>
                                <tr>
                                    <td scope="row">Total Income</td>
                                    <td><?php echo $total_income; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 mt-4">
                  <input type="button" value="Print Preview" class="btn btn-primary" onclick="PrintPreview()"/>
                  <input type="button" value="Print" class="btn btn-primary ml-3" onclick="PrintDoc()"/>
                </div>
            </div>
            <!-- footer -->
            <!-- ============================================================== -->
            <!-- <footer class="footer text-center">
                All Rights Reserved by Adminmart. Designed and Developed by <a
                    href="https://wrappixel.com">WrapPixel</a>.
            </footer> -->
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../assets/extra-libs/taskboard/js/jquery.ui.touch-punch-improved.js"></script>
    <script src="../../assets/extra-libs/taskboard/js/jquery-ui.min.js"></script>
    <script src="../../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="../../dist/js/app-style-switcher.js"></script>
    <script src="../../dist/js/feather.min.js"></script>
    <script src="../../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="../../assets/libs/moment/min/moment.min.js"></script>
    <script src="../../assets/libs/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="../../dist/js/pages/calendar/cal-init.js"></script>
    <script type="text/javascript">
      /*--This JavaScript method for Print command--*/
          function PrintDoc() {
              var toPrint = document.getElementById('printarea');
              var popupWin = window.open('', '_blank', 'width=350,height=150,location=no,left=200px');
              popupWin.document.open();
              popupWin.document.write('<html><title>::Preview::</title><link rel="stylesheet" type="text/css" href="print.css" /></head><body onload="window.print()">')
              popupWin.document.write(toPrint.innerHTML);
              popupWin.document.write('</html>');
              popupWin.document.close();
          }
      /*--This JavaScript method for Print Preview command--*/
          function PrintPreview() {
              var toPrint = document.getElementById('printarea');
              var popupWin = window.open('', '_blank', 'width=350,height=150,location=no,left=200px');
              popupWin.document.open();
              popupWin.document.write('<html><title>::Print Preview::</title><link rel="stylesheet" type="text/css" href="Print.css" media="screen"/></head><body">')
              popupWin.document.write(toPrint.innerHTML);
              popupWin.document.write('</html>');
              popupWin.document.close();
          }
      </script>
</body>

</html>
