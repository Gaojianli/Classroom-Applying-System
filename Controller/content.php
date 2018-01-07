<?php
define("HOST", "localhost");
define("USER", "");
define("PASS", "");
define("DBNAME", "class_applying_sys");
$dbc = mysqli_connect(HOST, USER, PASS, DBNAME);
mysqli_set_charset($dbc, 'utf8');
$message_id=$_GET["id"];
$get_content="SELECT * FROM class_applying_sys.message_list WHERE message_id=$message_id";
$get_content_result=mysqli_query($dbc,$get_content);
$get_content_row=mysqli_fetch_array($get_content_result,MYSQLI_ASSOC);
$content=$get_content_row["content"];
echo $content;