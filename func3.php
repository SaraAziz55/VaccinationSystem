<?php
session_start();
$con=mysqli_connect("localhost","root","","vaxinn");
if(isset($_POST['adsub'])){
	$username=$_POST['username1'];
	$password=$_POST['password2'];
	$query="select * from admintb where username='$username' and password='$password';";
	$result=mysqli_query($con,$query);
	if(mysqli_num_rows($result)==1)
	{
		$_SESSION['username']=$username;
		header("Location:admin-panel.php");
	}
	else
		echo("<script>alert('Invalid Username or Password. Try Again!');
          window.location.href = 'index.html';</script>");
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