<?php
if(isset($_COOKIE["token"])){
    $user=$_COOKIE["uid"];
    $token=$_COOKIE["token"];
    define("HOST", "localhost");
    define("USER", "");
    define("PASS", "");
    define("DBNAME", "class_applying_sys");
    $dbc = mysqli_connect(HOST, USER, PASS, DBNAME);
    mysqli_set_charset($dbc, 'uff8');
    $sql="UPDATE class_applying_sys.user_information SET token=NULL WHERE user_id='$user'";
    $result=mysqli_query($dbc,$sql);
    if($result){
        setcookie("token","",time()-3600,"/cas","jp.gaojianli.tk",true);
        setcookie("uid","",time()-3600,"/cas","jp.gaojianli.tk",true);
        echo "0";
    }
    else{
        echo "1";
    }
}
else{
    echo "1";
}

