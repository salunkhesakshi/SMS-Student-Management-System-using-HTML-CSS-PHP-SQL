<?php
    $studentname = $_POST["studentname"];
    $rollno = $_POST["rollno"];
    $studentemail = $_POST["studentemail"];
    $phonenumber = $_POST["phonenumber"];
    $percentage = $_POST["percentage"];
    $password = $_POST["password"];

    error_reporting(E_ERROR | E_PARSE);

    function getPosts()
{
    $posts=array();
    $posts[0] = $_POST["studentname"];
    $posts[1] = $_POST["rollno"];
    $posts[2] = $_POST["studentemail"];
    $posts[3] = $_POST["phonenumber"];
    $posts[4] = $_POST["percentage"];
    $posts[5] = $_POST["password"];   
    return $posts;
}
    //database connection
    $connect = new mysqli('localhost','root','','sms');
    if($connect->connect_error){
        die('connection failed : ' ($connect->connect_error));
    }
    else{
        if(isset($_POST['update']))
    {
    $data = getPosts();
    $update_Query="UPDATE `students` SET `studentname`='$data[0]',`studentemail`='$data[2]',`phonenumber`='$data[3]',`percentage`='$data[4]',`password`='$data[5]' WHERE rollno= $data[1]";
    try{
        $update_result=mysqli_query($connect,$update_Query);
        if($update_result)
        {
            if(mysqli_affected_rows($connect)>0)
            {
                echo '<h2><center>Data Updated!!!</h2></center>';
            }else{
                echo '<h2><center>Data Not Updated...</h2></center>';
            }
        }
    }catch (Exception $ex){
        echo '<h2><center>Error Updating...</h2></center>'.$ex->getMessage();
    }
    }
}
?>