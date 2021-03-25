

<?php
require_once(__DIR__."/assets/src/requirements.php");
require_once(__DIR__."/api/admins.php");
$sql = new MySQL();
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
	<div class="cons pt-2 pb-5 m-3">
		<div class="container" style="border:1px solid #6C757D;border-radius: 4px;">
			<div class="container text-center text-white pt-4 pb-3 mt-5" >
				
				<h1>Social Media</h1>
				<h3>Blacklisted & Trusted shops</h3>
				<p class="text-secondary">Search for social media blacklisted & trusted shops to maintain your safety<br>and guarantee your shopping legitimates</p>
					<div class="col-12">
						<p class="text-secondary"><a href="ar" class="text-white nav-link">الترجمة الى العربية</a></p>
					</div>

			</div>
			<hr class="bg-secondary mx-auto justify-content-center d-flex" style="max-width: 60%">
			<div class="container p-5 justify-content-center text-center text-white">

				
				<div class="col-12 justify-content-center mx-auto text-center">
					<h3><i class="fa fa-users mb-2"></i> Admins : </h3>
					<?php
					foreach($admin_list as $admin) {
						if (in_array($admin, ['fvs','wn3'])) {
						echo '<p class="d-inline"><a href="https://www.instagram.com/'.$admin.'" class="text-primary" target="_blank">@'.$admin.'</a></p> ';
						}
						else {
						echo '<p class="d-inline"><a href="https://www.instagram.com/'.$admin.'" class="text-white" target="_blank">@'.$admin.'</a></p> ';
						}
					}
					?>					

					<br>
					<small class="text-secondary">Contact admins to be ensured about your report.</small>

				</div>

			</div>	
			<hr class="bg-secondary mx-auto justify-content-center d-flex" style="max-width: 60%">
			<div class="container mb-5 justify-content-center d-flex mx-auto text-white">
							<div class="justify-content-center d-flex mx-auto">
							<div class="col-12 mt-4 mb-4 align-middle mx-auto">
								<small class="text-left">Contact:</small>
								<a href="https://www.instagram.com/ayahcuasa" class="text-light ml-3 mr-3 align-middle" target="_blank" style="font-size:20px"><i class="fab fa-instagram"></i></a>/
								<a href="https://discord.gg/8u5R5WG" class="text-light ml-3 mr-3 align-middle" target="_blank" style="font-size:20px"><i class="fab fa-discord"></i></a><br>
								<small class="text-left">Support:</small>
								<a href="https://www.paypal.me/k6b" class="text-light  ml-3 mr-3 align-middle" target="_blank" style="font-size:20px"><i class="fab fa-paypal"></i></a> / <a href="https://www.paypal.me/ahmedxalharbi" class="text-light  ml-3 mr-3 align-middle" target="_blank" style="font-size:20px"><i class="fab fa-paypal"></i></a>
							</div>	
							</div>

			</div>
	</div>
	</div>	
	<div class="container-fluid pb-5" id="footer">
		
		<div class="row text-center text-white">
			<div class="col-12"><p class="m-0 p-0">Made by <a href="https://www.instagram.com/ayahcuasa" target="_blank">Ahmed</a> &copy; - 2020</p></div>
		</div>

	</div>
	<?php

echo '
		<script>
$(document).ready(function(){


 function load_data(query)
 {
  $.ajax({
   url:"./api/search",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $(\'#search_result\').html(data);
   }
  });
 }
 $(\'#username\').keyup(function(){
  var search = $(this).val();
  if(search.length != 0)
  {
   load_data(search);
  }
  else if (search.length == 0) {
  	$(\'#search_result\').html(\'\');
  	return;
  }
  else {
  	return false;
  }
 });
});
		</script>
';

	?>		
</body>
</html>

