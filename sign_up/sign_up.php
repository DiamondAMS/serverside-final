<head>
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<?php
include "../connect/dbconnect.php";
if (isset($_POST['submit'])) {
    // TO GET USER INPUT
    $sign_up_email = $_POST['sign_up_email'];
    $userid = $_POST['userid'];
    $sign_up_pword = $_POST['sign_up_pword'];

    

    // TO CHECK IF DATA IS ALREADY EXIST
    $check = mysqli_query($connection, "SELECT * FROM user_data WHERE email = '$sign_up_email'");

    // TO CHECK IF DATA INPUTTED TO DATABASE IS SUCCESS
    if (mysqli_num_rows($check) == 0) {

        // TO SENT USER INPUT TO DATABASE
        $sign_up_query = "INSERT INTO user_data(email, username, password, user_type) VALUES('$sign_up_email', '$userid', '$sign_up_pword', 'user')";
        $sign_up = mysqli_query($connection, $sign_up_query);

        if ($sign_up) {
            echo                                   
            '<script> 
                alert("Sign Up success!");       
                window.location = "../login/login.php";   
            </script>';                            
        } else {                                 
            echo                                   
            '<script>                            
                alert("Sign Up failed");         
            </script>';                             
        }                                          
    } else {
        echo
        '<script>
            alert("Email has been registered");
        </script>';
    }
};
?>

<body>
    <form action="sign_up.php" method="POST">
        <div class="form">
            <div class="container" style="padding-top: 15px;">
                <font size='6'>
                    <center>
                        Sign Up
                    </center>
                </font>
            </div>
        </div>
        <hr>

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-2 label align offset-md-3">
                Email
            </label>
            <div class="col-md-6 col-sm-6 offset-md-3">
                <input type="text" name="sign_up_email" class="form-control" size="4" required>
            </div>
        </div>

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-2 label align offset-md-3">
                Username
            </label>
            <div class="col-md-6 col-sm-6 offset-md-3">
                <input type="text" name="userid" class="form-control" size="4" required>
            </div>
        </div>

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-2 label align offset-md-3">
                Password
            </label>
            <div class="col-md-6 col-sm-6 offset-md-3">
                <input type="password" name="sign_up_pword" class="form-control" size="4" required>
            </div>
        </div>

        <div class="item form-group" style="text-align: center;">
            <div class="col-md-6 col-sm-6 offset-md-3">
                already have an account? <a href="login.php">Login</a> here
            </div>
        </div>

        <div class="item form-group" style="text-align: center;">
            <div class="col-md-6 col-sm-6 offset-md-3">
                <input type="submit" name="submit" class="btn btn-primary" value="Sign Up">
            </div>
        </div>
    </form>
</body>