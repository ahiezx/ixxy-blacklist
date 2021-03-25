<?php
session_name('sid');
session_set_cookie_params(604800,"/");
session_start();
require_once("filemap.php");
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("Location: /");
    exit;
}
// elseif(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true){
// 	$_SESSION['page1'] = true;
// 	if ($_SESSION['admin'] == 1) {
// 		header("Location: ".$adminpath."user");
// 	}
// }
?>