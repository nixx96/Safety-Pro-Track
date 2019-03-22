 <?php session_start();?>
<!DOCTYPE html>
<html>
<head>
<title>Safety Pro Track</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script src="//cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="Raleway.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    
 

<style>
                    * { box-sizing: border-box; }
                body {
                  font: 16px Arial; 
                }
                .autocomplete {
                  /*the container must be positioned relative:*/
                  position: relative;
                  display: inline-block;
                }
                input {
                  border: 1px solid transparent;
                  background-color: #f1f1f1;
                  padding: 10px;
                  font-size: 16px;
                }
                input[type=text] {
                  background-color: #f1f1f1;
                  width: 100%;
                }
                input[type=submit] {
                  background-color: DodgerBlue;
                  color: #fff;
                }
                .autocomplete-items {
                  position: absolute;
                  border: 1px solid #d4d4d4;
                  border-bottom: none;
                  border-top: none;
                  z-index: 99;
                  /*position the autocomplete items to be the same width as the container:*/
                  top: 100%;
                  left: 0;
                  right: 0;
                }
    
                .autocomplete-items div {
                  padding: 10px;
                  cursor: pointer;
                  background-color: white; 
                  border-bottom: 1px solid #d4d4d4; 
                }
    
                .autocomplete-items div:hover {
                  /*when hovering an item:*/
                  background-color: #e9e9e9; 
                }
                .autocomplete-active {
                  /*when navigating through the items using the arrow keys:*/
                  background-color: DodgerBlue !important; 
                  color: #ffffff; 
                }
   
    
    
    
</style>
 <script>
        function checkaddobservation()
        {
            var date =document.getElementById("date").value;
            var time =document.getElementById("time").value;
            var location=document.getElementById("location").value;
            var des=document.getElementById("describe").value;
            var pic=document.getElementById("picture").value;
            var contractor=document.getElementById("contractor").value;
            if( date=="") {
                    alert("Please select the date");
                    return false;
                }
            if( time=="") {
                    alert("Please select the time");
                    return false;
                }
            if( location=="") {
                    alert("Please enter the location");
                    return false;
                }
            else if(des=="")
                {
                    alert("Description Field Cannot Be Empty");
                    return false;
                }
            else if(contractor==""){
                alert("Contractor Field Cannot Be Empty");
                    return false;
            }
          
            return true;
        }

     


     
     function checkobservation()
        {
            var sbe=document.getElementById("sbe").value;
            if( sbe=="") {
                    alert("Please Enter Empolyee Id");
                    return false;
                }
            else if(sbe.length != 7)
  {
    alert("Employee ID must be 7 digits");
    return false;
  }
   else if(isNaN(parseInt(sbe)))
      {
          alert("Employee Id Cannot Be characters");
          return false;
      }
  
            
            return true;
        }
     
      function download()
        {
            var from=document.getElementById("from").value;
            if( from=="") {
                    alert("Please Select Date");
                    return false;
                }
        var to=document.getElementById("to").value;
            if( to=="") {
                    alert("Please Select Date");
                    return false;
                }
            
            return true;
        }

     
     function download1()
        {
            var from=document.getElementById("from").value;
            if( from=="") {
                    alert("Please Select Date");
                    return false;
                }
        var to=document.getElementById("to").value;
            if( to=="") {
                    alert("Please Select Date");
                    return false;
                }
            
            return true;
        }
</script>

    </head>
   
<body class="w3-content" style="max-width:1300px">

