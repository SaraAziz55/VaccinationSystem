<?php
session_start();
$con=mysqli_connect("localhost","root","","vaxinn");
if(isset($_POST['vacsub1'])){
	$vname=$_POST['username3'];
	$vpass=$_POST['password3'];
	$query="select * from vactb where vaccinator='$vname' and password='$vpass';";
	$result=mysqli_query($con,$query);
	if(mysqli_num_rows($result)==1)
	{
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    
		      $_SESSION['vname']=$row['vaccinator'];
      
    }
		header("Location:vaccinator.php");
	}
	else{

    echo("<script>alert('Invalid Username or Password. Try Again!');
          window.location.href = 'index.html';</script>");
  }
}
function display_docs()
{
	global $con;
	$query="select * from vactb";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
		$name=$row['name'];
		echo '<option value="'.$name.'">'.$name.'</option>';
	}
}
?>