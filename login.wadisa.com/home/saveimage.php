<?php
require_once("../config/session.php");
//set random name for the image, used time() for uniqueness
$company = $_SESSION['company_code'];
$client = $_SESSION['user_id'];


$filename = 'photo_UID:' . $company . '_CID:' . $client . '.jpg';
$filepath = 'saved_images/';
$pngAbsoluteFilePath = $filepath . $filename;
//read th$pngAbsoluteFilePathe raw POST data and save the file with file_put_contents()
if (!file_exists($pngAbsoluteFilePath)) {
    $result = file_put_contents($filepath . $filename, file_get_contents('php://input'));
    if (!$result) {
        print "ERROR: Failed to write data to $filename, check permissions\n";
        exit();
    }
}

echo $filepath . $filename;

