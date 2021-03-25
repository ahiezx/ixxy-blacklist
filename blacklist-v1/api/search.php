<?php

error_reporting(0);


require_once(__DIR__."/../assets/src/requirements.php");

$MySQL = new MySQL();

$mysql = $MySQL::session();

$output = '';
	
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($mysql, $_POST["query"]);
 $sql = "SELECT name,platform,number FROM blacklist WHERE number LIKE '%".$search."%' OR name LIKE '%".$search."%' ORDER BY name LIMIT 10";
 $MySQL::exit();
}
else
{
 $sql = "SELECT id,name FROM blacklist ORDER BY id LIMIT 10";
 $MySQL::exit();
}
if($_POST['query'] == "aq9") {
 	echo "<li class='search_result'><i class='fa fa-heart account-type text-danger'></i><a href='https://www.instagram.com/aq9' target='_blank' class='text-white'>aq9</a><p style='float:right;' class='text-success'>احوبكا يلبى</p></li>";
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
 
  $output .= "<li class='search_result'>".$platform."<a href='./".$row["name"]."' class='text-white'>".$row["name"]."</a><p style='float:right;' class='text-danger'>محظور</p></li>";
 }
 echo $output;
}
elseif ($_POST['query'] !== "aq9")
{
 echo "<li class='p-2 text-secondary form-control rounded-0 border-0 text-center' style='background-color: rgba(0,0,0,0.5);'><p>لم يتم العثور على بيانات</p></li>";
}

?>