<?php
define("HOST", "localhost");
define("USER", "");
define("PASS", "");
define("DBNAME", "class_applying_sys");
$user = $_POST["uid"];
$password = $_POST["passwd"];
$token = md5($user . time() . $password);
$dbc = mysqli_connect(HOST, USER, PASS, DBNAME);
mysqli_set_charset($dbc, 'uff8');
$sql = "SELECT * FROM class_applying_sys.user_information WHERE tel=$user";
$result = mysqli_query($dbc, $sql);
if($result==false){
    $num=0;
}
else{
    $num = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
}
if ($num) {
    $salt1="dkhugfuywt278q123$%^&^$";
    $salt2=$user."234323afsa";
    $localPasswd=md5($row["password"].$salt1);
    $localPasswd=md5($salt2.$salt1.$localPasswd.$salt2."214231sdkfgewg");
    if ( $localPasswd==$password) {
        $add_token = "UPDATE class_applying_sys.user_information SET token='$token' WHERE tel='$user'";
        $add_result=mysqli_query($dbc,$add_token);
        if($add_result==false){
            echo "3";
        }
        setcookie("token","",time()-3600,"/cas",".gaojianli.tk",true);
        setcookie("uid","",time()-3600,"/cas",".gaojianli.tk",true);
        setcookie("token", $token, time() + 3600,"/cas",".gaojianli.tk",true);
        setcookie("uid",$row["user_id"],time()+3600,"/cas",".gaojianli.tk",true);
        echo "0";
    } else {
        echo "1";
    }
} else {
    echo "2";
}