<!-- First Grid: Logo & About -->
<div class="w3-row">
  <div class="w3-half w3-black w3-container w3-center" style="height:1600px;">
    <div class="w3-padding-64">
      <h1>SAFETY PRO TRACK</h1>
      <br>
      <img src="images/safetyman.jpg" style="border-radius: 70%;">
       <div class="w3-padding-64">
     
      <a href="#complaint" class="w3-button w3-black w3-block w3-hover-teal w3-padding-16">Log Observations</a>
      <a href="#download" class="w3-button w3-black w3-block w3-hover-brown w3-padding-16">Download Report By DIC</a>
      <a href="#download1" class="w3-button w3-black w3-block w3-hover-brown w3-padding-16">Download Report By Department</a>
      <a href="index.html" class="w3-button w3-black w3-block w3-hover-brown w3-padding-16">Log Out</a>
    </div>
    </div>
    
   
  </div>
  
  
  <div class="w3-half w3-teal w3-container" style="height:1600px">
    <div class="w3-padding-64 w3-padding-large" id="complaint">
      <h1>Log Observations</h1>
      
        <!-- Department -->

     
     
      
      
      
    <form name="myForm1" class="w3-container w3-card w3-padding-32 w3-white"  onsubmit="return checkaddobservation()" method="post" enctype="multipart/form-data" autocomplete="off" action="addobservation.php">
     
         <p align="left">Department</p>
  
     
        
    <?php
        
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "jsw1";
                    
                    $dep;
                    echo "<select class='w3-input w3-border' name='dept' id='dept'>";
            // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 

                $sql1 = "SELECT d.DEPT_NAME, d2.DIVISION_NAME FROM safety_mstr_departments d, safety_mstr_divisions d2, safety_mstr_company c, safety_mstr_divi_dept_map d1 WHERE d.PLANT_LOCATION_ID=c.LOCATION_ID and d.DEPART_ID=d1.DEPARTMENT_ID AND d1.DIVISION_ID=d2.DIVISION_ID and c.COMPANY_ID=1 and c.LOCATION_ID=2 and d2.REC_STATUS='ACTIVE';";
                $result1 = $conn->query($sql1);
        
                if ($result1->num_rows > 0) {
                    // output data of each row
                    while($row1 = $result1->fetch_assoc()) {
                               echo "<option id='dept1' >" . $row1['DEPT_NAME'] . ",". $row1['DIVISION_NAME'].   "</option>";
                               $_SESSION['division'] = $row1['DIVISION_NAME'];
                               $_SESSION['department'] = $row1['DEPT_NAME'];
                    }
                } 
            
                $conn->close();  
            echo "<script type='text/javascript'>
                $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
          
            </script>";
            echo "</select>";    
    ?>
    

     <p align="left">Location</p>
      <p><input class="w3-input w3-border" type="text" placeholder="" name="location" id="location"></p>
     
      <p align="left">Date</p>
      <p><input class="w3-input w3-border" type="date" placeholder="Date" name="date" id="date" id="date">
      </p>
      <p align="left">Time (24HRS Format)</p>
      <p><input class="w3-input w3-border" type="time" placeholder="Time" name="time" id="time" value="now"></p>
      
    <p align="left">Description</p>
      <p>
      <input type="text" rows="4" class="w3-input w3-border" cols="50" name="describe"  id="describe">
      </p>
   
    
    
    
    <!-- Manager Email  -->
    
    <p align="left">Responsible Manager</p>
  
     
   
      <div class="autocomplete" style="width:100%;" >
        <input id="myInput"  class="w3-input w3-border" type="text" name="email" placeholder="Email" >
      </div>
 

          <?php
             $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "jsw1";
                $manager=[];
            // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 

                $sql = "SELECT EMAIL_ID FROM safety_adm_users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                                array_push($manager,$row["EMAIL_ID"]);
                    }
                }             
                $conn->close();         
    ?>
    
    <script >

    var jArray = <?php echo json_encode($manager); ?>;

                    function autocomplete(inp, arr) {
                      /*the autocomplete function takes two arguments,
                      the text field element and an array of possible autocompleted values:*/
                      var currentFocus;
                      /*execute a function when someone writes in the text field:*/
                      inp.addEventListener("input", function(e) {
                          var a, b, i, val = this.value;
                          /*close any already open lists of autocompleted values*/
                          closeAllLists();
                          if (!val) { return false;}
                          currentFocus = -1;
                          /*create a DIV element that will contain the items (values):*/
                          a = document.createElement("DIV");
                          a.setAttribute("id", this.id + "autocomplete-list");
                          a.setAttribute("class", "autocomplete-items");
                          /*append the DIV element as a child of the autocomplete container:*/
                          this.parentNode.appendChild(a);
                          /*for each item in the array...*/
                          for (i = 0; i < arr.length; i++) {
                            /*check if the item starts with the same letters as the text field value:*/
                            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                              /*create a DIV element for each matching element:*/
                              b = document.createElement("DIV");
                              /*make the matching letters bold:*/
                              b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                              b.innerHTML += arr[i].substr(val.length);
                              /*insert a input field that will hold the current array item's value:*/
                              b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                              /*execute a function when someone clicks on the item value (DIV element):*/
                              b.addEventListener("click", function(e) {
                                  /*insert the value for the autocomplete text field:*/
                                  inp.value = this.getElementsByTagName("input")[0].value;
                                  /*close the list of autocompleted values,
                                  (or any other open lists of autocompleted values:*/
                                  closeAllLists();
                                  arr=[];
                              });
                              a.appendChild(b);
                            }
                          }
                      });
                      /*execute a function presses a key on the keyboard:*/
                      inp.addEventListener("keydown", function(e) {
                          var x = document.getElementById(this.id + "autocomplete-list");
                          if (x) x = x.getElementsByTagName("div");
                          if (e.keyCode == 40) {
                            /*If the arrow DOWN key is pressed,
                            increase the currentFocus variable:*/
                            currentFocus++;
                            /*and and make the current item more visible:*/
                            addActive(x);
                          } else if (e.keyCode == 38) { //up
                            /*If the arrow UP key is pressed,
                            decrease the currentFocus variable:*/
                            currentFocus--;
                            /*and and make the current item more visible:*/
                            addActive(x);
                          } else if (e.keyCode == 13) {
                            /*If the ENTER key is pressed, prevent the form from being submitted,*/
                            e.preventDefault();
                            if (currentFocus > -1) {
                              /*and simulate a click on the "active" item:*/
                              if (x) x[currentFocus].click();
                            }
                          }
                      });
                      function addActive(x) {
                        /*a function to classify an item as "active":*/
                        if (!x) return false;
                        /*start by removing the "active" class on all items:*/
                        removeActive(x);
                        if (currentFocus >= x.length) currentFocus = 0;
                        if (currentFocus < 0) currentFocus = (x.length - 1);
                        /*add class "autocomplete-active":*/
                        x[currentFocus].classList.add("autocomplete-active");
                      }
                      function removeActive(x) {
                        /*a function to remove the "active" class from all autocomplete items:*/
                        for (var i = 0; i < x.length; i++) {
                          x[i].classList.remove("autocomplete-active");
                        }
                      }
                      function closeAllLists(elmnt) {
                        /*close all autocomplete lists in the document,
                        except the one passed as an argument:*/
                        var x = document.getElementsByClassName("autocomplete-items");
                        for (var i = 0; i < x.length; i++) {
                          if (elmnt != x[i] && elmnt != inp) {
                            x[i].parentNode.removeChild(x[i]);
                          }
                        }
                      }
                      /*execute a function when someone clicks in the document:*/
                      document.addEventListener("click", function (e) {
                          closeAllLists(e.target);
                      });
                    }

                    /*An array containing all the country names in the world:*/


                    /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
                    autocomplete(document.getElementById("myInput"), jArray);
                   

 </script>
    
    

    
      

    
  
   

  
    <!-- HOD -->
    
    <p align="left">Head of Department</p>
  

     
      <div class="autocomplete" style="width:100%;" >
        <input id="hod"  class="w3-input w3-border" type="text" name="hod" placeholder="Email" >
      </div> 
    <script type="text/javascript">

    var jArray = <?php echo json_encode($manager); ?>;

                    function autocomplete(inp, arr) {
                      /*the autocomplete function takes two arguments,
                      the text field element and an array of possible autocompleted values:*/
                      var currentFocus;
                      /*execute a function when someone writes in the text field:*/
                      inp.addEventListener("input", function(e) {
                          var a, b, i, val = this.value;
                          /*close any already open lists of autocompleted values*/
                          closeAllLists();
                          if (!val) { return false;}
                          currentFocus = -1;
                          /*create a DIV element that will contain the items (values):*/
                          a = document.createElement("DIV");
                          a.setAttribute("id", this.id + "autocomplete-list");
                          a.setAttribute("class", "autocomplete-items");
                          /*append the DIV element as a child of the autocomplete container:*/
                          this.parentNode.appendChild(a);
                          /*for each item in the array...*/
                          for (i = 0; i < arr.length; i++) {
                            /*check if the item starts with the same letters as the text field value:*/
                            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                              /*create a DIV element for each matching element:*/
                              b = document.createElement("DIV");
                              /*make the matching letters bold:*/
                              b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                              b.innerHTML += arr[i].substr(val.length);
                              /*insert a input field that will hold the current array item's value:*/
                              b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                              /*execute a function when someone clicks on the item value (DIV element):*/
                              b.addEventListener("click", function(e) {
                                  /*insert the value for the autocomplete text field:*/
                                  inp.value = this.getElementsByTagName("input")[0].value;
                                  /*close the list of autocompleted values,
                                  (or any other open lists of autocompleted values:*/
                                  closeAllLists();
                                  arr=[];
                              });
                              a.appendChild(b);
                            }
                          }
                      });
                      /*execute a function presses a key on the keyboard:*/
                      inp.addEventListener("keydown", function(e) {
                          var x = document.getElementById(this.id + "autocomplete-list");
                          if (x) x = x.getElementsByTagName("div");
                          if (e.keyCode == 40) {
                            /*If the arrow DOWN key is pressed,
                            increase the currentFocus variable:*/
                            currentFocus++;
                            /*and and make the current item more visible:*/
                            addActive(x);
                          } else if (e.keyCode == 38) { //up
                            /*If the arrow UP key is pressed,
                            decrease the currentFocus variable:*/
                            currentFocus--;
                            /*and and make the current item more visible:*/
                            addActive(x);
                          } else if (e.keyCode == 13) {
                            /*If the ENTER key is pressed, prevent the form from being submitted,*/
                            e.preventDefault();
                            if (currentFocus > -1) {
                              /*and simulate a click on the "active" item:*/
                              if (x) x[currentFocus].click();
                            }
                          }
                      });
                      function addActive(x) {
                        /*a function to classify an item as "active":*/
                        if (!x) return false;
                        /*start by removing the "active" class on all items:*/
                        removeActive(x);
                        if (currentFocus >= x.length) currentFocus = 0;
                        if (currentFocus < 0) currentFocus = (x.length - 1);
                        /*add class "autocomplete-active":*/
                        x[currentFocus].classList.add("autocomplete-active");
                      }
                      function removeActive(x) {
                        /*a function to remove the "active" class from all autocomplete items:*/
                        for (var i = 0; i < x.length; i++) {
                          x[i].classList.remove("autocomplete-active");
                        }
                      }
                      function closeAllLists(elmnt) {
                        /*close all autocomplete lists in the document,
                        except the one passed as an argument:*/
                        var x = document.getElementsByClassName("autocomplete-items");
                        for (var i = 0; i < x.length; i++) {
                          if (elmnt != x[i] && elmnt != inp) {
                            x[i].parentNode.removeChild(x[i]);
                          }
                        }
                      }
                      /*execute a function when someone clicks in the document:*/
                      document.addEventListener("click", function (e) {
                          closeAllLists(e.target);
                      });
                    }

                    /*An array containing all the country names in the world:*/


                    /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
                    autocomplete(document.getElementById("hod"), jArray);
                   

 </script>
  
    
    
