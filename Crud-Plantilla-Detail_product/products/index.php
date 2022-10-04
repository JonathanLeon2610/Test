<!-- 
jleon_19@alu.uabcs.mx
q&9fKU70qw9699
-->
<?php
session_start();
include "../app/ChargeProductController.php";
$products= new ChargeProductController();
$products=$products-> chargeProducts($_SESSION["token"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../layouts/head.template.php"?>  
    <?php 
    $brands= ChargeProductController::chargeBrandsId();
    ?> 
</head>
<body>
    <?php include "../layouts/navbar.template.php"?>    
    <!-- Modal -->
    <div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" action="../app/ChargeProductController.php" enctype="multipart/form-data">}
            <div class="modal-body">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Name</span>
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="name" id="name">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Slug</span>
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="slug" id="slug">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Description</span>
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="description" id="description">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Features</span>
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="features" id="features">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Brand_id</span>
                <select class="form-select" aria-label="Default select example" name = "brand_id" id="brand_id">
                <?php foreach($brands as $brand): ?>
                <option value=<?php echo $brand->id?>><?php echo $brand->name?></option>
                <?php endforeach;?>
                </select>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Cargar Imagen</span>
                <input type="file" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="uploadedfile">
                
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>

            <input type="hidden" name="action" value="create" id="oculto_input">
            <input type="hidden"  id="id">
        </form>
        </div>
    </div>
    </div>
    <div class="container-fluid">
        <?php include "../layouts/sidebar.template.php"?> 
            <div class="col-lg-10">
                <div class="row d-flex flex-row justify-content-between mt-2 border-bottom">
                    <div class="col mt-4 mb-4">
                        <h1>Productos</h1>
                    </div>
                    <div class="col-2"><button class="btn btn-info mb-4 mt-4" data-bs-toggle="modal" data-bs-target="#modalAgregar" onclick="addProduct()">Añadir producto</button></div>
                </div>
                <div class="row">
                    <?php foreach($products as $item):?>
                        <div class="col-4 mb-4 mt-2">
                        <div class="card bg-light " style="width: 20rem;">
                            <img src="<?php echo $item['cover']?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title "><?php echo $item['name']?></h5>
                                <p class="card-text "><?php echo $item['description']?></p>
                                <div class="row">
                                    <div class="col">
                                        <a class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#modalAgregar" data-product='<?= json_encode($item)?>' onclick="editProduct(this)" >Editar</a>
                                    </div>
                                    <div class="col">
                                        <a href="#" class="btn btn-danger w-100" onclick="remove(this)">Eliminar</a>
                                    </div>
                                    <hr>
                                    <a href="./details.php?slug=<?php echo $item["slug"]?>" class="btn btn-primary w-100 py-3 mx-0 float-end">
                                        Detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <?php include "../layouts/scripts.template.php"?>
    <script type="text/javascript">
        function remove(target){
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
                } else {
                    swal("Your imaginary file is safe!");
                }
                });
        }

        function addProduct(){
            document.getElementById("oculto_input").value="create";
        }
        function editProduct(target){
            document.getElementById("oculto_input").value="update";
            let product=JSON.parse(target.getAttribute('data-product'));
            console.log(product);
            document.getElementById("name").value=product.name;
            document.getElementById("description").value=product.description;
            document.getElementById("slug").value=product.slug;
            document.getElementById("features").value=product.features;
            document.getElementById("brand_id").value=product.brand_id;
            document.getElementById("id").value=product.id;
        }
    </script>
</body>
</html>