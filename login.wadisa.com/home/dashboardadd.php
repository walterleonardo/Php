<?php
require_once("../config/session.php");
require_once("../config/class.user.php");
$auth_user = new USER();
$user_id_name = $_SESSION['user_session'];
$user_id = $_SESSION['company_code'];

if (!$auth_user->is_loggedin()) {
    $auth_user->redirect('../login/index.php');
}
$sql_user = "SELECT * FROM users WHERE user_id=$user_id_name";
$stmt_user = $auth_user->runQuery($sql_user);
$stmt_user->execute();
$results_user = $stmt_user->fetchAll(PDO::FETCH_ASSOC);

if (!$results_user[0]['admin']) {
    $auth_user->redirect('../home/index.php');
}

$button = "UPDATE";
$action = "updateclient";
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
        <!--  <meta name="viewport" content="width=device-width, initial-scale=1"> -->
        <meta name="description" content="Control Parental, Internet por fin segura">
        <meta name="keywords" content="Parental control,Control parental,parental,control, seguridad, internet, niños, seguros, navegación, filtros, antivirus, internet segura, firewall, cortafuego, analisis, paginas, seguras">
        <meta name="author" content="admin@wadisa.com">
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
        <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
        <!-- Custom CSS charts-->
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

                        <li>
                            <a class="page-scroll" href="index.php">HOME</a>
                        </li>
                        <?php
                        if ($results_user[0]['admin']) {
                            echo "<li>";
                            echo "<a class='page-scroll' href='dashboard.php' >ADMIN</a>";
                            echo "</li>";
                        }
                        ?>
                        <li>
                            <a class="page-scroll" href="../config/logout.php?logout=true">LOGOUT</a>
                        </li>
                    </ul>
                </div>
                <! -- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav> 


        <section id="info">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">INFORMATION</h2>
                        <h3 class="section-subheading text-muted"><?php echo "COMPANY ID " . $user_id . ""; ?></h3>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <form name="sentMessage" id="contactForm" novalidate>
                            <div class="row">
                                <div class="col-md-6">
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"> NAME</i></span>
                                        <input type="text" class="form-control" id="name" required>
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"> LASTNAME</i></span>
                                        <input type="text" class="form-control" id="lastname">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"> MAIL</i></span>
                                        <input type="text" class="form-control" id="mail">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"> ADDRESS</i></span>
                                        <input type="text" class="form-control" id="address" autocomplete="off">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"> TOWN</i></span>
                                        <input type="text" class="form-control" id="town"  autocomplete="off">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"> COUNTRY</i></span>
                                        <input type="text" class="form-control" id="country" autocomplete="off">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"> POSTAL CODE</i></span>
                                        <input type="text" class="form-control" id="cp" autocomplete="off">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"> CONTACT</i></span>
                                        <input type="tel" class="form-control" id="phone" autocomplete="off" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"> EMERGENCY 1</i></span>
                                        <input type="tel" class="form-control" id="phonee1" autocomplete="off" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"> EMERGENCY 2</i></span>
                                        <input type="tel" class="form-control" id="phonee2" autocomplete="off" >
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <input type="hidden" name="userid" class="form-control" id="userid" value="<?php echo $user_id; ?>"> 
                                <input type="hidden" name="user" class="form-control" id="user" value="<?php echo $results[0]['name']; ?>">  
                                <input type="hidden" name="type" class="form-control" id="type" value="addclient">  
                                <div class="col-md-6">


                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-heart"> LANGUAJE</i></span>
                                        <input type="text" class="form-control"  id="languaje" autocomplete="off">
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-heart"> DR NAME</i></span>
                                        <input type="text" class="form-control" id="drname" autocomplete="off">
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-heart"> DR PHONE</i></span>
                                        <input type="text" class="form-control" id="drphone" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-heart"> DETAIL</i></span>
                                        <input type="text" class="form-control"  id="detail" >
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-heart"> ALERGIES</i></span>
                                        <input type="text" class="form-control"  id="alergy" >
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-heart"> MEDICINE</i></span>
                                        <input type="text" class="form-control"  id="medicine" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-heart"> BLOOD TYPE</i></span>
                                        <input type="text" class="form-control"  id="blood" >
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-lg-12 text-center">
                                    <div id="success"></div>
                                    <button type="submit" class="btn btn-info">ADD</button>
                                    <a href="dashboard.php" class="btn btn-danger">BACK</a>
                                </div>
                            </div>
                        </form>
                        <br>

                    </div>
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
        <!-- /container -->
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
        <!-- <script src="actualizar_me.js"></script>-->
        <script src="../js/access_db.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/agency.js"></script>


        <!-- End Piwik Code -->    
    </body>
</html>