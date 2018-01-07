<?php
define("HOST", "localhost");
define("USER", "");
define("PASS", "");
define("DBNAME", "class_applying_sys");
if (isset($_COOKIE["uid"])&&isset($_COOKIE["token"])) {
    $user = $_COOKIE["uid"];
    $token = $_COOKIE["token"];
    $dbc = mysqli_connect(HOST, USER, PASS, DBNAME);
    mysqli_set_charset($dbc, 'uff8');
    $sql = "SELECT * FROM class_applying_sys.user_information WHERE user_id='$user'";
    $result = mysqli_query($dbc, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    include("getUserInformation.php");
    if ($row["token"] == $token) {
        getUserInformation($user, true);
    } else {
        $sql = "UPDATE class_applying_sys.user_information SET token=NULL WHERE user_id='$user'";
        setcookie("token", "", time() - 3600, "/cas", "jp.gaojianli.tk", true);
        setcookie("uid", "", time() - 3600, "/cas", "jp.gaojianli.tk", true);
        getUserInformation($user, false);
    }
}
else{
    $array=array('status'=>"1");
    echo json_encode($array);
}