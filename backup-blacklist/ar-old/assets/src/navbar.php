<div>
	<div class="head mt-2">
		<a href="/blacklist"><img src="https://cdn.discordapp.com/attachments/680727088755376157/699809759947391047/image0.jpg" class="justify-content-center d-flex mx-auto img" width="158.75" height="158.75"></a>
	</div>
	<div class="container mt-2">
		<div class="row text-light text-center mx-auto justify-content-center" style="border:solid #6C757D 1px;border-radius: 3px;">
			<div class="d-flex" >
			<li class="nav-item d-inline"><a class="nav-link text-light" href="blacklist-search">بحث</a></li><a class="nav-link text-secondary jawline">|</a>
			<li class="nav-item d-inline"><a class="nav-link text-light" href="/blacklist/legitimate-shops">متاجر مضمونة</li><a class="nav-link text-secondary jawline">|</a>			
			<li class="nav-item d-inline"><a class="nav-link text-light" href="/blacklist/report">ابلاغ</a>	
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
		echo "<h6 class='text-white'>".htmlspecialchars($_SESSION['username']);
		if ( $date >= 5 && $date <= 11 ) {
		    echo " ,صباح الخير </h6>";
		} else if ( $date >= 12 && $date <= 18 ) {
		    echo " ,مساء الخير </h6>";
		} else if ( $date >= 19 || $date <= 4 ) {
		    echo " ,مساء الخير </h6>";
		}		
	}	
	if (isset($_SESSION['level'])) {
		if ($_SESSION['level'] == 3){
			echo '<li class="d-block"><a class="text-light text-center pt-4" href="../staff-access"><i class="fa fa-users mb-2" style="font-size:10px;vertical-align: middle;padding-top:5px;"></i> Staff Access</a>	';
		}
		
	}
	?>				
	</div>	
</div>