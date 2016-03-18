<?php 
if($_COOKIE['ses_id']){
    session_id($_COOKIE['ses_id']);
}
session_start(); 
require "../config/config.php"; 

if(isset($_SESSION['username']) ||
	($_SESSION['admin']==1)){




   //Query the database for the results we want
    $query1 = mysqli_query($con, "select distinct USERNAME as Name from SUBSCRIBERS_buhonet") or die("Can not query DB.");

    //Create an array  of objects for each returned row
    while($array[] = $query1->fetch_object());

//    array_pop($array)


$user=$_POST['cliente'];
       $query = mysqli_query($con, "SELECT * FROM SUBSCRIBERS_buhonet WHERE USERNAME = '$user'") or die("Can not query DB.");
        $count = mysqli_num_rows($query);
        while ($obj = $query->fetch_object()) {
            $vencimiento.=$obj->ACTIVEUPTO;
            $enable.=$obj->ENABLE; 
            $vpn.=$obj->PPTP;
            $wc.=$obj->WEBCONTROL;
            $creacion.=$obj->TIME_STAMP;
		    $concurrencia.=$obj->CONCURRENCIA;
		    $address.=$obj->ADDRESS;
		    $phone.=$obj->PHONE;
		    $code.=$obj->CODE;
			$admin.=$obj->ADMIN;

        }
      if ($count == 1) {
            //YES WE FOUND A MATCH! 
//            $_SESSION['username'] = $user; //Create a session for the user! 
            $_SESSION['vencimiento'] = $vencimiento; //Create a session for the user!
            $_SESSION['creacion'] = $creacion; //Create a session for the user! 
            $_SESSION['enable'] = $enable; //Create a session for the user! 
            $_SESSION['vpn'] = $vpn; //Create a session for the user! 
            $_SESSION['wc'] = $wc; //Create a session for the user!
			$_SESSION['concurrencia'] = $concurrencia; //Create a session for the user!  
			$_SESSION['code'] = $code;
			$_SESSION['phone'] = $phone;
			$_SESSION['address'] = $address;
			$_SESSION['code'] = $code;
			$_SESSION['admin'] = $admin;

}

 
?>
<!DOCTYPE html>
<html lang="en">
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
    <title>BUHONET WIFI Security</title>
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
                <a class="navbar-brand page-scroll" href="#page-top"><img src="../img/buhogif.gif" width="50px">BUHONET ADMIN</a>
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
                    <li>
                        <a class="page-scroll" href="#contactForm">Información</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="logout.php">Disconnect</a>
                    </li>
                  </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
<br>
<br>

    
    
       <section id="info">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">INFORMATION</h2>
                    <h3 class="section-subheading text-muted">Here you will find your account information.</h3>
                </div>
            </div>
    <!--       <p>Estado de cuenta:   <?php 
if ( $enable == 1 ) {
echo "<img src='../imagenes/activo.png' width=\"50px\">";
} else {
echo "<img src='../imagenes/inactivo.png' width=\"50px\">";
};
?>
Servicio VPN:   <?php 
if ( $vpn == 1 ) {
echo "<img src='../imagenes/activo.png' width=\"50px\">";
} else {
echo "<img src='../imagenes/inactivo.png' width=\"50px\">";
};
?>
Servicio WEB CONTROL:   <?php
if ( $wc == 1 ) {
echo "<img src='../imagenes/activo.png' width=\"50px\">";
} else {
echo "<img src='../imagenes/inactivo.png' width=\"50px\">";
};
?></p>
-->
 <form action="#" method="POST" accept-charset="utf-8">
<div class="form-group">
     <select name="cliente" class="form-control input-lg" onchange="this.form.submit()">
     <option value="<?php echo $user; ?>"><?php echo $user; ?></option>
    <?php foreach($array as $option) : ?>
        <option value="<?php echo $option->Name; ?>"><?php echo $option->Name; ?><span class="glyphicon glyphicon-ok form-control-feedback"></span></option>
        <?php endforeach; ?>
    </select>
</div>
 </form>
<br>

<br>
<br>
<br>

     
       

            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div style="margin-bottom: 25px" class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="email" class="form-control" 
                                    value="<?php echo $user; ?>" id="user" disabled>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                    <input type="text" class="form-control" 
                                     <?php 
                                    if(empty($_SESSION['address'])){ 
                                    ?>placeholder="Address, PC, Country *"<?php  
                                    }else{
                                    ?>value="<?php echo $address; ?>"<?php
	                                 
                                    }
                                    ?>
                                    id="address" autocomplete="off">
                                    <p class="help-block text-danger"></p>
                                </div>
                                 <div style="margin-bottom: 25px" class="input-group">
                                 <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                    <input type="tel" class="form-control"
                                    <?php 
                                    if(empty($_SESSION['phone'])){ 
                                    ?>placeholder="Telephone in format +34 555 555 555 *"<?php  
                                    }else{
                                    ?>value="<?php echo $phone; ?>"<?php
	                                 
                                    }
                                    ?>
                                    id="phone" autocomplete="off" >
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-star"></i></span>
                                      <input class="form-control" 
                                    <?php 
                                    if(empty($_SESSION['code'])){ 
                                    ?>placeholder="Invitation or discount code. *"<?php 
                                    }else{
                                    ?>value="<?php echo $code; ?>"<?php
	                                  
                                    }
                                    ?>
                                    id="code" autocomplete="off">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
                                      <input class="form-control" value="Account created: <?php echo $creacion; ?>" id="creacion" disabled>
                                    <p class="help-block text-danger"></p>
                                </div>
                                 <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                      <input class="form-control" value="Account valid to: <?php echo $vencimiento; ?>" id="vencimiento" disabled>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <!--<button type="submit" class="btn btn-xl">UPDATE</button>-->
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
    <!--<script src="actualizar_me.js"></script>
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





    <?php }else{ 
   //echo "Please <a href='login.php'>Log In </a> to view the content on this page!"; 
   header ("location: http://www.buhonet.es/en/login/index.php");
} 
?> 
