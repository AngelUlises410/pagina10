<?php include("../template/cabecera.php"); ?>

<?php
//variables
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtPais=(isset($_POST['txtPais']))?$_POST['txtPais']:"";
$txtFecha=(isset($_POST['txtFecha']))?$_POST['txtFecha']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

//incluir base de datos
include("../config/bd.php");




switch($accion){
    
    case "Agregar":
    // INSERT INTO `libros` (`id`, `nombre`, `imagen`) VALUES (NULL, 'libros php', 'imagen.jpg');

    $sentenciaSQL= $conexion->prepare("INSERT INTO libros (nombre, pais, fecha, imagen) VALUES (:nombre, :pais, :fecha, :imagen);");
    $sentenciaSQL->bindParam(':nombre',$txtNombre);
    $sentenciaSQL->bindParam(':pais',$txtPais);
    $sentenciaSQL->bindParam(':fecha',$txtFecha);

    $fecha= new  DateTime();
    $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";

    $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

    if($tmpImagen!=""){
        move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
    }

    $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
    $sentenciaSQL->execute();
    header("Location:productos.php");
    break;

    case "Modificar":
    
        $sentenciaSQL= $conexion->prepare("UPDATE libros SET nombre=:nombre WHERE id=:id");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL= $conexion->prepare("UPDATE libros SET pais=:pais WHERE id=:id");
        $sentenciaSQL->bindParam(':pais',$txtPais);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();


        $sentenciaSQL= $conexion->prepare("UPDATE libros SET fecha=:fecha WHERE id=:id");
        $sentenciaSQL->bindParam(':fecha',$txtFecha);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        if($txtImagen!=""){

        $fecha= new  DateTime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
        
        move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
        
        $sentenciaSQL= $conexion->prepare("SELECT imagen FROM libros WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        
         if(isset($libro["imagen"])&&($libro["imagen"]!="imagen.jpg")){
             if(file_exists("../../img/".$libro["imagen"])){
                unlink("../../img/".$libro["imagen"]);
             }
         }

        $sentenciaSQL= $conexion->prepare("UPDATE libros SET imagen=:imagen WHERE id=:id");
        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        }

        header("Location:productos.php");
        // echo "presionado boton Modificar";
    break;

    case "Cancelar":
    header("Location:productos.php");
        // echo "presionado boton Cancelar";
    break;

    case "Seleccionar":

    $sentenciaSQL= $conexion->prepare("SELECT * FROM libros WHERE id=:id");
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();
    $libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

    $txtNombre=$libro['nombre'];
    $txtPais=$libro['pais'];
    $txtFecha=$libro['fecha'];
    $txtImagen=$libro['imagen'];
    

    // echo"presionado boton Seleccionar";
    break;

    case "Borrar":

    $sentenciaSQL= $conexion->prepare("SELECT imagen FROM libros WHERE id=:id");
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();
    $libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        
    if(isset($libro["imagen"])&&($libro["imagen"]!="imagen.jpg")){
             if(file_exists("../../img/".$libro["imagen"])){
                unlink("../../img/".$libro["imagen"]);
             }
    }
    
    $sentenciaSQL= $conexion->prepare("DELETE FROM libros WHERE id=:id");
    $sentenciaSQL->bindParam(':id',$txtID);
    $sentenciaSQL->execute();
    
    header("Location:productos.php");
    // echo"presionado boton Borrar";
    break;
}

$sentenciaSQL= $conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listalibros=$sentenciaSQL->fetchALL(PDO::FETCH_ASSOC);
?>

<div class="col-md-5">

<div class="card">
    <div class="card-header">
        Datos de libros
    </div>

    <div class="card-body">
    

<form method="POST" enctype="multipart/form-data" >
    
    <div class ="form-group">
    <label for="txtID">ID:</label>
    <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID"  placeholder="ID">
    </div>

    <div class="form-group">
    <label for="txtNombre">Nombre:</label>
    <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
    </div>


    <div class="form-group">
    <label for="txtPais">Pais:</label>
    <input type="text" required class="form-control" value="<?php echo $txtPais; ?>" name="txtPais" id="txtPais" placeholder="Pais">
    </div>
    

    <div class="form-group">
    <label for="txtFecha">Fecha:</label>
    <input type="Date" required class="form-control" value="<?php echo $txtFecha; ?>" name="txtFecha" id="txtFecha" placeholder="Fecha">
    </div>

    <div class="form-group">
    <label for="txtNombre">Imagen:</label>

    </br>
    
    <?php if($txtImagen!=""){ ?>
    
        <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen;?>" width="50" alt="" srcset="">    

    <?php } ?>

    <input type="file"  class="form-control" name="txtImagen" id="txtImagen" placeholder="Nombre del libro">
    </div>

    <div class="btn-group" role="group" aria-label="">
        <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>
        <button type="submit" name="accion" <?php echo ($accion!=="Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
        <button type="submit" name="accion" <?php echo ($accion!=="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
    </div>
    </form>
    </div>

    
</div>
    
    
    
</div>


<div class="col-md-7">

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Pais</th>
            <th>Fecha</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($listalibros as $libro) { ?>

        <tr>
            <td><?php echo $libro['id']; ?></td>
            <td><?php echo $libro['nombre']; ?></td>
            <td><?php echo $libro['pais']; ?></td>
            <td><?php echo $libro['fecha']; ?></td>
            <td>
            <img class="img-thumbnail rounded" src="../../img/<?php echo $libro['imagen']; ?>" width="50" alt="" srcset="">    
            </td>
            
            <td>
            <!--CODIGO PARA BOTONES-->
            <form method="post">
            <input type="hidden" name="txtID" id="txtID" value="<?php echo $libro['id']; ?>"/>
            
            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>
            
            <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>
            </form>
            </td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>

<?php include("../template/pie.php"); ?>