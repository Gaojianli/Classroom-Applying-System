<?php
define("HOST", "localhost");
define("USER", "");
define("PASS", "");
define("DBNAME", "class_applying_sys");
$dbc = mysqli_connect(HOST, USER, PASS, DBNAME);
mysqli_set_charset($dbc, 'utf8');
$user_id=$_COOKIE["uid"];
$new_tel=$_POST["tel"];
$update_date="UPDATE class_applying_sys.user_information SET tel=$new_tel WHERE user_id=$user_id";
mysqli_query($dbc,$update_date);