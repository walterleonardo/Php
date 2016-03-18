<?php
$modulo =isset($_REQUEST['variable']);
$sensor =isset($_REQUEST['variable']);
$host =isset($_REQUEST['variable']);
if (isset($_GET['modulo'])) {
$modulo = $_GET['modulo'];
} else {
$modulo = "";
}

if (isset($_GET['sensor'])) {
$sensor = $_GET['sensor'];
} else {
$sensor = "";
}

//var_dump($_GET); // Element 'foo' is string(1) "a"
//var_dump($_POST); // Element 'bar' is string(1) "b"
//var_dump($_REQUEST); // Does not contain elements 'foo' or 'bar'
//PHP PAGE EXAMPLE
require_once("RandomClass.php");
//Creamos un objeto de la clase randomTable
$rand = new RandomTable();
//insertamos un valor aleatorio
//$randdata = $rand->insertRandom();
//obtenemos toda la información de la tabla random
$rawdata = $rand->getAllInfoNode($modulo,$sensor);
$rawdataout = $rand->getInfoOut($modulo);
//nos creamos dos arrays para almacenar el tiempo y el valor numérico
$valoresArray;
$timeArray;
$moduloArray;
$out1Array;
$out2Array;
$out3Array;
$out4Array;
$date;
$name= $rawdataout[0][5];
$type1= $rawdataout[0][7];
$type2= $rawdataout[0][8];
$type3= $rawdataout[0][9];
$type4= $rawdataout[0][10];
$typeSensor = '$type';

//en un bucle for obtenemos en cada iteración el valor númerico y
//el TIMESTAMP del tiempo y lo almacenamos en los arrays
for($i = 0 ;$i<count($rawdata);$i++){
    $valoresArray[$i]= $rawdata[$i][0];
    //OBTENEMOS EL TIMESTAMP
    $time= $rawdata[$i][1];
    $date = new DateTime($time);
    //ALMACENAMOS EL TIMESTAMP EN EL ARRAY
    $timeArray[$i] = $date->getTimestamp()*1000;
}
//echo "HEMOS PASADO EL QUERRY";
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <LINK href="css/estilo.css" rel="stylesheet" type="text/css">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/cssplot.full.css" rel="stylesheet">
<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="BUHONET">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
        <!--  <meta name="viewport" content="width=device-width, initial-scale=1"> -->
        <meta name="description" content="Control, domotica, domo, domotic, remote">
        <meta name="author" content="admin@buhonet.es">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
        <link rel="apple-touch-icon" href="img/touch-icon-iphone.png">
        <link rel="apple-touch-icon" sizes="76x76" href="img/touch-icon-ipad.png">
        <link rel="apple-touch-icon" sizes="120x120" href="img/touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="152x152" href="img/touch-icon-ipad-retina.png">
        <link href="img/buhonet.png" rel="apple-touch-startup-image" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta content="true" name="HandheldFriendly" />
        <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">
        <title></title>
        <!--<LINK href="estilo.css" rel="stylesheet" type="text/css">-->
</head>
<BODY>
<!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">HOME CONTROL</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <div id="status"></div>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
 <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
      </div>
<h2>GRAFICO Module <?php echo $name ?> (<?php echo $modulo ?>) Sensor (<?php echo $sensor ?>)</h2>
<a class="btn btn-primary" href="module.php?modulo=<?php echo $modulo?>">VOLER al MODULO</a>
<a class="btn btn-primary" href="index.php">VOLER a HOME</a>
<meta charset="utf-8">
<h3>Sensor type
<?php
switch ($sensor) {
    case 1:
        echo $type1;
        break;
    case 2:
        echo $type2;
        break;
    case 3:
        echo $type3;
        break;
    case 4:
        echo $type4;
        break;
}

?>
</h3>
<div id="contenedor"></div>
<script src="https://code.jquery.com/jquery.js"></script>
    <!-- Importo el archivo Javascript de Highcharts directamente desde su servidor -->
<script src="js/highstock.js"></script>
<script src="js/exporting.js"></script>
<script>

chartCPU = new Highcharts.StockChart({
    chart: {
        renderTo: 'contenedor'
        //defaultSeriesType: 'spline'

    },
    rangeSelector : {
        enabled: false
    },
    title: {
        text: 'SENSOR'
    },
    xAxis: {
        type: 'datetime'
        //tickPixelInterval: 150,
        //maxZoom: 20 * 1000
    },
    yAxis: {
        minPadding: 0.1,
        maxPadding: 0.9,
        title: {
            text: 'Value',
            margin: 5
        }
    },
    series: [{
        name: 'Value',
        data: (function() {
                // generate an array of random data
                var data = [];
                <?php
                    for($i = 0 ;$i<count($rawdata);$i++){
                ?>
                data.push([<?php echo $timeArray[$i];?>,<?php echo $valoresArray[$i];?>]);
                <?php } ?>
                return data;
            })()
    }],
    credits: {
            enabled: false
    }
});

</script>
</div>
</BODY>
</html>