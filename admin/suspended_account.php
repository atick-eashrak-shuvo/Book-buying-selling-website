<?php
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['type']!="admin")
{
  header("Location: logout.php");
}

include "../include/dbcon.php";
$userid="";
$today=date("Y-m-d");
if($_SERVER["REQUEST_METHOD"]=="GET")
{
  if(!empty($_GET['x']))
  {
    $userid=$_GET['x'];
  }

  $sql1="update user set status='approved' where user_id=$userid";
  mysqli_query($conn,$sql1);
  $sql2="update user set last_login_date='$today' where user_id=$userid";
  mysqli_query($conn,$sql2);
}

$sql="select * from user where status='suspended'";
$result=mysqli_query($conn,$sql);


?>
<html>
  <head>

    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Suspended Account</title>
    <link rel = "icon" href =
  "resource\icons8-admin-settings-male-100.png"
          type = "image/x-icon">
  </head>
  <body>


    <?php include "admin_menu.php"; ?>

      <div class="table">
        <table class="tb">
          <tr>
            <th align="left" class="td">Full name</th>
            <th align="left">Email</th>
            <th align="left">Phone No.</th>
            <th align="left">Username</th>
            <th align="left">Action</th>
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
                  "<td class="."td><a href="."suspended_account.php?x=".$row['user_id'].">Approved</a></td>".
            "</tr>" ;


          }

         ?>
        </table>
      </div>

<?php include "footer.html"; ?>
  </body>
</html>