<p align="left">Involved Contractor Name</p>
  
     
   
      <div class="autocomplete" style="width:100%;" >
        <input id="contractor"  class="w3-input w3-border" type="text" name="contractor" >
      </div>
 

          <?php
             $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "jsw1";
                $contractor=[];
            // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 

                $sql = "SELECT distinct CONTRACTOR_NAME FROM safety_mstr_contractor";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                                array_push($contractor,$row["CONTRACTOR_NAME"]);
                    }
                }             
                $conn->close();         
    ?>
    
    <script >

    var jArray = <?php echo json_encode($contractor); ?>;

                    function autocomplete(inp, arr) {
                      /*the autocomplete function takes two arguments,
                      the text field element and an array of possible autocompleted values:*/
                      var currentFocus;
                      /*execute a function when someone writes in the text field:*/
                      inp.addEventListener("input", function(e) {
                          var a, b, i, val = this.value;
                          /*close any already open lists of autocompleted values*/
                          closeAllLists();
                          if (!val) { return false;}
                          currentFocus = -1;
                          /*create a DIV element that will contain the items (values):*/
                          a = document.createElement("DIV");
                          a.setAttribute("id", this.id + "autocomplete-list");
                          a.setAttribute("class", "autocomplete-items");
                          /*append the DIV element as a child of the autocomplete container:*/
                          this.parentNode.appendChild(a);
                          /*for each item in the array...*/
                          for (i = 0; i < arr.length; i++) {
                            /*check if the item starts with the same letters as the text field value:*/
                            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                              /*create a DIV element for each matching element:*/
                              b = document.createElement("DIV");
                              /*make the matching letters bold:*/
                              b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                              b.innerHTML += arr[i].substr(val.length);
                              /*insert a input field that will hold the current array item's value:*/
                              b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                              /*execute a function when someone clicks on the item value (DIV element):*/
                              b.addEventListener("click", function(e) {
                                  /*insert the value for the autocomplete text field:*/
                                  inp.value = this.getElementsByTagName("input")[0].value;
                                  /*close the list of autocompleted values,
                                  (or any other open lists of autocompleted values:*/
                                  closeAllLists();
                                  arr=[];
                              });
                              a.appendChild(b);
                            }
                          }
                      });
                      /*execute a function presses a key on the keyboard:*/
                      inp.addEventListener("keydown", function(e) {
                          var x = document.getElementById(this.id + "autocomplete-list");
                          if (x) x = x.getElementsByTagName("div");
                          if (e.keyCode == 40) {
                            /*If the arrow DOWN key is pressed,
                            increase the currentFocus variable:*/
                            currentFocus++;
                            /*and and make the current item more visible:*/
                            addActive(x);
                          } else if (e.keyCode == 38) { //up
                            /*If the arrow UP key is pressed,
                            decrease the currentFocus variable:*/
                            currentFocus--;
                            /*and and make the current item more visible:*/
                            addActive(x);
                          } else if (e.keyCode == 13) {
                            /*If the ENTER key is pressed, prevent the form from being submitted,*/
                            e.preventDefault();
                            if (currentFocus > -1) {
                              /*and simulate a click on the "active" item:*/
                              if (x) x[currentFocus].click();
                            }
                          }
                      });
                      function addActive(x) {
                        /*a function to classify an item as "active":*/
                        if (!x) return false;
                        /*start by removing the "active" class on all items:*/
                        removeActive(x);
                        if (currentFocus >= x.length) currentFocus = 0;
                        if (currentFocus < 0) currentFocus = (x.length - 1);
                        /*add class "autocomplete-active":*/
                        x[currentFocus].classList.add("autocomplete-active");
                      }
                      function removeActive(x) {
                        /*a function to remove the "active" class from all autocomplete items:*/
                        for (var i = 0; i < x.length; i++) {
                          x[i].classList.remove("autocomplete-active");
                        }
                      }
                      function closeAllLists(elmnt) {
                        /*close all autocomplete lists in the document,
                        except the one passed as an argument:*/
                        var x = document.getElementsByClassName("autocomplete-items");
                        for (var i = 0; i < x.length; i++) {
                          if (elmnt != x[i] && elmnt != inp) {
                            x[i].parentNode.removeChild(x[i]);
                          }
                        }
                      }
                      /*execute a function when someone clicks in the document:*/
                      document.addEventListener("click", function (e) {
                          closeAllLists(e.target);
                      });
                    }

                    /*An array containing all the country names in the world:*/


                    /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
                    autocomplete(document.getElementById("contractor"), jArray);
                   

 </script>
       
       
       
       
       
       
        <p align="left">Unsafe Act / Condition</p>
      <p>
     
            <select class="w3-input w3-border" name="aoc">
                <option value="Unsafe Act">Unsafe Act</option>
                <option value="Unsafe Condition">Unsafe Condition</option>
            </select>
    </p>
      
        

      <p align="left">Category Of Violation</p>
      <p>
     
      <select class="w3-input w3-border" name="cov" id="cov">
          <option value="WAH">WAH</option>
          <option value="CSE">CSE</option>
          <option value="PTW">PTW</option>
          <option value="Procedures">Procedures</option>
          <option value="PPE">PPE</option>
          <option value="Gas Cutting">Gas Cutting</option>
          <option value="Vehicle">Vehicle</option>
          <option value="LHM">LHM</option>
          <option value="Risk Assessment">Risk Assessment</option>
          <option value="LOTO">LOTO</option>
          <option value="Fire Extenguisher">Fire Extinguisher</option>
          <option value="Welding">Welding</option>
          <option value="ESS">ESS</option>
          <option value="Scaffolding">Scaffolding</option>
          <option value="Grinding">Grinding</option>
          <option value="Lifting tools and tackles">Lifting Tools and Tackles</option>
          <option value="MG">MG</option>
          <option value="Gassing and Asphyxiation">Gassing and Asphyxiation</option>
          <option value="Road Safety">Road Safety</option>
          <option value="Fall of object">Fall of Object</option>
          <option value="Conveyor">Conveyor</option>
          <option value="Others">Others</option>
    </select>
    </p>
      
      <p align="left">Type Of Observation</p>
      <p>
     
            <select class="w3-input w3-border" name="notice">
              <optgroup label="Safety Observation">
                <option value="Major Safety Observation">Major Safety Observation</option>
                <option value="Minor Safety Observation">Minor Safety Observation</option>
              </optgroup>
            <optgroup label="Fire Prevention">
                <option value="Fire Prevention">Fire Prevention</option>
              </optgroup>
              <optgroup label="Notice">
                <option value="Yellow Notice">Yellow Notice</option>
                <option value="Red Notice">Red Notice</option>
              </optgroup>
              <optgroup label="Inspection">
                <option value="Welding Inspection">Welding Inspection</option>
                <option value="Gas Cutting Inspection">Gas Cutting Inspection</option>
                <option value="Lifting Tools and Tackles Inspection">Lifting Tools and Tackles Inspection</option>
                <option value="Vehicle Inspection">Vehile Inspection</option>
                <option value="Crane Inspection">Crane Inspection</option>
                <option value="Fixed co detectors Inspection">Fixed Co-Detectors Inspection</option>
                <option value="Smoke Detectors Inspection">Smoke Detectors Inspection</option>
                <option value="Gas Holders Inspection">Gas Holders Inspection</option>
                <option value="Seal Pots Inspection">Seal Pots Inspection</option>
                <option value="Loco, Stacker and Reclaimer Inspection">Loco, Stacker and Reclaimer Inspection</option>
                <option value="Canteen Inspection">Canteen Inspection</option>
                <option value="Pressure Vessel Inspection">Pressure Vessel Inspection</option>
                <option value="Cable tunnel and Oil Cellars Inspection">Cable tunnel and Oil Cellars Inspection</option>
              </optgroup>
            </select>
    </p>
          
      <p align="left">Upload Photo</p>
      <p><input class="w3-input w3-border"  type="file" accept="image/*" name="picture" id="picture" ></p>
    
      <button type="submit" class="w3-button w3-teal w3-right" name="recordsubmit">Submit</button>
    </form>
    </div>
  </div>
