 <!DOCTYPE html>
<?php 
$con=mysqli_connect("localhost","root","","vaxinn");
include('newfunc.php');
if(isset($_POST['vacadd']))
{
  $vaccinator=$_POST['vaccinator'];
  $vpassword=$_POST['vpassword'];
  $vemail=$_POST['vemail'];
  $vaccine=$_POST['vaccines'];
  $fees=$_POST['fees'];
  $query="insert into vactb(vaccinator,password,email,vaccine,fees)values('$vaccinator','$vpassword','$vemail','$vaccine','$fees')";
  $result=mysqli_query($con,$query);
  if($result)
    {
      echo "<script>alert('Vaccinator added successfully!');</script>";
  }
  else{
  echo "<script>alert('Vaccinator already exists!');</script>";
  }
}
if(isset($_POST['vacdel']))
{
  $vemail=$_POST['vemail'];
  $query="delete from vactb where email='$vemail';";
  $result=mysqli_query($con,$query);
  if($result)
    {
      echo "<script>alert('Vaccinator removed successfully!');</script>";
  }
  else{
    echo "<script>alert('Unable to delete!');</script>";
  }
}
?>
<html lang="en">
  <head>
   <title>Vaxinn</title>
   <link rel="icon" href="vv.jpg" type="image/icon type">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js" integrity="sha512-YSdqvJoZr83hj76AIVdOcvLWYMWzy6sJyIMic2aQz5kh2bPTd9dzY3NtdeEAzPp/PhgZqr4aJObB3ym/vsItMg==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="style.css"> 
  <script >
    var check = function() {
  if (document.getElementById('vpassword').value ==
    document.getElementById('cvpassword').value) {
    document.getElementById('message').style.color = '#5dd05d';
    document.getElementById('message').innerHTML = 'Matched';
  } else {
    document.getElementById('message').style.color = '#f55252';
    document.getElementById('message').innerHTML = 'Not Matching';
  }
}
  </script>

  <style >
  

.col-md-4{
  max-width:20% !important;
}

.list-group-item.active {
    z-index: 2;
    color: #fff;
    background-color: #1C175A;
    border-color: #007bff;
}
.text-primary {
    color: #342ac1!important;
}

#cpass {
  display: -webkit-box;
}

#list-app{
  font-size:15px;
}

.btn{
  background-color: #1C175A;
  color:#fff;
}
  </style>

  
  </head>
  <style type="text/css">
    button:hover{cursor:pointer;}
    #inputbtn:hover{cursor:pointer;}
  </style>
  <body style="padding-top:50px;background-color:#F0F8FF;">
  <div class="top-bar">
            <div class="container">
                <nav class="navbar  navbar-dark navbar-expand-sm fixed-top">
                    <a href="#" class="navbar-brand"><i class="fas fa-syringe"></i> VAXINN</a>
                    <div id="main-menu" class="collapse navbar-collapse">
                        <ul class="navbar-nav w-100 justify-content-end">
                           
							<li class="nav-item">
                                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            
        </div>
   <div class="container-fluid" style="padding-top:50px;color:#1C175A;">
    <h3 style = "margin-left: 40%; padding-bottom: 20px;font-family: 'IBM Plex Sans', sans-serif;color:#0062cc;font-weight:bolder;"> WELCOME ADMIN!! </h3>
    <div class="row">
  <div class="col-md-4" style="max-width:25%;margin-top: 3%;">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="list-dash-list" data-toggle="list" href="#list-dash" role="tab" aria-controls="home">Dashboard</a>
      <a class="list-group-item list-group-item-action" href="#list-doc" id="list-doc-list"  role="tab"    aria-controls="home" data-toggle="list">Vaccinator List</a>
      <a class="list-group-item list-group-item-action" href="#list-pat" id="list-pat-list"  role="tab" data-toggle="list" aria-controls="home">Patient List</a>
      <a class="list-group-item list-group-item-action" href="#list-app" id="list-app-list"  role="tab" data-toggle="list" aria-controls="home">Appointment Details</a>
	 
      <a class="list-group-item list-group-item-action" href="#list-settings" id="list-avac-list"  role="tab" data-toggle="list" aria-controls="home">Add Vaccinator</a>
      <a class="list-group-item list-group-item-action" href="#list-settings1" id="list-dvac-list"  role="tab" data-toggle="list" aria-controls="home">Delete Vaccinator</a>
      <a class="list-group-item list-group-item-action" href="#list-mes" id="list-mes-list"  role="tab" data-toggle="list" aria-controls="home">Feedback</a>
      
    </div><br>
  </div>
  <div class="col-md-8" style="margin-top: 3%;">
    <div class="tab-content" id="nav-tabContent" style="width: 950px;">



      <div class="tab-pane fade show active" id="list-dash" role="tabpanel" aria-labelledby="list-dash-list">
        <div class="container-fluid container-fullw" style="background-color:#F0F8FF;" >
              <div class="row">
               <div class="col-sm-4">
                  <div class="panel no-radius text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"><i class="fas fa-user-md" style="color: #1C175A;"></i>
 </span>
                      <h4 class="StepTitle" style="margin-top: 5%;">Vaccinator List</h4>
                      <script>
                        function clickDiv(id) {
                          document.querySelector(id).click();
                        }
                      </script> 
                      <p class="links cl-effect-1">
                        <a href="#list-doc" onclick="clickDiv('#list-doc-list')">
                          View Vaccinators
                        </a>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-sm-4" style="left: -3%">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body" >
                      <span class="fa-stack fa-2x"><i class="fa fa-users fa-stack-1x fa-inverse" style="color: #1C175A;"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 5%;">Patient List</h4>
                     <script>
                        function clickDiv(id) {
                          document.querySelector(id).click();
                        }
                      </script> 
                      <p class="cl-effect-1">
                        <a href="#app-hist" onclick="clickDiv('#list-pat-list')">
                          View Patients
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
              

                <div class="col-sm-4">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body" >
                      
