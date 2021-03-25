<?php

require_once(__DIR__."/assets/src/requirements.php");

$sql = new MySQL();
$mysql = $sql::session();
$config = new Config();

?>
<html>
<head>
	<?php
	require_once(__DIR__."/assets/src/metas.php");
	?>	
	<title><?php echo $config::TITLE; ?></title>
</head>
<body style="background-color: black;">
	<?php

	require_once(__DIR__."/assets/src/navbar.php");

	?>

	<div class="container-fluid text-center text-white" style="text-transform: uppercase;">
		
		<h3 class="mb-3 mt-5" style="color:#913d88;">★ Sponsored Legitimate markets ★</h3>
		<div class="row text-center justificy-content-center d-flex mx-auto">
			<?php
			$platform_data = '';
			$result = mysqli_query($mysql, "SELECT * FROM shops ORDER BY vouches DESC,id ASC");
			if ($result->num_rows > 0) {
		    	while($row = $result->fetch_assoc()) {
		    		if($row['special'] == 1) {
		    			if($row['platform'] == "Telegram") {
		    				$platform_data = '<a href="tel:'.$row['account'].'" class="nav-link m-0 p-0 text-dark">Visit page</a>';
		    			}
		    			else {
		    				$platform_data = '<a href="https://www.instagram.com/'.$row['account'].'" class="nav-link m-0 p-0 text-dark">Visit page</a>';
		    			}
		    			echo '
			<div class="col-4  p-2">
				<i class="fa fa-heart text-white p-4 mb-2 mt-2" style="border-radius: 50%;font-size:25px;background-color:#913d88;" ></i>
				<h5 style="color:#913d88;">'.$row['name'].'</h5>
				<h6>Platform: '.$row['platform'].'</h6>
				<h6>Vouches: ~'.$row['vouches'].'+</h6>
				'.$platform_data.'
			</div>
		    			';
		    		}
		    	}
		    }
		    else {
		    	echo "No data was found";
		    }
			?>

		</div>		
		
		<h3 class="mb-3 mt-5 text-success">Legitimate markets</h3>
		<div class="row text-center justificy-content-center d-flex mx-auto">
			<?php
			$platform_data2 = '';
			$result2 = mysqli_query($mysql, "SELECT * FROM shops WHERE special='0' ORDER BY vouches DESC,id ASC");
			if ($result2->num_rows > 0) {
		    	while($row = $result2->fetch_assoc()) {
		    		if($row['special'] == 0) {
		    			if($row['platform'] == "Telegram") {
		    				$platform_data2 = '<a href="tel:'.$row['account'].'" class="nav-link m-0 p-0 text-dark">Visit page</a>';
		    			}
		    			elseif($row['platform'] == "Whatsapp") {
		    				$platform_data2 = '<a href="tel:'.$row['account'].'" class="nav-link m-0 p-0 text-dark">Visit page</a>';
		    			}		    			
		    			else {
		    				$platform_data2 = '<a href="https://www.instagram.com/'.$row['account'].'" class="nav-link m-0 p-0 text-dark">Visit page</a>';
		    			}
		    			echo '
			<div class="col-4  p-2">
				<i class="fa fa-heart text-danger p-4 mb-2 mt-2" style="border-radius: 50%;font-size:25px;background-color:white;" ></i>
				<h5 class="text-success">'.$row['name'].'</h5>
				<h6>Platform: '.$row['platform'].'</h6>
				<h6>Vouches: ~'.$row['vouches'].'+</h6>
				'.$platform_data2.'
			</div>
		    			';
		    		}
		    	}
		    }
		    else {
		    	echo "<p class='text-center mx-auto'>No data was found</p>";
		    }
			?>

		</div>	

	</div>


	<div class="container-fluid pt-5 pb-5" id="footer">
		
		<div class="row text-center text-white">
			<div class="col-12"><p class="m-0 p-0">Owned by <a href="https://www.instagram.com/wn3" target="_blank">Shelby</a> & <a href="https://www.instagram.com/fvs" target="_blank">Marty</a></p></div>
			<div class="col-12" style="font-size: 12px;"><p class="m-0 p-0">Made by <a href="https://www.instagram.com/ayahcuasa" target="_blank">Ahmed</a> &copy; - 2020</p></div>
		</div>

	</div>	
</body>
</html>