</div>













<!-- Second Grid: Work & Resume -->
<div class="w3-row">
  <div class="w3-half w3-light-grey w3-center"  style="min-height:800px">
   <div class="w3-padding-64 w3-center" id="download">
   <div class="w3-container w3-responsive">

      <h1 style="text-align:left;">Download Reports By DIC</h1>
<br>
 <form name="myForm" action="download_dic.php"  method="post" class="w3-container w3-card w3-padding-32 w3-white" onsubmit="return download1();">
       <p align="left">From:</p>
      <p><input class="w3-input w3-border" type="date" placeholder="Date" name="from" id="from1">
      </p> 
      <p align="left">To:</p>
      <p><input class="w3-input w3-border" type="date" placeholder="Date" name="to" id="to1">
      </p> 
      <p align="left">Select Report Status</p>
      <p>
     
      <select class="w3-input w3-border" name="srs" id="srs">
          <option value="open">OPEN Reports</option>
          <option value="closed">CLOSED Reports</option>
          <option value="all">ALL Reports</option>
    </select>
    </p>
        <!-- DIC  -->
    
        <p align="left">DIC</p>
  
     
        
    <?php
        
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "jsw1";
                    
                    $dep;
                    echo "<select class='w3-input w3-border' name='dic1' id='dic1'>";
            // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 

                $sql2 = "SELECT DISTINCT d2.DIVISION_NAME FROM safety_mstr_departments d, safety_mstr_divisions d2, safety_mstr_company c, safety_mstr_divi_dept_map d1 WHERE d.PLANT_LOCATION_ID=c.LOCATION_ID and d.DEPART_ID=d1.DEPARTMENT_ID AND d1.DIVISION_ID=d2.DIVISION_ID and c.COMPANY_ID=1 and c.LOCATION_ID=2 and d2.REC_STATUS='ACTIVE'";
                $result2 = $conn->query($sql2);
        
                if ($result2->num_rows > 0) {
                    // output data of each row
                    while($row2 = $result2->fetch_assoc()) {
                               echo "<option id='dic1' >" . $row2['DIVISION_NAME'] .  "</option>";
                    }
                    echo "<option id='dic1' value='All DIC' >All DIC</option>";
                } 
            
                $conn->close();  
            echo "<script type='text/javascript'>
                $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
          
            </script>";
            echo "</select>";    
    ?>       
     <button type="submit" class="w3-button w3-teal w3-right">Download</button>
    </form>
       <h2 style="text-align:left;">Download Report by Employee Name</h2>
        <form name="myForm" action="downloadEmployee.php" method="post" class="w3-container w3-card w3-padding-32 w3-white" onsubmit="return download2();">
              <p align="left">Employee Name</p>
  

     
      <div class="autocomplete" style="width:100%;" >
        <input id="employee"  class="w3-input w3-border" type="text" name="employee" placeholder="Name" >
      </div> 
     
           <button type="submit" class="w3-button w3-teal w3-right" >Download</button>
           
      </form>
  </div> 
      </div> 
    </div>
    
    <script >
        function download2()
        {
            var employee=document.getElementById("employee").value;
            if( employee=="") {
                    alert("Please Enter Employee Name");
                    return false;
                }
        }
    var jArray = <?php echo json_encode($manager); ?>;

                    function autocomplete(inp, arr) {
                      /*the autocomplete function takes two arguments,
                      the text field element and an array of possible autocompleted values:*/
                      var currentFocus;
                      /*execute a function when someone writes in the text field:*/
                      inp.addEventListener("input", function(e) {
                          var a, b, i, val = this.value;
                          /*close any already open lists of autocompleted values*/
                          closeAllLists();
                          if (!val) { return false;}
                          currentFocus = -1;
                          /*create a DIV element that will contain the items (values):*/
                          a = document.createElement("DIV");
                          a.setAttribute("id", this.id + "autocomplete-list");
                          a.setAttribute("class", "autocomplete-items");
                          /*append the DIV element as a child of the autocomplete container:*/
                          this.parentNode.appendChild(a);
                          /*for each item in the array...*/
                          for (i = 0; i < arr.length; i++) {
                            /*check if the item starts with the same letters as the text field value:*/
                            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                              /*create a DIV element for each matching element:*/
                              b = document.createElement("DIV");
                              /*make the matching letters bold:*/
                              b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                              b.innerHTML += arr[i].substr(val.length);
                              /*insert a input field that will hold the current array item's value:*/
                              b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                              /*execute a function when someone clicks on the item value (DIV element):*/
                              b.addEventListener("click", function(e) {
                                  /*insert the value for the autocomplete text field:*/
                                  inp.value = this.getElementsByTagName("input")[0].value;
                                  /*close the list of autocompleted values,
                                  (or any other open lists of autocompleted values:*/
                                  closeAllLists();
                                  arr=[];
                              });
                              a.appendChild(b);
                            }
                          }
                      });
                      /*execute a function presses a key on the keyboard:*/
                      inp.addEventListener("keydown", function(e) {
                          var x = document.getElementById(this.id + "autocomplete-list");
                          if (x) x = x.getElementsByTagName("div");
                          if (e.keyCode == 40) {
                            /*If the arrow DOWN key is pressed,
                            increase the currentFocus variable:*/
                            currentFocus++;
                            /*and and make the current item more visible:*/
                            addActive(x);
                          } else if (e.keyCode == 38) { //up
                            /*If the arrow UP key is pressed,
                            decrease the currentFocus variable:*/
                            currentFocus--;
                            /*and and make the current item more visible:*/
                            addActive(x);
                          } else if (e.keyCode == 13) {
                            /*If the ENTER key is pressed, prevent the form from being submitted,*/
                            e.preventDefault();
                            if (currentFocus > -1) {
                              /*and simulate a click on the "active" item:*/
                              if (x) x[currentFocus].click();
                            }
                          }
                      });
                      function addActive(x) {
                        /*a function to classify an item as "active":*/
                        if (!x) return false;
                        /*start by removing the "active" class on all items:*/
                        removeActive(x);
                        if (currentFocus >= x.length) currentFocus = 0;
                        if (currentFocus < 0) currentFocus = (x.length - 1);
                        /*add class "autocomplete-active":*/
                        x[currentFocus].classList.add("autocomplete-active");
                      }
                      function removeActive(x) {
                        /*a function to remove the "active" class from all autocomplete items:*/
                        for (var i = 0; i < x.length; i++) {
                          x[i].classList.remove("autocomplete-active");
                        }
                      }
                      function closeAllLists(elmnt) {
                        /*close all autocomplete lists in the document,
                        except the one passed as an argument:*/
                        var x = document.getElementsByClassName("autocomplete-items");
                        for (var i = 0; i < x.length; i++) {
                          if (elmnt != x[i] && elmnt != inp) {
                            x[i].parentNode.removeChild(x[i]);
                          }
                        }
                      }
                      /*execute a function when someone clicks in the document:*/
                      document.addEventListener("click", function (e) {
                          closeAllLists(e.target);
                      });
                    }

                    /*An array containing all the country names in the world:*/


                    /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
                    autocomplete(document.getElementById("employee"), jArray);
                   

 </script>
    
    
  
  
  
  
  
  
  
  
  
  
  
  <div class="w3-half w3-indigo w3-container" style="min-height:800px">
    <div class="w3-padding-64 w3-center" id="download1">
   
      <div class="w3-container w3-responsive">
      
            <h1 style="text-align:left;">Download Reports By Department</h1>
