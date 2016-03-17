<?php

// ESTE SCRIPT RECIVE LAS REQUEST DESDE EL SCRIPT DE JAVASCRIT QUE TRABAJ CON AJAX PARA HACER UN POST.
require_once 'class.user.php';

$login = new USER();

//session_start();
if (strpos(strtolower(filter_input(INPUT_SERVER, 'HTTP_USER_AGENT')), "apple")) { //to prevent cookies for non-apple devices
    $cookieLifetime = 365 * 24 * 60 * 60; // A year in seconds
    setcookie("ses_id", session_id(), time() + $cookieLifetime);
}

$val3 = $val1 + $val2;
//echo "lo ". $_POST['btnlogin'];


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

    if ($login->updateclient($id, $name, $lastname, $address, $phone, $phonee1, $phonee2, $qr, $joining_date, $end_date, $alergy, $drname, $drphone, $detail, $medicine, $blood)) {
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


    if ($uname == "") {
        $error[] = "provide email id !";
        echo "provide email id !";
        return false;
    } else if (!filter_var($uname, FILTER_VALIDATE_EMAIL)) {
        $error[] = 'Please enter a valid email address !';
        echo "Please enter a valid email address !";
        return false;
    } else if ($sec != $val3) {
        echo "ERROR CODE VERIFICATION...";
        return false;
    } else {
        try {
            $stmt = $login->runQuery("SELECT user_pass FROM users WHERE user_name=:uname");
            $stmt->execute(array(':uname' => $uname));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() == 1) {
                $emailpass = $row['user_pass'];
                if ($login->sendpass($uname,$emailpass)) {
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
                echo "Email is not in our database.";
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "DB CONNECTION ERROR...";
            return false;
        }
    }
}