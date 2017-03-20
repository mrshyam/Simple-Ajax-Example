<!--
 * Created by PhpStorm.
 * User: MrShyAm
 * Date: 3/16/2017
 * Time: 10:38 PM
 -->
<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<style>
    #block {
        background: #fff none repeat scroll 0 0;
        box-shadow: 0 0 3px;
        margin-bottom: 10px;
        margin-left: 0px;
        width: 100%;
    }
    .insertScroll{
        height: 300px;
        width: 100%;
        border: 2px solid gray;
        overflow-y:scroll ;
    }
    .searchScroll{
        height: 470px;
    }
    .newsScroll{
        height: 560px;
    }
</style>
<!-------------- Modal ------------------>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!----------- Container ----------------->
<div class="container">
    <div class="row">
        <!---------------------- Registration ----------------------->
        <div class="col-sm-3">
            <div class="row">
                <h2 align="center">Insert here..</h2>
                <div class="form-group">
                    <input type="text" id="fName" class="form-control" placeholder="First Name">
                    <input type="text" id="lName" class="form-control" placeholder="Last Name">
                    <input type="text" id="uName" class="form-control" placeholder="Username">
                    <input type="text" id="title" class="form-control" placeholder="Title">
                    <input type="text" id="disc" class="form-control" placeholder="Description">
                    <label class="form-control"><input type="checkbox" value="1" id="state">   Status</label>
                    <input type="button" class="btn btn-primary form-control" onclick="insertData()" value="Insert">
                </div>
                <div class="insertScroll">
                    <div id="dataBlock">
                        <!--------------data from database -------------->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-2"></div>
        <!---------------------- search ----------------------------->
        <div class="col-sm-3">
            <div class="row">
                <h2 align="center">Search here..</h2>
                <div class="form-group">
                    <input type="text" id="search" class="form-control" placeholder="Search by Username">
                    <input type="button" class="btn btn-primary form-control" onclick="searchUser()" value="Search User">
                </div>
                <div class="insertScroll searchScroll">
                    <div id="searchBlock">
                        <!--------------search query  from database -------------->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container" id="searchData">
                    <!-------------- Data fetched using Search ------->
                </div>
            </div>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-3">
            <div class="row">
                <h2 align="center">News feed:</h2>
                <div class="insertScroll newsScroll">
                    <marquee direction='up' onmouseover="this.stop()" onmouseout="this.start()" height="560px">
                        <div id="newsBlock">
                        <!--------------search query  from database -------------->
                        </div>
                    </marquee>
                </div>
            </div>
        </div>
    </div>
