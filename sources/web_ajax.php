<?php
require_once "/var/www/html/sources/filemap.php";
// Initialize the session
// error_reporting(0);
session_name('sid');
session_start();
setcookie(session_name(),session_id(),time()+604800);
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	if ($_SESSION['level'] == 3) {
		header("location: staff-access");
	}
	else {
    header("location: user");
	}
    exit;
}
elseif (isset($_SESSION["userin"]) && $_SESSION["userin"] === true) {
    header("location: ".$homepath."user");
}
// Include config file
require_once $homepath."sources/config.php";
require_once $homepath."sources/sqlconnect.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "الرجاء إدخال اسم المستخدم..";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "الرجاء ادخال كلمة المرور.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password,admin,level,deactivated FROM accounts WHERE username = ?";
        
        if($stmt = mysqli_prepare($mysql, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $admin,$level,$deactivated);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            if ($deactivated == 0) {
                            // Password is correct, so start a new session
                            session_name('sid');
                            session_start();
                            setcookie(session_name(),session_id(),time()+604800);
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["admin"] = $admin;
                            $_SESSION["level"] = $level;
                                if(!isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
                                    $ip = $_SERVER['REMOTE_ADDR'];
                                }
                                else {
                                    $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
                                }                                  
                            $sql2 = "UPDATE accounts SET ip=?, seen=? WHERE username=?";

                            if($ipstmt = mysqli_prepare($mysql, $sql2)){       
                                // Bind variables to the prepared statement as parameters
                                mysqli_stmt_bind_param($ipstmt, "sss", $param_ip,$param_seen,$param_username);
                                $param_ip = $ip;
                                $param_seen = date("20y-m-d, h:i:s");
                            }
                            if(mysqli_stmt_execute($ipstmt)){
                                // Redirect to login page
                                if ($level == 3){
                                	header("location: /staff-access");
                                }
                                else {
                                header("location: user");
                            	}
                            } else{
                             $login_err = "Something went wrong. Please try again later.<br><br>";
                            }                            
                        }
                            elseif ($deactivated == 1) {
                                $login_err = "Your account has been deactiavted for violating our terms of use..<br><br>";
                            }
                    }
                                             else{
                            // Display an error message if password is not valid
                            $password_err = "Incorrect password";
                        }
                }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "Username does not exist";
                }
            } else{
                $login_err = "هناك خطأ ما. الرجاء معاودة المحاولة في وقت لاحق.. <br><br>";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($mysql);
}
?>