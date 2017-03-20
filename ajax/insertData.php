<?php
$con= mysqli_connect("localhost", "root", "", "db_sts_class");
$status = "init";
$message = "";
$userData = array();
$fName=$_REQUEST['fName'];
$lName=$_REQUEST['lName'];
$uName=$_REQUEST['uName'];
$state=$_REQUEST['state'];
$title=$_REQUEST['title'];
$disc=$_REQUEST['disc'];
$query= "insert into noreload (fName, lName, uName, state, title, disc) VALUES ('$fName', '$lName', '$uName', '$state', '$title', '$disc')";
$result = mysqli_query($con,$query);
if($result){
    $status= "Success";
    $message= "Data Inserted";
}
else{
    $status = "Error";
    $message = "Data Does not Inserted";
}
$response['status'] = $status;
$response['message'] = $message;
echo json_encode($response);
?>