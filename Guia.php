<?php include ('index_header.php'); ?>
<?php include ('navbar.php'); ?>

<!--Guia de envio-->
<?php include ('Conexion.php'); 

$tiendas = "SELECT * FROM tiendas"
?>

<h1>Crear Guia De Envio</h1>
<hr>

<div class="container p-4">   
<div class="row">
<div class="col-md-8">

    <form action="Consu_Guias.php" method="post">
    <!--Tienda Origen-->
    <label for="Origen">Origen:</label>
    <select name="t_Origen" id="t_origen">
        <option value="0">--</option>
        <?php

            $sql = "SELECT  id_tienda, Nombre_tienda FROM tiendas";

            $query = $conn->query($sql); 
        
            while($valores = mysqli_fetch_array( $query)){
            echo '<option value="'.$valores['id_tienda'].'">'.$valores['Nombre_tienda'].'</option>';

        } 
        ?>
    </select>
    <br>

    <!--Tienda Destino-->
    <label for="Destino">Destino:</label>
    <select name="t_Destino" id="t_destino">
        <option value="0">--</option>
        <?php

            $sql = "SELECT  id_tienda, Nombre_tienda FROM tiendas";

            $query = $conn->query($sql); 
        
            while($valores = mysqli_fetch_array( $query)){
            echo '<option value="'.$valores['id_tienda'].'">'.$valores['Nombre_tienda'].'</option>';

        } 
        ?>
    </select>
    <!--demas datos de la guia-->
        <div class="form-group">
            <input type="number" name="Valor_declarado" class="form-control" placeholder="Valor Declarado:" autofocus>
        </div>
        <div class="form-group">
            <input type="text" name="Contenido" class="form-control" placeholder="Contenido:" autofocus>
        </div>
        <div class="form-group">
            <input type="text" name="Observaciones" class="form-control" placeholder="Observaciones:" autofocus>
        </div>

        <label for="Detalle">Detalle del empaque</label>

        <div class="row">

            <div class="col-md-4">
                    <div class="form-group">
                        <input type="number" name="Alto" class="form-control" placeholder="Alto:" autofocus>
                    </div>
            </div>
            <div class="col-md-4">
                    <div class="form-group">
                        <input type="number" name="Ancho" class="form-control" placeholder="Ancho:" autofocus>
                    </div>
            </div>
            <div class="col-md-4">
                    <div class="form-group">
                        <input type="number" name="Largo" class="form-control" placeholder="Largo:" autofocus>
                    </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-6">
                    <div class="form-group">
                        <input type="number" name="Peso" class="form-control" placeholder="Peso:" autofocus>
                    </div>
            </div>
            <div class="col-md-6">
                    <div class="form-group">
                        <input type="number" name="Unidades" class="form-control" placeholder="Unidades:" autofocus>
                    </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                    <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block" name="save_guia"  value="Guardar">
                    </div>                        
            </div>
            <div class="col-md-6">
                        <div class="form-group">
                        <input type="submit" class="btn btn-danger btn-block" name="Cancelar"  value="Cancelar">
                        </div>                       
            </div>
        </div>          
    </form>
</div>

</div>
</div>

