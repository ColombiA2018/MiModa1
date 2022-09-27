<?php include ('Form_Cotizador.php'); ?>
<?php include ('Conexion.php'); ?>

    <?php


    //conexion con el WSDL
    $url ='https://ws.coordinadora.com/ags/1.5/server.php?wsdl';
    $client = new SoapClient( $url, ['soap_version' => SOAP_1_1,'trace' => 1, ' ' => 0]);
    

    // Opcion cancelar

    if(isset($_POST['Cancelar'])){
    header("index.php");
    };


//Tomamos los datos del formulario para cotizar
if (isset($_POST['Cotizar'])){
  $COrigen = $_POST['COrigen'];
  $CDestino = $_POST['CDestino'];
  $Alto = $_POST['Alto'];
  $Ancho = $_POST['Ancho'];
  $Largo = $_POST['Largo'];
  $Peso = $_POST['Peso'];
  $Unidades = $_POST['Unidades'];
  $v_declarado = $_POST['Valor_declarado'];
}  
  
  $DetalleCOT[] = (object)[
    'ubl' => 0,
    'alto' => $Alto,
    'ancho' => $Ancho,
    'largo' => $Largo,
    'peso' => $Peso,
    'unidades' => $Unidades,
  ];

  $nivel_servicio[] = (object)[
    'item' => 1,
];

$paramCoti = array(
    'p'=>[
        'nit' => '900464589',
        'div' => '01',
        'cuenta' => 2,
        'producto' => 0,
        'origen' => $COrigen, //Toma el numero ingresado como ciudad origen
        'destino' => $CDestino, //toma el destino
        'valoracion' => $v_declarado,
        'nivel_servicio' => $nivel_servicio,
        'detalle' => $DetalleCOT,
        'apikey' => '4c7a2b56-b9db-11e9-a2a3-2a2ae2dbcce4',
        'clave' => 'E0PmQ9cYH0uEcR'
    ]
);


//nueva variable que ejecuta, la conexion del WSDL --> el servicio que se desea consumir --> los parametros a enviar
$respuestaCotizador = $client->Cotizador_cotizar($paramCoti);
//nueva variable para almacenar los datos de respuesta, en este caso solo el numero de la guia

$Flete_Total = $respuestaCotizador->Cotizador_cotizarResult->flete_total;
echo "<br>";
echo "<br>";
echo "Fleto Total";
echo $Flete_Total;
echo "<br>";

?>