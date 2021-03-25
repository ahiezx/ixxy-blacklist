<?php
require_once("sources/metas.php");
require_once("/var/www/html/sources/create_web_ajax.php");
session_name('sid');
session_start();
if(isset($_SESSION["loggedin"]) || isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
    header("Location: /");
    exit;
}
?>
<html>
<head>
	<title><?php echo $title; ?>Sign Up</title>
<?php
#require_once("sources/busy.php");
#require_once("sources/getinfo.php");
?>	
</head>
<body class="body">
	<?php
	require_once("sources/su.php");
	?>
</body>
</html>