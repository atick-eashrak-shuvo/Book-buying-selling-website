<?php
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['type']!="admin")
{
  header("Location: logout.php");
}
?>

<html>
<head>
    <title>Delete book </title>
    </head>
    <body>
      <?php include "admin_menu.php"; ?>
<table class="tb">
<tr>
    <th>Bookid</th>
    <th>Username                   </th>
    <th>Type</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Delete</th>

    </tr>
    <?php

    include "../include/dbcon.php";


    $sql="SELECT * FROM book_ad";
    mysqli_query($conn,$sql);

    $records=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($records))
    {
        echo"<tr>";
            echo"<td>".$row['book_id']."</td>";
        echo"<td>".$row['user_name']."</td>";
        echo"<td>".$row['book_condition_status']."</td>";
         echo"<td>".$row['quantity']."</td>";
         echo"<td>".$row['price']."</td>";
        
          echo"<td><a href=removebook.php?id=".$row['ad_id'].">Delete</a></td>";

    }
    ?>
</table>
<?php include "footer.html"; ?>
    </body>
</html>
