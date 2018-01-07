<?php
$user=$_COOKIE["uid"];
$token=$_COOKIE["token"];
define("HOST", "localhost");
define("USER", "");
define("PASS", "");
define("DBNAME", "class_applying_sys");
$dbc = mysqli_connect(HOST, USER, PASS, DBNAME);
mysqli_set_charset($dbc, 'uff8');
$sql="SELECT * FROM class_applying_sys.user_information WHERE user_id=$user";
$result=mysqli_query($dbc,$sql);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
if($row["token"]==$token&&$row["token"]!=NULL){
    header("Location:main.html");
}
else{
    header("Location:login.html");
}