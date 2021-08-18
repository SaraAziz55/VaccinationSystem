<!DOCTYPE html>
<?php 
include('func.php');  
include('newfunc.php');
$con=mysqli_connect("localhost","root","","vaxinn");


  $pid = $_SESSION['pid'];
  $username = $_SESSION['username'];
  $email = $_SESSION['email'];
  $fname = $_SESSION['fname'];
  $gender = $_SESSION['gender'];
  $lname = $_SESSION['lname'];
  $contact = $_SESSION['contact'];
  $age=$_SESSION['age'];
if(isset($_POST['app-submit']))
{
  $pid = $_SESSION['pid'];
  $username = $_SESSION['username'];
  $email = $_SESSION['email'];
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];
  $gender = $_SESSION['gender'];
  $contact = $_SESSION['contact'];
  $age=$_SESSION['age'];
  $vaccinator=$_POST['vaccinator'];
 
  $email=$_SESSION['email'];
  

  $appdate=$_POST['appdate'];
  $apptime=$_POST['apptime'];
  $cur_date = date("Y-m-d");
  date_default_timezone_set('Asia/Kolkata');
  $cur_time = date("H:i:s"); $apptime1 = strtotime($apptime);
  $apptime1 = strtotime($apptime);
  $appdate1 = strtotime($appdate);
  
    if((date("Y-m-d",$appdate1)==$cur_date and date("H:i:s",$apptime1)>$cur_time) or date("Y-m-d",$appdate1)>$cur_date) {
      $check_query = mysqli_query($con,"select apptime from appointmenttb where vaccinator='$vaccinator' and appdate='$appdate' and apptime='$apptime'");

        if(mysqli_num_rows($check_query)==0){
          $query=mysqli_query($con,"insert into appointmenttb(pid,fname,lname,gender,email,contact,age,vaccinator,appdate,apptime,userStatus,vacStatus) values($pid,'$fname','$lname','$gender','$email','$contact','$age',
		  '$vaccinator','$appdate','$apptime','1','1')");

          if($query)
          {
            echo "<script>alert('Your appointment successfully booked');</script>";
          }
          else{
            echo "<script>alert('You have already registered!');</script>";
          }
      }
      else{
        echo "<script>alert('We are sorry to inform that the vaccinator is not available in this time or date. Please choose different time or date!');</script>";
      }
    }
    else{
      echo "<script>alert('Select a time or date in the future!');</script>";
    }
  }

function generate_bill(){
  $con=mysqli_connect("localhost","root","","vaxinn");
  $pid = $_SESSION['pid'];
  $output='';
  $query=mysqli_query($con,"select a.pid,a.ID,a.fname,a.lname,a.vaccinator,a.age,v.vaccine,a.appdate,a.apptime,v.fees from appointmenttb a inner join vactb v on a.vaccinator=v.vaccinator and a.pid = '$pid' and a.ID = '".$_GET['ID']."'");
  while($row = mysqli_fetch_array($query)){
    $output .= '
    <label style="color:maroon; font-weight:bolder;"> Patient ID : </label>'.$row["pid"].'<br/><br/>
    <label style="color:maroon; font-weight:bolder;"> Appointment ID : </label>'.$row["ID"].'<br/><br/>
    
    <label style="color:maroon; font-weight:bolder;"> Appointment Date : </label>'.$row["appdate"].'<br/><br/>
    <label style="color:maroon; font-weight:bolder;"> Appointment Time : </label>'.$row["apptime"].'<br/><br/>
    <label style="color:maroon; font-weight:bolder;"> Fees : </label>'.$row["fees"].'<br/><br/><br/><br/>
	<table border = "border">

<tr align = "center">

<th style="color:maroon; font-weight:bolder;"> Appointment ID</th>
<th style="color:maroon; font-weight:bolder;">Patient Name</th>
<th style="color:maroon; font-weight:bolder;">Age </th>
<th style="color:maroon; font-weight:bolder;">Vaccinator</th>
<th style="color:maroon; font-weight:bolder;">Vaccine</th>
</tr>
<tr align = "center">

<td style="height:50px;">'.$row["ID"].'</td>
<td rowspan="4">'.$row["fname"].' '.$row["lname"].'</td>
<td rowspan="4">'.$row["age"].'</td>
<td rowspan="4">'.$row["vaccinator"].'</td>
<td rowspan="4">'.$row["vaccine"].'</td>
</tr>
</table>
<p/><p/>


   
    ';

  }
  
  return $output;
}


