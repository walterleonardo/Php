<?php
require_once("../config/class.user.php");
$auth_user = new USER;

//example of request
// http://127.0.0.1:8000/home/dashboardshow.php?btn-update=enable&type=load&userid=2239&clientid=1

if (isset($_GET['btn-update'])) {
    if (isset($_GET['type']) and $_GET['type'] == 'load') {
        $uid = strip_tags(filter_input(INPUT_GET, 'userid'));
        $cid = strip_tags(filter_input(INPUT_GET, 'clientid'));
        $sql = "SELECT * FROM clients WHERE id=$cid and user_id=$uid";
        $stmt = $auth_user->runQuery($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    $file = 'saved_images/photo_UID:' . $uid . '_CID:' . $cid . '.jpg';
    ?>
    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-status-bar-style" content="black">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
            <!--  <meta name="viewport" content="width=device-width, initial-scale=1"> -->
            <meta name="description" content="Control Parental, Internet por fin segura">
            <meta name="keywords" content="Parental control,Control parental,parental,control, seguridad, internet, niños, seguros, navegación, filtros, antivirus, internet segura, firewall, cortafuego, analisis, paginas, seguras">
            <meta name="author" content="admin@WifiCounter.es">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
            <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
            <link rel="apple-touch-icon" href="../imagenes/touch-icon-iphone.png">
            <link rel="apple-touch-icon" sizes="76x76" href="../imagenes/touch-icon-ipad.png">
            <link rel="apple-touch-icon" sizes="120x120" href="../imagenes/touch-icon-iphone-retina.png">
            <link rel="apple-touch-icon" sizes="152x152" href="../imagenes/touch-icon-ipad-retina.png">
            <link href="../imagenes/WifiCounter.png" rel="apple-touch-startup-image" />
            <meta name="apple-mobile-web-app-capable" content="yes" />
            <meta content="true" name="HandheldFriendly" />
            <title><?php echo $empresa; ?></title>
            <!-- Bootstrap Core CSS -->
            <link href="../css/bootstrap.min.css" rel="stylesheet">
            <!-- Custom CSS -->
            <link href="../css/agency.css" rel="stylesheet">
            <!-- Custom Fonts -->
            <link href="../css/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
            <link href="../css/css.css" rel="stylesheet" type="text/css">
<!--            <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
            <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
            <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>-->
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
                <script src="../js/html5shiv.js"></script>
                <script src="../js/respond.min.js"></script>
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
                        <a class="navbar-brand page-scroll" href="#page-top"><img src="../imagenes/buhogif.gif" width="50"><?php echo $empresa; ?></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="hidden">
                                <a href="#page-top"></a>
                            </li>

                        </ul>
                    </div>
                    <! -- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav> 
            <section id="dashboard">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h2 class="section-heading">DASHBOARD SHOW</h2>
                            <h3 class="section-subheading text-muted">Information.</h3>
                            <h3 class="section-subheading text-muted"><?php echo "COMPANY ID " . $uid . ""; ?><?php echo "   CLIENT ID " . $cid . ""; ?></h3>
                            <!--<a href="<?php echo $actual_link; ?>" class="btn btn-info" target="_blank">LINK TO INFO</a>-->
                            <br>
                            <hr>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <form name="sentMessage" id="contactForm" novalidate>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"> PHOTO</i></span>
                                            <img src="<?php
                                            if (!file_exists($file)) {
                                                echo '../imagenes/picture.png';
                                            } else {
                                                echo $file;
                                            }
                                            ?>" alt="" class="img-rounded">
                                        </div>
                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"> NAME</i></span>
                                            <input type="text" class="form-control" value="<?php echo $results[0]['name']; ?>" id="name" disabled>
                                            <p class="help-block text-danger"></p>
                                        </div>

                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"> LASTNAME</i></span>
                                            <input type="text" class="form-control" value="<?php echo $results[0]['lastname']; ?>" id="lastname" disabled>
                                            <p class="help-block text-danger"></p>
                                        </div>

                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"> MAIL</i></span>
                                            <input type="text" class="form-control" value="<?php echo $results[0]['mail']; ?>" id="mail" disabled>
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-home"> ADDRESS</i></span>
                                            <input type="text" class="form-control" value="<?php echo $results[0]['address']; ?>" id="address" autocomplete="off" disabled>
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-home"> TOWN</i></span>
                                            <input type="text" class="form-control" value="<?php echo $results[0]['town']; ?>" id="town" autocomplete="off" disabled>
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-home"> COUNTRY</i></span>
                                            <input type="text" class="form-control" value="<?php echo $results[0]['country']; ?>" id="country" autocomplete="off" disabled>
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-home"> POSTAL CODE</i></span>
                                            <input type="text" class="form-control" value="<?php echo $results[0]['cp']; ?>" id="cp" autocomplete="off" disabled>
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"> CONTACT</i></span>
                                            <input type="tel" class="form-control" value="<?php echo $results[0]['phone']; ?>" id="phone" autocomplete="off" disabled>
                                            <p class="help-block text-danger"></p>
                                        </div>

                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"> EMERGENCY 1</i></span>
                                            <input type="tel" class="form-control" value="<?php echo $results[0]['phonee1']; ?>" id="phonee1" autocomplete="off" disabled>
                                            <p class="help-block text-danger"></p>
                                        </div>

                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-phone"> EMERGENCY 2</i></span>
                                            <input type="tel" class="form-control" value="<?php echo $results[0]['phonee2']; ?>"  id="phonee2" autocomplete="off" disabled>
                                            <p class="help-block text-danger"></p>
                                        </div>


                                    </div>
                                    <div class="col-md-6">
                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-qrcode"> DETAIL</i></span>
                                            <a href="#" onclick="lightbox_open();"><img src="tmp/image_UID:<?php echo $uid;?>_CID:<?php echo $cid;?>.png" alt="qr"></a>
                                        </div>
                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                                            <input class="form-control" value="JOINING DATE: <?php echo " " . $results[0]['joining_date'] . " "; ?>" id="joining_date" disabled>
                                            <p class="help-block text-danger"></p>
                                        </div>

                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                                            <input class="form-control" value="UPDATE DETAIL: <?php echo " " . $results[0]['end_date'] . " "; ?>" id="end_date" disabled>
                                            <p class="help-block text-danger"></p>
                                        </div>

                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-heart"> LANGUAJE</i></span>
                                            <input class="form-control" value="<?php echo $results[0]['languaje']; ?>" id="drname" disabled>
                                            <p class="help-block text-danger"></p>
                                        </div>

                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-heart"> DR NAME</i></span>
                                            <input class="form-control" value="<?php echo $results[0]['drname']; ?>" id="drname" disabled>
                                            <p class="help-block text-danger"></p>
                                        </div>

                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-heart"> DR PHONE</i></span>
                                            <input class="form-control" value="<?php echo $results[0]['drphone']; ?>" id="drphone" disabled>
                                            <p class="help-block text-danger"></p>
                                        </div>

                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-heart"> DETAIL</i></span>
                                            <input class="form-control" value="<?php echo $results[0]['detail']; ?>" id="detail" disabled>
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-heart"> ALERGIES</i></span>
                                            <input class="form-control" value="<?php echo $results[0]['alergy']; ?>" id="alergy" disabled>
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-heart"> MEDICINE</i></span>
                                            <input class="form-control" value="<?php echo $results[0]['medicine']; ?>" id="medicine" disabled >
                                            <p class="help-block text-danger"></p>
                                        </div>

                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-heart"> BLOOD TYPE</i></span>
                                            <input class="form-control" value="<?php echo $results[0]['blood']; ?>" id="blood" disabled>
                                            <p class="help-block text-danger"></p>
                                        </div>


                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="col-lg-12 text-center">
                                        <div id="success"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

            </section>
            <footer>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <span class="copyright">Copyright &copy; WADISA.COM 2014</span>
                        </div>
                        <div class="col-md-4">
                            <ul class="list-inline social-buttons">
                                <li><a href="https://twitter.com/buhonet_es" target="_blank"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li><a href="https://www.facebook.com/buhonet.es" target="_blank"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li><a href="https://www.linkedin.com/company/buhonet" target="_blank"><i class="fa fa-linkedin"></i></a>
                                </li>
                                <li><a href="tel:+34644240832"><i class="fa fa-phone"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="list-inline quicklinks">
                                <li><a href="../avisolegal.php">Privacy Policy</a>
                                </li>
                                <li><a href="../avisolegal.php">Terms of Use</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
            <div id="light">
                <a href="#" onclick="lightbox_close();"><img src="tmp/image_UID:<?php echo $uid;?>_CID:<?php echo $cid;?>.png" alt="QR" /></a>
            </div>
            <div id="fade" onClick="lightbox_close();"></div>
            <!-- /container -->
            <!-- jQuery Version 1.11.0 -->
            <script src="../js/jquery-1.11.0.js"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="../js/bootstrap.min.js"></script>

            <!-- Plugin JavaScript -->
            <script src="../js/jquery.easing.min.js"></script>
            <script src="../js/classie.js"></script>
            <script src="../js/cbpAnimatedHeader.js"></script>

            <!-- Contact Form JavaScript -->
            <script src="../js/jqBootstrapValidation.js"></script>
            <!-- <script src="actualizar_me.js"></script>-->
            <script src="../js/access_db.js"></script>

            <!-- Custom Theme JavaScript -->
            <script src="../js/agency.js"></script>

          
            <!-- SCRIPT FOR POPUP IMAGE -->
            <script type="text/javascript">
                window.document.onkeydown = function (e)
                {
                    if (!e) {
                        e = event;
                    }
                    if (e.keyCode == 27) {
                        lightbox_close();
                    }
                }
                function lightbox_open() {
                    window.scrollTo(0, 0);
                    document.getElementById('light').style.display = 'block';
                    document.getElementById('fade').style.display = 'block';
                }
                function lightbox_close() {
                    document.getElementById('light').style.display = 'none';
                    document.getElementById('fade').style.display = 'none';
                }
            </script>
            <noscript><p><img src="http://piwik.walii.es/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
            <!-- End Piwik Code -->    
        </body>
    </html>

    <?php
} else {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>INFORMACION</title>
        </head>
        <body>

            <h1>ACCESO RESTRINGIDO</h1>
        </body>
    </html>

    <?php
}
?>

