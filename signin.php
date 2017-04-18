<?php
session_start();

if(isset($_SESSION['usr_id'])!="") {
    header("Location: index.php");
}

include_once ("config_mb/configure_mb.php");

//check if form is submitted
if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($dbc, $_POST['email']);
    $password = mysqli_real_escape_string($dbc, $_POST['password']);
    $result = mysqli_query($dbc, "SELECT * FROM sys_signup WHERE email = '" . $email. "' and password = '" . md5($password) . "'");

    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['usr_id'] = $row['id'];
        $_SESSION['usr_name'] = $row['name'];
        header("Location: index.php");
    } else {
        $errormsg = "Incorrect Email or Password!!!";
    }
}
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sign In</title>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/custom.css">
</head>

<body>

<div class="container-customss">
    <div class="row-custom">
        <div class="col-md-4 well well-sm well-custom">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
            <fieldset>
                    <legend>Login</legend>
                    
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="text" name="email" placeholder="Your Email" required class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" name="password" placeholder="Your Password" required class="form-control" />
                    </div>

                    <div class="form-group">
                        <input type="submit" name="login" value="Login" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">    
        New User? <a href="signup.php">Sign Up Here</a>
        </div>
    </div>
</div>

 <!-- Load jQuery and bootstrap datepicker scripts -->
        <script src="js/jquery-3.1.0.min.js"></script>
</body>
</html>