<span class="fa-stack fa-2x"><i class="fas fa-notes-medical" style="color: #1C175A;"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 5%;">Appointment Details</h4>
                    
                      <p class="cl-effect-1">
                        <a href="#app-hist" onclick="clickDiv('#list-app-list')">
                          View Appointments
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
                </div>
 <div class="row">
                <div class="col-sm-4" style="left: 13%;margin-top: 5%;">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body" >
                         <span class="fa-stack fa-2x"><i class="fas fa-clinic-medical" style="color: #1C175A;"></i>
 </span>
                      <h4 class="StepTitle" style="margin-top: 5%;"> Delete Vaccinators</h4>
                    
                      <p class="cl-effect-1">
                        <a href="#app-hist" onclick="clickDiv('#list-dvac-list')">
                          Delete Vaccinators
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
                

                <div class="col-sm-4" style="left: 18%;margin-top: 5%">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body" >
                     
 <span class="fa-stack fa-2x">
<i class="fas fa-hospital" style="color: #1C175A;"></i>
 </span>
                      <h4 class="StepTitle" style="margin-top: 5%;">Add Vaccinators</h4>
                    
                      <p class="cl-effect-1">
                        <a href="#app-hist" onclick="clickDiv('#list-avac-list')">Add Vaccinators</a>
                       
                       
                      </p>
                    </div>
                  </div>
                </div>
                </div>
               
              </div>
            </div>
      
      <div class="tab-pane fade" id="list-doc" role="tabpanel" aria-labelledby="list-home-list">
              

              
              <table class="table table-hover table-bordered" style="background-color:white;">
                <thead>
                  <tr style="background-color:#7ECCC5;color:white;"> 
                    <th scope="col">Vaccinator Name</th>
                    <th scope="col">Vaccine</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Fees</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $con=mysqli_connect("localhost","root","","vaxinn");
                    global $con;
                    $query = "select * from vactb";
                    $result = mysqli_query($con,$query);
                    while ($row = mysqli_fetch_array($result)){
                      $vaccinator = $row['vaccinator'];
                      $vaccine = $row['vaccine'];
                      $vemail = $row['email'];
                      $vpassword = $row['password'];
                      $fees = $row['fees'];
                      
                      echo "<tr>
                        <td>$vaccinator</td>
                        <td>$vaccine</td>
                        <td>$vemail</td>
                        <td>$vpassword</td>
                        <td>$fees</td>
                      </tr>";
                    }

                  ?>
                </tbody>
              </table>
        <br>
      </div>
    

    <div class="tab-pane fade" id="list-pat" role="tabpanel" aria-labelledby="list-pat-list">
<table class="table table-hover table-bordered" style="background-color:white;">
                <thead>
                  <tr style="background-color:#7ECCC5;color:white;"> 
                  <th scope="col">Patient ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Age</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $con=mysqli_connect("localhost","root","","vaxinn");
                    global $con;
                    $query = "select * from patreg";
                    $result = mysqli_query($con,$query);
                    while ($row = mysqli_fetch_array($result)){
                      $pid = $row['pid'];
                      $fname = $row['fname'];
                      $lname = $row['lname'];
                      $gender = $row['gender'];
                      $email = $row['email'];
                      $contact = $row['contact'];
                      $age=$row['age'];
                      
                      echo "<tr>
                        <td>$pid</td>
                        <td>$fname</td>
                        <td>$lname</td>
                        <td>$gender</td>
                        <td>$email</td>
                        <td>$contact</td>
						<td>$age</td>
                      </tr>";
                    }

                  ?>
                </tbody>
              </table>
        <br>
      </div>
