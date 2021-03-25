<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
	if($_SERVER['HTTP_USER_AGENT'] == "ig-check5Firas") {
		http_response_code(202);
		$jsonString = file_get_contents('uses.json');
		$data = json_decode($jsonString, true);

			$data['uses'] = $data['uses'] + 1;
			$newJsonString = json_encode($data);
			file_put_contents('uses.json', $newJsonString);
			
	}
	else {
		http_response_code(404);
		// header("Location:/checkdb");
	}
}
?>
