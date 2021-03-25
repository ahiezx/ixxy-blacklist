<?php
require_once("sources/metas.php");
require_once("sources/config.php");
require_once("sources/sqlconnect.php");
require_once("sources/checklogged.php");
setcookie(session_name(),session_id(),time()+604800);
?>
<html>
<head>
	<title><?php echo $title." ".ucwords($_SESSION['username']); ?></title>
</head>
<body class="body">
</body>
</html>