<?php
	require 'header.php';
?>

	<script type="text/javascript">
					
		$(document).ready(function(){
			getAllMenus();

			function getAllMenus(){
				$.get('menulist.json', function(response){
					
					var menuObjectArray = response;

					var html='';
					$.each(menuObjectArray, function(i,v){
						var name=v.name;
						var price=v.price;
						var photo=v.photo;

						html+=`
								<div class="col-md-4> 
									<div class="card">
									<div class="card-img-top card-img-top-250" id="detail_photo">${photo}
									</div>
									<div class="card-block p-t-2" >
									<div class="card-header">${name}<br>${price}ks</div>
									<div class="card-text">
									<button class="btn btn-outline-danger text-danger btn-block">Add to cart</button>
									</div>
									</div></div>`
							
					});
					$('.detailShow').html(html);

				});
			}

		});
	</script>

	
	<!-- Jumbotron -->
	<div class="jumbotron bg-danger" >
		<img src="photo/1.jpg" class="img-fluid rounded-circle " style="float:left;width:120px; height: 120px;margin-left: 250px;">
		<h1 style="color:white;text-align: center;">KKK Restaurant</h1>
		<p style="color: white;text-align: center;">Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod
		 </p>
	</div>
	<!-- end jumbotron -->

	<!-- nav start -->
	<nav class="navbar navbar-expand-lg bg-dark navbar-light">
		<div class="container">
			<div class="collapse navbar-collapse" id="Navbar">
				<ul class="navbar-nav " >
					<li class="nav-item"><a class="nav-link" style="color:white;" href="index.php">Home</a></li>
					<li class="nav-item"><a class="nav-link" style="color:white;">Menu</a></li>
					<li class="nav-item"><a class="nav-link" style="color:white;">About</a></li>
					<li class="nav-item"><a class="nav-link" style="color:white;">Contact</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- nav end -->

	<!-- card slider start-->
			<div class="row detailShow" >
				
		</div>
	<!-- card slider end -->

	<br><br><button class="btn btn-primary btn-info" style="float:right;margin-right: 200px;"><a href="menu.php" style="color:white;">Add Menu</a></button><br><br>

<?php 
	require 'footer.php';
?>