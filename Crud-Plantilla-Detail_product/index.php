<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
</head>
<body class="m-0 row justify-content-center">
    <div class="container col-auto ">
            <form method="post" action="app/AuthController.php">
                    <fieldset>
                        <legend>
                            <h1>Datos de acceso</h1>
                        </legend>
                        <div class="form-floating mb-3 ">
                            <input type="email" name="email" class="form-control shadow-lg bg-body rounded" style="width: 200px" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" name="password" class="form-control shadow-lg bg-body rounded" style="width: 200px" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-outline-primary">Acceder</button>
                        <input type="hidden" value="access" name="action">
                    </fieldset>
            </form>
    </div>
</body>
</html>