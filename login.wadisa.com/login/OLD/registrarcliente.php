<?php
session_start();
require "../config/config.php"; //Connection Script, include in every file! 
//Check to see if the user is logged in. 
if (isset($_SESSION['username'])) {
    header('location: ../home/index.php'); //isset check to see if a variables has been 'set' 
}
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
    <title>WADISA WIFI Counter</title>
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
                <a class="navbar-brand page-scroll" href="#page-top"><img src="../img/buhogif.gif" width="50px">QR</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="../index.php" >Inicio</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="index.php" >Acceso</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#registro">Registro</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="contraseña.php">Recuperar contraseña</a>
                    </li>
                  </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>


<br>      
    
     <section id="registro">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">REGISTRO</h2>
                    <h3 class="section-subheading text-muted">El registro es necesario para la utilización de nuestros servicios</h3>
                </div>
            </div>
           
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div style="margin-bottom: 25px" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="email" class="form-control" placeholder="Su Correo *" id="user" required autofocus data-validation-required-message="Por favor ingrese su correo.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="password" class="form-control" placeholder="Su Clave *" id="pass" required data-validation-required-message="Por favor ingrese su clave.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                 <div style="margin-bottom: 25px" class="input-group">
                                 <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="password" class="form-control" placeholder="Repita su Clave *" id="rpass" required data-validation-required-message="Por favor ingrese su clave nuevamente.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                                      <input class="form-control" placeholder="Si eres humano ¿Suma <?php echo $val1?>+<?php echo $val2?>?" id="sec" required data-validation-required-message="Please enter a message.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-gift"></i></span>
                                      <input class="form-control" placeholder="Código de descuento o invitación" id="code">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-xl">Registrar</button>
                            </div>
                        </div>
                    </form>
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
    <script src="../js/jqBootstrapValidation.js"></script>
    <script src="../js/registro_me.js"></script>

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
