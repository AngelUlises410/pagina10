<?php include("template/cabecera.php"); ?>

<?php
include("administrador/config/bd.php"); 
$sentenciaSQL= $conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listaLibros=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);    
?>

<?php foreach($listaLibros as $libro) { ?>

<div class="col-md-3">
<div class="card">
<img class="card-img-top" src="./img/<?php echo $libro['imagen']; ?>" alt="">

<div class="card-body">
<h4 class="card-title"> <?php echo $libro['nombre']; ?> </h4>
<a> <?php echo $libro['pais']; ?> </a>
<br>
<a> <?php echo $libro['fecha']; ?> </a>
<br>
<a name="" id="" class="btn btn-primary" href="https://goalkicker.com/" role="button">ver mas</a>
</div>
</div>
</div>

<?php } ?>







<?php include("template/pie.php"); ?>
