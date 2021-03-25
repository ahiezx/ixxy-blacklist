<?php

error_reporting(0);

require_once(__DIR__."/../assets/src/requirements.php");
require_once(__DIR__."/../api/admins.php");

$MySQL = new MySQL();

$mysql = $MySQL::session();

$output = '';
	
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($mysql, $_POST["query"]);
 $sql = "SELECT name,platform,number FROM blacklist WHERE number LIKE '%".$search."%' OR name LIKE '%".$search."%' ORDER BY name LIMIT 7 ";
 $sql2 = "SELECT name,account,platform FROM shops WHERE name LIKE '%".$search."%' AND special='0' OR account LIKE '%".$search."%' AND special='1' ORDER BY name LIMIT 3 ";
 $MySQL::exit();
}

else
{
 die(http_response_code(400));
}

function custom_search($search) {

foreach ($search as $account) {
	if(in_array($account, ['fvs','wn3'])) {
		echo "<li class='search_result'><i class='fas fa-crown account-type text-warning'></i><a href='https://www.instagram.com/".$account."' target='_blank' class='text-white'>".$account."</a><p style='float:right;' class='text-warning'>Owner</p></li>";
	}
	else {
		echo "<li class='search_result'><i class='fas fa-certificate account-type text-primary'></i><a href='https://www.instagram.com/".$account."' target='_blank' class='text-white'>".$account."</a><p style='float:right;' class='text-primary'>Administrator</p></li>";
	}
}

}

$result = mysqli_query($mysql, $sql);
if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_array($result))
 {
 	if (isset($row["platform"])) {
 		if ($row["platform"] == "Instagram") {
 			$platform = "<i class='fab fa-instagram account-type text-white'></i>";
 		}
		elseif ($row["platform"] == "Whatsapp") {
 			$platform = "<i class='fab fa-whatsapp account-type text-white'></i>";
 		} 		
		elseif ($row["platform"] == "Psn") {
 			$platform = "<i class='fab fa-playstation account-type text-white'></i>";
 		} 		
		elseif ($row["platform"] == "Snapchat") {
 			$platform = '<i class="fab fa-snapchat account-type text-white"></i>';
 		} 	 
		elseif ($row["platform"] == "Telegram") {
 			$platform = '<i class="fab fa-telegram account-type text-white"></i>';
 		}  				 	 		
 	}
 
  $output .= "<li class='search_result'>".$platform."<a href='./".$row["name"]."' class='text-white'>".$row["name"]."</a><p style='float:right;' class='text-danger'>Blacklisted</p></li>";
 }
}

$result2 = mysqli_query($mysql, $sql2);
if(mysqli_num_rows($result2) > 0)
{
 while($row = mysqli_fetch_array($result2))
 {
 	if (isset($row["platform"])) {
 		if ($row["platform"] == "Instagram") {
 			$platform = "<i class='fab fa-instagram account-type text-white'></i>";
 		}
		elseif ($row["platform"] == "Whatsapp") {
 			$platform = "<i class='fab fa-whatsapp account-type text-white'></i>";
 		} 		
		elseif ($row["platform"] == "Psn") {
 			$platform = "<i class='fab fa-playstation account-type text-white'></i>";
 		} 		
		elseif ($row["platform"] == "Snapchat") {
 			$platform = '<i class="fab fa-snapchat account-type text-white"></i>';
 		} 	 
		elseif ($row["platform"] == "Telegram") {
 			$platform = '<i class="fab fa-telegram account-type text-white"></i>';
 		}  				 	 		
 	}
 
  $output .= "<li class='search_result'>".$platform."<a href='https://www.instagram.com/".$row["account"]."' target='_blank' class='text-white'>".$row["account"]."</a><p style='float:right;color:#913D88;'>Sponsored</p></li>";
 }
}


if(in_array($_POST['query'],$admin_list)) {
 	echo custom_search($admin_list);
}
elseif (mysqli_num_rows($result) <1 && mysqli_num_rows($result2) < 1) {
	echo "<li class='p-2 text-secondary form-control rounded-0 border-0 text-center' style='background-color: rgba(0,0,0,0.5);'><p>Not found</p></li>";
}
echo $output;
?>