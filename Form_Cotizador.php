<?php include ('index_header.php'); ?>
<?php include ('navbar.php'); ?>

<!--Guia de envio-->
<?php include ('Conexion.php'); 

?>

<h1>Cotizar Envio</h1>
<hr>

<div class="container p-4">   
<div class="row">
<div class="col-md-8">

    
    
<form action="Cons_Cotizador.php" method="post">
<!--demas datos de la guia-->
        <div class="form-group">
            <input type="number" name="COrigen" class="form-control" placeholder="Origen:" autofocus>
        </div>
        <div class="form-group">
            <input type="number" name="CDestino" class="form-control" placeholder="Destino:" autofocus>
        </div>
        <div class="form-group">
            <input type="number" name="Valor_declarado" class="form-control" placeholder="Valor Declarado:" autofocus>
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
                    <input type="submit" class="btn btn-success btn-block" name="Cotizar"  value="Cotizar">
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

