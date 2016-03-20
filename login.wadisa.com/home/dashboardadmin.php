<?php
require_once("../config/session.php");
require_once("../config/class.user.php");
include_once 'phpqrcode/qrlib.php';
$auth_user = new USER();
$user_id_name = $_SESSION['user_session'];
$user_id = $_SESSION['company_code'];



if (isset($_POST['userid'])) {
    $uid = strip_tags($_POST['userid']);
    $_SESSION['user_id'] = $uid;
    $sql = "SELECT * FROM clients WHERE id=$uid";
    $stmt = $auth_user->runQuery($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $button = "UPDATE";
    $action = "updateclient";

    $actual_link = 'http://' . $_SERVER[HTTP_HOST] . '/home/dashboardshow.php' . '?btn-update=enable&type=load&userid=' . $user_id . '&clientid=' . $uid;
//    $photo = 'http://' . $_SERVER[HTTP_HOST] . '/home/saved_images/photo_UID:' . $user_id . '_CID:' . $uid . '.jpg';
//    $logo = 'http://' . $_SERVER[HTTP_HOST] . '/home/tmp/image_UID:' . $user_id . '_CID:' . $uid . '.png';
//CREAMON UNA INSTANCIA DE QR
    $qr = new QrGenerator();
    $imageName = $qr->qrGen($results, $actual_link);
} else if (isset($_SESSION['user_id'])) {
//
    $uid = $_SESSION['user_id'];
    $sql = "SELECT * FROM clients WHERE id=$uid";
    $stmt = $auth_user->runQuery($sql);
    $stmt->execute();
    $cuenta = $stmt->rowCount();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//CREAMON UNA INSTANCIA DE QR
    $actual_link = 'http://' . $_SERVER[HTTP_HOST] . '/home/dashboardshow.php' . '?btn-update=enable&type=load&userid=' . $user_id . '&clientid=' . $uid;
//    $photo = 'http://' . $_SERVER[HTTP_HOST] . '/home/saved_images/photo_UID:' . $user_id . '_CID:' . $uid . '.jpg';
//    $logo = 'http://' . $_SERVER[HTTP_HOST] . '/home/tmp/image_UID:' . $user_id . '_CID:' . $uid . '.png';
    $qr = new QrGenerator();
    $imageName = $qr->qrGen($results, $actual_link);
    $button = "UPDATE";
    $action = "updateclient";
}


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

$file = 'saved_images/photo_UID:' . $user_id . '_CID:' . $uid . '.jpg';
$photo = 'http://' . $_SERVER[HTTP_HOST] . '/home/saved_images/photo_UID:' . $user_id . '_CID:' . $uid . '.jpg';
$logo = 'http://' . $_SERVER[HTTP_HOST] . '/home/tmp/image_UID:' . $user_id . '_CID:' . $uid . '.png';
   
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
                        <h3 class="section-subheading text-muted"><?php echo "COMPANY ID " . $user_id . ""; ?><?php echo "   CLIENT ID " . $uid . ""; ?></h3>
                        <a href="<?php echo $actual_link; ?>" class="btn btn-info" target="_blank">LINK TO INFO</a>
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
                                        <a href="#" onclick="lightbox_open();"><img src="<?php
                                            if (!file_exists($file)) {
                                                echo '../imagenes/picture.png';
                                            } else {
                                                echo $file;
                                            }
                                            ?>" alt=""></a>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"> ID</i></span>
                                        <input type="text" class="form-control" value="<?php echo $results[0]['id']; ?>" id="id" required disabled>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"> NAME</i></span>
                                        <input type="text" class="form-control" 
                                        <?php
                                        if (empty($results[0]['name'])) {
                                            ?>placeholder="Name *"<?php
                                               } else {
                                                   ?>value="<?php echo $results[0]['name']; ?>"<?php
                                               }
                                               ?>
                                               id="name" required>
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"> LASTNAME</i></span>
                                        <input type="text" class="form-control" 
                                        <?php
                                        if (empty($results[0]['lastname'])) {
                                            ?>placeholder="LastName *"<?php
                                               } else {
                                                   ?>value="<?php echo $results[0]['lastname']; ?>"<?php
                                               }
                                               ?>
                                               id="lastname">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"> MAIL</i></span>
                                        <input type="text" class="form-control" 
                                        <?php
                                        if (empty($results[0]['mail'])) {
                                            ?>placeholder="Mail *"<?php
                                               } else {
                                                   ?>value="<?php echo $results[0]['mail']; ?>"<?php
                                               }
                                               ?>
                                               id="mail">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"> ADDRESS</i></span>
                                        <input type="text" class="form-control" 
                                        <?php
                                        if (empty($results[0]['address'])) {
                                            ?>placeholder="Address *"<?php
                                               } else {
                                                   ?>value="<?php echo $results[0]['address']; ?>"<?php
                                               }
                                               ?>
                                               id="address" autocomplete="off">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"> TOWN</i></span>
                                        <input type="text" class="form-control" 
                                        <?php
                                        if (empty($results[0]['town'])) {
                                            ?>placeholder="Town *"<?php
                                               } else {
                                                   ?>value="<?php echo $results[0]['town']; ?>"<?php
                                               }
                                               ?>
                                               id="town" autocomplete="off">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"> COUNTRY</i></span>
                                        <input type="text" class="form-control" 
                                        <?php
                                        if (empty($results[0]['country'])) {
                                            ?>placeholder="Country *"<?php
                                               } else {
                                                   ?>value="<?php echo $results[0]['country']; ?>"<?php
                                               }
                                               ?>
                                               id="country" autocomplete="off">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"> POSTAL CODE</i></span>
                                        <input type="text" class="form-control" 
                                        <?php
                                        if (empty($results[0]['cp'])) {
                                            ?>placeholder="Postal Code *"<?php
                                               } else {
                                                   ?>value="<?php echo $results[0]['cp']; ?>"<?php
                                               }
                                               ?>
                                               id="cp" autocomplete="off">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"> CONTACT</i></span>
                                        <input type="tel" class="form-control"
                                        <?php
                                        if (empty($results[0]['phone'])) {
                                            ?>placeholder="Contact phone +34 555 555 555 *"<?php
                                               } else {
                                                   ?>value="<?php echo $results[0]['phone']; ?>"<?php
                                               }
                                               ?>
                                               id="phone" autocomplete="off" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"> EMERGENCY 1</i></span>
                                        <input type="tel" class="form-control"
                                        <?php
                                        if (empty($results[0]['phonee1'])) {
                                            ?>placeholder="Emergency phone 1  +34 555 555 555 *"<?php
                                               } else {
                                                   ?>value="<?php echo $results[0]['phonee1']; ?>"<?php
                                               }
                                               ?>
                                               id="phonee1" autocomplete="off" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"> EMERGENCY 2</i></span>
                                        <input type="tel" class="form-control"
                                        <?php
                                        if (empty($results[0]['phonee2'])) {
                                            ?>placeholder="Emergency phone 2 +34 555 555 555 *"<?php
                                               } else {
                                                   ?>value="<?php echo $results[0]['phonee2']; ?>"<?php
                                               }
                                               ?>
                                               id="phonee2" autocomplete="off" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                </div>
                                <input type="hidden" name="userid" class="form-control" id="userid" value="<?php echo $results[0]['user_id']; ?>"> 
                                <input type="hidden" name="user" class="form-control" id="user" value="<?php echo $results[0]['name']; ?>"> 
                                <input type="hidden" name="qr" class="form-control" id="qr" value="<?php echo $imageName[0]; ?>"> 
                                <input type="hidden" name="qrlink" class="form-control" id="qrlink" value="<?php echo $actual_link; ?>"> 
                                <input type="hidden" name="type" class="form-control" id="type" value="updateclient">  
                                <input type="hidden" name="urlphoto" class="form-control" id="urlphoto" value="<?php echo $photo; ?>"> 
                                <input type="hidden" name="logo" class="form-control" id="logo" value="<?php echo $logo; ?>">  
                                <div class="col-md-6">


                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-qrcode"> DETAIL</i></span>
                                        <img src="<?php echo $imageName[0]; ?>" />
                                    </div> 
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-heart"> LANGUAJE</i></span>
                                        <input class="form-control"
                                        <?php
                                        if (empty($results[0]['languaje'])) {
                                            ?>placeholder="Languaje *"<?php
                                               } else {
                                                   ?>value="<?php echo $results[0]['languaje']; ?>"<?php
                                               }
                                               ?> id="languaje" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-heart"> DR NAME</i></span>
                                        <input class="form-control"
                                        <?php
                                        if (empty($results[0]['drname'])) {
                                            ?>placeholder="Doctor Name *"<?php
                                               } else {
                                                   ?>value="<?php echo $results[0]['drname']; ?>"<?php
                                               }
                                               ?> id="drname" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-heart"> DR PHONE</i></span>
                                        <input class="form-control" 
                                        <?php
                                        if (empty($results[0]['drphone'])) {
                                            ?>placeholder="Doctor Phone *"<?php
                                               } else {
                                                   ?>value="<?php echo $results[0]['drphone']; ?>"<?php
                                               }
                                               ?>  id="drphone" >
                                        <p class="help-block text-danger"></p>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-heart"> DETAIL</i></span>
                                        <input class="form-control" 
                                        <?php
                                        if (empty($results[0]['detail'])) {
                                            ?>placeholder="Detail info *"<?php
                                               } else {
                                                   ?>value="<?php echo $results[0]['detail']; ?>"<?php
                                               }
                                               ?> id="detail" >
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-heart"> ALERGIES</i></span>
                                        <input class="form-control" 
                                        <?php
                                        if (empty($results[0]['alergy'])) {
                                            ?>placeholder="Include Alergies *"<?php
                                               } else {
                                                   ?>value="<?php echo $results[0]['alergy']; ?>"<?php
                                               }
                                               ?> id="alergy" >
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-heart"> MEDICINE</i></span>
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
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-heart"> BLOOD TYPE</i></span>
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
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-qrcode"> LINK</i></span>
                                        <img src="<?php echo $imageName[1]; ?>" />
                                    </div>
                                    <div id="success"></div>
                                    <button type="submit" class="btn btn-info"><?php echo $button; ?></button>
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

        <div id="light">
            <!--<a href="#" onclick="lightbox_close();"><img src="../imagenes/picture.png" alt="" /></a>-->
            <div id="camera_wrapper">
                <div id="camera"></div>
                <button id="capture_btn" class="btn btn-info">CAPTURE</button><button id="close" onclick="lightbox_close();" class="btn btn-danger">CLOSE</button>
                <div id="show_saved_img" ></div>
            </div>
            <!--show captured image--> 


        </div>
        <div id="fade" onClick="lightbox_close();"></div>


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
                window.location.reload(true);
            }
        </script>
        <script type="text/javascript" src="scripts/webcam.js"></script>
        <script>
            $(function () {
                //give the php file path
                webcam.set_api_url('saveimage.php');
                webcam.set_swf_url('scripts/webcam.swf');//flash file (SWF) file path
                webcam.set_quality(100); // Image quality (1 - 100)
                webcam.set_shutter_sound(false); // play shutter click sound

                var camera = $('#camera');
                camera.html(webcam.get_html(320, 240)); //generate and put the flash embed code on page

                $('#capture_btn').click(function () {
                    //take snap
                    webcam.snap();
                    $('#show_saved_img').html('<h3>CAPTURED...</h3>');
                });


                //after taking snap call show image
//                webcam.set_hook('onComplete', function (img) {
//                    $('#show_saved_img').html('<img src="' + img + '">');
//                    //reset camera for the next shot
//                    webcam.reset();
//                });

            });
        </script>
    </body>
</html>