<?php
require_once("../config/session.php");
require_once("../config/class.user.php");
$auth_user = new USER();
$user_id = $_SESSION['user_session'];



$sql = "SELECT * FROM clients WHERE user_id=$user_id";
$stmt = $auth_user->runQuery($sql);
$stmt->execute();
$cuenta = $stmt->rowCount();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$auth_user->is_loggedin()) {
    $auth_user->redirect('../login/index.php');
}


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
                        if ($userRow['admin']) {
                            echo "<li>";
                            echo "<a class='page-scroll' href='dashboard.php' >ADMIN</a>";
                            echo "</li>";
                            echo "<li>";
                            echo "<a class='page-scroll' href='dashboardadd.php' >ADD CLIENT</a>";
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
                        <h3 class="section-subheading text-muted">.</h3>
                        <h3><?php echo "USER ID " . $user_id . ""; ?></h3>
                        <br>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form name="sentMessage" id="contactForm" novalidate>

                            <div class="row">
                                <div class="col-md-6">
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon">ID</i></span>
                                        <input type="text" class="form-control" 
                                        <?php
                                               if (empty($results[0]['id'])) {
                                                   ?>placeholder="Id Auto incremented *"<?php
                                               } else {
                                                   ?>value="<?php echo "" . $results[0]['id'] . ""; ?>"<?php
                                               }
                                               ?>
                                                   id="id" disabled>
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" class="form-control" 
                                        <?php
                                               if (empty($results[0]['name'])) {
                                                   ?>placeholder="Name *"<?php
                                               } else {
                                                   ?>value="<?php echo "" . $results[0]['name'] . ""; ?>"<?php
                                               }
                                               ?>
                                               id="name">
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" class="form-control" 
                                        <?php
                                               if (empty($results[0]['lastname'])) {
                                                   ?>placeholder="LastName *"<?php
                                               } else {
                                                   ?>value="<?php echo "" . $results[0]['lastname'] . ""; ?>"<?php
                                               }
                                               ?>
                                               id="lastname">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                        <input type="text" class="form-control" 
                                        <?php
                                               if (empty($results[0]['address'])) {
                                                   ?>placeholder="Address *"<?php
                                               } else {
                                                   ?>value="<?php echo "" . $results[0]['address'] . ""; ?>"<?php
                                               }
                                               ?>
                                               id="address" autocomplete="off">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                        <input type="tel" class="form-control"
                                        <?php
                                               if (empty($results[0]['phone'])) {
                                                   ?>placeholder="Contact phone +34 555 555 555 *"<?php
                                               } else {
                                                   ?>value="<?php echo "" . $results[0]['phone'] . ""; ?>"<?php
                                               }
                                               ?>
                                               id="phone" autocomplete="off" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                        <input type="tel" class="form-control"
                                        <?php
                                               if (empty($results[0]['phonee1'])) {
                                                   ?>placeholder="Emergency phone 1  +34 555 555 555 *"<?php
                                               } else {
                                                   ?>value="<?php echo "" . $results[0]['phonee1'] . ""; ?>"<?php
                                               }
                                               ?>
                                               id="phonee1" autocomplete="off" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                        <input type="tel" class="form-control"
                                            <?php
                                               if (empty($results[0]['phonee2'])) {
                                                   ?>placeholder="Emergency phone 2 +34 555 555 555 *"<?php
                                               } else {
                                                   ?>value="<?php echo "" . $results[0]['phonee2'] . ""; ?>"<?php
                                               }
                                               ?>
                                               id="phonee2" autocomplete="off" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    
                                </div>
                                <input type="hidden" name="userid" class="form-control" id="userid" value="<?php echo $user_id ?>"> 
                                <input type="hidden" name="user" class="form-control" id="user" value="<?php echo $results[0]['name'] ?>">  
                                <input type="hidden" name="pass" class="form-control" id="pass" value="<?php echo $results[0]['name'] ?>"> 
                                <input type="hidden" name="type" class="form-control" id="type" value="addclient">  
                                <div class="col-md-6">
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                                        <input class="form-control" value="Joining Date: <?php echo " " . $results[0]['joining_date'] . " "; ?>" id="joining_date" disabled>
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                                        <input class="form-control" value="End date account: <?php echo " " . $results[0]['end_date'] . " "; ?>" id="end_date" disabled>
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                                        <input class="form-control" 
                                                                          <?php
                                               if (empty($results[0]['alergy'])) {
                                                   ?>placeholder="Include Alergies *"<?php
                                               } else {
                                                   ?>value="<?php echo "" . $results[0]['alergy'] . ""; ?>"<?php
                                               }
                                               ?> id="alergy" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                                        <input class="form-control"
                                               <?php
                                               if (empty($results[0]['drname'])) {
                                                   ?>placeholder="Doctor Name *"<?php
                                               } else {
                                                   ?>value="<?php echo "" . $results[0]['drname'] . ""; ?>"<?php
                                               }
                                               ?> id="drname" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                                        <input class="form-control" 
                                               <?php
                                               if (empty($results[0]['drphone'])) {
                                                   ?>placeholder="Doctor Phone *"<?php
                                               } else {
                                                   ?>value="<?php echo "" . $results[0]['drphone'] . ""; ?>"<?php
                                               }
                                               ?>  id="drphone" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                                        <input class="form-control" 
                                               <?php
                                               if (empty($results[0]['detail'])) {
                                                   ?>placeholder="Detail info *"<?php
                                               } else {
                                                   ?>value="<?php echo "" . $results[0]['detail'] . ""; ?>"<?php
                                               }
                                               ?> id="detail" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                                        <input class="form-control" 
                                               <?php
                                               if (empty($results[0]['medicine'])) {
                                                   ?>placeholder="Medicine info *"<?php
                                               } else {
                                                   ?>value="<?php echo "" . $results[0]['medicine'] . ""; ?>"<?php
                                               }
                                               ?> id="medicine" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                                        <input class="form-control" 
                                               <?php
                                               if (empty($results[0]['blood'])) {
                                                   ?>placeholder="Blood info *"<?php
                                               } else {
                                                   ?>value="<?php echo "" . $results[0]['blood'] . ""; ?>"<?php
                                               }
                                               ?> id="blood" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    



                                </div>
                                <div class="clearfix"></div>
                                <div class="col-lg-12 text-center">
                                    <div id="success"></div>
                                    <button type="submit" class="btn btn-xl">ADD</button>
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
        <!-- Script para grafico de barras -->
    </body>
</html>
