<?php
	include "../app/ProductsController.php";
	include "../app/BrandController.php";

	$productController = new ProductsController();

	$brandController = new BrandController();

	$products = $productController->getProducts();
	$brands = $brandController->getBrands();

	#echo json_encode($_SESSION);
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include "../layouts/head.template.php"; ?>
	</head>
	<body>

		<?php include "../layouts/nav.template.php"; ?>

		<!--CONTAINER-->
		<div class="container-fluid">
			
			<div class="row">

				<!--SIDEBAR-->
				<?php include "../layouts/sidebar.template.php"; ?>

				<!--CONTENT-->
				<div class="col-lg-10 col-sm-12">
					
					<!--BREAD-->
					<div class="border-bottom">
						
						<div class="row m-2">
							
							<div class="col">
								<p>Productos</p>
							</div>
							<div class="col">
								<button onclick="addProduct()" data-bs-toggle="modal" data-bs-target="#createProductModal" class="btn btn-info float-end">
									Añadir producto
								</button>
							</div>

						</div>

					</div>

					<!--CONTENT-->

					<div class="row">
						
						<?php if (isset($products) && count($products)>0): ?>
						<?php foreach ($products as $product): ?> 
						
						<div class="col-md-3 col-sm-10 p-2">
							
							<div class="card mb-1" >
							  <img src="<?= $product->cover ?>" class="card-img-top img-fluid" alt="...">
							  <div class="card-body">
							    <h5 class="card-title text-center">
							    	<?= $product->name ?>
							    </h5>
    							<h6 class="card-subtitle mb-2 text-muted text-center">
    								<?= isset($product->brand->name)?$product->brand->name:'No Brand' ?>
    							</h6>
							    <p class="card-text">
							    	Some quick example text to build on the card title and make up the bulk of the card's content
							    </p>
							    <div class="row">
							    	<a data-product='<?= json_encode($product) ?>' onclick="editProduct(this)" href="#" data-bs-toggle="modal" data-bs-target="#createProductModal" class="btn btn-warning col-6">
								    	Editar
								    </a>
								    <a  onclick="remove(<?= $product->id ?>)" href="#" class="btn btn-danger col-6">
								    	Eliminar
								    </a>
								    <a href="details.php?slug=<?= $product->slug ?>" class="btn btn-info col-12">
								    	Detalles
								    </a>
							    </div>
							  </div>
							</div>


						</div>

						<?php endforeach ?> 
						<?php endif ?>

					</div>

				</div>

			</div>

		</div>

		<!-- Modal -->
		<div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>

		      <form enctype="multipart/form-data" method="post" action="../app/ProductsController.php">

			      <div class="modal-body">
			        
			        

			      	<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1">@</span>
					  <input id="name" name="name" type="text" class="form-control" placeholder="Product name" aria-label="Username" aria-describedby="basic-addon1">
					</div>

					<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1">@</span>
					  <input id="slug" name="slug" type="text" class="form-control" placeholder="Product slug" aria-label="Username" aria-describedby="basic-addon1">
					</div>

					<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1">@</span>
					  <input id="description" name="description" type="text" class="form-control" placeholder="Product description" aria-label="Username" aria-describedby="basic-addon1">
					</div>

					<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1">@</span>
					  <input id="features" name="features" type="text" class="form-control" placeholder="Product features" aria-label="Username" aria-describedby="basic-addon1">
					</div>

					<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1">@</span>

					  <select id="brand_id" class="form-control" name="brand_id">ç
					  	<?php if (isset($brands) && count($brands)): ?> 
					  	<?php foreach ($brands as $brand): ?>
					  		<option value="<?= $brand->id ?>">
					  			<?= $brand->name ?>
					  		</option>
					  	<?php endforeach ?>
					  	<?php endif ?>
					  	
					  </select>

					   
					</div>

					<div class="input-group mb-3">
					  <span class="input-group-text" id="basic-addon1">@</span>
					  <input name="cover" type="file" class="form-control" placeholder="Product features" aria-label="Username" aria-describedby="basic-addon1">
					</div>
					

			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary">Save changes</button>
			      </div>

			      <input id="oculto_input" type="hidden" name="action" value="create">

			      <input type="hidden" id="id" name="id">

		      </form>
		    </div>
		  </div>
		</div>

		<?php include "../layouts/scripts.template.php"; ?>

		<script type="text/javascript">
			function remove(id)
			{
				swal({
				  title: "Are you sure?",
				  text: "Once deleted, you will not be able to recover this imaginary file!",
				  icon: "warning",
				  buttons: true,
				  dangerMode: true,
				})
				.then((willDelete) => {
				  if (willDelete) {
				    swal("Poof! Your imaginary file has been deleted!", {
				      icon: "success",
				    });

				    var bodyFormData = new FormData();

				    bodyFormData.append('id', id);
				    bodyFormData.append('action', 'delete');


				    axios.post('../app/ProductsController.php', bodyFormData)
					  .then(function (response) {
					    console.log(response);

					    location.reload()

					  })
					  .catch(function (error) {
					    console.log(error);
					  });


				  } else {
				    swal("Your imaginary file is safe!");
				  }
				});
			}

			function addProduct()
			{
				document.getElementById("oculto_input").value = "create";
			}

			function editProduct(target)
			{
				document.getElementById("oculto_input").value = "update";	

				let product = JSON.parse(target.getAttribute('data-product'));
				console.log(product.name)

				document.getElementById("name").value = product.name;
				document.getElementById("description").value = product.description;
				document.getElementById("slug").value = product.slug;
				document.getElementById("features").value = product.features;
				document.getElementById("brand_id").value = product.brand_id;
				document.getElementById("id").value = product.id; 
			}
		</script>

	</body>
</html>









