<?phpinclude('Consu_Guias')?>
    
    <?php

    $url ='https://ws.coordinadora.com/ags/1.5/server.php?wsdl';
    $client = new SoapClient( $url, ['soap_version' => SOAP_1_1,'trace' => 1, 'exceptions' => 0]);
     
    
    //consumo del servicio
    $param = array(
        'p'=>[
            'codigo_remision' => ,
            'nit' => '901020769',
            'div' => '01',
            'referencia' => '',
            'imagen' => 1, //1 si se devuelve la imagen, 0 en caso contrario
            'anexo' => '', //1 si se devuelve el anexo de la imagen, 0 en caso contrario
            'apikey' => '696227f6-6a15-11ea-bc55-0242ac130003',
            'clave' => 'KO7LyNN71f19O'
        ]
    );

    $respuesta = $client->Seguimiento_simple($param);
    var_dump($respuesta);
        
?>