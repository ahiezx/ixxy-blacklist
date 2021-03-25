<?php
if (isset($_GET['sucess'])) {
	if ($_GET['sucess'] == "true") {
		echo '<div class="alert alert-success" role="alert">اكتمال!</div>';
	}
	elseif($_GET['sucess'] == "false") {
		echo '<div class="alert alert-danger" role="alert">لم يتم الاكتمال</div>';
	}
}
?>