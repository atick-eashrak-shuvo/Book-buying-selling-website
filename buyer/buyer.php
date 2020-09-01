<?php
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['type']!="buyer")
{
  header("Location: ../logout.php");
}
$perPage = 2;
$i=0;

include "../include/dbcon.php";

$countsql="select count(*) as no from book_ad";
$countsqlreg=mysqli_query($conn,$countsql);
$countreg=mysqli_fetch_assoc($countsqlreg);
$total=$countreg['no'];

  if(!empty($_GET['i']))
  {
    $i=$_GET['i'];
    $sql1="SELECT book_ad.ad_id,books.book_name,books.cover_photo,books.author,book_ad.quantity,book_ad.price,user.user_name,book_ad.location FROM book_ad,books,user WHERE books.book_id=book_ad.book_id and user.user_name=book_ad.user_name limit $i,$perPage";
}
  $sql1="SELECT book_ad.ad_id,books.book_name,books.cover_photo,books.author,book_ad.quantity,book_ad.price,user.user_name,book_ad.location FROM book_ad,books,user WHERE books.book_id=book_ad.book_id and user.user_name=book_ad.user_name limit $i,$perPage";


$result1=mysqli_query($conn,$sql1);



?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Buyer</title>
    <link rel = "icon" href =
  "resource\icons8-admin-settings-male-100.png"
          type = "image/x-icon">
        <link rel="stylesheet" href="style.css">

  </head>
  <body>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>



    <div class="" align="right">
      <input type="text" id="searchKeyword" placeholder="Search">
    </div>








    <?php include "buyer_menu.php";

    ?>


         <?php while($row=mysqli_fetch_assoc($result1)) { ?>

          <div id="comments" width="100%" style="display: block;">

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

<div class="" align="center">
  <?php if($i<=0){echo "<!--";} ?>
  <a href="buyer.php?i=<?php echo $i-$perPage; ?>">Prev</a> <?php if($i<=0){echo "-->";} ?> <?php if($i+$perPage>=$total){echo "<!--";} ?><a href="buyer.php?i=<?php echo $i+$perPage; ?>">next</a><?php if($i+$perPage>=$total){echo "-->";} ?>
</div>

<?php include "footer.html"; ?>
  </body>
  <script>

  $('#ldMore').click(function(){

          $('#comments').load('book_search.php',{limitValue: i});
        });

        $(document).ready(function(){
          $('#searchKeyword').on('keyup',function(){
            $('#comments').load('book_search.php',{searchedKeyWord: document.getElementById('searchKeyword').value});
          });

        });

      </script>
</html>
