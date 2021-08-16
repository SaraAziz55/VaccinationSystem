<?php
session_start();
$con=mysqli_connect("localhost","root","","vaxinn");
if(isset($_POST['patsub1'])){
	$fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $gender=$_POST['gender'];
  $email=$_POST['email'];
  $contact=$_POST['contact'];
  $age=$_POST['age'];
	$password= $_POST['password'];
    $cpassword=$_POST['cpassword'];
  if($password==$cpassword){
  	$query="insert into patreg(fname,lname,gender,email,contact,age,password,cpassword) values ('$fname','$lname','$gender','$email','$contact','$age','$password','$cpassword');";
    $result=mysqli_query($con,$query);
    if($result){
        $_SESSION['username'] = $_POST['fname']." ".$_POST['lname'];
        $_SESSION['fname'] = $_POST['fname'];
        $_SESSION['lname'] = $_POST['lname'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['contact'] = $_POST['contact'];
		$_SESSION['age']=$_POST['age'];
        $_SESSION['email'] = $_POST['email'];
        header("Location:patient.php");
    } 

    $query1 = "select * from patreg;";
    $result1 = mysqli_query($con,$query1);
    if($result1){
      $_SESSION['pid'] = $row['pid'];
    }

  }
  else{
    header("Location:index.html");
  }
}

?>
