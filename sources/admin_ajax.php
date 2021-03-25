<?php
if (!$_SESSION['admin'] == 1) {
	echo "You Don't Have Permissions To Access This Page! <a href='".$rootpath."'>Back</a>";
	die();
}
elseif ($_SESSION['admin'] == 1) {
	
}
?>