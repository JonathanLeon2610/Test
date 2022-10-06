<!-- 
jleon_19@alu.uabcs.mx
q&9fKU70qw9699
-->
<?php
include_once "./app/config.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>
			Acceso al panel
		</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
		<!-- <link rel="stylesheet" type="text/css" href="public/css/main.css?v=1"> -->
		<style type="text/css">
			div.login{ 
			}
			.row{
				height: 500px;
			}
		</style>
	</head>
	<body>

		<div class="container">
			
			<section>
				
				<div class="row justify-content-md-center align-items-center">
					
					<div class="col-md-6 border col-lg-6 col-sm-12 login">
						<h1 class="text-center">
							Acceso al panel
						</h1>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
						</p>

						<form method="post" action="<?=BASE_PATH?>auth" class="form">
							
							<div>
								<label>
									Correo electrónico
								</label>
								<div class="input-group mb-3">
								  <span class="input-group-text" id="basic-addon1">@</span>
								  <input name="email" type="text" class="form-control" placeholder="username@fakemail.com" aria-label="Username" aria-describedby="basic-addon1">
								</div>
							</div>

							<div>
								<label>
									Contraseña
								</label>
								<div class="input-group mb-3">
								  <span class="input-group-text" id="basic-addon1">@</span>
								  <input name="password" type="password" class="form-control" placeholder="* * * * * " aria-label="Username" aria-describedby="basic-addon1">
								</div>
							</div>

							<button type="submit" class="btn btn-primary col-12 mb-3">
								Acceder
							</button>

							<input type="hidden" value="access" name="action">
							<input type="hidden" name="global_token" value="<?= $_SESSION['global_token']?>">

						</form>

					</div> 

				</div>

			</section>

		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
	</body>
</html>