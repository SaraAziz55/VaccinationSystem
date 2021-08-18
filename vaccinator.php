<!DOCTYPE html>
<?php 
include('func1.php');
$con=mysqli_connect("localhost","root","","vaxinn");
$vaccinator = $_SESSION['vname'];
?>
<html lang="en">
  <head>
  <title>Vaxinn</title>
   <link rel="icon" href="vv.jpg" type="image/icon type">
<link rel="stylesheet" href="style.css"> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js" integrity="sha512-YSdqvJoZr83hj76AIVdOcvLWYMWzy6sJyIMic2aQz5kh2bPTd9dzY3NtdeEAzPp/PhgZqr4aJObB3ym/vsItMg==" crossorigin="anonymous"></script>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <style >
      .btn-outline-light:hover{
        color: #25bef7;
        background-color: #f8f9fa;
        border-color: #f8f9fa;
      }
   
.list-group-item.active {
    z-index: 2;
    color: #fff;
    background-color: #1C175A;
    
}
.text-primary {
    color: #342ac1!important;
}
  </style>
</head>
  <body style="padding-top:50px;background-color:#F0F8FF;">
     <div class="top-bar">
            <div class="container">
                <nav class="navbar  navbar-dark navbar-expand-sm fixed-top">
                    <a href="#" class="navbar-brand"><i class="fas fa-syringe"></i> VAXINN</a>
                    <div id="main-menu" class="collapse navbar-collapse">
                        <ul class="navbar-nav w-100 justify-content-end">
                           
							<li class="nav-item">
                                <a class="nav-link" href="logout.php"><i class="fas fa-sign-in-alt"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            
        </div>
   <div class="container-fluid" style="padding-top:50px;">
    <h3 style = "margin-left: 35%; padding-bottom: 20px;font-family:'IBM Plex Sans', sans-serif;color:#0062cc;font-weight:bolder;"> Welcome <?php echo $_SESSION['vname'] ?>  !!</h3>
    <div class="row">
 
  <div class="col-md-12" style="margin-top: 3%;color:yellow;">
    <table class="table table-hover table-bordered" style="background-color:white;">
                <thead>
                <tr style="background-color:#1C175A;color:white;"> 
                    <th scope="col">Patient ID</th>
                    <th scope="col">Appointment ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
					<th scope="col">Age</th>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Appointment Time</th>

                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $con=mysqli_connect("localhost","root","","vaxinn");
                    global $con;
                    $vname = $_SESSION['vname'];
                    $query = "select pid,ID,fname,lname,gender,email,contact,age,appdate,apptime from appointmenttb where vaccinator='$vname';";
                    $result = mysqli_query($con,$query);
                    while ($row = mysqli_fetch_array($result)){
                     

					 $pid = $row['pid'];
                      $ID = $row['ID'];
                      $fname = $row['fname'];
                      $lname = $row['lname'];
                      $gender = $row['gender'];
                      $email = $row['email'];
					  $contact = $row['contact'];
					  $age = $row['age'];
					  $appdate = $row['appdate'];
					  $apptime = $row['apptime'];
                      echo " <tr> 
                        <td>$pid</td>
                        <td>$ID</td>
                        <td>$fname</td>
                        <td>$lname</td>
                        <td>$gender</td>
						<td>$email</td>
						<td>$contact</td>
						<td>$age</td>
						<td>$appdate</td>
						<td>$apptime</td>
                      </tr>";
                    }

                  ?>
                      
                </tbody>
     </table>
        <br>
 
    </div>
  </div>
</div>
   </div>
   
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
   </body>
</html>