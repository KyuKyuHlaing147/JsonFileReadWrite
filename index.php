<?php
	require('header.php');
?>

	<!-- menu js -->
	<script type="text/javascript">
		$(document).ready(function(){
			getAllMenus();

			function getAllMenus(){
				$.get('menulist.json',function(response){

					// !string
					var menuObjArray = response;

					var html =''; 

					$.each(menuObjArray, function(i,v){
						var name = v.name;
						var price = v.price;
						var photo = v.photo;

						//For Card
						html +=`<div class="col-lg-2 col-md-3 p-4">
									<img src="${photo}" class="card-img-top img-fluid">
									<div class="card-body text-center">
										<div class="card-block">
											${name}<br>Price: ${price}ks
		       								</div>
		     							</div>
										<button class="btn btn-outline-danger btn-block addtocart" data-id="${i}" data-name="${name}" data-price="${price}" data-profile="${photo}">Add to Cart</button>
									</div>
								</div>`

					}); 

					$('.row').html(html);

				});
			} 
			
		showdata();

		//add localstorage
		$(".loop").on("click",".addtocart",function(){
		
			var id=$(this).data('id');
			var name=$(this).data('name');
			var price=$(this).data('price');
			var photo=$(this).data('photo');
			
			var item={
				id:id,
				name:name,
				price:price,
				photo:photo,
				qty:1,
			}

			var itemlist=localStorage.getItem("item");

			var itemArray;
			if(itemlist==null){
				itemArray=[];
			}else{
				itemArray=JSON.parse(itemlist);
			}

			var status=false;
			itemArray.forEach( function(v, i) {
				if(id==v.id){
					v.qty++
					status=true;
				}
				
		});//end  add to card function

			if(status==false){
				itemArray.push(item);
			}
			
			//console.log(itemArray);
			var itemstring=JSON.stringify(itemArray);
			localStorage.setItem("item", itemstring);
			showdata();
		})


		//showdata
		function showdata(){
			var itemlist=localStorage.getItem("item");
			if(itemlist){
				var itemArray=JSON.parse(itemlist);
				
				var html="";
				var j=1;
				var total=0;
				var subtotal;
				itemArray.forEach( function(v, i) {
					
					subtotal=v.qty*v.price;
					total+=subtotal;
					html+=`<tr>
					<td>${j++}</td>
					<td>${v.name}</td>
					<td><button class="btnincrease" data-id="${i}">+</button>${v.qty}<button class="btndecrease" data-id="${i}">-</button></td>
					<td>${v.price}</td>
					<td>${subtotal}</td>
					</tr>`
				});
				html+=`<tr><td colspan="4">all total</td><td>${total}</td><tr>`
				$("tbody").html(html);
			}
		}//end show data function
		
		$("tbody").on('click','.btnincrease',function(){
			
			var id=$(this).data('id');

			var itemlist=localStorage.getItem("item");
			if(itemlist){
				var itemArray=JSON.parse(itemlist);

				itemArray.forEach( function(v, i) {

					if(i==id){
						
						v.qty++;
					}
					
				});
			var itemstring=JSON.stringify(itemArray);
			localStorage.setItem("item",itemstring);
			showdata();
			}
		})


		$("tbody").on('click','.btndecrease',function(){
			var id=$(this).data('id');

			var itemlist=localStorage.getItem("item");
			if(itemlist){
				var itemArray=JSON.parse(itemlist);

				itemArray.forEach( function(v, i) {

					if(i==id){
						v.qty--;
						if(v.qty==0){
							itemArray.splice(id, 1);
						}
					}
					
				});
			var itemstring=JSON.stringify(itemArray);
			localStorage.setItem("item",itemstring);
			showdata();
			}
		})
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

	<br><button class="btn btn-primary btn-info " style="float:right;margin-right: 200px;"><a href="menu.php" style="color:white;">Add Menu</a></button><br><br><hr>

	<!-- card start -->
	
	<div class="row loop my-4">
		
	</div>
	<!-- card -->

	<hr>
	<div class="container">	
		<div class="col-lg-12 p-2">
			<table class="table table-bordered text-center">
				<thead class="thead-dark">
					<tr>
						<th> No </th>
						<th> Name</th>
						<th> Qty </th>
						<th> Price </th>
						<th> Total </th> 
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
			
	
<?
	require('footer.php');
?>
