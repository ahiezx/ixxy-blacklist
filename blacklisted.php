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
	<style type="text/css">
		.wrapping div{
			border-left: 2px solid white;
			padding-left: 15px;
			margin-left: 25px;
		}
	</style>
	<title><?php echo $config::TITLE; ?></title>
	<?php
	require_once(__DIR__."/assets/src/metas.php");
	?>
</head>
<body style="background-color: black;">

		<?php
		$vendor = "None";
		if (!isset($_GET['username'])) {
			header("Location: home");
		}
		else {

		$name = mysqli_real_escape_string($mysql, htmlspecialchars($_GET['username']));
		$result = mysqli_query($mysql, "SELECT * FROM blacklist WHERE (name LIKE '$name')");

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	if($row["platform"] == "Whatsapp") {
		    		if(isset($row['number'])) {
		    			$platform_data = "<p class='d-inline text-white'>Phone Number: </p><a href='tel:+".$row['number']."'>".$row['number']."</a><br>";
						$platform_data .= '<p class="d-inline text-white">Platform: Whatsapp <i class="fab fa-'.$row["platform"].'" style="font-size: 12px;vertical-align: middle;color:grey;"></i></p>';		    			
		    		}
		    		else {
		    			$platform_data = '<p class="d-inline text-white">Phone Number: +'.$row['name'].'</p><br>';
		    		}
		    			$vendor_data = '<a class="text-danger" href="tel:+'.$row['name'].'">+'.$row['name'].'</a>';
		    	}
		    	elseif ($row["platform"] == "Instagram") {
		    		$platform_data = '<p class="d-inline text-white">Platform: </p><a class="d-inline" href="https://www.instagram.com/'.$row['name'].'" target="_blank">'.$row["platform"].' <i class="fab fa-'.$row["platform"].'" style="font-size: 12px;vertical-align: middle;color:grey;"></i></a>';
		    		if ($row["number"]) {
					$platform_data .= '<br><p class="d-inline text-white">Phone Number: <a class="d-inline text-white" href="tel:+'.$row['number'].'" target="_blank">'.$row["number"].'</a>';		    			
		    		}
		    		$vendor_data = '<a class="text-danger" target="_blank" href="https://www.instagram.com/'.$row['name'].'">'.$row['name'].'</a>';
		    	}
		    	elseif ($row["platform"] == "Psn") {
		    		$platform_data = '<p class="d-inline text-white">Platform: </p><a class="d-inline" href="https://my.playstation.com/profile/'.$row['name'].'" target="_blank">'.$row["platform"].'</a>';
		    		if ($row["number"]) {
					$platform_data .= '<br><p class="d-inline text-white">Phone Number: <a class="d-inline" href="tel:+'.$row['number'].'" target="_blank">'.$row["number"].'</a>';		    			
		    		}
		    		$vendor_data = '<a class="text-danger" target="_blank" href="https://my.playstation.com/profile/'.$row['name'].'">'.$row['name'].'</a>';
		    	}		  
		    	elseif ($row["platform"] == "Snapchat") {
		    		$platform_data = '<p class="d-inline text-white">Platform: </p><a class="d-inline" href="https://www.snapchat.com/add/'.$row['name'].'" target="_blank">'.$row["platform"].' <i class="fab fa-'.$row["platform"].'" style="font-size: 12px;vertical-align: middle;color:grey;"></i></a>';
		    		if ($row["number"]) {
					$platform_data .= '<br><p class="d-inline text-white">Phone Number: <a class="d-inline" href="tel:+'.$row['number'].'" target="_blank">'.$row["number"].'</a>';		    			
		    		}
		    		$vendor_data = '<a class="text-danger" target="_blank" href="https://www.snapchat.com/add/'.$row['name'].'">'.$row['name'].'</a>';
		    	}	
		    	elseif ($row["platform"] == "Telegram") {
		    		$platform_data = '<p class="d-inline text-white">Platform: </p><a class="d-inline text-white">'.$row["platform"].' <i class="fab fa-'.$row["platform"].'" style="font-size: 12px;vertical-align: middle;color:grey;"></i></a>';
		    		if ($row["number"]) {
					$platform_data .= '<br><p class="d-inline text-white">Phone Number: <a class="d-inline" href="tel:+'.$row['number'].'" target="_blank">'.$row["number"].'</a>';		    			
		    		}
		    		$vendor_data = '<a class="text-danger" target="_blank" >'.$row['name'].'</a>';
		    	}		
		    	elseif ($row["platform"] == "Twitter") {
		    		$platform_data = '<p class="d-inline text-white">Platform: </p><a class="d-inline" href="https://www.twitter.com/'.$row['name'].'" target="_blank">'.$row["platform"].' <i class="fab fa-'.$row["platform"].'" style="font-size: 12px;vertical-align: middle;color:grey;"></i></a>';
		    		if ($row["number"]) {
					$platform_data .= '<br><p class="d-inline text-white">Phone Number: <a class="d-inline" href="tel:+'.$row['number'].'" target="_blank">'.$row["number"].'</a>';		    			
		    		}
		    		$vendor_data = '<a class="text-danger" target="_blank" href="https://www.twitter.com/'.$row['name'].'">'.$row['name'].'</a>';
		    	}			    		    		    			    	  	
		    	if ($row['proof'] == "") {
		    		$proof = "no-proof";
		    	}
		    	else {
		    		$proof = $row['proof'];
		    	}
		    	if($row['sus'] == 0) {
		    		$type = '<p class="text-danger d-inline">Blacklisted</p>';
		    	}
		    	else {
		    		$type = '<p class="d-inline" style="color:#F75314;">Suspicious</p>';
		    	}
		    	echo '
		    	<div class="container text-uppercase">	    	
		    		<div class="row h-100">
		    			<div class="my-auto wrapping justificy-content-center mx-auto">
		    			<a href="/"><img src="https://cdn.discordapp.com/attachments/680727088755376157/699809759947391047/image0.jpg" width="79.375" height="79.375" class="d-inline"><p class="d-inline text-white"> &mdash; IXXY Database</p></a>

			    			<div>
								<p class="d-inline text-white">Status:</p> '.$type.'
							</div>
							<div>
								<p class="d-inline text-white">Vendor:</p> '.$vendor_data.'
							</div>
							<div>
								'.$platform_data.'
							</div>							
							<div>
								<p class="d-inline text-white">Proof:</p> <a class="text-primary d-inline" href="'.$proof.'" target="_blank" class="text-warning">Media <i class="fa fa-file" style="font-size: 12px;vertical-align: middle;color: grey;"></i></a>
							</div>
							<div class="text-secondary">
								<p class="d-inline">Mistake?</p>
								<a href="https://www.instagram.com/ixxysite/" target="_blank" class="d-inline">Contact us</a>
							</div>				
						</div>
					</div>
		    	</div>

		    	';
		        
		    }
		} else {
		    http_response_code(404);
		    	echo '
		    		<div class="row h-100 justificy-content-center mx-auto text-center">
			    		<div class="col-12 m-0 p-0 p-5 text-white text-uppercase my-auto">
			    			<p class="d-inline">Status: <p class="text-info d-inline">Not found</p></p>
		    				<h1 class="m-0 p-0 text-success" style="word-wrap: break-word;">'.htmlspecialchars($_GET['username']).'</h1>
			    		</div>
		    		</div>

		    	';
		}
		}
		?>	

</body>
</html>