if(isset($_GET["generate_bill"])){
  require_once("TCPDF/tcpdf.php");
  $obj_pdf = new TCPDF('P',PDF_UNIT,PDF_PAGE_FORMAT,true,'UTF-8',false);
  $obj_pdf -> SetCreator(PDF_CREATOR);
  $obj_pdf -> SetTitle("Generate Bill");
  $obj_pdf -> SetHeaderData('','',PDF_HEADER_TITLE,PDF_HEADER_STRING);
  $obj_pdf -> SetHeaderFont(Array(PDF_FONT_NAME_MAIN,'40',PDF_FONT_SIZE_MAIN));
  $obj_pdf -> SetFooterFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
  $obj_pdf -> SetDefaultMonospacedFont('helvetica');
  $obj_pdf -> SetFooterMargin(PDF_MARGIN_FOOTER);
  $obj_pdf -> SetMargins(PDF_MARGIN_LEFT,'5',PDF_MARGIN_RIGHT);
  
  $obj_pdf -> SetPrintHeader(false);
  $obj_pdf -> SetPrintFooter(false);
  $obj_pdf -> SetAutoPageBreak(TRUE, 10);
  $obj_pdf -> SetFont('helvetica','',12);
  $obj_pdf -> AddPage();

  $content = '';

  $content .= '
      <br/>
	  
      <h2 align ="center">VAXINN</h2></br>
      <h3 align ="center"> Bill</h3></br></br>
      

  ';
 
  $content .= generate_bill();
  $obj_pdf -> writeHTML($content);
  ob_end_clean();
  $obj_pdf -> Output("bill.pdf",'I');

}

function get_specs(){
  $con=mysqli_connect("localhost","root","","vaxinn");
  $query=mysqli_query($con,"select vaccinator,vaccine from vactb");
  $vacarray = array();
    while($row =mysqli_fetch_assoc($query))
    {
        $vacarray[] = $row;
    }
    return json_encode($vacarray);
}

?>
<html lang="en">
  <head>
<title>Vaxinn</title>
  <link rel="icon" href="vv.jpg" type="image/icon type">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js" integrity="sha512-YSdqvJoZr83hj76AIVdOcvLWYMWzy6sJyIMic2aQz5kh2bPTd9dzY3NtdeEAzPp/PhgZqr4aJObB3ym/vsItMg==" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="style.css">
  <style >
   
.list-group-item.active {
    z-index: 2;
    color: #fff;
    background-color: #1C175A;
    border-color: #007bff;
}
.text-primary {
    color: #342ac1!important;
}

.btn-primary{
  background-color:#1C175A;
  border-color: #3c50c1;
}
.btn-secodary{
 background-color:blue;
  border-color: #3c50c1;
  color:white;
  margin-left:50px;
}
  </style>
<style type="text/css">
    button:hover{cursor:pointer;}
    #inputbtn:hover{cursor:pointer;}
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
   <div class="container-fluid" style="margin-top:50px;">
    <h3 style = "margin-left: 40%;  padding-bottom: 20px; font-family: 'IBM Plex Sans', sans-serif;color:#0062cc;font-weight:600;"> Welcome <?php echo $username ?> !!
   </h3>
   <marquee style = "color:#DC143C; font-weight:bolder;font-size:18px;">NOTE: Bring valid ID,<span style="color:#1C175A;">  <?php echo $username ?> </span>when coming to vaccination center.</marquee>
    <div class="row">
  <div class="col-md-4" style="max-width:25%; margin-top: 3%">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="list-dash-list" data-toggle="list" href="#list-dash" role="tab" aria-controls="home">Dashboard</a>
	  <a class="list-group-item list-group-item-action" href="#list-doc" id="list-doc-list"  role="tab"    aria-controls="home" data-toggle="list">Vaccinator List</a>
      <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Book Appointment</a>
      <a class="list-group-item list-group-item-action" href="#app-hist" id="list-pat-list" role="tab" data-toggle="list" aria-controls="home">Appointment History</a>
      
      
    </div><br>
  </div>
  <div class="col-md-8" style="margin-top: 3%;">
    <div class="tab-content" id="nav-tabContent" style="width: 950px;">


      <div class="tab-pane fade  show active" id="list-dash" role="tabpanel" aria-labelledby="list-dash-list">
        <div class="container-fluid container-fullw " style="background-color:#F0F8FF;" >
              <div class="row">
			  <div class="col-sm-4" style="left: 3%">
                  <div class="panel panel-white no-radius text-center">
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
               <div class="col-sm-4" style="left: 3%">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">
                       <span class="fa-stack fa-2x">
