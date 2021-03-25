<?php
require_once(__DIR__."/assets/src/requirements.php");

$MySQL = new MySQL();
$config = new Config();

?>
<html>
<head>
	<?php
	require_once(__DIR__."/assets/src/metas.php");
	?>	
	<title><?php echo $config::TITLE; ?></title>
</head>
<body>

	<?php

	$mysql = $MySQL::session();
	$result = mysqli_query($mysql, "SELECT * FROM reports;");
	if(mysqli_num_rows($result) > 0)
	{
	 while($row = mysqli_fetch_array($result))
	 {
	 	echo "-------------<Br>";
		echo "[Name]: ".$row['name'];
		echo "<br>";
		echo "[Number]: ".$row['number'];
		echo "<br>";
		echo "[Platform]: ".$row['platform'];
		echo "<br>";
	 	if($row['type'] == "report"){
	 		echo "[Type]: "."<a class='text-danger bg-dark'>".$row['type']."</a>";	
	 	}
	 	else {
	 		echo "[Type]: "."<a class='text-success bg-dark'>".$row['type']."</a>";	
	 	}
		echo "<br>";
		echo "[IP]: ****.****.****.****";
		echo "<br>";
		echo "[Reports]: ".$row['reports'];		
		echo "<br>";
		echo "[Proof]: ".$row['proof'];		
		echo "<br>-----------------------";
	 }
	}

	?>

</body>
</html>