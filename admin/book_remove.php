<?php
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['type']!="admin")
{
  header("Location: logout.php");
}
include "../include/dbcon.php";
$sql="";
if($_SERVER["REQUEST_METHOD"]=="GET")
{
  if(!empty($_GET['x']))
  {
    $userid=$_GET['x'];
  }

  $sql="DELETE FROM books_request WHERE request_id ='$userid'";
  mysqli_query($conn,$sql);

  header("Location: apv_book.php");

}


 ?>