</div>
<!------------------------- dataParsing --------------------->
<script>
    function insertData() {
        var id = "";
        var fName = $("#fName").val();
        var lName = $("#lName").val();
        var uName = $("#uName").val();
        var state = $("#state").val();
        var title = $("#title").val();
        var disc = $("#disc").val();
        var url = "insertData.php";
        $.post(url, {"id": id, "fName": fName, "lName": lName, "uName": uName, "state":state, "title":title, "disc":disc}, function (data) {
            var json = $.parseJSON(data);
            if (json.status == "Success") {
                $('.modal-header').css('display', 'none');
                $('.modal-body').html("<p style='color: green'> Data Inserted. </p>");
                $('.modal-footer').css('display', 'none');
                $('#myModal').modal("show");
                setTimeout(function(){
                    $('#myModal').modal('hide')
                }, 2000);
                getUserData();
                getNews();
            }
            else {
                $('.modal-header').css('display', 'none');
                $('.modal-body').html("<p style='color: red'>" + json.message + "</p>");
                $('.modal-footer').css('display', 'none');
                $('#myModal').modal("show");
                setTimeout(function(){
                    $('#myModal').modal('hide')
                }, 2000);
                getUserData();
                getNews();
            }
        });
    }
    function getUserData() {
        var url = "getData.php";
        $.get(url, function (data) {
            var json = $.parseJSON(data);
            if (json.status == "Success") {
                var userData = json.userData;
                var datashow = "";
                for (var i = 0; i<userData.length; i++) {
                    var checked = userData[i].state;
                    var box = "";
                    if(checked == "1"){
                        box = "checked"
                    }
                    datashow = datashow + "<div class='row' id='block'>" +
                        "<div class='col-sm-2'></div>" +
                        "<div class='col-sm-8 userbox'>" +
                        "<div class='input-group'><span class='glyphicon glyphicon-user'></span>" +
                        "<label><b><font color='green'>"+userData[i].id+":" + userData[i].fName + " " + userData[i].lName + "</font></b></label>" +
                        "</div>" +
                        "<div class='input-group'><span class='glyphicon glyphicon-pencil'></span>" +
                        "<label><b><font color='green'>" + userData[i].uName + "</font></b>" +
                        "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' "+box+" onclick=state('"+userData[i].id+"') id='state"+userData[i].id+"'></label>" +
                        "</div>" +
                        "<div class='input-group'>" +
                        "<input type='button' class='btn btn-xs btn-primary' onclick=deleteUser('"+userData[i].id+"') value='Delete'>" +
                        "</div>" +
                        "</div>" +
                        "</div>";
                }
                $("#dataBlock").html(datashow);
            }
            else {
                $("#dataBlock").html(json.message);
            }
        });
    }
    /*********            Search user           *********************/
    function searchUser(){
        var search = $("#search").val();
        var url = "getSearch.php?search="+search;
        $.get(url,function(data){
            var json = $.parseJSON(data);
            if(json.status == "Success") {
                var userData = json.userData;
                var datashow="";
                for (var i = 0; i<userData.length; i++) {
                    datashow = datashow+"<div class='row' id='block'>" +
                        "<div class='col-sm-2'></div>" +
                        "<div class='col-sm-8 userbox'>" +
                        "<div class='input-group'><span class='glyphicon glyphicon-user'></span>" +
                        "<label><b><font color='green'>"+userData[i].id+": " + userData[i].fName + " " + userData[i].lName + "</font></b></label>" +
                        "</div>" +
                        "<div class='input-group'><span class='glyphicon glyphicon-pencil'></span>" +
                        "<label><b><font color='green'>" + userData[i].uName + "</font></b>" +
                        "</div>" +
                        "<div class='input-group'><span class='glyphicon glyphicon-heart-empty'></span>" +
                        "<label><b><font color='green'>" + userData[i].title + "</font></b>" +
                        "</div>" +
                        "<div class='input-group'><span class='glyphicon glyphicon-tasks'></span>" +
                        "<label><b><font color='green'>" + userData[i].disc + "</font></b>" +
                        "</div>" +
                        "</div>" +
                        "</div>";
                }
                $('#searchBlock').html(datashow);
            }
            else{
                $("#searchBlock").html(json.message);
            }
        });
    }
    function deleteUser(user_id) {
        $('.modal-title').html("<h2>Delete Notification</h2>");
        $('.modal-body').html("Are you sure want to delete user Account? ");
        $('.modal-footer').html("<input type='button' class='btn btn-danger' onclick=confirmDelete('"+user_id+"') value='Delete'>" +
            "<button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>");
        $('#myModal').modal("show");
    }
    function confirmDelete(user_id) {
        var url = "delete.php?id="+user_id;
        $.get(url, function (data) {
            var json = $.parseJSON(data);
            if (json.status == "Success") {
                getUserData();
                searchUser();
                getNews();
                $("#myModal").modal("hide");
            }
            else {
                $('.modal-header').css('display', 'none');
                $('.modal-body').html("<p style='color: red'> Error while deletion </p>");
                $('.modal-footer').css('display', 'none');
                $('#myModal').modal("hide");
            }
        });
    }
    /************************** status *********************************/
    function state(obj)
    {
        var state=$("#state"+obj).is(':checked');
        if(state)
        {
            state = "1";
        }
        else
        {
            state="0";
        }
        var url = "update.php?state="+state+"&id="+obj;
        $.get(url,function(data){
            var json = $.parseJSON(data);
            if(json.status == "Success")
            {
                $(".modal-title").css('display', 'none');
                $(".modal-body").html("Updated");
                $(".modal-footer").css('display', 'none');
                $("#myModal").modal("show");
                setTimeout(function(){
                    $('#myModal').modal('hide')
                }, 2000);
            }
            else
            {
                $(".modal-body").html("Not Updated");
                $("#myModal").modal("show");
                $(".modal-title").css('display', 'none');
                $(".modal-footer").css('display', 'none');
                setTimeout(function(){
                    $('#myModal').modal('hide')
                }, 2000);
            }
        });
    }
    function getNews() {
        var url = "getData.php";
        $.get(url, function (data) {
            var json = $.parseJSON(data);
            if (json.status == "Success") {
                var userData = json.userData;
                var datashow = "";
                for (var i = 0; i<userData.length; i++) {
                    var checked = userData[i].state;
                    var box = "";
                    if(checked == "1"){
                        box = "checked"
                    }
                    datashow = datashow +"<div class='row' id='block'>" +
                        "<div class='col-sm-2'></div>" +
                        "<div class='col-sm-8 userbox'>" +
                        "<div class='input-group'><span class='glyphicon glyphicon-heart-empty'></span>" +
                        "<label><b><font color='green'>"+userData[i].id+":" + userData[i].title + "</font></b></label>" +
                        "</div>" +
                        "<div class='input-group'><span class='glyphicon glyphicon-tasks'></span>" +
                        "<label><b><font color='green'>" + userData[i].disc + "</font></b>" +
                        "</div>" +
                        "</div>" +
                        "</div>";
                }

                $("#newsBlock").html(datashow);
            }
            else {
                $("#newsBlock").html(json.message);
            }
        });
    }
    getUserData();
    getNews();
</script>