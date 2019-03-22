<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif; box-sizing: border-box;}


input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}
    
input[type=file] {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=date] {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=time] {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 50px;
  width: 300px;
  margin: 0 auto;
}
    
.form,h3 {
    width: 300px;
    margin: 0 auto;
}
</style>
</head>
<body>


<div class="container">
     <h3>Corrective and Preventive Action Form</h3>
 <br>
 <br>
  <form class="form" action="addclosedreport.php" method="post" enctype="multipart/form-data" onsubmit="return download()">
    <label for="fname">Observation Number</label>
    <input type="text" id="unum" name="unum" value="" disabled>
    
   

    <label for="lname">Date</label>
    <input type="date" id="date" name="date">
    
  
  
    <label for="subject">Corrective / Preventive Action</label>
    <textarea id="subject" name="describe" placeholder="What Corrective / Preventive Action taken" style="height:200px"></textarea>
    
     <label for="fname">Image</label>
    <input type="file" accept="image/*" id="observe" name="picture" >

    <input type="submit" value="Submit">
  </form>
</div>

<?php
    session_start(); // this NEEDS TO BE AT THE TOP of the page before any output etc
    $a = $_SESSION['click'];
?>

<script>
    function download()
        {
            var from=document.getElementById("date").value;
            if( from=="") {
                    alert("Please Select Date");
                    return false;
                }
    
            var too=document.getElementById("subject").value;
            if( too=="") {
                    alert("Please Enter Description");
                    return false;
                }
            
            return true;
        }
    var Observer = <?php echo json_encode($a); ?>;
    document.getElementById("unum").value=Observer;
</script>
</body>
</html>
