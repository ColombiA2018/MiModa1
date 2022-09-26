<?php include ('index_header.php'); ?>
<?php include ('navbar.php'); ?>

<!--Guia de envio-->
<?php include ('Conexion.php'); 

$tiendas = "SELECT * FROM traslados
INNER JOIN tiendas
ON traslados.id_tienda = tiendas.id_tienda"
?>

<h1>Traslados</h1>
<hr>


<div clas="col-md-8">
<table class="table table-bordered">
   <thead>
      <tr>

      
      <th>Numero de Traslado</th>
      <th>Tienda Origen</th>
      <!--<th>Tienda Destino</th>-->
      <th>Numero de Guía</th>
      <th>Consultar Estado Envio</th>
     </tr>
   </thead>

<?php $resultados = mysqli_query($conn, $tiendas);

while($row=mysqli_fetch_assoc($resultados)) { ?>
<tbody>
<tr>    
<td><?php echo $row["id"];?></td>
<td><?php echo $row["Nombre_tienda"];?></td>
<td><?php echo $row["numero_remision"];?></td>
<td>

<span>
<a class="btn btn-primary" href="Seguimiento_Simple_Consumo.php?guia_Cons=<?=$row["numero_remision"]?>" role="button">CONSULTAR</a>
</span>
</td>
<?php } mysqli_free_result($resultados); ?>

         </tr>
      </tbody>
</table>

<img src="" alt="">

</div>