<div class="tab-pane fade" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">...</div>



      <div class="tab-pane fade" id="list-app" role="tabpanel" aria-labelledby="list-pat-list">

        
              <table class="table table-hover table-bordered" style="background-color:white;">
                <thead>
                  <tr style="background-color:#7ECCC5;color:white;"> 
                  <th scope="col">AID</th>
                  <th scope="col">PID</th>
                    <th scope="col"> Name</th>
                    
                    <th scope="col">Gender</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
					<th scope="col">Age</th>
                    <th scope="col">Vaccinator</th>
                    
                    <th scope="col">ADate</th>
                    <th scope="col">ATime</th>
               
                  </tr>
                </thead>
                <tbody>
                  <?php 

                    $con=mysqli_connect("localhost","root","","vaxinn");
                    global $con;

                    $query = "select * from appointmenttb;";
                    $result = mysqli_query($con,$query);
                    while ($row = mysqli_fetch_array($result)){
						
                      $ID = $row['ID'];
					  $pid = $row['pid'];
                      $fname = $row['fname'];
                      $lname = $row['lname'];
					  $gender= $row['gender'];
					  $email = $row['email'];
					  $contact = $row['contact'];
					  $age=$row['age'];
					  $vaccinator = $row['vaccinator'];
					  
                      $appdate = $row['appdate'];
                      $apptime = $row['apptime'];
					  
					  
					  echo "<tr>
                        <td>$ID</td>
                        <td>$pid</td>
                        
                        <td>$fname $lname</td>
                        
						<td>$gender</td>
						<td>$email</td>
						<td>$contact</td>
						<td>$age</td>
						<td>$vaccinator</td>
						
                        <td>$appdate</td>
                        <td>$apptime</td>
                        
                      </tr>";
					}
                  ?>
                      
                </tbody>
              </table>
        <br>
      </div>




      <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
        <form class="form-group" method="post" action="admin-panel.php">
          <div class="row">
                  <div class="col-md-4"><label>Vaccinator Name:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="vaccinator" required/></div><br><br>
                  <div class="col-md-4"><label>Vaccine:</label></div>
                  <div class="col-md-8">
                   <select name="vaccines" class="form-control" id="special" required="required">
                      <option value="head" name="vaccine" disabled selected>Select Vaccine</option>
                      <option value="Covaxin" name="vaccine">Covaxin</option>
                      <option value="Covishield" name="vaccine">Covishield</option>
                      
                    </select>
                    </div><br><br>
                  <div class="col-md-4"><label>Email ID:</label></div>
                  <div class="col-md-8"><input type="email"  class="form-control" name="vemail" required></div><br><br>
                  <div class="col-md-4"><label>Password:</label></div>
                  <div class="col-md-8"><input type="password" class="form-control"  onkeyup='check();' name="vpassword" id="vpassword"  required></div><br><br>
                  <div class="col-md-4"><label>Confirm Password:</label></div>
                  <div class="col-md-8"  id='cpass'><input type="password" class="form-control" onkeyup='check();' name="cvpassword" id="cvpassword" required>&nbsp &nbsp <span id='message'></span> </div><br><br>
                   
                  
                  <div class="col-md-4"><label>Fees:</label></div>
                  <div class="col-md-8"><input type="text" class="form-control"  name="fees" required></div><br><br>
                </div>
          <input type="submit" name="vacadd" value="Add Vaccinator" class="btn">
        </form>
      </div>

      <div class="tab-pane fade" id="list-settings1" role="tabpanel" aria-labelledby="list-settings1-list">
        <form class="form-group" method="post" action="admin-panel.php">
          <div class="row">
          
                  <div class="col-md-4"><label>Email ID:</label></div>
                  <div class="col-md-8"><input type="email"  class="form-control" name="vemail" required/></div><br><br>
                  
                </div>
          <input type="submit" name="vacdel" value="Delete Vaccinator" class="btn" onclick="confirm('do you really want to delete?')">
        </form>
      </div>
       <div class="tab-pane fade" id="list-mes" role="tabpanel" aria-labelledby="list-mes-list">
  <table class="table table-hover table-bordered" style="background-color:white;">
                <thead>
                 <tr style="background-color:#7ECCC5;color:white;"> 
                    <th scope="col">User Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Comments</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 

                    $con=mysqli_connect("localhost","root","","vaxinn");
                    global $con;

                    $query = "select * from contact;";
                    $result = mysqli_query($con,$query);
                    while ($row = mysqli_fetch_array($result)){
                  ?>
                      <tr>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['contact'];?></td>
                        <td><?php echo $row['message'];?></td>
                      </tr>
                    <?php } ?>
                </tbody>
              </table>
        <br>
      </div>
 </div>
  </div>
</div>
   </div>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>