<?php
   
    session_start();
    /* Attempt MySQL server connection. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */

    $link = mysqli_connect("localhost", "root", "", "jsw1");
    //echo $_SESSION['click'];

    // Check connection

    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    // Escape user inputs for security
    $image=basename( $_FILES["picture"]["name"],".png");
    $unum = mysqli_real_escape_string($link, $_SESSION['click']);
    $date = mysqli_real_escape_string($link, $_POST['date']);
     $describe = mysqli_real_escape_string($link, $_POST['describe']);

$image=basename( $_FILES["picture"]["name"]);

$target_dir = "";
$target_file = $target_dir . basename($_FILES["picture"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["picture"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
       // echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    //echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["picture"]["size"] > 500000) {
    //echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["picture"]["name"]). " has been uploaded.";
    } else {
       // echo "Sorry, there was an error uploading your file.";
    }
}

  
    // attempt insert query execution
    $sql = "INSERT INTO safety_adm_closed_observations (OBSERVATION_ID, DATE,DESCRIPTION, AFTER_PHOTO) VALUES ('$unum', '$date', '$describe', '$image')";
    $sql1 = "UPDATE safety_adm_observation SET status='closed' WHERE observation_id= '$unum'";

    if(mysqli_query($link, $sql) && mysqli_query($link, $sql1)){
       echo "<p align='center'> <font color=blue  size='6pt'>Observation has been added successfully.</font> </p>";
         echo "<p align='center'> <font color=blue  size='6pt'>Please wait while we redirect you to the previous page</font> </p>";
        header( "refresh:2;url=observations.php" );
    } else{
        echo "<p align='center'> <font color=blue  size='6pt'>ERROR: failed to log record, try again later</font> </p>";
    }
    
    // close connection
    mysqli_close($link);
?>
