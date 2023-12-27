<head>
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <form action="loginprocess.php?mod=login" method="POST" name="login">
        <div class="form">
            <div class="container" style="padding-top: 15px;">
                <font size='6'>
                    <center>
                        Login
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
            <input type="text" name="user_email" class="form-control" size="4" required>
            </div>
        </div>

        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-2 label align offset-md-3">
                Password
            </label>
            <div class="col-md-6 col-sm-6 offset-md-3">
            <input type="password" name="pWord_login" class="form-control" size="4" required>
            </div>
        </div>

        <div class="item form-group" style="text-align: center;">
            <div class="col-md-6 col-sm-6 offset-md-3">
                Didn't have account? <a href="sign_up.php">Sign Up</a> here
            </div>
        </div>

        <div class="item form-group" style="text-align: center;">
            <div class="col-md-6 col-sm-6 offset-md-3">
                <input type="submit" name="login" class="btn btn-primary" value="Login">
            </div>
        </div>
    </form>
</body>