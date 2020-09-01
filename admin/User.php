<html>
<head>
    <title>user remove </title>
    </head>
    <body>
      <?php include "admin_menu.php"; ?>
      <div class="table">
        <table class="tb">
        <tr>
            <th>FullName</th>
            <th>Email                   </th>
            <th>Phone</th>
            <th>User_type</th>
            <th>Username</th>
            <th>Delete</th>

            </tr>
            <?php
            include "../include/dbcon.php";
            $sql="SELECT * FROM user where user_type in ('buyer','seller') and status='approved'";
            mysqli_query($conn,$sql);
            $records=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($records))
            {
                echo"<tr>";
                echo"<td>".$row['full_name']."</td>";
                echo"<td>".$row['email']."</td>";
                echo"<td>".$row['phono_no']."</td>";
                 echo"<td>".$row['user_type']."</td>";
                 echo"<td>".$row['user_name']."</td>";
                 echo"<td><a href=delete.php?id=".$row['user_id'].">Delete</a></td>";

            }
            ?>
        </table>
    </div>
	<?php include "footer.html"; ?>
    </body>
</html>
