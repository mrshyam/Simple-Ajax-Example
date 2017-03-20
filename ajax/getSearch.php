<?php
$con= mysqli_connect("localhost", "root", "", "db_sts_class");
$status = "init";
$message = "";
$search= $_REQUEST['search'];
$userData = array();
$query = "select * from noreload WHERE uName LIKE '$search'";
$result = mysqli_query($con,$query);
if($result){
    $num = mysqli_num_rows($result);
    if($num>0){
        while($rows = mysqli_fetch_array($result)){
            $id= $rows['id'];
            $fName = $rows['fName'];
            $lName = $rows['lName'];
            $uName = $rows['uName'];
            $state = $rows['state'];
            $title = $rows['title'];
            $disc = $rows['disc'];
            $userData[]=array("id"=>$id,"fName"=>$fName,"lName"=>$lName, "uName"=>$uName, "state"=>$state, "title"=>$title, "disc"=>$disc);
        }
        $status = "Success";
        $message = "Data Found";
    }
    else{
        $status = "Error";
        $message = "No Data Found";
    }
}
else{
    $status = "Error";
    $message = mysqli_error($con);
}
$response['status'] = $status;
$response['message'] = $message;
$response['userData'] = $userData;
echo json_encode($response);
?>