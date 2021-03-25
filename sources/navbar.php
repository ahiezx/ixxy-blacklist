<div id="usercontent">
<div class="nav">	
	<ul>
		<h3 class="webname">S T A N.</h3>
		<?php 
		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		echo '
		<a href="#"><li class="navbtn">Contact</li></a>
		<a href="#"><li class="navbtn">About</li></a>
		<a href="login"><li class="navbtn fright">Login</li></a>';
		 }

		elseif(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true)
		{
			echo '
<script>
function openNav() {
  document.getElementById("settings").style.width = "250px";
  document.getElementById("usercontent").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("settings").style.width = "0";
  document.getElementById("usercontent").style.marginLeft= "0";
}
</script>
			';
			$link_err = $user_err = $oldpass_err = $confimpass_err = $newpass_err = $email_err = "";
			$this_username = $_SESSION['username'];
			if (isset($_POST["username"])) {
				if(!preg_match("/[A-Za-z0-9_]/", trim($_POST["username"])) || preg_match("/([%\$#\*\s]+)/", trim($_POST["username"])) || preg_match("/([أ-ي]+)/", trim($_POST["username"]))) {
					$new_user = $this_username;
				}
				else {
					$new_user = $_SESSION['username'] = $_POST['username'];
				}
			}
			elseif (!isset($new_user)) {
				$new_user = $_SESSION['username'];
			}
			if (isset($_POST["username"])) {
			    if(empty(trim($_POST["username"]))){
			        $user_err = '


					                    <script>
					                    openNav();
					                    	var cont = document.getElementsByClassName("colcolcont")[1];
					                    	var conts = document.getElementsByClassName("colcont")[0];
					                    	cont.style.display = "block";
					                    	conts.style.display = "block";
					                    </script>		

			        Please enter a username.';
			    }				
			    elseif(!preg_match("/[A-Za-z0-9_]/", trim($_POST["username"])) || preg_match("/([%\$#\*\s]+)/", trim($_POST["username"])) || preg_match("/([أ-ي]+)/", trim($_POST["username"]))) {
			    	$new_user = $_SESSION['username'];
			        $user_err = '



					                    <script>
					                    openNav();
					                    	var cont = document.getElementsByClassName("colcolcont")[1];
					                    	var conts = document.getElementsByClassName("colcont")[0];
					                    	cont.style.display = "block";
					                    	conts.style.display = "block";
					                    </script>		

			        Username does not support spaces or special characters';
			    }
			    elseif(strlen(trim($_POST["username"])) > 32){
			        $user_err = '


					                    <script>
					                    openNav();
					                    	var cont = document.getElementsByClassName("colcolcont")[1];
					                    	var conts = document.getElementsByClassName("colcont")[0];
					                    	cont.style.display = "block";
					                    	conts.style.display = "block";
					                    </script>			        


			        Please use a shorter username, less than 32 characters.';
			    }	

					else{
					        // Prepare a select statement
					        $sql = "SELECT id FROM accounts WHERE username = ?";
					        
					        if($stmt = mysqli_prepare($mysql, $sql)){
					            // Bind variables to the prepared statement as parameters
					            mysqli_stmt_bind_param($stmt, "s", $param_username);
					            
					            // Set parameters
					            $param_username = trim($_POST["username"]);
					            
					            // Attempt to execute the prepared statement
					            if(mysqli_stmt_execute($stmt)){
					                /* store result */
					                mysqli_stmt_store_result($stmt);
					                
					                if(mysqli_stmt_num_rows($stmt) == 1){
					                    $user_err = '

					                    <script>
					                    openNav();
					                    	var cont = document.getElementsByClassName("colcolcont")[1];
					                    	var conts = document.getElementsByClassName("colcont")[0];
					                    	cont.style.display = "block";
					                    	conts.style.display = "block";

					                    </script>

					                    This username is already taken.';
					                } else{
					                    $username = trim($_POST["username"]);
					                }
					            } else{
					                echo "Oops! Something went wrong. Please try again later.";
					            }
					        }

					         
					        // Close statement
					        mysqli_stmt_close($stmt);
					    }}
    if(empty($user_err)){
        // Prepare an insert statement
        $sql = "UPDATE accounts SET username=? WHERE username=?";
         
        if($stmt = mysqli_prepare($mysql, $sql)){    	
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_new_u, $param_u);            

            // Set parameters
            $param_u = $this_username;
            $param_new_u = $new_user;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                $this_username = $_SESSION['username'];
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

  //   	if(!isset($_POST["oldpass"]) && !isset($_POST["newpass"]) && !isset($_POST["confirm_pass"])) {
		// 			        $sql5 = "SELECT password FROM accounts WHERE username = '$this_username'";
		// 			        $results = $mysql->query($sql5);
		// 			        if ($results->num_rows > 0) {
		// 			        while($row = $results->fetch_assoc()) {
		// 			        	$user_pass = $row["password"];
		// 			        	global $user_pass;
		// 			        }
		// 			    }
		// 			    else {
		// 			    	echo "No Password Defined";
		// 			    }

		// 			    $_POST['oldpass'] = $user_pass;
		// 			    $_POST['newpass'] = $user_pass;
		// 			    $_POST['confirm_pass'] = $user_pass;
		// 			    echo $_POST['oldpass'];
		// 			    	if(isset($_POST["oldpass"]) && isset($_POST["newpass"]) && isset($_POST["confirm_pass"])) {
		// 			    		if (empty($_POST["oldpass"])) {
		// 			    			$oldpass_err = "Fill this";
		// 			    		}
		// 			    		if (empty($_POST["newpass"])) {
		// 			    			$newpass_err = "Fill this";
		// 			    		}  
		// 			    		if (empty($_POST["confirm_pass"])) {
		// 			    			$confimpass_err = "Fill this";
		// 			    		}       		  		
		// 			    	}			
		// 			    }
		// $_POST['oldpass'] = $_POST['newpass'] = $_POST['confirm_pass'] = $user_pass;
		// if (isset($_POST["oldpass"]) && isset($_POST["newpass"]) && isset($_POST["confirm_pass"])) {
		// 			    		if (empty($_POST["oldpass"])) {
		// 			    			$oldpass_err = "Fill this";
		// 			    		}
		// 			    		if (empty($_POST["newpass"])) {
		// 			    			$newpass_err = "Fill this";
		// 			    		}  
		// 			    		if (empty($_POST["confirm_pass"])) {
		// 			    			$confimpass_err = "Fill this";
		// 			    		}       		  		
					    	
		// 					    		  }					    		  
					    			    		    			
		echo 

		'

		<style type="text/css">

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: rgba(25,25,25,0.9);
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 75px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #d2d2d2;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #ffffff;
  background-color: rgba(25,25,25,0.7);
}

.sidenav .closebtn {
  position: absolute;
  top: 9;
  right: 35px;
  font-size: 36px;
  margin-left: 50px;
  transition: .2s;
}
.sidenav .closebtn:hover {
	cursor: pointer;
	color: red;
	transition: .2s;
}

#usercontent {
  transition: margin-left .5s;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}			
		</style>