<br>
 <form name="myForm" action="download_dept.php"  method="post" class="w3-container w3-card w3-padding-32 w3-white" onsubmit="return download();">
       <p align="left">From:</p>
      <p><input class="w3-input w3-border" type="date" placeholder="Date" name="from1" id="date" id="date">
      </p> 
      <p align="left">To:</p>
      <p><input class="w3-input w3-border" type="date" placeholder="Date" name="to1" id="date" id="date">
      </p> 
      <p align="left">Select Report Status</p>
      <p>
     
      <select class="w3-input w3-border" name="srs1" id="srs">
          <option value="open">OPEN Reports</option>
          <option value="closed">CLOSED Reports</option>
          <option value="all">ALL Reports</option>
    </select>
    </p>
        <!-- DIC  -->
    

  
     
        
          <p align="left">Department</p>
  
     
        
    <?php
        
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "jsw1";
                    
                    $dep;
                    echo "<select class='w3-input w3-border' name='dept1' id='dept1'>";
            // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 

                $sql1 = "SELECT d.DEPT_NAME, d2.DIVISION_NAME FROM safety_mstr_departments d, safety_mstr_divisions d2, safety_mstr_company c,                     safety_mstr_divi_dept_map d1
                        WHERE d.PLANT_LOCATION_ID=c.LOCATION_ID and d.DEPART_ID=d1.DEPARTMENT_ID AND
                        d1.DIVISION_ID=d2.DIVISION_ID and c.COMPANY_ID=1;";
                $result1 = $conn->query($sql1);
        
                if ($result1->num_rows > 0) {
                    // output data of each row
                    while($row1 = $result1->fetch_assoc()) {
                               echo "<option id='dept1' >" . $row1['DEPT_NAME'] .  "</option>";
                    }
                } 
            
                $conn->close();  
            echo "<script type='text/javascript'>
                $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
          
            </script>";
            echo "</select>";    
    ?>       
     
     <button type="submit" class="w3-button w3-teal w3-right">Download</button>
    </form>
      <h2 style="text-align:left;">Check Particular Observation</h2>
     <form name="myForm" action="uniqueReport.php" method="post" class="w3-container w3-card w3-padding-32 w3-white">
             <p align="left">Enter Unique Observation Number</p>
      <input class="w3-input w3-border" type="text"  name="uid" id="uid" >
     
           <button type="submit" class="w3-button w3-teal w3-right">Submit</button>
           
      </form>
      </div>
    </div>
   
  </div>
  <script>
     function download()
        {
            var from=document.getElementById("from").value;
            if( from=="") {
                    alert("Please Select Date");
                    return false;
                }
        var to=document.getElementById("to").value;
            if( to=="") {
                    alert("Please Select Date");
                    return false;
                }
            
            return true;
        }
      
       function download1()
        {
            var from1=document.getElementById("from1").value;
            if( from1=="") {
                    alert("Please Select Date");
                    return false;
                }
        var to1=document.getElementById("to1").value;
            if( to1=="") {
                    alert("Please Select Date");
                    return false;
                }
            
            return true;
        }
    </script>
  
  
</div>


<!-- Footer -->
<footer class="w3-container w3-black w3-padding-16">

</footer>
</body>
</html>