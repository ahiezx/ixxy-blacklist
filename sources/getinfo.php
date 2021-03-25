<?php
date_default_timezone_set("Europe/Amsterdam");
if(!isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
	$ip = mysqli_real_escape_string($mysql, $_SERVER['REMOTE_ADDR']);
}
else {
	$ip = mysqli_real_escape_string($mysql, $_SERVER['HTTP_CF_CONNECTING_IP']);
}
$agent = mysqli_real_escape_string($mysql, $_SERVER['HTTP_USER_AGENT']);
$date = mysqli_real_escape_string($mysql, date("20y-m-d, h:i:s"));
$sql1 = "SELECT * FROM visits WHERE ip = '$ip'";
$result = $mysql->query($sql1);
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	$sql = "UPDATE `visits` SET attempts = attempts + 1, date = '$date' WHERE ip = '$ip'";
	$mysql->query($sql);
}
}
elseif ($result->num_rows == 0) {
	$sql = "INSERT INTO `visits` (date, agent, ip, attempts) VALUES ('$date', '$agent', '$ip', 1);";
	$mysql->query($sql);
}
?>