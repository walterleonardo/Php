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

if (isset($_GET['s'])) {
    // Store search term into a variable
    $search_term = htmlspecialchars($_GET['s'], ENT_QUOTES);
    $limit = htmlspecialchars($_GET['limit'], ENT_QUOTES);
    // Send the search term to our search class and store the result
    $search_results = $auth_user->search($search_term, $user_id, $limit);
}

if (isset($_GET['deleteItem']) and is_numeric($_GET['deleteItem'])) {
    $uid_to_delete = $_GET['deleteItem'];
    // here comes your delete query: use $_POST['deleteItem'] as your id
    $auth_user->deleteClient($uid_to_delete, $user_id);
} 

$sql = "SELECT * FROM clients WHERE user_id=$user_id ORDER BY id DESC ";
$stmt = $auth_user->runQuery($sql);
$stmt->execute();
$cuenta = $stmt->rowCount();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
        <!-- Custom CSS charts-->
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
        <section id="dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">DASHBOARD</h2>
                        <h3 class="section-subheading text-muted">Information.</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form name="sentMessage" id="contactForm" novalidate>
                            <div class="row">

                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-star">  ID </i></span>
                                    <input class="form-control" 
                                    <?php
                                    if (empty($results_user[0]['code'])) {
                                        ?>placeholder="Nombre. ***"<?php
                                           } else {
                                               ?>value="<?php echo "" . $results_user[0]['code'] . ""; ?>"<?php
                                           }
                                           ?>
                                           id="nas" disabled>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="clearfix"></div>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <span class="badge"><?php
                                            if ($cuenta == 0) {
                                                echo "No clients";
                                            } else {
                                                echo "" . $cuenta . "";
                                            }
                                            ?></span>
                                        Active clients
                                    </li>
                                </ul>                
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="search-form">
                    <form action="" method="get">
                        <div class="form-field">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <input type="search" name="s" class="form-control" placeholder="Search for..." value="<?php echo $search_term; ?>">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-secondary" type="button">SEARCH</button>
                                        </span>

                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <input type="text" id="limit" class="form-control" name="limit" value="10"> 
                                        <span class="input-group-btn"><button type="button" class="btn btn-secondary" type="button" disabled>RESULT LIMIT</button></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <br>
                <br>
                <?php if ($search_results) : ?>
                    <label for="sel1">Last clients found:</label>
                    <div class="results-table">                        
                        <?php foreach ($search_results as $row) { ?>
                            <form name="form" action="dashboardadmin.php" method="POST">
                                <div style="margin-bottom: 5px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                                    <input class="form-control" name="user" value="<?php echo $row['name'] . " " . $row['lastname']; ?>" id="user" disabled>
                                    <span class="input-group-addon">
                                        <input type="submit" id="btn-add" name="btn-add" value="CONFIG"></span>
                                        <span class="input-group-addon">
                                            <input type="button" id="btn-add" name="btn-add" value="DELETE" onclick="return confirm('ARE YOU SURE THAT WANT TO DELETE THE CLIENT  <?php echo $row['name'] ?> <?php echo $row['lastname'] ?>?')? window.open('?deleteItem=<?php echo $row['id'] ?>','_self'): void(0);">
                                    </span>
                                    <input type="hidden" name="userid" class="form-control" id="userid" value="<?php echo $row['id'] ?>"> 
                                </div>
                                <input type="hidden" id="type"  name="type" value="set">  
                                <input type="hidden" id="btn-update" name="btn-update" value="submit">
                                <!--<input type="submit" id="btn-add" name="btn-add" value="submit">-->
                            </form>
                        <?php } ?>
                    </div>
                <?php endif; ?>

                <hr>
                <div class="form-group">
                    <?php if ($cuenta > 0) { ?>
                        <label for="sel1">Last clients added:</label>
                        <br>
                        <?php foreach ($results as $row) { ?>
                            <form name="form" action="dashboardadmin.php" method="POST">
                                <div style="margin-bottom: 5px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                                    <input class="form-control" name="user" value="<?php echo $row['name'] . " " . $row['lastname']; ?>" id="user" disabled>
                                    <span class="input-group-addon">
                                        <input type="submit" id="btn-add" name="btn-add" value="CONFIG"></span>
                                        <span class="input-group-addon">
                                            <input type="button" id="btn-add" name="btn-add" value="DELETE" onclick="return confirm('ARE YOU SURE THAT WANT TO DELETE THE CLIENT  <?php echo $row['name'] ?> <?php echo $row['lastname'] ?>?')? window.open('?deleteItem=<?php echo $row['id'] ?>','_self'): void(0);">
                                    </span>
                                    <input type="hidden" name="userid" class="form-control" id="userid" value="<?php echo $row['id'] ?>"> 
                                </div>
                                <input type="hidden" id="type"  name="type" value="set">  
                                <input type="hidden" id="btn-update" name="btn-update" value="submit">
                                <!--<input type="submit" id="btn-add" name="btn-add" value="submit">-->
                            </form>
                        <?php } ?>
                    <?php } else {?>
                        <label for="sel1">No clients found</label>
                          <?php } ?>
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
        <!--<script src="../js/access_db.js"></script>-->

        <!-- Custom Theme JavaScript -->
        <script src="../js/agency.js"></script>

        <!-- Piwik
        <script type="text/javascript">
            var _paq = _paq || [];
            _paq.push(['trackPageView']);
            _paq.push(['enableLinkTracking']);
            (function () {
                var u = (("https:" == document.location.protocol) ? "https" : "http") + "://piwik.walii.es/";
                _paq.push(['setTrackerUrl', u + 'piwik.php']);
                _paq.push(['setSiteId', 1]);
                var d = document, g = d.createElement('script'), s = d.getElementsByTagName('script')[0];
                g.type = 'text/javascript';
                g.defer = true;
                g.async = true;
                g.src = u + 'piwik.js';
                s.parentNode.insertBefore(g, s);
            })();
        </script>
        <noscript><p><img src="http://piwik.walii.es/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>-->
        <!-- End Piwik Code -->    
    </body>
</html>