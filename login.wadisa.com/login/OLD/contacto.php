<?php
if(isset($_POST['email'])) {
    // CHANGE THE TWO LINES BELOW
    $email_to = "admin@buhonet.es"; 
    $email_subject = "Contacto desde WEB";

    function died($error) {
        // your error code can go here
        echo "Encontramos un error en el formulario.";
        echo "El detalle del problema aparece a continuaci&oacute;n.<br /><br />";
        echo $error."<br /><br />";
        echo "Por favor vuelva a intentarlo.<br /><br />";
        die();
    }
     
    // validation expected data exists
    if(!isset($_POST['email']) ||
        //!isset($_POST['last_name']) ||
        //!isset($_POST['email']) ||
        //!isset($_POST['telephone']) ||
        !isset($_POST['message'])) {
        died('Lo sentimos pero hay un error con el formulario.');       
    }
     
    $first_name = $_POST['name']; // required
    //$last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['phone']; // not required
    $comments = $_POST['message']; // required   
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'El mail que ha escrito, no parece ser valido.<br />';
  }
  
    $string_exp = "/^[A-Za-z .'-]+$/";
  // if(!preg_match($string_exp,$first_name)) {
  //  $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  //}
  //if(!preg_match($string_exp,$last_name)) {
  //  $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  //}
  if(strlen($comments) < 2) {
    $error_message .= 'Existe un problema en los comentarios.<br />';
  }
  
  if(strlen($error_message) > 0) {
    died($error_message);
  }
  
    $email_message = "Los detalles se muestran a continuacion.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "First Name: ".clean_string($first_name)."\n";
    //$email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
     
     
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- place your own success html below -->
 
<script language="javascript" type="text/javascript">
// Print a message
alert('Gracias por contactarnos.');
// Redirect to some page of the site. You can also specify full URL, e.g. 
// header("location: http://www.google.es");
</script>

<?php
//header('location: http://buhonet.es'); //isset check to see if a variables has been 'set'
}
die();
?>