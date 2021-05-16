<?php
    $rollno =$_POST["rollno"];
    $password =$_POST["password"];
   //database connection
   $con =new mysqli("localhost","root","","sms");
   if ($con->connect_error){
       die("Failed to connect : " ($con->connect_error));
   }else{
       $stmt = $con->prepare("select * from students where rollno = ?");
       $stmt->bind_param("s",$rollno);
       $stmt->execute();
       $stmt_result = $stmt->get_result();
       if($stmt_result->num_rows > 0) {
           $data = $stmt_result->fetch_assoc();
           if($data['password'] === $password){
               echo "<h1><center>LOGIN SUCCESFUL!!!</center></h1>";
               header('Location:student.html');
           } else{
               echo "<h1><center>INVALID ROLL NO OR PASSWORD...</center></h1>";
           }
       }
       else{
           echo "<h1><center>INVALID ROLL NO OR PASSWORD...</center></h1>";
       }
   }
?>