<i class="fas fa-id-card-alt" style="color: #1C175A;"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 5%;"> Book My Appointment</h4>
                      <script>
                        function clickDiv(id) {
                          document.querySelector(id).click();
                        }
                      </script>                      
                      <p class="links cl-effect-1">
                        <a href="#list-home" onclick="clickDiv('#list-home-list')">
                          Book Appointment
                        </a>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-sm-4" style="left: 3%">
                  <div class="panel panel-white no-radius text-center">
                    <div class="panel-body" >
                      <span class="fa-stack fa-2x"><i class="fas fa-notes-medical" style="color: #1C175A;"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 5%;">My Appointments</h2>
                    <script>
                        function clickDiv(id) {
                          document.querySelector(id).click();
                        }
                      </script>               
                      <p class="cl-effect-1">
                        <a href="#app-hist" onclick="clickDiv('#list-pat-list')">
                          View Appointment History
                        </a>
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
                 <tr style="background-color:#87CEEB;color:white;"> 
                    <th scope="col">Vaccinator Name</th>
                    <th scope="col">Vaccine</th>
                    <th scope="col">Email</th>
                    
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
					  
                      $email = $row['email'];
                      $fees = $row['fees'];
                      
                      echo "<tr>
                        <td>$vaccinator</td>
                        <td>$vaccine</td>
                        <td>$email</td>
                        
                        <td>$fees</td>
                      </tr>";
                    }

                  ?>
                </tbody>
              </table>
        <br>
      </div>

      <div class="tab-pane fade" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body" style="background-color:#87CEEB;">
              <center><h4 style="color:white;">Create an appointment</h4></center><br>
              <form class="form-group" method="post" action="patient.php">
                <div class="row">
      

                    <div class="col-md-4">
                          <label for="spec" style="color:white;">Vaccine:</label>
                        </div>
                        <div class="col-md-8">
                          <select name="spec" class="form-control" id="spec">
                              <option value="" disabled selected>Select Vaccine</option>
                              <?php 
                              display_specs();
                              ?>
                          </select>
                        </div>

                        <br><br>
<script>
                      document.getElementById('spec').onchange = function foo() {
                        let spec = this.value;   
                        console.log(spec)
                        let docs = [...document.getElementById('vaccinator').options];
                        
                        docs.forEach((el, ind, arr)=>{
                          arr[ind].setAttribute("style","");
                          if (el.getAttribute("data-spec") != spec ) {
                            arr[ind].setAttribute("style","display: none");
                          }
                        });
                      };

                  </script>
                        

              <div class="col-md-4"><label for="vaccinator" style="color:white;">Vaccinators:</label></div>
                <div class="col-md-8">
                    <select name="vaccinator" class="form-control" id="vaccinator" required="required">
                      <option value="" disabled selected>Select Vaccinator</option>
                
                      <?php display_vacs(); ?>
                    </select>
                  </div><br/><br/> 

		


                  <div class="col-md-4" style="color:white;"><label>Appointment Date:</label></div>
                  <div class="col-md-8"><input type="date" class="form-control datepicker" name="appdate"></div><br><br>

                  <div class="col-md-4" style="color:white;"><label>Appointment Time:</label></div>
                  <div class="col-md-8">
                    
                    <select name="apptime" class="form-control" id="apptime" required="required">
                      <option value="" disabled selected>Select Time</option>
                      <option value="08:00:00">8:00 AM</option>
                      <option value="10:00:00">10:00 AM</option>
                      <option value="12:00:00">12:00 PM</option>
                      <option value="14:00:00">2:00 PM</option>
                      <option value="16:00:00">4:00 PM</option>
                    </select>

                  </div><br><br>

                  <div class="col-md-4">
                    <input type="submit" name="app-submit" value="Create new entry" class="btn btn-primary" id="inputbtn" >
                  </div>
                <div class="col-md-8"></div> 
              </form>
            </div>
          </div>
        </div><br>
      </div>
      </div>
<div class="tab-pane fade" id="app-hist" role="tabpanel" aria-labelledby="list-pat-list">
        
              <table class="table table-hover table-bordered" style="background-color:white;">
                <thead>
                    <tr style="background-color:#87CEEB;color:white;"> 
                    
                    <th scope="col">Vaccinator</th>
		
                 
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Appointment Time</th>
                    <th scope="col">Generate Bill</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 

                    $con=mysqli_connect("localhost","root","","vaxinn");
                    global $con;

                    $query = "select ID,vaccinator,appdate,apptime from appointmenttb where fname ='$fname' and lname='$lname';";
                    $result = mysqli_query($con,$query);
                    while ($row = mysqli_fetch_array($result)){
						?>
                      <tr>
                        <td><?php echo $row['vaccinator'];?></td>
		
                     
                        <td><?php echo $row['appdate'];?></td>
                        <td><?php echo $row['apptime'];?></td>
                        
                        <td>
                          <form method="get">
                              <a href="patient.php?ID=<?php echo $row['ID']?>">
                               <input type ="hidden" name="ID" value="<?php echo $row['ID']?>"/>
                              <input type = "submit" onclick="alert('Bill Generated Successfully');" name ="generate_bill" class = "btn btn-secodary" value=" Bill"/>
                              </a>
                              </td>
                              </form>

                    
                      </tr>
                    <?php }
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
