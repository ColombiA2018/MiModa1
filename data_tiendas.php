<?php include ('index_header.php'); ?>
<?php include ('navbar.php'); ?>

<!--Guia de envio-->
<?php include ('Conexion.php'); 

$tiendas = "SELECT * FROM tiendas"
?>

<h1>Crear tienda</h1>
<hr>

<div class="container p-4">   
<div class="row">
<div class="col-md-8">


<!--formulario para ingresar los datos de las nuevas tiendas-->
    <form action="save_tiendas.php" method="POST">
        <div class="form-group">
            <input type="text" name="Nombre_tienda" class="form-control" placeholder="Nombre:" autofocus>
        </div>
        <div class="form-group">
            <input type="text" name="Direccion_tienda" class="form-control" placeholder="Dirección:" autofocus>
        </div>
        <div class="form-group">
            <input type="text" name="Telefono_tienda" class="form-control" placeholder="Telefono:" autofocus>
        </div>
        <div class="form-group">
            <input type="text" name="Ciudad_tienda" class="form-control" placeholder="Ciudad:" autofocus>
        </div> 
        <div class="form-group">
            <input type="submit" class="btn btn-success btn-block" name="save_tiendas"  value="Guardar">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-danger btn-block" name="Cancelar"  value="Cancelar">
        </div>  
    </form>
</div>
</div>
</div>

