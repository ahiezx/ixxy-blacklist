<?php
require_once("web_ajax.php");
?>
	<div class="login-panel">
        <div class="logininfo">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>اسم المستخدم</label><br>
                <label class="error_code"><?php echo $username_err; ?></label>
                <input type="text" name="username" class="input" value="<?php echo $username; ?>">
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>كلمة المرور</label><br>
                <label class="error_code"><?php echo $password_err; ?></label>
                <input type="password" name="password" class="input">
            </div>
            <div class="form-group">
                <label class="error_code"><p><?php echo $login_err; ?></p></label>
                <input type="submit" class="btnx bgred">
                <a href="signup" class="btnx bgwhite">Sign Up</a>
            </div>
        </form>
    </div>
	</div>