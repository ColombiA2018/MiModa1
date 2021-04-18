<?php include ('Guia.php'); ?>
<?php include ('Conexion.php'); ?>

<?php


//conexion con el WSDL
$urlSanbox15 ='https://sandbox.coordinadora.com/agw/ws/guias/1.6/server.php?wsdl'; // URL o WSDL, del servicio
$client = new SoapClient( $urlSanbox15, ['soap_version' => SOAP_1_1,'trace' => 1, 'exceptions' => 0]); // Consumo del servicio como Cliente,


// Opcion cancelar

if(isset($_POST['Cancelar'])){
  header("Guia.php");
};


//datos del traslado tomados por pantalla
//tomamos los datos de los input del formulario Guia.php
if (isset($_POST['save_guia'])){
  $Alto = $_POST['Alto'];
  $Ancho = $_POST['Ancho'];
  $Largo = $_POST['Largo'];
  $Peso = $_POST['Peso'];
  $Unidades = $_POST['Unidades'];
  $v_declarado = $_POST['Valor_declarado'];
  $cont = $_POST['Contenido'];
  $obs = $_POST['Observaciones'];
  
  //Datos Origen tomados del select para asignarle el remitente al consumo

   $id_tienda_origen= $_POST['t_Origen'];
  
   // con el id de la tienda generamos un request para traer el resto de la informacion, nombre, direccion, telefono y ciudad

   $sql2 = "SELECT * FROM tiendas WHERE id_tienda = $id_tienda_origen";
 
   $query = $conn->query($sql2);
   
   //iniciamos variables como datos del remitente

   $nom_Origen = '';
   $dir_Origen = '';
   $tel_Origen = '';
   $ciu_Origen = '';
   
   //enlazamos los datos de la consulta a la base de datos con las nuevas variables

   while($valores = mysqli_fetch_array( $query)){
   //echo $valores['id_tienda'];
   $nom_Origen = $valores['Nombre_tienda'];
   $dir_Origen = $valores['Direccion_tienda'];
   $tel_Origen = $valores['Telefono_tienda'];
   $ciu_Origen = $valores['Ciudad_tienda'];
   }

    //Datos Origen tomados del select para asignarle el remitente al consumo datos Destino
  $id_tienda_destino= $_POST['t_Destino'];

  // con el id de la tienda generamos un request para traer el resto de la informacion, nombre, direccion, telefono y ciudad


  $sql1 = "SELECT * FROM tiendas WHERE id_tienda = $id_tienda_destino";

  $query = $conn->query($sql1);


  //Iniciamos variables como datos del destino
  $nom_destino = '';
  $dir_destino = '';
  $tel_destino = '';
  $ciu_destino = '';
  
  
   //enlazamos los datos de la consulta a la base de datos con las nuevas variables
  while($valoresd = mysqli_fetch_array( $query)){
  //echo $valoresd['id_tienda'];
  $nom_destino = $valoresd['Nombre_tienda'];
  $dir_destino = $valoresd['Direccion_tienda'];
  $tel_destino = $valoresd['Telefono_tienda'];
  $ciu_destino = $valoresd['Ciudad_tienda'];
  }

  
  // parametros del consumo, un arreglo que debe ir para el consumo
  //asignamos las variables que trajimos del formulario de entrada a cada paremetro que se debe enviar. 

  $datalle[] = (object)[
    'ubl' => 0,
    'alto' => $Alto,
    'ancho' => $Ancho,
    'largo' => $Largo,
    'peso' => $Peso,
    'unidades' => $Unidades,
    'referencia' => '',
    'nombre_empaque' => '',
];

//parametros del consumo, a traves de una variable
//asignamos las variables que trajimos del formulario de entrada a cada paremetro que se debe enviar.
$paramGenerarGuia = [ //Parametros para la creacion de la guia, segun doc de coordianadora
  'codigo_remision' => '', // null
  'fecha' => '', // null
  'id_cliente' => 26252,
  'id_remitente' => '', // null
  'nit_remitente' => '', // null'
  'nombre_remitente' => $nom_Origen,
  'direccion_remitente' => $dir_Origen,
  'telefono_remitente' => $tel_Origen,
  'ciudad_remitente' => '11001000',
  'nit_destinatario' => '1', 
  'div_destinatario' => '1',
  'nombre_destinatario' => $nom_destino,
  'direccion_destinatario' => $dir_destino,
  'ciudad_destinatario' => '11001000',
  'telefono_destinatario' => $tel_destino,
  'valor_declarado' => "$v_declarado",
  'codigo_cuenta' => 2,
  'codigo_producto' => 0,
  'nivel_servicio' => 1,
  'linea' => '', //null
  'contenido' => $cont,
  'referencia' => '',
  'observaciones' => $obs, //null
  'estado' => 'IMPRESO',
  'detalle' => $datalle,
  'cuenta_contable' => '', // null
  'centro_costos' => '', // null
  'recaudos' => '', // null
  'margen_izquierdo' => '', // null
  'margen_superior' => '', // null
  'usuario_vmi' => '', // null
  'formato_impresion' => '', // null
  'atributo1_nombre' => '', // null
  'atributo1_valor' => '', // null
  'notificaciones' => '', // null
  'atributos_retorno' => '',
  'nro_doc_radicados' => '', // null
  'nro_sobre' => '', // null
  'codigo_vendedor' => '', // null
  'usuario' => 'rumbosexpress.ws',
  'clave' => '911fc91a56f8aa4430885d27b2f960384c0d67e52822377a5ecc59ff8431180c'
];

//nueva variable que ejecuta, la conexion del WSDL --> el servicio que se desea consumir --> los parametros a enviar
$soapResponse = $client->Guias_generarGuia($paramGenerarGuia);

//nueva variable para almacenar los datos de respuesta, en este caso solo el numero de la guia

$new_guia = $soapResponse->codigo_remision;

//query para almacenar el numero del traslado, remitente y numero de guia, en la tabla traslados

$query_tras = "INSERT INTO traslados(id_tienda, numero_remision) VALUES ('$id_tienda_origen', '$new_guia')";    
$result = mysqli_query($conn, $query_tras);
    if (!$result){
        die("Fallo Guardando Traslado");
    }
	
	//generacion de pdf
	
	$pdf_content= $soapResponse->pdf_guia;
	//Decode pdf content
	$pdf_decoded = base64_decode ($pdf_content);
	//se almacena el pdf en la carpeta archivos, se le da como nombre el mismo numero de guia
	$pdf = fopen ('Archivos/'.$new_guia.'.pdf','w');
	fwrite ($pdf,$pdf_decoded);
	//close output file
	fclose ($pdf);
	
	//mostrar por mensaje del numero de guia y subventana con pdf

	echo'<script type="text/javascript">
		alert("Guia Guardada : '.$new_guia.'");
		window.open("Archivos/'.$new_guia.'.pdf","_blank","width=850,height=400");
		</script>';
};