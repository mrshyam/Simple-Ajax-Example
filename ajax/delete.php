<?php
$con= mysqli_connect("localhost", "root", "", "db_sts_class");
$status = "init";
$message = "";
$id = $_REQUEST['id'];
$query = "DELETE FROM noreload WHERE id='$id'";
$result= mysqli_query($con,$query);
if($result){
$status = "Success";
$message = "Data Deleted Successfully";
}
else{
$status = "error";
$message = mysqli_error($con);
}
$response['status'] = $status;
$response['message'] = $message;
echo json_encode($response);
?>