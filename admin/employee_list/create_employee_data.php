<head>
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
if (!isset($_SESSION['admin'])) {
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
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Employee Page</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Employee List -->
            <li class="nav-item">
                <a class="nav-link" href="employee_list.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Employee List</span></a>
            </li>

            <!-- Nav Item - Product List -->
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
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
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

                    <!-- Page Heading -->
                    <?php
                    include "../../connect/dbconnect.php";
                    if (isset($_POST['submit'])) {
                        $uid = $_POST['UID'];
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $position = $_POST['position'];
                        $phone = $_POST['phone'];
                        $gender = $_POST['gender'];
                       

                        $fileName = $_FILES['userfile']['name'];
                        $fileSize = $_FILES['userfile']['size'];
                        $fileType = $_FILES['userfile']['type'];
                        $fileTemp = $_FILES['userfile']['tmp_name'];

                        $file = fopen($fileTemp, "r");
                        $photouser = fread($file, filesize($fileTemp));
                        $photouser = addslashes($photouser);
                        fclose($file);

                        $check = mysqli_query($connection, "SELECT * FROM employee_data WHERE uid = '$uid' ");

                        if (mysqli_num_rows($check) == 0) {
                            $sql = mysqli_query($connection, "INSERT INTO employee_data(uid, name, email, position, phone, gender, namefile, typefile, size, picture) 
                            VALUES('$uid', '$name', '$email', '$position', '$phone', '$gender' , '$fileName', '$fileType', '$fileSize', '$photouser')");

                            if ($sql) {
                                echo
                                '<script>
                                    alert("Succesful");
                                    window.location="employee_list.php";             
                                </script>';
                            } else {
                                echo
                                '<script>
                                    alert("Failed to create data");
                                    window.location="employee_list.php";             
                                </script>';
                            }
                        } else {
                            echo
                            '<script>
                                alert("Employee is already on the list");
                                window.location="employee_list.php";             
                            </script>';
                        }
                    };
                    ?>

                    <form action="create_employee_data.php" method="POST" enctype="multipart/form-data">
                        <div class="form">
                            <div class="container" style="padding-top: 15px;">
                                <h1 class="h3 mb-0 text-gray-800 offset-md-5">Employee Data</h1>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-2 label align offset-md-3">
                                    UID
                                </label>
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <input type="text" name="UID" class="form-control" size="4" required>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label align offset-md-3">
                                    Name
                                </label>
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <input type="text" name="name" class="form-control" size="4" required>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label align offset-md-3">
                                    Email
                                </label>
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <input type="text" name="email" class="form-control" size="4" required>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label align offset-md-3">
                                    Position
                                </label>
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <select type="text" name="position" class="form-control" required>
                                        <option disabled selected>Choose Position</option>
                                        <option value="General Manager">General Manager</option>
                                        <option value="IT Support">IT Support</option>
                                        <option value="Accountant">Accountant</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label align offset-md-3">
                                    Phone
                                </label>
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <input type="text" name="phone" class="form-control" size="4" required>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label align offset-md-3">
                                    Gender
                                </label>
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <select type="text" name="gender" class="form-control" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-2 label align offset-md-3">
                                    Picture
                                </label>
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <input type="file" name="userfile" class="form-control" size="4" value="" required>
                                </div>
                            </div>

                            <div class="item form-group" style="text-align: center;">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Save">
                                    <a href="employee_list.php" class="btn btn-danger">Back</a>
                                </div>
                            </div>
                        </div>
                    </form>

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