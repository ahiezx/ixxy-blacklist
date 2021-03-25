<style type="text/css">
.jawline {
	padding-left: 8.5 !important;padding-right: 8.5 !important;
}
</style>
<div>
	<div class="head mt-2 animated zoomIn" style="animation-delay: 1s;">
		<a href="/" class=""><img src="https://cdn.discordapp.com/attachments/680727088755376157/699809759947391047/image0.jpg" class="justify-content-center d-flex mx-auto img" width="158.75" height="158.75"></a>
	</div>
	<div class="container mt-2 animated fadeInDown p-md-0" style="animation-delay: 0.2;">
		<div class="row text-light text-center mx-auto justify-content-center" style="border:solid #6C757D 1px;border-radius: 3px;">
			<div class="d-flex" >
			<li class="nav-item d-inline"><a class="nav-link text-light animated fadeInDown" href="blacklist-search">Search</a></li><a class="nav-link text-secondary jawline animated fadeInDown" style="animation-delay: 1s;">|</a>
			<li class="nav-item d-inline"><a class="nav-link text-light animated fadeInDown" href="legitimate-shops">Markets</li><a class="nav-link text-secondary jawline animated fadeInDown" style="animation-delay: 1s;">|</a>			
			<li class="nav-item d-inline"><a class="nav-link text-light animated fadeInDown" href="middle-men">Middlemen</a></li>
			</div>
		</div>
	</div>
	<div class="container mt-4">
	<?php
	$date = date('G');
	if(!isset($_SESSION)) 
    { 
	session_name('sid');
	session_start();
	}
	if (isset($_SESSION['username'])) {
		if ( $date >= 5 && $date <= 11 ) {
		    echo "<h6 class='text-white animated fadeInUp'>Good Morning, ";
		} else if ( $date >= 12 && $date <= 18 ) {
		    echo "<h6 class='text-white animated fadeInUp'>Good Afternoon, ";
		} else if ( $date >= 19 || $date <= 4 ) {
		    echo "<h6 class='text-white animated fadeInUp'>Good Evening, ";
		}		
		echo "<span class='text-primary'>".htmlspecialchars($_SESSION['username'])."</span></h6>";
	}	
	if (isset($_SESSION['level'])) {
		if ($_SESSION['level'] == 3){
			echo '<li class="d-block animated fadeIn"><a class="text-light text-center pt-4" href="staff-access"><i class="fa fa-users mb-2" style="font-size:10px;vertical-align: middle;padding-top:5px;"></i> Staff Access</a>	';
		}
		
	}
	?>				
	</div>		
</div>