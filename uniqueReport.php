<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}



/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}


/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>
</head>
<body>


       <?php
                session_start();
                $a=$_POST['uid'];
            $flag=0;
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "jsw1";
                
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 
            
                $sql11 = "SELECT STATUS FROM safety_adm_observation where OBSERVATION_ID='$a' AND STATUS='open'";
                $result11 = $conn->query($sql11);
                if ($result11->num_rows > 0){
                    $sql = "SELECT * FROM safety_adm_observation where OBSERVATION_ID='$a'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $flag=1;
                    // output data of each row
                       echo "<h3>OPEN REPORTS</h3>";
                       echo "<a href='trial1.php'> <button type='button'  class='form-container' style='background-color: #4CAF50;color: white;padding: 16px 20px; border: none; text-align:right;'>Go Back</button></a>";
                       echo "<table><tr>
                                                                <th>Unique Observation Number</th>
                                                                <th>Department</th>
                                                                <th>Location</th>
                                                                <th>Date</th>
                                                                <th>Time (24 HRS FORMAT)</th>
                                                                <th>Description</th>
                                                                <th>Responsible Manager</th>
                                                                <th>Head of Deaprtment</th>
                                                                <th>Involved Contractor Name</th>
                                                                <th>Unsafe Act / Condition</th>
                                                                <th>Category Violation</th>
                                                                <th>Type of Observation</th>
                                                                <th>Image</th>
                                                              </tr>";
                                              
                                                while($row = $result->fetch_assoc()) {
                                                              
                                                               echo "<form  method='POST' action='observations1.php' >";
                                                               echo "<tr>";
                                                               echo "<td><input id='observer' type='text' name='observe' placeholder='Unique Number' disabled value='{$row['OBSERVATION_ID']}'></td><td>{$row['DEPARTMENT']}</td><td>{$row['LOCATION']}</td><td>{$row['DATE']}</td><td>{$row['TIME']}</td><td>{$row['DESCRIPTION']}</td><td>{$row['RESPONSIBLE_MANAGER']}</td><td>{$row['HOD']}</td><td>{$row['CONTRACTOR']}</td><td>{$row['ACT_OR_CONDITION']}</td><td>{$row['CATEGORY_OF_VIOLATION']}</td><td>{$row['NOTICE']}</td>";
                                                               echo "<td><img src='",$row['BEFORE_IMAGE'],"' width='175' height='200' />";
                                                               echo "</td>";
                                                                $_SESSION['click'] = $row['OBSERVATION_ID'];
                                                            echo "</form>";
                                                            
                    }
                    echo "</table>";
                    
                } 
                }
  
    
        $sql="SELECT * FROM safety_adm_observation o, safety_adm_closed_observations c where o.observation_id='$a' AND c.observation_id='$a'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $flag=1;
                    // output data of each row
                       echo "<h3>CLOSED REPORTS</h3>";
              echo "<a href='trial1.php'> <button type='button'  class='form-container' style='background-color: #4CAF50;color: white;padding: 16px 20px; border: none; text-align:right;'>Go Back</button></a>";
                       echo "<table><tr>
                                                                <th>Unique Observation Number</th>
                                                                <th>Department</th>
                                                                <th>Location</th>
                                                                <th>Date</th>
                                                                <th>Time (24 HRS FORMAT)</th>
                                                                <th>Description</th>
                                                                <th>Responsible Manager</th>
                                                                <th>Head of Deaprtment</th>
                                                                <th>Involved Contractor Name</th>
                                                                <th>Unsafe Act / Condition</th>
                                                                <th>Category Violation</th>
                                                                <th>Type of Observation</th>
                                                                <th>Action Taken Date</th>
                                                                <th>CAPA</th>
                                                                <th>Before Picture</th>
                                                                <th>After Picture</th>
                                                              </tr>";
                                              
                                                while($row = $result->fetch_assoc()) {
                                                              
                                                               echo "<form  method='POST' action='observations1.php' >";
                                                               echo "<tr>";
                                                               echo "<td><input id='observer' type='text' name='observe' placeholder='Unique Number' disabled value='{$row['OBSERVATION_ID']}'></td><td>{$row['DEPARTMENT']}</td><td>{$row['LOCATION']}</td><td>{$row['DATE']}</td><td>{$row['TIME']}</td><td>{$row['DESCRIPTION']}</td><td>{$row['RESPONSIBLE_MANAGER']}</td><td>{$row['HOD']}</td><td>{$row['CONTRACTOR']}</td><td>{$row['ACT_OR_CONDITION']}</td><td>{$row['CATEGORY_OF_VIOLATION']}</td><td>{$row['NOTICE']}</td><td>{$row['DATE']}</td><td>{$row['DESCRIPTION']}</td>";
                                                               echo "<td><img src='",$row['BEFORE_IMAGE'],"' width='175' height='200' />";
                                                               echo "</td>";
                                                               echo "<td><img src='",$row['AFTER_PHOTO'],"' width='175' height='200' />";
                                                               echo "</td>";
                                                                $_SESSION['click'] = $row['OBSERVATION_ID'];
                                                            echo "</form>";
                                                            
                    }
                    echo "</table>";
                    
                } 
 
if($flag==0){
      echo"<h2>NO REPORTS FOUND</h2>";
}
                
                
                $conn->close();
    ?>
</body>
</html>
