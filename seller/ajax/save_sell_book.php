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
    

    $book_id=$book_condition=$book_copy=$book_discount=$book_price=$location="";
    $quantity=0;
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

                if(!empty($_POST['book_copy']))
                {
                    $book_copy= mysqli_real_escape_string($conn,$_POST['book_copy']);
                }
                else {
                    $error="Number of books Can Not Be empty or Zero";
                    echo json_encode(array("error"=>$error,"success"=>""));
                    return;
                }
                
                $sqlsekectExistingBookAD="select * from book_ad where user_name='$user_name' and book_condition_status='$book_condition' and book_id='$book_id' " ;
                $result=mysqli_query($conn, $sqlsekectExistingBookAD);
                $rowcount=0;
                $quantity=0;
                while($row=mysqli_fetch_assoc($result))
                {

                    $quantity=$row['quantity']==0? "0":intval($row['quantity']);
                    $rowcount++;
                    
                }
                $quantity= ((int)$quantity-(int)$book_copy);
                if($rowcount>0 && $quantity>=0)
                {
                    $updateSql="update book_ad set quantity='$quantity' where user_name='$user_name' and book_condition_status='$book_condition' and book_id='$book_id'";
                    $uresult=mysqli_query($conn, $updateSql);
                    if($uresult){
                        mysqli_free_result($result);
                        mysqli_close($conn);
                        echo json_encode(array("error"=>"","success"=>"Successfully Soled The Book"));
                        return;
                    }
                }else{
                        echo json_encode(array("error"=>"This Book is not avalable to sell","success"=>""));
                        return;
                }
            }
            
?>

