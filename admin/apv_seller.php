<?php
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['type']!="admin")
{
  header("Location: logout.php");
}

include "../include/dbcon.php";
$userid="";
if($_SERVER["REQUEST_METHOD"]=="GET")
{
  if(!empty($_GET['x']))
  {
    $userid=$_GET['x'];
  }

  $sql="update user set status='approved' where user_id=$userid";
  mysqli_query($conn,$sql);
}

$sql="select * from user where status='not approved'";
$result=mysqli_query($conn,$sql);

?>
<html>
  <head>

    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Verify Seller</title>
    <link rel = "icon" href =
  "resource\icons8-admin-settings-male-100.png"
          type = "image/x-icon">
  </head>
  <body>

    <!--<div class="menu-bar">
    <ul>
      <li ><a href="admin.php">Avalable Books</a></li>
      <li class="active"><a href="#">Request</a>
        <div class="sub2">
          <ul>
            <li><a href="apv_book.php">New  Book</a> </li>
            <li><a href="apv_seller.php">New Seller</a> </li>
          </ul>
        </div>

      </li>

      <li><a href="#">Remove</a>
          <div class="sub2">
            <ul>
              <li><a href="#">User</a> </li>
              <li><a href="#">Book</a> </li>
            </ul>

          </div>

      </li>
      <li><a href="logout.php">logout</a> </li>

    </div>-->
    <?php include "admin_menu.php"; ?>

      <div class="table">
        <table class="tb">
          <tr>
            <th align="left" class="td">Full name</th>
            <th align="left">Email</th>
            <th align="left">Phone No.</th>
            <th align="left">Username</th>
          </tr>



        <?php
          while($row=mysqli_fetch_assoc($result))
          {
              echo
              "<tr>".
                  "<td  class="."td>" .$row['full_name']. "</td>" .
                  "<td class="."td>" .$row['email']. "</td>" .
                  "<td class="."td>" .$row['phono_no']. "</td>" .
                  "<td class="."td>" .$row['user_name']. "</td>" .
                  "<td class="."td><a href="."apv_seller.php?x=".$row['user_id'].">Approved</a><a href="."apv_seller.php".">Denay</a></td>".
            "</tr>" ;


          }

         ?>
        </table>
      </div>

<?php include "footer.html"; ?>
  </body>
</html>
