<?php
session_start();
require "../config/config.php"; //Connection Script, include in every file! 
//Check to see if the user is logged in. 
//if (isset($_SESSION['username'])) {
//    header('location: http://www.buhonet.es/es/home/index.php'); //isset check to see if a variables has been 'set' 
//}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
            <meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="BUHONET">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
  <!--  <meta name="viewport" content="width=device-width, initial-scale=1"> -->
        <meta name="description" content="Control Parental, Internet por fin segura">
<meta name="keywords" content="Parental control,Control parental,parental,control, seguridad, internet, niños, seguros, navegación, filtros, antivirus, internet segura, firewall, cortafuego, analisis, paginas, seguras">
<meta name="author" content="admin@buhonet.es">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <link rel="apple-touch-icon" href="../img/touch-icon-iphone.png">
	<link rel="apple-touch-icon" sizes="76x76" href="../img/touch-icon-ipad.png">
	<link rel="apple-touch-icon" sizes="120x120" href="../img/touch-icon-iphone-retina.png">
	<link rel="apple-touch-icon" sizes="152x152" href="../img/touch-icon-ipad-retina.png">
	<link href="../img/buhonet.png" rel="apple-touch-startup-image" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	  <meta content="true" name="HandheldFriendly" />
    <title><?php echo $empresa; ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/agency.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/css.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top"><img src="../img/buhogif.gif" width="50px"><?php echo $empresa; ?></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="../index.html" >Inicio</a>
                    </li>
                    <!--<li>
                        <a class="page-scroll" href="#login" >Ca</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="registrarme.php">Registro</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="contraseña.php">Recuperar contraseña</a>
                    </li>-->
                  </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>


<br>  
    
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contratar</h2>
                    <h3 class="section-subheading text-muted">En está página puede ver los diferentes productos que ofrecemos.</h3>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2>Servicio BUHONET</h2>
                            <p class="item-intro text-muted">Servicio configurable manualmente.</p>
                            <!--<img class="img-responsive" src="img/portfolio/basico.png" alt="">-->
                            <p>Servicio de filtrado Inteligente de paginas, imágenes y palabras.</p>
                            <p>En estos servicios se incluye ANTIVIRUS y VPN</p>
                            <p>Servicio configurable por el usuario (puede solicitar la ayuda de un técnico especializado), se realiza la configuración del navegador y el servicio se disfruta de manera inmediata.</p>
                            <p>* Para disfrutar del control por tiempos, acceso a diferentes redes y el filtrado de redes sociales, necesita adquirir el router wifi que se vende por separado.</p>
                                
                                   <div class="row">
                                   <hr  width="30%" size="15" noshade>
                     <div class="col-sm-6">
                     <p>Contrate el servicio durante un mes. A un precio muy económico.<p>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="8WDCER7Z37JPN">
<input type="image" src="http://buhonet.es/es/img/portfolio/contratar1mes.png" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
<img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
</form>



<br>
<br>
<br>
                </div>
                <div class="col-sm-6">
                <p>Contrate el servicio durante tres meses.Con un descuento especial.<p>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="66F3KUBZYNYGC">
<input type="image" src="http://buhonet.es/es/img/portfolio/contratar3meses.png" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
<img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
</form>



<br>
<br>
<br>
                </div>
                <div class="col-sm-6">
         <p>Contrate el servicio durante seis meses. Con un descuento especial.<p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="W37LXD3B2LDFU">
<input type="image" src="http://buhonet.es/es/img/portfolio/contratar6meses.png" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
<img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
</form>


<br>
<br>

<br>
<br>
<br>
                </div>
                <div class="col-sm-6">
         <p>Contrate el servicio durante un año, con un descuento especial, paga 10 meses y disfruta de 12.<p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="STP749SKHZVWG">
<input type="image" src="http://buhonet.es/es/img/portfolio/contratar99.png" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
<img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
</form>


<br>
<br>

<br>
<br>
<br>
                </div>
                <div class="col-sm-6">
         <p>Contrate el servicio durante un año he incluya el router wifi, con un descuento especial.<p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="42WF26QZ7SDBW">
<input type="image" src="http://buhonet.es/es/img/portfolio/contratar129.png" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
<img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
</form>


<br>
<br>


<br>
<br>
<br>
                </div>
                <div class="col-sm-6">
         <p>Compre el router wifi, 100% compatible con el servicio de BUHONET, y se incluye un mes de servicio gratis.<p>
         <p>El precio incluye envío a España, Peninsula y Baleares. Otros destinos, por favor consultar.</p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="XYVJU4UJR6EG6">
<input type="image" src="http://buhonet.es/es/img/portfolio/comprarRouter.png" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
<img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
</form>


<br>
<br>


<br>
<br>
<br>
                </div>
            </div>

                  </div>
    </section>
    
    
                               
                                

    
<?php
include_once "../tools/footer.php";
?>
        </div><!-- /container -->
    <!-- jQuery Version 1.11.0 -->
    <script src="../js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="../js/classie.js"></script>
    <script src="../js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->

    <!-- Custom Theme JavaScript -->
    <script src="../js/agency.js"></script>

<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://piwik.walii.es/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 1]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
    g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="http://piwik.walii.es/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->    </body>
</html>
