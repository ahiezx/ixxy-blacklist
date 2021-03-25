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
		
		<h3 class="mb-3 mt-5" style="color:grey;" data-aos="fade-up" data-aos-duration="1200">&there4; Middlemen &there4;	</h3>
		<div class="row text-center justificy-content-center d-flex mx-auto">
			<?php
			$platform_data = '';
			$result = mysqli_query($mysql, "SELECT * FROM middle ORDER BY deals DESC,id ASC");
			if ($result->num_rows > 0) {
		    	while($row = $result->fetch_assoc()) {
		    			if($row['platform'] == "Telegram") {
		    				$platform_data = '<a href="tel:'.$row['account'].'" class="nav-link m-0 p-0 text-dark">Visit page</a>';
		    			}
		    			else {
		    				$platform_data = '<a href="https://www.instagram.com/'.$row['account'].'" class="nav-link m-0 p-0 text-dark">Visit page</a>';
		    			}
		    			echo '
			<div class="col-4 p-2" data-aos="fade-up" data-aos-duration="1200">
				<i class="fa fa-user text-white p-4 mb-2 mt-2" style="border-radius: 50%;font-size:25px;background-color:grey;" ></i>
				<h5 style="color:grey;">'.$row['account'].'</h5>
				<h6>Platform: '.$row['platform'].'</h6>
				<h6>Deals: ~'.$row['deals'].'+</h6>
				'.$platform_data.'
			</div>
		    			';
		    	}
		    }
		    else {
		    	echo "<span class='text-center mx-auto'>No data was found</span>";
		    }
			?>

		</div>		

	</div>


	<div class="container-fluid pt-5 pb-5" id="footer">
		
		<div class="row text-center text-white">
			<div class="col-12"><p class="m-0 p-0">Owned by <a href="https://www.instagram.com/wn3" target="_blank">Shelby</a> & <a href="https://www.instagram.com/fvs" target="_blank">Marty</a></p></div>
			<div class="col-12" style="font-size: 12px;"><p class="m-0 p-0">Made by <a href="https://www.instagram.com/_pmy" target="_blank">Ahmed</a> &copy; - 2020</p></div>
		</div>

	</div>	
	<script>
  AOS.init();
  window.addEventListener('load', AOS.refresh);
</script>	
</body>
</html>
