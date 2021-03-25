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

	<div class="container text-white">
		<div class="row text-center mt-5 mb-5 justificy-content-center d-flex mx-auto appealform">
			<div class="col-12 p-5" style="background-color: rgba(255, 255, 255,0.02);border-radius: 3px;">
				<p id="status" class="m-0" style="border-radius: 3px;"></p>
				<h1 class="m-0 p-0"><p class="d-inline text-success">Appeal</p> / <p class="d-inline text-danger">Report</p></h1>
				<form method="post" id="appealwhitelist" action="api/appeal">
					<div class="form-group pt-3">
						<label for="appealname">Account / Number / ID*</label>
						<input type="text" class="form-control" name="name" id="appealname" placeholder="Social Media @username" required=""><Br>
						<label for="appealname">Phone Number (Optional)</label>
						<input type="text" class="form-control" name="number" id="appealname" placeholder="+1 234 567890"><Br>
						<label for="proof">Proof*</label>
						<textarea form="appealwhitelist" type="text" name="proof" class="form-control" id="proof" placeholder="URL or explanation" required=""></textarea><br>
						<label for="platform">Soical Media Platform*</label>
						<select name="platform" form="appealwhitelist" class="form-control" id="platform" required="">
						  <option value="Instagram">Instagram</option>
						  <option value="WhatsApp">WhatsApp</option>
						  <option value="Snapchat">Snapchat</option>
						  <option value="Other">Other</option>
						</select>
						  <br>
						  <input type="radio" name="type" value="whitelist" class="form-check-input" required=""> Appeal*<br>
						  <input type="radio" name="type" value="report" checked class="form-check-input" required=""> Report Someone*<br>
						<button type="submit" class="btn rounded-0 text-white mt-4" style="background-color: rgba(255, 255, 255,0.02);" class="form-check-input">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php
echo '
				  <script type="text/javascript">
				$(\'#appealwhitelist\').submit(function(e){
				    e.preventDefault();
				    $.ajax({
				        url:\'api/appeal\',
				        type:\'post\',
				        data:$(\'#appealwhitelist\').serialize(),
				        success:function(data){
				          for(index in data){
				          	document.getElementById("status").innerHTML = data[index] + ".";
				          }
				          var element = document.getElementById("status");
				          element.classList.add("p-2");
				          element.classList.add("mb-2");
				          element.classList.add("bg-light");
				          element.classList.add("text-body");
				          element.classList.add("rounded");
				        }
				    });
				}); 				  
				  </script>    		
';
	?>
</body>
</html>