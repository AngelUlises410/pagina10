<?php
session_start();
//develoteca es usuario para iniciar sesion en login y sistema es contraseña
if($_POST){
  if(($_POST['usuario']=="angel")&&($_POST['contrasena']=="12345")){
    
    $_SESSION['usuario']="ok";
    $_SESSION['nombreUsuario']="Angel Ulises Jimenez Carrales";
    
    header('location:inicio.php');
  }else{
    $mensaje="Error: El usuario o contraseña son incorrectos";
  }
    
}
?>

<!doctype html>
<html lang="en">
  <head>
    <title>administrador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      


<div class="container">
  <div class="row">
<!--este es para centrar el lgin-->
<div class="col-md-4">
    
</div>

    <div class="col-md-4">

    <br><br><br>
           <div class="card">
            <div class="card-header">
            login
            </div>
               <div class="card-body">
                
               <?php if(isset($mensaje)){?>
                <div class="alert alert-danger" role="alert">
                <?php echo $mensaje; ?>
                </div>
              <?php } ?>


               <form method="POST">
               <div class = "form-group">
               <label>Usuario:</label>
               <input type="text" class="form-control" name="usuario"  placeholder="escribe tu usuario">
               <small id="emailHelp" class="form-text text-muted">Aqui puedes ingresar el usuario.</small>
               </div>

               <div class="form-group">
               <label>Contraseña:</label>
               <input type="password" class="form-control" name="contrasena" placeholder="escribe tu contraseña">
               </div>
               
               <button type="submit" class="btn btn-primary">Entrar al administrador</button>
               </form>
               
               


               </div>

            </div>

    </div>
   </div>
</div>
   
  </body>
</html>
    








