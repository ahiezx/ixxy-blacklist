<?php
require_once("create_web_ajax.php");
?>
    <div class="login-panel">
        <img src="assets/image/logo-white.png" width="114" height="64"><br><BR>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>اسم المستخدم</label><br>
                <label class="error_code"><?php echo $username_err; ?></label>             
                <input type="text" name="username" class="input" value="<?php echo $username; ?>">
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>كلمة المرور</label><br>
                <label class="error_code"><?php echo $password_err; ?></label>                
                <input type="password" name="password" class="input" value="<?php echo $password; ?>">
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>تأكيد كلمة المرور</label><br>
                <label class="error_code"><?php echo $confirm_password_err; ?></label>
                <input type="password" name="confirm_password" class="input" value="<?php echo $confirm_password; ?>">
            </div>
            <div class="form-group">
                <input type="submit" class="btnx bgred" value="Submit">
                <a type="reset" class="btnx bgwhite" href="login">Login</a>
            </div>
        </form>
    </div>

<!-- <html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="input" value="<?php echo $username; ?>">
                <label class="error_code"><?php echo $username_err; ?></label>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="input" value="<?php echo $password; ?>">
                <label class="error_code"><?php echo $password_err; ?></label>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="input" value="<?php echo $confirm_password; ?>">
                <label class="error_code"><?php echo $confirm_password_err; ?></label>
            </div>
            <div class="form-group">
                <input type="submit" class="btnx bgwhite" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html> -->