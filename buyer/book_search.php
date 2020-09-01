<?php

include "../include/dbcon.php";


if(isset($_POST['searchedKeyWord'])){
  $sk = $_POST['searchedKeyWord'];
  $sql1 = "SELECT book_ad.ad_id,books.book_name,books.cover_photo,books.author,book_ad.quantity,book_ad.price,user.user_name,book_ad.location FROM book_ad,books,user WHERE books.book_id=book_ad.book_id and user.user_name=book_ad.user_name and books.book_name like '%$sk%'";
    $result1 = mysqli_query($conn, $sql1);

}


?>

<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table width="50%">
      <tr>

      </tr>
    <?php while($row=mysqli_fetch_assoc($result1)) { ?>

          <div style="display: block;">

          							  <center>
          								<div class="product-item">
          								  <div class="pi-img-wrapper">
          									<img src="../<?php echo $row['cover_photo']; ?>" class="img-responsive" alt="<?php echo $row['book_name']; ?>" style="height:300px;">
          								  </div>
          								  <h3><a href="ad_page.php?x=<?php echo $row['ad_id']; ?>"><?php echo $row['book_name']; ?></a> </h3>
          									<p>By:<?php echo $row['author']; ?> </p>
                            <p>Posted By:<?php echo $row['user_name']; ?> </p>
                            <p>Location:<?php echo $row['location']; ?> </p>
          								  <div class="pi-price">TK <?php echo $row['price']; ?></div>

          								  </div>



          								</center>
                          </div>

              <?php } ?>
    </table>
    <div  align="center">
      <p style="color:red">End Of result</p>
      <br>
      <p>More Books</p>
    </div>

  </body>
</html>
