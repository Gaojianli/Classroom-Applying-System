<?php
define("HOST", "localhost");
define("USER", "");
define("PASS", "");
define("DBNAME", "class_applying_sys");
$dbc = mysqli_connect(HOST, USER, PASS, DBNAME);
mysqli_set_charset($dbc, 'utf8');
$classroom_id=$_POST["classroomId"];
$user_id=$_COOKIE["uid"];
$apply_time=$_POST["time"];
$insert_query="INSERT INTO class_applying_sys.applicant(classroom_id,user_id,apply_time,need_media,apply_status) VALUES 
($classroom_id,$user_id,$apply_time,0,2)";
$insert_query_result=mysqli_query($dbc,$insert_query);
if($insert_query_result){
    echo "0";
}
else{
    echo "1";
}