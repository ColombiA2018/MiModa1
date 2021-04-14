<?php

include("Conexion.php");

if(isset($_POST['Cancelar'])){
    header("location: tiendas.php");
}

if (isset($_POST['save_guia'])){
    $Nombre_tienda = $_POST['Nombre_tienda'];
    $Direccion_tienda = $_POST['Direccion_tienda'];
    $Telefono_tienda = $_POST['Telefono_tienda'];
    $Ciudad_tienda = $_POST['Ciudad_tienda'];

    $query = "INSERT INTO tiendas(Nombre_tienda, Direccion_tienda, Telefono_tienda, Ciudad_tienda) VALUES ('$Nombre_tienda', '$Direccion_tienda', '$Telefono_tienda', '$Ciudad_tienda')";
    $result = mysqli_query($conn, $query);
    if (!$result){
        die("Fallo Guardando Tienda");
    }

    header("location: Consu_Guias.php");

    
}

?>