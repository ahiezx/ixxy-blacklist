<?php
require_once(__DIR__."/../assets/src/requirements.php");

$MySQL = new MySQL();
$mysql = $MySQL::session();
$Sessions = new Sessions();
$clientip = $Sessions::client_ip();

header('Content-Type: application/json');

error_reporting(0);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
function validate_phone_number($phone)
{
     // Allow +, - and . in phone number
     $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
     // Remove "-" from number
     $phone_to_check = str_replace("-", "", $filtered_phone_number);
     // Check the lenght of number
     // This can be customized if you want phone number from a specific country
     if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
        return false;
     } else {
       return true;
     }
}
	if(isset($_POST['name']) && isset($_POST['proof']) && isset($_POST['platform']) && isset($_POST['type']) && isset($_POST['number'])) {

		if(!empty($_POST['name']) && !empty($_POST['proof']) && !empty($_POST['platform']) && !empty($_POST['type'])) {

			if ($_POST['type'] == "whitelist" or $_POST['type'] == "report") {

				$name = mysqli_real_escape_string($mysql, htmlspecialchars(trim($_POST['name'])));
				$proof = mysqli_real_escape_string($mysql, htmlspecialchars(trim($_POST['proof'])));
				$platform = mysqli_real_escape_string($mysql, htmlspecialchars(trim($_POST['platform'])));
				$type = mysqli_real_escape_string($mysql, htmlspecialchars(trim($_POST['type'])));
				$ip = mysqli_real_escape_string($mysql, htmlspecialchars(trim($clientip)));
				$number = null;

				if(!empty($_POST['number'])) {

					$number = mysqli_real_escape_string($mysql, htmlspecialchars(trim($_POST['number'])));
					if(validate_phone_number($number)) {					
						
					}
					else {
						echo json_encode(array("message"=>"معلومات غير صالحة"));
						die();													
					}
				}

				if(preg_match('/[^A-Za-z0-9-.-_\-]/', $name)) {

					http_response_code(400);

				}
				else {

					$name = preg_replace('/[^A-Za-z0-9-.-_\-]/', '', $name);

					$exist = $mysql->query("SELECT name,ip FROM reports WHERE ip='$ip' AND name='$name'");

					if(mysqli_num_rows($exist) > 0) {

						$update = $mysql->query("UPDATE reports SET reports = reports + 1 WHERE ip='$ip' AND name='$name'");
						echo json_encode(array("message"=>"تم تقديم الابلاغ"));
					}
					else {

						$query = $mysql->query("INSERT INTO reports (name,number,platform,type,ip,proof) VALUES ('$name','$number','$platform','$type','$ip','$proof');");

						if($query) {
							echo json_encode(array("message"=>"تم تقديم الابلاغ"));
						}
						else {
							echo json_encode(array("message"=>"يرجى المحاولة لاحقاً أو الابلاغ عن الخطأ لصاحب الموقع"));
						}
					}

				}
			}

			else {
				echo json_encode(array("message"=>"معلومات غير صالحة"));
			}
		}

		else {
			echo json_encode(array("message"=>"معلومات غير صالحة"));
		}

	}

	else {
		http_response_code(400);	
	}

}
else {
	http_response_code(400);
}

?>