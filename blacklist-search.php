
<?php
require_once(__DIR__."/assets/src/requirements.php");

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
	<div class="mt-5 p-5 container">
	<div class="mx-auto justify-content-center d-flex text-center text-white">
		<div class="col-12 animated fadeInUp">
			<h1>IXXY — Lookup</h1>
		</div>
	</div>
		
		<div class="justify-content-center mx-auto searching">
			
			<div class="form-group text-white animated fadeIn">
				<label for="search">Search</label>
				<div class="search animated fadeInUp">
					<input autocomplete="off" id="username" type="text" name="username" placeholder="Name, Phone number, Username, ID, Snap" class="form-control rounded-0 border-0">
				</div>
				<div id="search_result">
					

				</div>
				<small id="privacypolicy" class="form-text text-muted animated fadeInDown">
				  Your search requests are signed in our database, feel free to search anything. your data won't be shared with any third parties.
				</small>
			</div>

		</div>

	</div>
	<div class="container-fluid pb-5 pt-5 mt-5" id="footer">
		
		<div class="row text-center text-white">
			<div class="col-12"><p class="m-0 p-0">Owned by <a href="https://www.instagram.com/wn3" target="_blank">Shelby</a> & <a href="https://www.instagram.com/fvs" target="_blank">Marty</a></p></div>
			<div class="col-12" style="font-size: 12px;"><p class="m-0 p-0">Made by the power of <a href="https://www.instagram.com/_pmy" target="_blank">Ahmed</a> &copy; - 2020</p></div>
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
	<script>
  AOS.init();
  window.addEventListener('load', AOS.refresh);
</script>	
</body>
</html>