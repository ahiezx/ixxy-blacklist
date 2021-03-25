<?php

require_once(__DIR__."/assets/src/requirements.php");

$config = new Config();
$MySQL = new MySQL();
$mysql = $MySQL::session();
$platform = '';
$proof = '';
?>
<html>
<head>
	<title><?php echo $config::TITLE; ?></title>
	<?php
	require_once(__DIR__."/assets/src/metas.php");
	?>
</head>
<body style="background-color: black;">

		<?php

		if (!isset($_GET['username'])) {
			header("Location: home");
		}
		else {

		$name = mysqli_real_escape_string($mysql, htmlspecialchars($_GET['username']));
		$result = mysqli_query($mysql, "SELECT * FROM blacklist WHERE name= '$name' LIMIT 1");

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	if($row["platform"] == "Whatsapp") {
		    		if(isset($row['number'])) {
		    			$platform_data = "رقم الهاتف: <a href='tel:".$row['number']."'>".$row['number']."</a>";
		    		}
		    		else {
		    			$platform_data = "رقم الهاتف: مجهول";
		    			$platform_data .= "<br>حاول عللا ".'<a class="d-inline" href="https://www.instagram.com/'.$row['name'].'" target="_blank">Instagram</a>';
		    		}
		    	}
		    	elseif ($row["platform"] == "Instagram") {
		    		$platform_data = '<p class="d-inline">المنصة: </p><a class="d-inline" href="https://www.instagram.com/'.$row['name'].'" target="_blank">'.$row["platform"].'</a>';
		    		if ($row["number"]) {
					$platform_data .= '<br><p class="d-inline">رقم الهاتف: </p><a class="d-inline" href="tel:'.$row['number'].'" target="_blank">'.$row["number"].'</a>';		    			
		    		}
		    	}
		    	elseif ($row["platform"] == "Psn") {
		    		$platform_data = '<p class="d-inline">المنصة: </p><a class="d-inline" href="https://my.playstation.com/profile/'.$row['name'].'" target="_blank">'.$row["platform"].'</a>';
		    		if ($row["number"]) {
					$platform_data .= '<br><p class="d-inline">رقم الهاتف: </p><a class="d-inline" href="tel:'.$row['number'].'" target="_blank">'.$row["number"].'</a>';		    			
		    		}
		    	}		
		    	elseif ($row["platform"] == "Snapchat") {
		    		$platform_data = '<p class="d-inline">المنصة: </p><a class="d-inline" href="https://www.snapchat.com/add/'.$row['name'].'" target="_blank">'.$row["platform"].'</a>';
		    		if ($row["number"]) {
					$platform_data .= '<br><p class="d-inline">رقم الهاتف: </p><a class="d-inline" href="tel:'.$row['number'].'" target="_blank">'.$row["number"].'</a>';		    			
		    		}
		    	}	
		    	elseif ($row["platform"] == "Telegram") {
		    		$platform_data = '<p class="d-inline">المنصة: </p><a class="d-inline" href="#'.$row['name'].'" target="_blank">'.$row["platform"].'</a>';
		    		if ($row["number"]) {
					$platform_data .= '<br><p class="d-inline">رقم الهاتف: </p><a class="d-inline" href="tel:'.$row['number'].'" target="_blank">'.$row["number"].'</a>';		    			
		    		}
		    	}			    			    		    	
		    	if ($row['proof'] == null) {
		    		$proof = "#";
		    	}
		    	else {
		    		$proof = $row['proof'];
		    	}
		    	echo '
		    		<div class="row h-100 justificy-content-center mx-auto text-center">
			    		<div class="col-12 m-0 p-0 p-5 text-white text-uppercase my-auto">
			    			<p class="d-inline">الحالة: <p class="text-danger d-inline">محظور</p></p>
		    				<h1 class="m-0 p-0">'.$row["name"].'</h1>
		    				'.$platform_data.'<br><br>
		    				<p class="d-inline">دليل: </p><a class="d-inline" href="'.$proof.'" target="_blank" class="text-warning">Media</a><br>
		    				<p class="text-secondary d-inline">غلطة?</p>
		    				<a class="text-white d-inline" href="report">الغاء الحظر</a>
			    		</div>
		    		</div>

		    	';
		        
		    }
		} else {
		    http_response_code(404);
		    	echo '
		    		<div class="row h-100 justificy-content-center mx-auto text-center">
			    		<div class="col-12 m-0 p-0 p-5 text-white text-uppercase my-auto">
			    			<p class="d-inline">الحالة: <p class="text-danger d-inline">غير موجود</p></p>
		    				<h1 class="m-0 p-0 text-success" style="word-wrap: break-word;">'.htmlspecialchars($_GET['username']).'</h1>
			    		</div>
		    		</div>

		    	';
		}
		}
		?>	

</body>
</html>