<?php 
$host="localhost";
$user="root";
$password="";
$database="sms";


$studentname ="";
$rollno ="";
$studentemail ="";
$phonenumber ="";
$percentage ="";
$password ="";

echo $studentname;
//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT-STRICT);
error_reporting(E_ERROR | E_PARSE);
try{
    $connect=mysqli_connect($host,$user,$password,$database);
}catch (Exception $ex){
    echo "Error";
}

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
//------------------------------------------------------------------
// search
//--------------------------------------------------------------
if(isset($_POST['search']))
{
    $data=getPosts();
    $search_Query= "SELECT * FROM `students` WHERE rollno = $data[1]";
    $search_Result = mysqli_query($connect,$search_Query);
    if ($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while ($row =mysqli_fetch_array($search_Result))
            {
                $studentname = $row['studentname'];
                $rollno = $row['rollno'];
                $studentemail = $row['studentemail'];
                $phonenumber = $row['phonenumber'];
                $percentage = $row['percentage'];
                $password = $row['password'];
            }
        }else{
            echo '<h2><center>No Data for this Roll NO...</h2></center>';
        }
    }else{
        echo  '<h2><center>Result Error...</h2></center>';
    }
}
//----------------------------------------------------------
//insert
//----------------------------------------------------------
if(isset($_POST['insert']))
{
    $data = getPosts();
    $insert_Query="INSERT INTO `students`(`studentname`, `rollno`, `studentemail`, `phonenumber`, `percentage`, `password`) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]')";
    try{
        $insert_result=mysqli_query($connect,$insert_Query);
        if($insert_result)
        {
            if(mysqli_affected_rows($connect)>0)
            {
                echo '<h2><center>Data Inserted!!!</h2></center>';
            }
            else{
                echo '<h2><center>Data Not Inserted...</h2></center>';
            }
        }
    }
    catch (Exception $ex){
        echo '<h2><center>Error Inserting Data...</h2></center>'.$ex->getMessage();
    }
}
//---------------------------------------------------------------------------
//delet
//-------------------------------------------------------------
if(isset($_POST['delete']))
{
    $data = getPosts();
    $delete_Query="DELETE FROM `students` WHERE rollno = $data[1]";
    try{
        $delete_result=mysqli_query($connect,$delete_Query);
        if($delete_result)
        {
            if(mysqli_affected_rows($connect)>0)
            {
                echo '<h2><center>Data Deleted!!!</h2></center>';
            }else{
                echo '<h2><center>Data Not deleted...</h2></center>';
            }
        }
    }catch (Exception $ex){
        echo '<h2><center>Error Deleted...</h2></center>'.$ex->getMessage();
    }
}
//-------------------------------------------------------------
//update
//------------------------------------------------------------
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
//-------------------------------------------------------------------

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP INSERT UPDATE DELETE SEARCH</title>
    <link href="style.css" rel="stylesheet" /> 
</head>
<body>
     <h1 align = "center">SCHOOL MANAGEMENT SYSTEM</h1>
     <center><h4><a class="nav-link" href="index.html">Home</a><h4><a class="nav-link" href="adminlogin.html">Log Out</a></h4></h4></center>

    <ins><h2 align="center"><legend>Student Information</legend></h2></ins>
    <img class="image" src="./back.jpg" alt="school">
    <section class="adminconnect">
        <div class="adminconnectcontainer">
        <form action="adminconnect.php" method="post">
        
        <center> <label>Student Name:</label><input type="text" name="studentname"  value="<?php echo $studentname;?>"> </label><br><br>
            <label>Student Roll No:</label><input type="text" name="rollno" required value="<?php echo $rollno;?>" > </label><br><br>
            <label>Student E-mail:</label><input type="email" name="studentemail"  value="<?php echo $studentemail;?>"> </label><br><br>
            <label>Phone No:</label><input type="text" name="phonenumber"  value="<?php echo $phonenumber;?>"> </label><br><br>
            <label>Percentage:</label><input type="text" name="percentage"  value="<?php echo $percentage;?>"> </label><br><br>
            <label>Password:<input type="password" name="password"  value="<?php echo $password;?>"> </label><br><br></center>
           <center> <div>
                <input class="buttons" type="submit" name="insert" value="Add Student">
                <input class="buttons" type="submit" name="update" value="Update Student">
                <input class="buttons" type="submit" name="delete" value="Delete Student">
                <input class="buttons" type="submit" name="search" value="Search Student">
            </div></center>
            
            
        </form>
        </div>
    </section>
    <section class="section section-small">
            <h3 class="section-header">  Talk to us:</h3>
            <p class="mailbox">
              Reach us via
              <a href="mailto:salunkhesakshi1@gmail.com" class="contact-link">Email</a>
                   Thank you.
            </p>
  
          </section>
        </div>
        <footer>
          <p class="footer-text">
            Copyright &copy; 2021. Designed By:
            <a href="#" class="footer-link">SCHOOL MANAGEMENT SYSTEM</a>
          </p>
        </footer>
</body>
</html>