<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Custom fonts for this template -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<!-- Session Start -->
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location:../logout/logout.php");
};
if (!isset($_SESSION['username'])) {
    header("location:../login/mustLogin.php");
}
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="sales.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Employee Page</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Absent -->

            <li class="nav-item">
                <a class="nav-link" href="sales.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Cashier</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['user']; ?></span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Product List</h1>

                    </div>

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Product Code</th>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Category</th>
                                                <th>Remaining Stock</th>
                                                <th>Add to Cart</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include "../connect/dbconnect.php";
                                            $no = 1;
                                            $data = mysqli_query($connection, "SELECT * FROM product_list ORDER BY code");
                                            while ($display = mysqli_fetch_array($data)) {
                                                echo '
                                                    <tr>
                                                        <td>' . $no . '</td>
                                                        <td>' . $display['code'] . '</td>
                                                        <td>' . $display['name'] . '</td>
                                                        <td>' . number_format($display['price']) . '</td>
                                                        <td>' . $display['category'] . '</td>
                                                        <td>' . $display['stock'] . '</td>
                                                        <td>
                                                        <a href="add.php?code=' . $display['code'] . '"
                                                            class="btn btn-warning btn-sm">Add to cart
                                                        </td>
                                                    </tr>';
                                                $no++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <td>No</td>
                                                <td>Product Code</td>
                                                <td>Amount</td>
                                                <td>Price</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total_bayar = 0;
                                            $nomor = 1;
                                            $sales = mysqli_query($connection, "SELECT sales.id, sales.code, product_list.name, sales.qty, sales.price FROM sales INNER JOIN product_list ON sales.code = product_list.code"); ?>
                                            <?php foreach ($sales as $row) {; ?>
                                                <tr>
                                                    <td><?php echo $nomor; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td>
                                                        <form method="POST" action="update_calc.php?sale=sales">
                                                            <input type="number" name="qty" value="<?php echo $row['qty']; ?>" class="form-control">
                                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" class="form-control">
                                                            <input type="hidden" name="product_id" value="<?php echo $row['code']; ?>" class="form-control">
                                                    </td>
                                                    <td>Rp.<?php echo number_format($row['price']); ?>,-</td>
                                                    <td>
                                                        <button type="submit" class="btn btn-warning">Update</button>
                                                        </form>
                                                        <a href="delete_calc.php?sale=sales&id=<?php echo $row['id']; ?>&item=<?php echo $row['code']; ?>
                                                    &qty=<?php echo $row['qty']; ?>" class="btn btn-danger">DELETE</a>
                                                    </td>
                                                </tr>
                                            <?php $nomor++;
                                                $total_bayar += $row['price'];
                                            } ?>
                                        </tbody>
                                    </table>
                                    <br />
                                    
                                    <div id="cashier">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <form method="POST" action="payment.php?receipt=yes">
                                                <?php foreach($sales as $row_sales){;?>
                                                    <input type="hidden" name="code[]" value="<?php echo $row_sales['code'];?>">
                                                    <input type="hidden" name="qty[]" value="<?php echo $row_sales['qty'];?>">
                                                    <input type="hidden" name="price[]" value="<?php echo $row_sales['price'];?>">
                                                <?php $nomor++; }?>
                                                <tr>
                                                    <td>Grand Total</td>
                                                    <td><input type="text" class="form-control" name="total" value="<?php echo $total_bayar;?>"></td>
                                                    <td>Pay</td>
                                                    <td><input type="text" class="form-control" name="pay"></td>
                                                    <td>
                                                        <button class="btn btn-success">PAY</button>
                                                            <a class="btn btn-danger" href="delete_item.php?sale=sales">
                                                                RESET
                                                            </a>
                                                    </td>
                                                </tr>
                                            </form>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

</body>