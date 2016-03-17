<?php

session_start();
require_once('dbconfig.php');
require_once('passwordhash.php');
require_once('PHPMailer/PHPMailerAutoload.php');
$val3 = $val1 + $val2;


if (strpos(strtolower(filter_input(INPUT_SERVER, 'HTTP_USER_AGENT')), "apple")) { //to prevent cookies for non-apple devices
    $cookieLifetime = 365 * 24 * 60 * 60; // A year in seconds
    setcookie("ses_id", session_id(), time() + $cookieLifetime);
}

class USER {

    private $conn;

    public function __construct() {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function runQuery($sql) {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    public function register($uname, $upass) {
        try {
            $new_password = password_hash($upass, PASSWORD_DEFAULT);

            $stmt = $this->conn->prepare("INSERT INTO users(user_name,user_pass) VALUES(:uname, :upass)");
            $stmt->bindparam(":uname", $uname);
            $stmt->bindparam(":upass", $new_password);
            $stmt->execute();
            $stmt1 = $this->conn->prepare("SELECT user_id, user_name, user_pass FROM users WHERE user_name=:uname ");
            $stmt1->execute(array(":uname" => $uname));
            $userRow = $stmt1->fetch(PDO::FETCH_ASSOC);
            if ($stmt1->rowCount() == 1) {
                $_SESSION['user_session'] = $userRow['user_id'];
            }
            //echo "DONE";
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function sendpass($uname) {
        try {

            $upass = self::generateRandomString(8);//number of characters.
            $new_password = password_hash($upass, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("UPDATE users set user_pass=:upass WHERE user_name=:uname ");
            $stmt->bindparam(":uname", $uname);
            $stmt->bindparam(":upass", $new_password);
            $stmt->execute();
            if (self::sendmailer($uname, $upass)) {
                //echo "DONE";
                return true;
            } else {
                echo " ERROR SENDING MAIL ";
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function sendmail($email_address, $message) {
// Create the email and send the message
        $to = $email_address; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
        $email_subject = "Password retrieve";
        $email_body = "Hi.\n\n" . "You are requested a new password.\n\n" . "Here you have the new password: $message\n\n" . "LINK TO LOGIN: http://qr.wadisa.com/login\n\n" . "Greetings\n\n";
        $headers = "From: noreply@wadisa.com\n";
// This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
        //$headers .= "Reply-To: $email_address";
        if (mail($to, $email_subject, $email_body, $headers)) {
            return true;
        } else {
            return false;
        }
    }

    public function sendmailer($email_address, $message) {
//Create a new PHPMailer instance
        $mail = new PHPMailer;
//Tell PHPMailer to use SMTP
        $mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
        $mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
//Set the hostname of the mail server
        $mail->Host = "wadisa.com";
//Set the SMTP port number - likely to be 25, 465 or 587
        $mail->Port = 25;
//Whether to use SMTP authentication
        $mail->SMTPAuth = true;
//Username to use for SMTP authentication
        $mail->Username = "admin@wadisa.com";
//Password to use for SMTP authentication
        $mail->Password = "jodete2k";
//Set who the message is to be sent from
        $mail->setFrom('admin@wadisa.com', 'Admin Wadisa');
//Set an alternative reply-to address
        $mail->addReplyTo('admin@wadisa.com', 'Admin Wadisa');
//Set who the message is to be sent to
        $mail->addAddress($email_address, ' ');
//Set the subject line
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Retrieve password qr.wadisa.com ';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
        //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
        $mail->Body = "Hi.<br><br>\n\n" . "You are requested a new password from wadisa.<br>\n\n" . "Here you have the new password: <b>$message</b> <br>\n\n" . "LINK TO LOGIN: http://qr.wadisa.com/login<br><br>\n\n" . "Greetings<br><br>\n\n";
        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

//Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
            return false;
        } else {
            //echo "Message sent!";
            return true;
        }
    }

    public function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function doLogin($uname, $upass) {
        try {
            $stmt = $this->conn->prepare("SELECT user_id, user_name, user_pass FROM users WHERE user_name=:uname ");
            $stmt->execute(array(":uname" => $uname));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() == 1) {
                if (password_verify($upass, $userRow['user_pass'])) {
                    $_SESSION['user_session'] = $userRow['user_id'];
                    //echo "USER SESSION " . $_SESSION['user_session'] . " ";
                    return true;
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update($uid, $address, $phone) {
        try {
            $stmt = $this->conn->prepare("UPDATE users set address=:address, phone=:phone WHERE user_id=:uid ");
            $stmt->bindParam(':uid', $uid);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':phone', $phone);
            $stmt->execute();
            //echo "DONE";
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updatepass($uid, $pass, $rpass, $rpassb) {

        try {
            $stmt = $this->conn->prepare("SELECT user_id, user_name, user_pass FROM users WHERE user_id=:uid");
            $stmt->bindParam(':uid', $uid);
            $stmt->execute();
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() == 1) {
                if (!password_verify($pass, $userRow['user_pass'])) {
                    echo "Your Password is wrong ! ";
                    return false;
                }
            } else {
                echo "Your mail is not in DB ! ";
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }

        if ($rpass == "") {
            $error[] = "provide password !";
            echo "Provide password ! ";
            return false;
        } else if (strlen($rpass) < 4) {
            $error[] = "Password must be atleast 4 characters";
            echo "Password must be atleast 4 characters ";
            return false;
        } else if ($rpass != $rpassb) {
            $error[] = "Passwords must be the same ";
            echo "Passwords must be the same ";
            return false;
        } else {
            try {
                $new_password = password_hash($rpass, PASSWORD_DEFAULT);

                $stmt = $this->conn->prepare("UPDATE users set user_pass=:rpass WHERE user_id=:uid ");
                $stmt->bindparam(":uid", $uid);
                $stmt->bindparam(":rpass", $new_password);
                $stmt->execute();

                //echo "DONE";
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    public function updateclient($id, $user_id, $name, $lastname, $address, $phone, $phonee1, $phonee2, $qr, $joining_date, $end_date, $alergy, $drname, $drphone, $detail, $medicine, $blood) {
        try {
            $stmt = $this->conn->prepare("REPLACE INTO clients "
                    . "(id,name,user_id,lastname,address,phone,phonee1,phonee2,qr,joining_date,end_date,alergy,drname,drphone,detail,medicine,blood) VALUES "
                    . "(:id,:name,:user_id,:lastname,:address,:phone,:phonee1,:phonee2,:qr,:joining_date,:end_date,:alergy,:drname,:drphone,:detail,:medicine,:blood)");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':phonee1', $phonee1);
            $stmt->bindParam(':phonee2', $phonee2);
            $stmt->bindParam(':qr', $qr);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':joining_date', $joining_date);
            $stmt->bindParam(':end_date', $end_date);
            $stmt->bindParam(':alergy', $alergy);
            $stmt->bindParam(':drname', $drname);
            $stmt->bindParam(':drphone', $drphone);
            $stmt->bindParam(':detail', $detail);
            $stmt->bindParam(':medicine', $medicine);
            $stmt->bindParam(':blood', $blood);
            $stmt->execute();
            //echo "DONE";
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function addclient($user_id, $name, $lastname, $address, $phone, $phonee1, $phonee2, $qr, $joining_date, $end_date, $alergy, $drname, $drphone, $detail, $medicine, $blood) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO clients (name,user_id,lastname,address,phone,phonee1,phonee2,qr,joining_date,end_date,alergy,drname,drphone,detail,medicine,blood) VALUES (:name,:user_id,:lastname,:address,:phone,:phonee1,:phonee2,:qr,:joining_date,:end_date,:alergy,:drname,:drphone,:detail,:medicine,:blood)");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':phonee1', $phonee1);
            $stmt->bindParam(':phonee2', $phonee2);
            $stmt->bindParam(':qr', $qr);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':joining_date', $joining_date);
            $stmt->bindParam(':end_date', $end_date);
            $stmt->bindParam(':alergy', $alergy);
            $stmt->bindParam(':drname', $drname);
            $stmt->bindParam(':drphone', $drphone);
            $stmt->bindParam(':detail', $detail);
            $stmt->bindParam(':medicine', $medicine);
            $stmt->bindParam(':blood', $blood);
            $stmt->execute();
            //echo "DONE";
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function is_loggedin() {
        if (isset($_SESSION['user_session'])) {
            return true;
        } else {
            return false;
        }
    }

    public function redirect($url) {
        header("Location: $url");
    }

    public function doLogout() {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }

}

//ESTE GENERADOR DE QR NECESITA IMPORTAR LA LIBRERIA LIBQR:PHP
class QrGenerator {

    public function qrGen($results, $actual_link) {
        //QR STYLE
// how to build raw content - QRCode with detailed Business Card (VCard) 
        $imagesQR = array();
        $tempDir = "tmp/image";

// here our data 
        $name = $results[0]['name'];
        $uid = $results[0]['id'];
        $user_id = $results[0]['user_id'];
        $lastname = $results[0]['lastname'];
        $phone = $results[0]['phone'];
        $phonePrivate = $results[0]['phonee1'];
        $phoneCell = $results[0]['phonee2'];
        $orgName = $results[0]['empresa'];
        $email = $results[0]['mail'];
        $url = $results[0]['url'];
        $urlphoto = $results[0]['urlphoto'];
        $gps = $results[0]['gps'];
        $logo = $results[0]['logo'];
        $languaje = $results[0]['languaje'];

// medical data data 
        $blood = $results[0]['blood'];
        $medicine = $results[0]['medicine'];
        $alergy = $results[0]['alergy'];
        $drname = $results[0]['drname'];
        $drphone = $results[0]['drphone'];
        $detail = $results[0]['detail'];

// if not used - leave blank! 
        $addressLabel = 'home';
        $addressPobox = '';
        $addressExt = '';
        $addressStreet = $results[0]['address'];
        $addressTown = $results[0]['town'];
        $addressRegion = $results[0]['region'];
        $addressPostCode = $results[0]['cp'];
        $addressCountry = $results[0]['country'];



//NOTE with all the rest of data
//
        $note = 'BLOOD:' . $blood . '______ MEDICINE:' . $medicine . ' _______ ALERGY:' . $alergy . ' _______DR NAME:' . $drname . ' _______ DR PHONE:' . $drphone . ' _______ DETAILS: ' . $detail . '';

//
// we building raw data 
        $codeContents = 'BEGIN:VCARD' . "\n";
        $codeContents .= 'VERSION:4.0' . "\n";
        $codeContents .= 'CLASS:PUBLIC' . "\n";
        $codeContents .= 'N:' . $name . ";" . $lastname . ";;;\n";
        $codeContents .= 'FN:' . $lastname . " " . $name . "\n";
        $codeContents .= 'PHOTO;MEDIATYPE=image/jpeg:' . $urlphoto . "\n"; //PHOTO;MEDIATYPE=image/jpeg 
        $codeContents .= 'GEO:' . $gps . "\n"; //GEO:geo:39.95,-75.1667
        $codeContents .= 'KIND:individual\n';
        $codeContents .= 'LANG:' . $logo . "\n"; //LOGO;PNG:http://example.com/logo.png
        $codeContents .= 'logo:' . $languaje . "\n";
        $codeContents .= 'TITLE:' . $orgName . "\n";
        $codeContents .= 'URL:' . $orgName . "\n";
        $codeContents .= 'TEL;HOME;VOICE:' . $phone . "\n";
        $codeContents .= 'TEL;WORK;VOICE:' . $phonePrivate . "\n";
        $codeContents .= 'TEL;TYPE=cell:' . $phoneCell . "\n";
        $codeContents .= 'NOTE:' . $note . "\n";

        $codeContents .= 'ADR;TYPE=HOME;' .
                'LABEL="' . $addressLabel . '":'
                . $addressPobox . ';'
                . $addressExt . ';'
                . $addressStreet . ';'
                . $addressTown . ';'
                . $addressRegion . ';'
                . $addressPostCode . ';'
                . $addressCountry
                . "\n";
        $codeContents .= 'EMAIL:' . $email . "\n";
        $codeContents .= 'END:VCARD';

        $codeContentsLink = $actual_link;
// we need to generate filename somehow,  
// with md5 or with database ID used to obtains $codeContents... 
        $fileName = '_UID:' . $user_id . '_CID:' . $uid . '_' . md5($codeContents) . '.png';
        $fileNamelink = '_UID:' . $user_id . '_CID:' . $uid . '_' . md5($codeContents) . 'link.png';

        $pngAbsoluteFilePath = $tempDir . $fileName;
        $pngAbsoluteFilePathlink = $tempDir . $fileNamelink;
// generating 
        if (!file_exists($pngAbsoluteFilePath)) {
            QRcode::png($codeContents, $pngAbsoluteFilePath, "L", 4, 4);
        }
        if (!file_exists($pngAbsoluteFilePathlink)) {
            QRcode::png($codeContentsLink, $pngAbsoluteFilePathlink, "H", 4, 4);
        }
        return array($pngAbsoluteFilePath, $pngAbsoluteFilePathlink);
    }

}

/// START POST METHODS

$login = new USER();


if (isset($_POST['btnlogin']) and $_POST['btnlogin'] == 'login') {
    $uname = strip_tags(filter_input(INPUT_POST, 'user'));
    $upass = strip_tags(filter_input(INPUT_POST, 'pass'));
    $sec = strip_tags(filter_input(INPUT_POST, 'sec'));

    if ($sec == $val3) {
        if ($login->doLogin($uname, $upass)) {
            //$login->redirect('../home/index.php');
            echo "DONE";
            return true;
        } else {
            $error = "Wrong Credentials !";
            echo "AUTHENTICATION ERROR";
            return false;
        }
    } else {
        echo "ERROR CODE VERIFICATION...";
        return false;
    }
}



if (isset($_POST['btnlogin']) and $_POST['btnlogin'] == 'register') {
    $uname = strip_tags(filter_input(INPUT_POST, 'user'));
    $upass = strip_tags(filter_input(INPUT_POST, 'pass'));
    $rpass = strip_tags(filter_input(INPUT_POST, 'rpass'));
    $sec = strip_tags(filter_input(INPUT_POST, 'sec'));

    if ($uname == "") {
        $error[] = "provide email id !";
        echo "provide email id !";
        return false;
    } else if (!filter_var($uname, FILTER_VALIDATE_EMAIL)) {
        $error[] = 'Please enter a valid email address !';
        echo "Please enter a valid email address !";
        return false;
    } else if ($upass == "") {
        $error[] = "provide password !";
        echo "provide password !";
        return false;
    } else if (strlen($upass) < 4) {
        $error[] = "Password must be atleast 4 characters";
        echo "Password must be atleast 4 characters";
        return false;
    } else if ($upass != $rpass) {
        $error[] = "Passwords must be the same";
        echo "Passwords must be the same";
        return false;
    } else if ($sec != $val3) {
        echo "ERROR CODE VERIFICATION...";
        return false;
    } else {
        try {
            $stmt = $login->runQuery("SELECT user_name FROM users WHERE user_name=:uname");
            $stmt->execute(array(':uname' => $uname));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row['user_name'] == $uname) {
                $error[] = "sorry username or mail already taken !";
                echo "sorry username or mail already taken !";
                return false;
            } else {
                if ($login->register($uname, $upass)) {
                    //$login->redirect('../login/index.php?joined');
                    echo "DONE";
                    return true;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "DB CONNECTION ERROR...";
            return false;
        }
    }
}


if (isset($_POST['btnlogin']) and $_POST['btnlogin'] == 'update') {
    $uid = strip_tags(filter_input(INPUT_POST, 'userid'));
    $uname = strip_tags(filter_input(INPUT_POST, 'user'));
    $upass = strip_tags(filter_input(INPUT_POST, 'pass'));
    $address = strip_tags(filter_input(INPUT_POST, 'address'));
    $phone = strip_tags(filter_input(INPUT_POST, 'phone'));
    //$sec = strip_tags(filter_input(INPUT_POST, 'sec'));
    if ($login->update($uid, $address, $phone)) {
        //$login->redirect('../home/index.php');
        echo "DONE";
        return true;
    } else {
        $error = "Wrong Credentials !";
        echo "UPDATE ERROR";
        return false;
    }
}


if (isset($_POST['btnlogin']) and $_POST['btnlogin'] == 'updatepass') {
    $uid = strip_tags(filter_input(INPUT_POST, 'userid'));
    $uname = strip_tags(filter_input(INPUT_POST, 'user'));
    $pass = strip_tags(filter_input(INPUT_POST, 'pass'));
    $rpass = strip_tags(filter_input(INPUT_POST, 'rpass'));
    $rpassb = strip_tags(filter_input(INPUT_POST, 'rpassb'));

    if ($login->updatepass($uid, $pass, $rpass, $rpassb)) {
        //$login->redirect('../home/index.php');
        echo "DONE";
        return true;
    } else {
        $error = "Wrong Credentials !";
        echo "UPDATE ERROR";
        return false;
    }
}




if (isset($_POST['btnlogin']) and $_POST['btnlogin'] == 'updateclient') {
    $id = strip_tags(filter_input(INPUT_POST, 'id'));
    $user_id = strip_tags(filter_input(INPUT_POST, 'userid'));
    $name = strip_tags(filter_input(INPUT_POST, 'name'));
    $lastname = strip_tags(filter_input(INPUT_POST, 'lastname'));
    $address = strip_tags(filter_input(INPUT_POST, 'address'));
    $phone = strip_tags(filter_input(INPUT_POST, 'phone'));
    $phonee1 = strip_tags(filter_input(INPUT_POST, 'phonee1'));
    $phonee2 = strip_tags(filter_input(INPUT_POST, 'phonee2'));
    $qr = strip_tags(filter_input(INPUT_POST, 'qr'));
    $joining_date = strip_tags(filter_input(INPUT_POST, 'joining_date'));
    $end_date = strip_tags(filter_input(INPUT_POST, 'end_date'));
    $alergy = strip_tags(filter_input(INPUT_POST, 'alergy'));
    $drname = strip_tags(filter_input(INPUT_POST, 'drname'));
    $drphone = strip_tags(filter_input(INPUT_POST, 'drphone'));
    $detail = strip_tags(filter_input(INPUT_POST, 'detail'));
    $medicine = strip_tags(filter_input(INPUT_POST, 'medicine'));
    $blood = strip_tags(filter_input(INPUT_POST, 'blood'));

    if ($login->updateclient($id, $user_id, $name, $lastname, $address, $phone, $phonee1, $phonee2, $qr, $joining_date, $end_date, $alergy, $drname, $drphone, $detail, $medicine, $blood)) {
        //$login->redirect('../home/index.php');
        echo "DONE";
        return true;
    } else {
        $error = "Wrong Credentials !";
        echo "UPDATE ERROR";
        return false;
    }
}


if (isset($_POST['btnlogin']) and $_POST['btnlogin'] == 'addclient') {
    $user_id = strip_tags(filter_input(INPUT_POST, 'userid'));
    $name = strip_tags(filter_input(INPUT_POST, 'name'));
    $lastname = strip_tags(filter_input(INPUT_POST, 'lastname'));
    $address = strip_tags(filter_input(INPUT_POST, 'address'));
    $phone = strip_tags(filter_input(INPUT_POST, 'phone'));
    $phonee1 = strip_tags(filter_input(INPUT_POST, 'phonee1'));
    $phonee2 = strip_tags(filter_input(INPUT_POST, 'phonee2'));
    $qr = strip_tags(filter_input(INPUT_POST, 'qr'));
    $joining_date = strip_tags(filter_input(INPUT_POST, 'joining_date'));
    $end_date = strip_tags(filter_input(INPUT_POST, 'end_date'));
    $alergy = strip_tags(filter_input(INPUT_POST, 'alergy'));
    $drname = strip_tags(filter_input(INPUT_POST, 'drname'));
    $drphone = strip_tags(filter_input(INPUT_POST, 'drphone'));
    $detail = strip_tags(filter_input(INPUT_POST, 'detail'));
    $medicine = strip_tags(filter_input(INPUT_POST, 'medicine'));
    $blood = strip_tags(filter_input(INPUT_POST, 'blood'));

    if ($login->addclient($user_id, $name, $lastname, $address, $phone, $phonee1, $phonee2, $qr, $joining_date, $end_date, $alergy, $drname, $drphone, $detail, $medicine, $blood)) {
        //$login->redirect('../home/index.php');
        echo "DONE";
        return true;
    } else {
        $error = "Wrong Credentials !";
        echo "UPDATE ERROR";
        return false;
    }
}

if (isset($_POST['btnlogin']) and $_POST['btnlogin'] == 'sendpass') {
    $uname = strip_tags(filter_input(INPUT_POST, 'user'));
    $sec = strip_tags(filter_input(INPUT_POST, 'sec'));

    if ($uname == "") {
        $error[] = "provide email id !";
        echo "PLEASE ENTER A EMAIL !";
        return false;
    } else if (!filter_var($uname, FILTER_VALIDATE_EMAIL)) {
        $error[] = 'Please enter a valid email address !';
        echo "PLEASE ENTER A VALID EMAIL !";
        return false;
    } else if ($sec != $val3) {
        echo "ERROR CODE VERIFICATION...";
        return false;
    } else {
        try {
            $stmt = $login->runQuery("SELECT * FROM users WHERE user_name=:uname");
            $stmt->execute(array(':uname' => $uname));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() == 1) {
                if ($login->sendpass($uname)) {
                    echo "DONE";
                    return true;
                } else {
                    $error = "EMAIL SEND ERROR !";
                    echo "EMAIL SEND ERROR";
                    return false;
                }
                return true;
            } else {
                $error[] = "sorry username or mail dont exist!";
                echo "THIS EMAIL IS NOT IN OUR DB.";
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "DB CONNECTION ERROR...";
            return false;
        }
    }
}