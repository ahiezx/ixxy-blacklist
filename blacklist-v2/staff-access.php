<?php
session_name('sid');
session_start();

require_once(__DIR__."/assets/src/requirements.php");

$config = new Config();
$MySQL = new MySQL();
$mysql = $MySQL::session();
if(isset($_SESSION['username'])) {


	if($_SERVER['REQUEST_METHOD'] == 'POST') {

		$today = sprintf('%s %s '.date('H:i'), date('d'), date('F'));
		$username = mysqli_real_escape_string($mysql, htmlspecialchars(trim($_SESSION['username'])));
		$ip = mysqli_real_escape_string($mysql, htmlspecialchars(trim(Sessions::client_ip())));

		if (isset($_POST['clear'])) {

			if($_POST['clear'] == "audit") {
				$clear = mysqli_query($mysql, "DELETE FROM audit;");
			}

		}

		if (isset($_POST['type'])) {
			


			switch ($_POST['type']) {
				case 'add':

					
					if(isset($_POST['add_type'])) {

						switch ($_POST['add_type']) {
							case 'blacklist':
								

								if(isset($_POST['account']) and isset($_POST['platform']) and isset($_POST['proof'])) {
								if(!empty($_POST['account']) and !empty($_POST['platform']) and !empty($_POST['proof'])) {

									$name = mysqli_real_escape_string($mysql, htmlspecialchars(trim($_POST['account'])));
									$platform = mysqli_real_escape_string($mysql, htmlspecialchars(trim($_POST['platform'])));
									$proof = mysqli_real_escape_string($mysql, htmlspecialchars(trim($_POST['proof'])));
									if(isset($_POST['number'])) {
										$number = mysqli_real_escape_string($mysql, htmlspecialchars(trim($_POST['number'])));
									}
									else {
										$number = NULL;
									}

									$query = mysqli_query($mysql, "INSERT INTO blacklist (name,platform,number,proof) VALUES('$name','$platform','$number','$proof');");
									$query2 = mysqli_query($mysql, "INSERT INTO audit (date,username,action,target,ip) VALUES('$today','$username','+ Blacklist','$name','$ip');");

									if($query) {

										echo "<div class='bg-success p-2 text-center text-white'>Done</div>";

									}


								}
								else {
									die("invalid parameters");
								}
								}
								else {
									die("invalid parameters");
								}


								break;
							case 'shop':
								
								if(isset($_POST['account']) and isset($_POST['vouches']) and isset($_POST['shop_type']) and isset($_POST['platform'])) {
								if(!empty($_POST['account']) and !empty($_POST['vouches']) and !empty($_POST['shop_type']) and !empty($_POST['platform'])) {
									if($_POST['shop_type'] == "special") {$_POST['shop_type'] = 1;}
									elseif($_POST['shop_type'] == "normal") {$_POST['shop_type'] = 0;}
									$name = mysqli_real_escape_string($mysql, htmlspecialchars(trim($_POST['account'])));
									$vouches = mysqli_real_escape_string($mysql, htmlspecialchars(trim($_POST['vouches'])));
									$shop_type = mysqli_real_escape_string($mysql, htmlspecialchars(trim($_POST['shop_type'])));
									$platform = mysqli_real_escape_string($mysql, htmlspecialchars(trim($_POST['platform'])));

									$query = mysqli_query($mysql, "INSERT INTO shops (name,account,platform,vouches,special) VALUES('$name','$name','$platform','$vouches','$shop_type');");
									$query2 = mysqli_query($mysql, "INSERT INTO audit (date,username,action,target,ip) VALUES('$today','$username','+ Shop','$name','$ip');");

									if($query) {

										echo "<div class='bg-success p-2 text-center text-white'>Done</div>";

									}


								}
								else {
									die("invalid parameters");
								}
								}
								else {
									die("invalid parameters");
								}


								break;						
							default:
								die("invalid parameters");
						}

					}


					break;

				case 'remove':

					
					if(isset($_POST['remove_type'])) {

						switch ($_POST['remove_type']) {
							case 'blacklist':
								

								if(isset($_POST['account'])) {
								if(!empty($_POST['account'])) {

									$name = mysqli_real_escape_string($mysql, htmlspecialchars(trim($_POST['account'])));
									$query = mysqli_query($mysql, "DELETE FROM blacklist WHERE name='$name';");
									$query2 = mysqli_query($mysql, "INSERT INTO audit (date,username,action,target,ip) VALUES('$today','$username','- Blacklist','$name','$ip');");

									if($query) {

										echo "<div class='bg-success p-2 text-center text-white'>Done</div>";

									}


								}
								else {
									die("invalid parameters");
								}
								}
								else {
									die("invalid parameters");
								}


								break;
							case 'shop':
								
								if(isset($_POST['account'])) {
								if(!empty($_POST['account'])) {

									$name = mysqli_real_escape_string($mysql, htmlspecialchars(trim($_POST['account'])));

									$query = mysqli_query($mysql, "DELETE FROM shops WHERE account='$name';");
									$query2 = mysqli_query($mysql, "INSERT INTO audit (date,username,action,target,ip) VALUES('$today','$username','- Shop','$name','$ip');");

									if($query) {

										echo "<div class='bg-success p-2 text-center text-white'>Done</div>";
									}


								}
								else {
									die("invalid parameters");
								}
								}
								else {
									die("invalid parameters");
								}


								break;						
							default:
								die("invalid parameters");
						}

					}
					break;

				default:
					# code...
					break;
			}



		}



	}


	$username = mysqli_real_escape_string($mysql, htmlspecialchars($_SESSION['username']));
	$result = mysqli_query($mysql, "SELECT * FROM accounts WHERE username='$username' AND level=3");
	if ($result->num_rows > 0) {
		require_once(__DIR__."/assets/src/metas.php");
		?>
		<html>
		<head>
			<title><?php echo $config::TITLE; ?></title>
		</head>
		<body style="background-color:black;">
		<?php require_once(__DIR__."/assets/src/navbar.php"); ?>

		<div class="container pt-3">
			<div class="row">
				<div class="col-12 pb-3 pt-3 text-white" style="border-top: solid white 1px;border-right: solid white 1px;border-left: solid white 1px;border-radius: 3px;">
					
					<h6 class="mb-0 p-2 text-center" style="border:solid white 1px;">Staff Access v1.0 Alpha</h1>

				</div>

				<div class="col-6 p-5 text-white" style="border: solid white 1px;">
					
					<h6 class="mb-0 p-2 text-center" style="border:solid white 1px;">Add Shop<br>اضافة متجر</h1>

					<form method="post" action="#">
						<input type="hidden" name="type" value="add">
						<input type="hidden" name="add_type" value="shop">
						<div class="form-group justificy-content-center mx-auto text-center mt-3">
							<label for="shop_name">Shop Account<br>حساب المتجر</label>
							<input type="text" name="account" class="form-control mb-2" id="shop_name" placeholder="حساب المتجر - Shop Account">
							<input type="number" name="vouches" class="form-control mb-2" id="shop_name" placeholder="اعداد المعاملات - Vouches">
							<select id="platforms" name="platform" class="form-control">
							  <option value="Instagram">Instagram</option>
							  <option value="Snapchat">Snapchat</option>
							  <option value="Whatsapp">WhatsApp</option>
							  <option value="Telegram">Telegram</option>
							  <option value="Psn">PSN</option>
							</select>							
							<input type="radio" name="shop_type" value="special"> Special - مميز<br>
							<input type="radio" name="shop_type" value="normal" checked> Normal - طبيعي<br>					
							<input type="submit" class="btn btn-primary btn-sm mt-2">
						</div>
					</form>

				</div>		

				<div class="col-6 p-5 text-white" style="border: solid white 1px;">
					
					<h6 class="mb-0 p-2 text-center" style="border:solid white 1px;">Remove Shop<br>حذف متجر</h1>

					<form method="post" action="#">
						<input type="hidden" name="type" value="remove">
						<input type="hidden" name="remove_type" value="shop">
						<div class="form-group justificy-content-center mx-auto text-center mt-3">
							
							<label for="shop_name">Shop Account<br>حساب المتجر</label>
							<input type="text" class="form-control mb-2" id="shop_name" name="account" placeholder="حساب المتجر - Shop Account">		
							<input type="submit" class="btn btn-primary btn-sm mt-2">

						</div>
					</form>

				</div>		

				<div class="col-6 p-5 text-white" style="border: solid white 1px;">
					
					<h6 class="mb-0 p-2 text-center" style="border:solid white 1px;">Add Blacklist<br>اضافة محتال</h1>
					
					<form method="post" action="#">
						<input type="hidden" name="type" value="add">
						<input type="hidden" name="add_type" value="blacklist">						
						<div class="form-group justificy-content-center mx-auto text-center mt-3">
							
							<label for="shop_name">Shop Account<br>حساب المتجر</label>
							<input type="text" class="form-control mb-2" id="shop_name" name="account" placeholder="حساب المتجر - Shop Account">		
							<label for="proof">Proof - الاثبات</label>
							<input type="text" class="form-control mb-2" id="proof" name="proof" placeholder="الاثبات - Proof">							
							<label for="platforms">المنصة - Platform</label>
							<select id="platforms" name="platform" class="form-control">
							  <option value="Instagram">Instagram</option>
							  <option value="Snapchat">Snapchat</option>
							  <option value="Whatsapp">WhatsApp</option>
							  <option value="Telegram">Telegram</option>
							  <option value="Psn">PSN</option>
							</select>							
							<input type="submit" class="btn btn-primary btn-sm mt-2">

						</div>
					</form>

				</div>	


				<div class="col-6 p-5 text-white" style="border: solid white 1px;">
					
					<h6 class="mb-0 p-2 text-center" style="border:solid white 1px;">Remove Blacklist<br>حذف محتال</h1>
					
					<form method="post" action="#">
						<input type="hidden" name="type" value="remove">
						<input type="hidden" name="remove_type" value="blacklist">							
						<div class="form-group justificy-content-center mx-auto text-center mt-3">
							
							<label for="shop_name">Shop Account<br>حساب المتجر</label>
							<input type="text" class="form-control mb-2" id="shop_name" name="account" placeholder="حساب المتجر - Shop Account">							
							<input type="submit" class="btn btn-primary btn-sm mt-2">

						</div>
					</form>

				</div>	

			</div>
		</div>
	</div>
		<div style="white-space: nowrap;text-overflow: ellipsis;width: 100%;">
				<?php
				if(in_array($_SESSION['username'], ['Ahmed','shelby','a'])) {
				?>
					<div class="col-12 p-5 text-white">
						<h1 class="d-inline">Audit log</h1>
						<form method="post" action="#" class="d-inline">
							<input type="hidden" name="clear" value="audit">
							<input type="submit" class="btn btn-danger float-right btn-sm d-inline" value="Clear Audit Log">
						</form>
						<table style="width:100%">
						  <tr class="text-white">
						    <th>Date (UTC)</th>
						    <th>Username</th>
						    <th>Action</th>
						    <th>Target</th>
						  </tr>
						  <?php

						  $audit_log = mysqli_query($mysql, "SELECT * FROM audit;");
						  while($row = $audit_log->fetch_assoc()) {
							echo '


						  <tr>
						    <td class="text-primary">'.$row['date'].'</td>
						    <td class="text-warning">'.$row['username'].'</td>
						    <td class="text-success">'.$row['action'].'</td>
						    <td class="text-danger">'.$row['target'].'</td>
						  </tr>

							';					  	
						  }

						  ?>
						</table>

					</div>
				<?php
				}
				?>			
		</div>

		</body>
		</html>
		<?php
	}
	else {
		http_response_code(404);
		die("404 not found");
	}	
}
else {
	http_response_code(404);
	die("404 not found");
}
?>