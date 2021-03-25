<?php
// Include config file
require_once "/var/www/html/sources/filemap.php";
require_once $homepath."sources/config.php";
require_once $homepath."sources/sqlconnect.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    }
    elseif(!preg_match("/[A-Za-z0-9_]/", trim($_POST["username"])) || preg_match("/([%\$#\*\s]+)/", trim($_POST["username"])) || preg_match("/([أ-ي]+)/", trim($_POST["username"]))) {
        $username_err = "Username does not support spaces or special characters";
    }
    elseif(strlen(trim($_POST["username"])) > 32){
        $username_err = "Please use a shorter username, less than 32 characters.";
    }
     else{
        // Prepare a select statement
        $sql = "SELECT id FROM accounts WHERE username = ?";
        
        if($stmt = mysqli_prepare($mysql, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO accounts (username, password, creation, seen, version, ip) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($mysql, $sql)){    	
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $param_password, $param_creation, $param_seen, $param_version, $param_protocol);

			// Get Protocol            

			if(!isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			else {
				$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
			}                  

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_creation = date("20y-m-d, h:i:s");
            $param_seen = date("20y-m-d, h:i:s");
            $param_version = $version.$version_type;
            $param_protocol = $ip;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($mysql);
}
?>