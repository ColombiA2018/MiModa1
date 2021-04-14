<?php include ('index_header.php'); ?>
<?php include ('navbar.php'); ?>

<!--Guia de envio-->
<?php include ('Conexion.php'); 

$tiendas = "SELECT * FROM tiendas"
?>

<h1>Datos de las tiendas</h1>
<hr>


<div clas="col-md-8">
<table class="table table-bordered">
   <thead>
      <tr>

      
      <th>Item</th>
      <th>Nombre de la Tienda</th>
      <th>Dirección</th>
      <th>Telefono</th>
      <th>Ciudad</th>
     </tr>
   </thead>

<?php $resultados = mysqli_query($conn, $tiendas);

while($row=mysqli_fetch_assoc($resultados)) { ?>
      <tbody>
         <tr></tr>    
<td><?php echo $row["id_tienda"];?></td>
<td><?php echo $row["Nombre_tienda"];?></td>
<td><?php echo $row["Direccion_tienda"];?></td>
<td><?php echo $row["Telefono_tienda"];?></td>
<td><?php echo $row["Ciudad_tienda"];?></td>
<?php } mysqli_free_result($resultados); ?>
         </tr>
      </tbody>
</table>

<a href="data_tiendas.php"><button  type="button" class="btn btn-light"> Crear Nueva Tienda</button></a>
</div>