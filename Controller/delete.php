<?php
define("HOST", "localhost");
define("USER", "");
define("PASS", "");
define("DBNAME", "class_applying_sys");
$dbc = mysqli_connect(HOST, USER, PASS, DBNAME);
mysqli_set_charset($dbc, 'utf8');
$apply_id=$_POST["id"];
$delete_operation="DELETE FROM class_applying_sys.applicant WHERE apply_id=$apply_id LIMIT 1";
mysqli_query($dbc,$delete_operation);
