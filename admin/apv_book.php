<?php
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['type']!="admin")
{
  header("Location: logout.php");
}
include "../include/dbcon.php";

$sql="SELECT * FROM book_request";
$result=mysqli_query($conn,$sql);





 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>New Book Request </title>
    <link rel = "icon" href =
  "resource\icons8-admin-settings-male-100.png"
          type = "image/x-icon">
  </head>
  <body>
    <?php include "admin_menu.php"; ?>

      <div class="table">
        <table class="tb">
          <tr>
            <th><label for="">Book Name</label> </th>
            <th><label for="">Author</label> </th>
            <th><label for="">Category</label> </th>
            <th><label for="">Summary</label> </th>
            <th><label for="">Cover Photo</label> </th>
          </tr>


            <?php while($row=mysqli_fetch_assoc($result)) {?>
              <tr>

              <td><?php echo $row['book_name']?></td>
              <td><?php echo $row['author'] ?></td>
              <td><?php echo $row['category'] ?></td>
              <td><?php echo $row['summary']; ?></td>
              <td><img src="../<?php echo $row['cover_photo']; ?>" alt="<?php echo $row['book_name']; ?>" style="height:200px"> </td>
              <td><a href="apv_book_proc.php?x=<?php echo $row['request_id']; ?>">Add Book</a>
                <!-- <a href="edit_book_ad.php?x=<?php echo $row['request_id']; ?>">Edit</a>-->

                 <a href="apv_book_rmv.php?x=<?php echo $row['request_id']; ?>">Remove</a> </td>
              </tr>
          <?php } ?>


        </table>

      </div>
<?php include "footer.html"; ?>
  </body>
</html>
