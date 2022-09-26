<?php include ('index_header.php'); ?>
<?php include ('navbar.php'); ?>


<?php include ('Conexion.php'); ?>

    
    <?php

    $url ='https://ws.coordinadora.com/ags/1.5/server.php?wsdl';
    $client = new SoapClient( $url, ['soap_version' => SOAP_1_1,'trace' => 1, ' ' => 0]);
    

    $guias_enviar = $_GET['guia_Cons'];
    
    //consulta base de datos el numero de guia:
    
    

    //consumo del servicio
    $param = array(
        'p'=>[
            'codigo_remision' => $guias_enviar,
            'nit' => '900464589',
            'div' => '01',
            'referencia' => '',
            'imagen' => 1, //1 si se devuelve la imagen, 0 en caso contrario
            'anexo' => '', //1 si se devuelve el anexo de la imagen, 0 en caso contrario
            'apikey' => '4c7a2b56-b9db-11e9-a2a3-2a2ae2dbcce4',
            'clave' => 'E0PmQ9cYH0uEcR'
        ]
    );

    $respuesta = $client->Seguimiento_simple($param);
    //var_dump($respuesta);

    $estado= $respuesta->Seguimiento_simpleResult->estado->descripcion;
    echo "<br>";
    echo "<br>";
    echo "ESTADO: " ;
    echo $estado, "<br>";
    echo "<br>";
    echo "GUIA DE ENVIO: ";
    $guia= $respuesta->Seguimiento_simpleResult->codigo_remision;
    echo $guia, "<br>";
    echo "<br>";
    echo "FECHA DE ENTREGA: ";
    $fecha= $respuesta->Seguimiento_simpleResult->estado->fecha;
    echo $fecha, "<br>";
    echo "<br>";
    echo "PERSONA QUE RECIBE: ";
    $perso= $respuesta->Seguimiento_simpleResult->persona_recibe;
    echo $perso, "<br>";
    echo "<br>";
    echo "Cumplido: ";

    //mostrar imagen del cumplido
    $imagen_content = $respuesta->Seguimiento_simpleResult->imagen;
    
    $imagen_decoded = base64_decode ($imagen_content);
    
    file_put_contents("Cumplidos/$guia.png", $imagen_decoded);
    echo "<img src='Cumplidos/$guia.png' alt='guia' />";
    
?>