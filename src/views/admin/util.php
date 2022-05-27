<?php

require __DIR__ . '/../sendgrid-php/sendgrid-php.php';

$key = '';

function sendEmail($emails, $title, $message, $key) {
  /*  $attachment = new SendGrid\Attachment();
    $file_encoded;
    $filename = array_filter($_FILES['file']['name']);
    if(!empty($filename)) {
        $attachment->setType("application/text");
        $attachment->setFilename($filename);
        $file_encoded = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
        $attachment->setContent($file_encoded);
        $attachment->setDisposition("attachment");
    }*/
    foreach($emails as $email) {
        $mail = new \SendGrid\Mail\Mail();
        $mail->setFrom("donotreply@YOUR_SENDGRID_DOMAIN", "COMPANY NAME");
        $mail->setSubject($title);
      //  $mail->addAttachment($attachment);
        $mail->addTo($email, $email);
        $mail->addContent("text/plain", $message);
        $sendgrid = new \SendGrid($key);
        try {
          $sendgrid->send($mail);
        } catch (Exception $e) {
          
        }
    }
}

function exportDB($host, $name, $user, $password) {
    $db = new mysqli($host, $user, $password, $name);
    $tables = array();
    $result = $db->query("SHOW TABLES");
    while($row = $result->fetch_row()) { 
        $tables[] = $row[0];
    }

    $return = '';

    foreach($tables as $table){
        $result = $db->query("SELECT * FROM $table");
        $numColumns = $result->field_count;

        $result2 = $db->query("SHOW CREATE TABLE $table");
        $row2 = $result2->fetch_row();

        $return .= "\n\n".$row2[1].";\n\n";

        for($i = 0; $i < $numColumns; $i++) { 
            while($row = $result->fetch_row()) { 
                $return .= "INSERT INTO $table VALUES(";
                for($j=0; $j < $numColumns; $j++) { 
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = $row[$j];
                    if (isset($row[$j])) { 
                        $return .= '"'.$row[$j].'"' ;
                    } else { 
                        $return .= '""';
                    }
                    if ($j < ($numColumns-1)) {
                        $return.= ',';
                    }
                }
                $return .= ");\n";
            }
        }

        $return .= "\n\n\n";
    }

    $filename = time() . '.sql';
    $handle = fopen($filename, 'w');
    fwrite($handle, $return);
    fclose($handle);

    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename=' . basename($filename));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: '. filesize($filename));
    header('Content-Type: application/sql');
    ob_clean();
    flush();
    readfile($filename);
}

function importDB($pdo) {
    $sql = file_get_contents($_FILES['file']['tmp_name']);
    $pdo->query($sql);
}

function uploadImages() {

    // File upload configuration 
    $targetDir = "uploads/"; 
    $allowTypes = array('jpg','png','jpeg','gif');
    $paths = array();
     

    $fileNames = array_filter($_FILES['files']['name']); 
    if(!empty($fileNames)){ 
        foreach($_FILES['files']['name'] as $key=>$val){ 
            // File upload path
            $file = explode(".", $_FILES["files"]["name"][$key]);
            $fileName = md5(microtime(true)) . '.' . end($file);
            $targetFilePath = $targetDir . $fileName; 
            

            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            // Check whether file type is valid 
            if(in_array($fileType, $allowTypes, true) && verifyMagicByte($_FILES["files"]["tmp_name"][$key])) {
                $imageTemp = $_FILES["files"]["tmp_name"][$key];
                $imageUploadPath = $targetDir . $fileName;
                $paths[] = compressImage($imageTemp, $imageUploadPath, 50);
            } 
        } 
         
    }
    return $paths;
}


function verifyMagicByte($file) {
    // PNG, GIF, JFIF JPEG, EXIF JPEF respectively
    $allowed = array('89504E47', '47494638', 'FFD8FFE0', 'FFD8FFE1');
    $handle = fopen($file, 'r');
    $bytes = strtoupper(bin2hex(fread($handle, 4)));
    fclose($handle);
    return in_array($bytes, $allowed);
}

function removeExif($image) {
    $img = new Imagick($image);
    $profiles = $img->getImageProfiles("icc", true);

    $img->stripImage();

    if(!empty($profiles))
        $img->profileImage("icc", $profiles['icc']);
}


function compressImage($source, $destination, $quality) { 
    // Get image info 
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
     
    // Create a new image from file 
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            break; 
        default: 
            $image = imagecreatefromjpeg($source); 
    } 
     
    // Save image 
    imagejpeg($image, $destination, $quality); 
     
    // Return compressed image 
    return $destination; 
}
