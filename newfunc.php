<?php
$con=mysqli_connect("localhost","root","","vaxinn");
if(isset($_POST['update_data']))
{
 $contact=$_POST['contact'];
 $status=$_POST['status'];
 $query="update appointmenttb set payment='$status' where contact='$contact';";
 $result=mysqli_query($con,$query);
 if($result)
  header("Location:updated.php");
}
function display_specs() {
  global $con;
  $query="select distinct(vaccine) from vactb";
  $result=mysqli_query($con,$query);
  while($row=mysqli_fetch_array($result))
  {
    $vaccine=$row['vaccine'];
    echo '<option data-value="'.$vaccine.'">'.$vaccine.'</option>';
  }
}
function display_vacs()
{
 global $con;
 $query = "select * from vactb";
 $result = mysqli_query($con,$query);
 while( $row = mysqli_fetch_array($result) )
 {
  $vaccinator = $row['vaccinator'];
  $price = $row['fees'];
  $vaccine = $row['vaccine'];
  echo '<option value="' .$vaccinator. '" data-value="'.$price.'"  data-spec="'.$vaccine.'">'.$vaccinator.'</option>';
 }
}
?>