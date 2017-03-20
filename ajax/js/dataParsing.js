function insertData(){
    var id="";
    var fName=$("#fName").val();
    var lName=$("#lName").val();
    var uName=$("#uName").val();
    var url="insertData.php";
    $.post(url,{"id":id,"fName":fName,"lName":lName,"uName":uName},function (data) {
        var json=$.parseJSON(data);
        if(json.status=="Success"){
            $('.modal-header').css('display', 'none');
            $('.modal-body').html("<p style='color: green'> Data Inserted. </p>");
            $('.modal-footer').css('display', 'none');
            $('#myModal').modal("show");
            getUserData();
        }
        else{
            $('.modal-title').html("<p style='color: red'>"+json.message+"</p>");
            $('#myModal').modal("show");
        }
    });
}
function getUserData(){
    var url="getData.php";
    $.get(url,function (data) {
        var json =$.parseJSON(data);
        if(json.status=="Success"){
            var userData = json.userData;
            var datashow="";
            for(var i=0;i<userData.length;i++){
                datashow= datashow +"<div class='row' id='block'>" +
                    "<div class='col-sm-2'></div>"+
                    "<div class='col-sm-8 userbox'>"+
                    "<div class='input-group'><span class='glyphicon glyphicon-user'></span>"+
                    "<label><b><font color='green'>"+userData[i].fName+" "+userData[i].lName+"</font></b></label>" +
                    "</div>" +
                    "<div class='input-group'><span class='glyphicon glyphicon-pencil'></span>" +
                    "<label><b><font color='green'>"+userData[i].uName+"</font></b></label>"+
                    "</div>"+
                    "<div class='input-group'>"+
                    "<input type='button' class='btn btn-xs btn-primary' onclick=deleteUser('"+userData[i].id+"') value='Delete'>"+
                    "</div>" +
                    "</div>"+
                    "</div>";
            }
            $("#dataBlock").html(datashow);
        }
        else{
            alert(json.message);
        }
    });
}
/*function deleteUser(deleteUserData){
 var url="getData.";
 $.get(url,function (data) {
 var json =$.parseJSON(data);
 if(json.status=="Success"){
 var userData = json.userData;
 $('.modal-title').html("<h2>Delete Notification</h2>");
 $('.modal-body').html("Are you sure want to delete user Account?");
 $('.modal-footer').html("<input type='button' class='btn btn-danger' onclick='confirmDelete(deleteUserData)' value='Delete'>" +
 "<input type='button' class='btn btn-default' data-dissmiss='modal' value='Cancel'> ");
 $('#myModal').modal("show");
 }*/
/*function confirmDelete(dlt){
 var url="getData.";
 $.get(url,function (data) {
 var json =$.parseJSON(data);
 if(json.status=="Success") {
 var userData = json.userData;
 }
 else{
 alert("json.message");
 }
 });
 getUserData();
 }*/
getUserData();