<div id="settings" class="sidenav">
  <span href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</span>
  <a href="#" class="collapsible">Account</a>
  <div class="colcont">
  	<form action="#" method="post">
  <a href="#" class="collapsible collapsebutton" style="font-size: 20px;">Change Password</a>
    <div class="colcolcont">
	    	<p>Old Password</p>
	    	<label class="error_code">'.$oldpass_err.'</label>
	  			<input type="Password" name="oldpass" class="collapsebutton"><br>
	  		<p>New Password</p>
	  		<label class="error_code">'.$newpass_err.'</label>
	  			<input type="Password" name="newpass" class="collapsebutton"><br>
	  		<p>Confirm Password</p>
	  		<label class="error_code">'.$confimpass_err.'</label>
	  			<input type="Password" name="confirm_pass" class="collapsebutton"><br>

	</div>
  <a href="#" class="collapsible collapsebutton" style="font-size: 20px;">Account Info</a>

    <div class="colcolcont">
    <div class="pfp"></div>
    <br>
	    	<p>E-mail</p>
	  			<input type="email" disabled="" name="test" class="collapsebutton" placeholder="Email Address" value="Email@stan.com"><br><br><p>Public Email</p><input type="checkbox" checked="" disabled=""><br><br>
	  		<p>Username</p>
	  			<label class="error_code">'.$user_err.'</label>	  		
	  			<input type="text" name="username" class="collapsebutton" placeholder="Username" value="'.$this_username.'"><br>
	  		<p>Bio</p>
	  			<input type="text" disabled="" name="test" class="collapsebutton" placeholder="Mood"><br>
	</div>	

	<a href="#" class="collapsible collapsebutton" style="font-size: 20px;">Linked Accounts</a>

    <div class="colcolcont">
	    	<p>Instagram</p>
	    		<label class="error_code">'.$link_err.'</label>
	  			<input type="text" disabled="" name="test" class="collapsebutton" placeholder="Username"><br>
	  		<p>Twitter</p>
	  			<label class="error_code">'.$link_err.'</label>
	  			<input type="text" disabled="" name="test" class="collapsebutton" placeholder="Username"><br>
	  		<p>Facebook</p>
	  			<label class="error_code">'.$link_err.'</label>	  		
	  			<input type="text" disabled="" name="test" class="collapsebutton" placeholder="Username"><br>
	  		<p>Snapchat</p>
	  			<label class="error_code">'.$link_err.'</label>	  		
	  			<input type="text" disabled="" name="test" class="collapsebutton" placeholder="Username"><br>
	</div>		
	<input type="submit">
	</form>
</div>
  <a href="#">Help</a>
</div>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
				<div class="dropdown">
		  <a><li class="navbtn">Account</li></a>
		  <div class="dropdown-content">
		  	<a id="account" href="'.$rootpath.'user#'.$_SESSION['username'].'"><i class="fas fa-user dropleft"></i> My Profile</a>
		    <a href="#" onclick="openNav()"><i class="fas fa-cog dropleft"></i> Settings</a>
		    <a id="privacypolicy" href="#"><i class="fas fa-receipt dropleft"></i> Privacy Policy</a>
		  </div>
		</div>				
		<div class="dropdown">
		  <a><li class="navbtn">Products</li></a>
		  <div class="dropdown-content">
		    <a href="#"><i class="fas fa-shopping-cart dropleft"></i> Buy Products</a>
		    <a href="#"><i class="fab fa-product-hunt dropleft"></i> My Products</a>
		    <a href="'.$rootpath.'free-products#'.$_SESSION['username'].'"><i class="fas fa-hashtag dropleft"></i> Free Products</a>
		  </div>
		</div>	
		<div class="search">
			<input style="display: inline-block;" autocomplete="off" id="username" type="text" name="username" placeholder="Search..">
		</div>';
		if (isset($_GET['e'])) {
			if ($_GET['e'] == 18) {
				echo " Query Error";
			}
		}
		echo '
		<div id="avatar"></div>
		<a href="logout"><li class="navbtn fright">Logout</li></a>
		<script>
$(document).ready(function(){


 function load_data(query)
 {
  $.ajax({
   url:"search_fetch.php",
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
		'		
		;



		 }		  

		 ?>
	</ul>
</div>
<div id="search_result"></div>