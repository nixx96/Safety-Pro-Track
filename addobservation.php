
   <?php
    session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc
    require 'D:\xampp2\htdocs\www\PHPMailer\PHPMailerAutoload.php';
    /* Attempt MySQL server connection. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */

    $link = mysqli_connect("localhost", "root", "", "jsw1");

    // Check connection

    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    // Escape user inputs for security
    $date = mysqli_real_escape_string($link, $_POST['date']);
    $time = mysqli_real_escape_string($link, $_POST['time']);
    $location = mysqli_real_escape_string($link, $_POST['location']);
    $describe = mysqli_real_escape_string($link, $_POST['describe']);
$describe1= str_replace("\n", '', $describe);
$describe1= str_replace("\r", '', $describe1);
    $cov = mysqli_real_escape_string($link, $_POST['cov']);
   $email = mysqli_real_escape_string($link, $_POST['email']);
   $hod = mysqli_real_escape_string($link, $_POST['hod']);

    $contractor = mysqli_real_escape_string($link, $_POST['contractor']);

   $notice = mysqli_real_escape_string($link, $_POST['notice']);
$aoc = mysqli_real_escape_string($link, $_POST['aoc']);
 $dept1 = mysqli_real_escape_string($link, $_POST['dept']);  
list($dept) = explode(',', $dept1);
$dic = substr($dept1, strrpos($dept1, ',') + 1);

 $image=basename( $_FILES["picture"]["name"]);

$target_dir = "";
$target_file = $target_dir . basename($_FILES["picture"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["picture"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
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
   // echo "Sorry, your file is too large.";
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
        //echo "Sorry, there was an error uploading your file.";
    }
}






    $status="open";


                $sql = "SELECT * FROM safety_adm_observation";
                $result = $link->query($sql);
                $obnum="JSW_SAFETY";
                $obnum.=$result->num_rows+1000;


    // attempt insert query execution
   $sql = "INSERT INTO `safety_adm_observation`(`OBSERVATION_ID`, `DATE`, `TIME`, `LOCATION`, `DESCRIPTION`, `ACT_OR_CONDITION`, `CATEGORY_OF_VIOLATION`, `RESPONSIBLE_MANAGER`, `DEPARTMENT`, `DIC`, `HOD`, `CONTRACTOR`, `NOTICE`, `STATUS`, `BEFORE_IMAGE`) VALUES ('$obnum','$date', '$time', '$location', '$describe', '$aoc', '$cov', '$email', '$dept', '$dic','$hod', '$contractor', '$notice', '$status','$image')";
   

    if(mysqli_query($link, $sql)){
       echo "<p align='center'> <font color=blue  size='6pt'>Observation has been added successfully.</font> </p>";
         echo "<p align='center'> <font color=blue  size='6pt'>Please wait while we redirect you to the previous page</font> </p>";
        header( "refresh:0.5;url=trial1.php" );
    } else{
        echo "<p align='center'> <font color=blue  size='6pt'>ERROR: failed to log observation, Please try again. </font> </p>";
    }

    $mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'kyatham.nikhil@gmail.com';                 // SMTP username
$mail->Password = 'RGBbaraccuda47';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$email1=$email;
$email1.="@jsw.in";
$hod1=$hod;
$hod1.="@jsw.in";
$mail->setFrom('kyatham.nikhil@gmail.com', 'Mailer');
$mail->addAddress($email1);     // Add a recipient
$mail->addAddress('kyatham.nikhil@gmail.com');               // Name is optional
$mail->addReplyTo('kyatham.nikhil@gmail.com', 'Information');
$mail->addCC($hod1);
$mail->addBCC('');

$mail->addAttachment($target_file);         // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML
echo "<style>table,td,th{border: 1px solid black;}</style>";
$mail->Subject = 'SAFETY OBSERVATION ALERT! '.$date.' '.$time;
$mail->Body    = '<html><head><style>table,td,th{border: 1px solid black;
  border-collapse: collapse;
  padding : 10px;}</style><head><body>
<table>
    <tr>
    <td>Unique Observation Number</td>
	<td>'.$obnum.'</td>
  </tr>
  <tr>
    <td>DIC</td>
	<td>'.$dic.'</td>
  </tr>
  <tr>
    <td>Department</td>
	<td>'.$dept.'</td>
  </tr>
   <tr>
    <td>Location</td>
	<td>'.$location.'</td>
  </tr>
  <tr>
    <td>Date</td>
	<td>'.$date.'</td>
  </tr>
  <tr>
    <td>Time</td>
	<td>'.$time.'</td>
  </tr>
   <tr>
    <td>Description</td>
	<td>'.$describe1.'</td>
  </tr>
  <tr>
    <td>Responsible Manager</td>
	<td>'.$email.'</td>
  </tr>
    <tr>
    <td>HOD</td>
	<td>'.$hod.'</td>
  </tr>
   <tr>
    <td>Contractor</td>
	<td>'.$contractor.'</td>
  </tr>
    <tr>
    <td>Unsafe Act / Condition</td>
	<td>'.$aoc.'</td>
  </tr>
  <tr>
    <td>Category of Violation</td>
	<td>'.$cov.'</td>
  </tr>
  <tr>
    <td>Type</td>
	<td>'.$notice.'</td>
  </tr>
  <tr>
    <td>Status</td>
	<td>'.$status.'</td>
  </tr>
</table>
</body>
</html>';


$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
   // echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
   // echo 'Message has been sent';
}
    
    // close connection
    mysqli_close($link);
?>
