<?php
$con = mysqli_connect("localhost", "root", "", "db_sts_class");
$status = "init";
$message = "";
$state = $_REQUEST['state'];
$id = $_REQUEST['id'];
$query = "update noreload set state='$state' where id = '$id'";
$result = mysqli_query($con,$query);
if($result){
$status = "Success";
$message = "updated Successfully";
}
else{
$status = "Error";
$message = mysqli_error($con);
}
$response['status'] = $status;
$response['message'] = $message;
echo json_encode($response);
?>