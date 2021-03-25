

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
	<div class="cons">
	<div class="container text-center text-white p-5 mt-5" style="background-color: rgba(255,255,255,0.03);">
		
		<h1> البحث عن المحلات التجارية في القائمة السوداء</h1>
		<h5 class="text-secondary">ابحث عن  المحلات التجارية في القائمة السوداء للحفاظ على سلامة تسوقك <br> وضمان شرعية البائع</h5>
			<div class="col-12">
				<p class="text-secondary"><a href="/blacklist" class="text-white nav-link">Translate to English</a></p>
			</div>

	</div>

	<div class="container p-5" style="background-color: rgba(255,255,255,0.05);">
		
		<div class="justify-content-center d-flex mx-auto searching">
			
			<div class="form-group text-white">
				<label for="search">البحث</label>
				<div class="search">
					<input autocomplete="off" id="username" type="text" name="username" placeholder="أسم, رقم الهاتف, اسم مستخدم, ID, Snap" class="form-control rounded-0 border-0">
				</div>
				<div id="search_result">
					

				</div>
				<small id="privacypolicy" class="form-text text-muted">
				  طلبات البحث الخاصة بك موقعة في قاعدة البيانات الخاصة بنا ، لا تتردد في البحث عن أي شيء. لن تتم مشاركة بياناتك مع أي أطراف ثالثة.
				</small>
			</div>

		</div>

	</div>

	<div class="container p-5 justify-content-center d-flex mx-auto text-white" style="background-color: #111;">
					<div class="justify-content-center d-flex mx-auto">
					<div class="col-12 mt-4 mb-4 align-middle mx-auto">
						<a href="https://www.instagram.com/fvs" class="text-light ml-3 mr-3 align-middle" target="_blank" style="font-size:20px"><i class="fab fa-instagram"></i></a>&#183;
						<a href="https://discord.gg/8u5R5WG" class="text-light ml-3 mr-3 align-middle" target="_blank" style="font-size:20px"><i class="fab fa-discord"></i></a><small class="text-right">:التواصل</small><br><hr class="bg-white mx-auto justify-content-center">
						<a href="https://www.paypal.me/k6b" class="text-light  ml-3 mr-3 align-middle" target="_blank" style="font-size:20px"><i class="fab fa-paypal"></i></a> / <a href="https://www.paypal.me/ahmedxalharbi" class="text-light  ml-3 mr-3 align-middle" target="_blank" style="font-size:20px"><i class="fab fa-paypal"></i></a>
						<small class="text-right">:التبرع</small>
					</div>	
					</div>

	</div>
	<div class="container p-5 mb-5 justify-content-center text-center text-white" style="background-color: rgba(245,245,245,0.09);">

		<i class="fa fa-users mb-2"></i>
		<div class="col-12"><h1>المشرفين</h1></div>
		<div class="col-8 justify-content-center mx-auto text-center">
			
			<h4 class="d-inline"><a href="https://www.instagram.com/fvs" class="text-danger" target="_blank">@fvs</a></h4>
			<hr class="bg-white w-25 mx-auto">
			<h4 class="d-inline"><a href="https://www.instagram.com/wn3" class="text-white" target="_blank">@wn3</a></h4>
			<h4 class="d-inline"><a href="https://www.instagram.com/ipnnz" class="text-white" target="_blank">@ipnnz</a></h4>
			<h4 class="d-inline"><a href="https://www.instagram.com/q6t" class="text-white" target="_blank">@q6t</a></h4>
			<h4 class="d-inline"><a href="https://www.instagram.com/y.fx" class="text-white" target="_blank">@y.fx</a></h4><br>
			<small class="text-secondary">.تواصل مع المشرفين  للإبلاغ عن متجر</small>

		</div>

	</div>	
	</div>	
	<div class="container-fluid p-5" id="footer" style="background-color: rgba(255,255,255,1);">
		
		<div class="row text-center">
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

