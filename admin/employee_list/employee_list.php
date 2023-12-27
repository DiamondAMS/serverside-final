<head>
    <style>
        table.center {
            margin: auto;
        }

        .button {
            height: 150px;
            margin-left: 50%;
            position: relative;
        }

        .vertical-center {
            margin: 0;
            text-align: center;
            position: absolute;
            top: 50%;
            -ms-transform: translateX(-50%);
            transform: translateX(-50%);
        }
    </style>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<!-- Session Start -->
<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("location:../../logout/logout.php");
};
if (!isset($_SESSION['username'])) {
    header("location:../../login/mustLogin.php");
}
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="employee_list.php">
                <div class="sidebar-brand-text mx-3">Admin Page</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Absent -->
           

            <!-- Nav Item - Employee List -->
            <li class="nav-item">
                <a class="nav-link" href="employee_list.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Employee List</span></a>
            </li>

            <!-- Nav Item - Employee List -->
            <li class="nav-item">
                <a class="nav-link" href="../product_list/product_list.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Product List</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="../transaction_list/transaction.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Transaction List</span></a>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['admin']; ?></span>
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
                        <h1 class="h3 mb-0 text-gray-800">Employee Data</h1>
                        <a href="create_employee_data.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"></i> Create Data</a>
                    </div>

                    <div class="container">
                        <div class="table-responsive text-center" style="width: 110%; margin-left: -40px;">
                            <table class="table table-bordered jumbo_table bulk_action center" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Picture</th>
                                        <th>UID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Position</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                        <th>Delete/Update</th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php
                                    include "../../connect/dbconnect.php";
                                    $no = 1;
                                    $data = mysqli_query($connection, "SELECT * FROM employee_data ORDER BY id");
                                    
                                    while ($display = mysqli_fetch_array($data)) {
                                        $id = $display['uid'];
                                        echo "
                                            <tr>
                                                <td>" . $no . "</td>
                                                <td style='width: fit-content;'> <img src='pictureshow.php?uid=$id' width='200' height='150'/> </td>
                                                <td>" . $display['uid'] . "</td>
                                                <td>" . $display['name'] . "</td>
                                                <td>" . $display['email'] . "</td>
                                                <td>" . $display['position'] . "</td>
                                                <td>" . $display['phone'] . "</td>
                                                <td>" . $display['gender'] . "</td>
                                                <td>
                                                    <a href='delete_employee_data.php?uid=$id'
                                                        class='btn btn-danger btn-sm'
                                                        onclick='return confirm(\'Delete employee?\')'>Delete
                                                    </a>
                                                    <a href='update_employee_data.php?uid=$id'
                                                        class='btn btn-warning btn-sm'>
                                                        Update
                                                    </a>
                                                </td>
                                            </tr>";
                                        $no++;
                                    };
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                        <a class="btn btn-primary" href="../../logout/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="../../vendor/jquery/jquery.min.js"></script>
        <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../../js/sb-admin-2.min.js"></script>

</body>