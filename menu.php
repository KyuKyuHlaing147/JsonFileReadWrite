<?php
	require 'header.php';
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#editMenudiv").hide();
		getAllMenus();

		function getAllMenus(){
			$.get('menulist.json', function(response){

				console.log(typeof(response));
				var menuObjectArray=response;
				console.log(menuObjectArray);

				var html='';var j=1;
				$.each(menuObjectArray, function(i,v){
					var name=v.name;
					var price=v.price;
					var photo=v.photo;

					html+=`<tr>
								<td style="text-align: center;">${j++}</td>
								<td style="text-align: center;">${name}</td>
								<td style="text-align: center;">${price}</td>

								<td style="text-align: center;">
								<button class="btn btn-outline-primary detailBtn" data-id="${i}" data-name="${name}" data-price="${price}" data-photo="${photo}">Detail</button>
								<button class="btn btn-outline-warning editBtn" data-id="${i}" data-name="${name}" data-price="${price}" data-photo="${photo}"">Edit</button>
								<button class="btn btn-outline-danger deleteBtn" data-id="${i}">
								Delete</button>
					</tr>`
				});
				$('tbody').html(html);
			});
		}

		//start detail
			$('tbody').on('click','.detailBtn',function(){
				var id = $(this).data("sid");
				var name = $(this).data("name");
				var price = $(this).data("price");
				var photo = $(this).data("photo");
				
				$("#exampleModalLabel").text(name);
				$("#detail_name").text(name);
				$("#detail_price").text(price);
				$("#detail_photo").attr('src',photo);
				$("#detailModal").modal('show');
			});
		//end detail

		//edit start
			$('tbody').on('click','.editBtn',function(){
				//alert('ok');
				var id = $(this).data("sid");
				var name = $(this).data("name");
				var price = $(this).data("price");
				var photo = $(this).data("photo");

				//show and hide
				$("#editMenudiv").show();
				$('#addMenudiv').hide();
				
				//to get data value
				$("#edit_id").val(id);
				$('#edit_name').val(name);
				$('#edit_price').val(price);

				$('#edit_oldphoto').val(photo);

				$('#showOldPhoto').attr('src',photo);

			}) //end edit

			//Deleta
		$('tbody').on('click','.deleteBtn',function(){
			var id=$(this).data('id');

			var ans= confirm('Are u sure want to delete?');

			if (ans) { 

				//console.log(ans);
				$.post('deletemenu.php',{
					id:id
				},function(data){
					getAllMenus();
				})
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

<!-- Add Menu -->
<div class="container" id="addMenudiv">
		
		<div class="row mt-5">
			<div class="col-12 text-center">
				<h1 class="display-4"> Add New Menu </h1>
			</div>
		</div>

		<div class="row mt-5">
			<div class="col align-self-center">

				<form action="addmenu.php" method="POST" enctype="multipart/form-data">
					
					<div class="form-group row">
						<label for="photo" class="col-sm-2 col-form-label"> Photo </label>
					    <div class="col-sm-10">
					    	<input type="file"  id="photo" name="photo">
					    </div>
					</div>

					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label"> Name </label>
					    <div class="col-sm-10">
					    	<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
					    </div>
					</div>

					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label"> Price</label>
					    <div class="col-sm-10">
					    	<input type="number" class="form-control" id="name" placeholder="Enter Price" name="price">
					    </div>
					</div>
					
					<div class="form-group row">
					    <div class="col-sm-10">
					   		<button type="submit" class="btn btn-primary" style="width:150px;float: right;" >
					   			Add Menu
					   		</button>
					    </div>
					</div>

				</form>
			</div>
		</div>
	</div><hr>
<!-- End Add Menu -->

<!-- start detail modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  		<div class="modal-dialog">
   			<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title" id="exampleModalLabel"></h5>
       					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
         					<span aria-hidden="true">&times;</span>
       					</button>
      			</div>
      			<div class="modal-body">
     	   			<div class="container">
     	   				<div class="row">
     	   					<div class="col-4">
     	   						<img src="" class="img-fluid" id="detail_photo">
     	   					</div>
     	   					<div class="col-8">
	     	   					<h5 id="detail_name"></h5>
	     	   					<h5 id="detail_price"></h5>
     	   					</div>
     	   				</div>
     	   			</div>
     			</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      			</div>
    		</div>
 		</div>
	</div>
<!-- end deatil modal -->


<!-- start edit menu -->
<div class="container" id="editMenudiv">	
	<div class="row mt-5">
		<div class="col-12 text-center">
			<h1 class="display-4"> Edit Existing Menu </h1>
		</div>
	</div>
		
		
	<div class="row mt-5">
		<div class="col align-self-center">
			<form action="updatemenu.php" method="POST" enctype="multipart/form-data">

				<input type="hidden" name="id" id="edit_id">
				<input type="hidden" name="oldphoto" id="edit_oldphoto"> <!-- to send old photo path -->
					
				<div class="form-group row">
					<label for="photo" class="col-sm-2 col-form-label"> Photo </label>
						<div class="col-sm-10">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
		 		 				<li class="nav-item" >
		    						<a class="nav-link active" id="oldprofile-tab" data-toggle="tab" href="#oldprofile" role="tab" aria-controls="home" aria-selected="true">Old Photo</a>	
		  						</li>
		 						<li class="nav-item">
		    						<a class="nav-link" id="newprofile-tab" data-toggle="tab" href="#newprofile" role="tab" aria-controls="photo" aria-selected="false">New Photo</a>
		  						</li>
							</ul>

						    <div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="oldprofile" role="tabpanel" aria-labelledby="oldprofile-tab">
									<img src="" id="showOldPhoto" class="img-fluid" width="100px" height="90px">
								</div>
								
								<div class="tab-pane fade" id="newprofile" role="tabpanel" aria-labelledby="newprofile-tab">
									<input type="file"  id="profile" name="newphoto">
								</div>
							</div> 
						</div>
				</div>

				<div class="form-group row">
					<label for="name" class="col-sm-2 col-form-label"> Name </label>
					<div class="col-sm-10">
					    <input type="text" class="form-control" id="edit_name" placeholder="Enter Name" name="name">
					</div>
				</div>

				<div class="form-group row">
					<label for="name" class="col-sm-2 col-form-label"> Price </label>
					<div class="col-sm-10">
					    <input type="price" class="form-control" id="edit_price" placeholder="Enter price" name="price">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-sm-10">
					   	<button type="submit" class="btn btn-primary">
					   		SAVE
					   	</button>
					</div>
				</div>

				</form>
			</div>
		</div>
	</div>
<!-- end edit menu -->


<table class="table table-bordered table-striped"> 
	<thead class="thead-dark">
		<tr>
			<th style="text-align: center;">#</th>
			<th style="text-align: center;">Name</th>
			<th style="text-align: center;">Price</th>
			<th style="text-align: center;">Action</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>

<?php 
	require 'footer.php';
?>