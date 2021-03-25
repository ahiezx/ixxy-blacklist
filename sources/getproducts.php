<?php


$sql2 = "SELECT * FROM products WHERE available='1'";
$result = $mysql->query($sql2);
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$prodid = $row['product_id'];
		$url = "?product=".$prodid;
		$prodown = $row['product_owner'];
		$product_name = $row['product_name'];
		$downloads = $row['downloads'];
		echo "



<div class='productholder'>

		<div class='product'>


			<div class='product_image'><img src='assets/image/logo.png' width='105.6' height='59.4'></div>

			<div class='product_content'>


				<p class='product_title'>".$product_name."</p><br>
				<a href='".$url."' class='dbtn'>Download</a><br><br>
				<p>Made By <a style='color:#c0392b;' href=".$prodown.">".$prodown."</a></p>

			</div>



		</div>

</div>


		";
if (isset($_GET['product'])) {
	if ($_GET['product'] == $prodid) {
		// header('Content-Type: application/octet-stream');
		// header("Content-Transfer-Encoding: Binary"); 
		// header('Content-Disposition: attachment; filename="'.basename($product_name).'.zip"');
		// ob_clean();
  //   	flush();
  //   	readfile('product/'.$prodid.".zip");

		// $sql8 = "UPDATE `products` SET `downloads` = `downloads` + 1 WHERE `products`.`product_id` = '$prodid';";
		// $mysql->query($sql8);
		// exit;
	}
}		
	}
}
else {
	echo "No products are available";
}
?>