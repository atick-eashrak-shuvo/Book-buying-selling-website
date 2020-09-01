<?php
    session_start();
    header('Content-Type: application/json');
    if(!isset($_SESSION['user_id']) || $_SESSION['type']!="seller")
    {
        echo json_encode(array("error"=>"User Is Not Valid","success"=>""));
        return;
    }

    $user_name=$_SESSION['user_name'];
    $userId=$_SESSION['user_id'];
    include "../../include/dbcon.php";
    

    $book_id=$book_condition=$book_copy=$book_discount=$book_price=$quantity=$location="";
    $error="";

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                if(!empty($_POST['book']) && $_POST['book']!='0')
                {
                    $book_id= mysqli_real_escape_string($conn,$_POST['book']);
                }
                else {
                    $error="Select One Book From the list";
                    echo json_encode(array("error"=>$error,"success"=>""));
                    return;
                }

                if(isset($_POST['book_condition']) && !empty($_POST['book_condition']))
                {
                    $book_condition= mysqli_real_escape_string($conn,$_POST['book_condition']);
                }
                else {
                    $book_condition='old';
                }

                if(!empty($_POST['book_price']))
                {
                    $book_price= mysqli_real_escape_string($conn,$_POST['book_price']);
                }
                else {
                    $error="Book price Can Not Be empty or Zero";
                    echo json_encode(array("error"=>$error,"success"=>""));
                    return;
                }

                if($_POST['book_discount']==0 || !empty($_POST['book_discount']))
                {
                    $book_discount= mysqli_real_escape_string($conn,$_POST['book_discount']);
                }
                else {
                    $error="Book discount Can Not Be empty ".$_POST['book_discount'];
                    echo json_encode(array("error"=>$error,"success"=>""));
                    return;
                }

                if(!empty($_POST['book_copy']))
                {
                    $book_copy= mysqli_real_escape_string($conn,$_POST['book_copy']);
                }
                else {
                    $error="Number of books Can Not Be empty";
                    echo json_encode(array("error"=>$error,"success"=>""));
                    return;
                }

                if(!empty($_POST['location']))
                {
                    $location= mysqli_real_escape_string($conn,$_POST['location']);
                }
                else {
                    $error="Book location Can Not Be empty";
                    echo json_encode(array("error"=>$error,"success"=>""));
                    return;
                }
                
                $sqlsekectExistingBookAD="select * from book_ad where user_name='$user_name' and book_condition_status='$book_condition' and book_id='$book_id' " ;
                $result=mysqli_query($conn, $sqlsekectExistingBookAD);
                $rowcount=0;
                while($row=mysqli_fetch_assoc($result))
                {
                    $quantity=(int)$row['quantity'];
                    $rowcount++;
                }
                if($rowcount>0)
                {
                    $quantity+= (int)$book_copy;
                    $updateSql="update book_ad set quantity='$quantity', price='$book_price', location='$location', discount='$book_discount' where user_name='$user_name' and book_condition_status='$book_condition' and book_id='$book_id'";
                    $uresult=mysqli_query($conn, $updateSql);
                    if($uresult){
                        mysqli_free_result($result);
                        mysqli_close($conn);
                        echo json_encode(array("error"=>"","success"=>"Successfully Updated Book AD"));
                        return;
                    }
                }else{
                    $insertSql="insert into book_ad(book_id , user_name , book_condition_status, quantity,price,location,discount)"
                    ." VALUES ('$book_id','$user_name','$book_condition','$quantity','$book_price','$location','$book_discount') ";
                    $iresult=mysqli_query($conn, $insertSql);
                    if($iresult){
                        mysqli_free_result($result);
                        mysqli_close($conn);
                        echo json_encode(array("error"=>"","success"=>"Successfully Created New Book AD"));
                        return;
                    }
                }
                
               
            }
            
?>

