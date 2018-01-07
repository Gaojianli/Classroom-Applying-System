<?php
function getUserInformation($user, $status)
{
    $dbc = mysqli_connect(HOST, USER, PASS, DBNAME);
    mysqli_set_charset($dbc, 'utf8');
    $get = "SELECT * FROM class_applying_sys.user_information WHERE user_id=$user";
    $get_result = mysqli_query($dbc, $get);
    $get_row = mysqli_fetch_array($get_result, MYSQLI_ASSOC);
    if ($status == true) {
       switch($get_row["level"]){
           case 0:{
               $get_message_level0="SELECT * FROM class_applying_sys.message_list WHERE user_id=$user AND isRead=0";
               $get_message_result_level0=mysqli_query($dbc,$get_message_level0);
               $notice=mysqli_num_rows($get_message_result_level0);
               $get_classroom_level0="SELECT * FROM class_applying_sys.classroom_information WHERE isApplied=0";
               $get_classroom_result_level0=mysqli_query($dbc,$get_classroom_level0);
               $emClass=mysqli_num_rows($get_classroom_result_level0);
               $get_applicant_level0="SELECT * FROM class_applying_sys.applicant WHERE  apply_status=2";
               $get_applicant_result_level0=mysqli_query($dbc,$get_applicant_level0);
               $applicant=mysqli_num_rows($get_applicant_result_level0);
               $array = array('status' => "0", 'name' => $get_row["name"], 'tel' => $get_row["tel"], 'mail' => $get_row["mail"], 'qq' => $get_row["qq"], 'position' => $get_row["position"]
               ,'level'=>"0",'notice'=>(string)$notice,'emClass'=>(string)$emClass,'applicant'=>(string)$applicant);
               echo json_encode($array);
               return;
           }
           case 1:{
               $get_message_level1="SELECT * FROM class_applying_sys.message_list WHERE user_id=$user AND isRead=0";
               $get_message_result_level1=mysqli_query($dbc,$get_message_level1);
               $notice=mysqli_num_rows($get_message_result_level1);
               $get_classroom_level1="SELECT * FROM class_applying_sys.classroom_information WHERE isApplied=0";
               $get_classroom_result_level1=mysqli_query($dbc,$get_classroom_level1);
               $emClass=mysqli_num_rows($get_classroom_result_level1);
               $get_applicant_level1="SELECT * FROM class_applying_sys.applicant WHERE  apply_status=2";
               $get_applicant_result_level1=mysqli_query($dbc,$get_applicant_level1);
               $applicant=mysqli_num_rows($get_applicant_result_level1);
               $array = array('status' => "0", 'name' => $get_row["name"], 'tel' => $get_row["tel"], 'mail' => $get_row["mail"], 'qq' => $get_row["qq"], 'position' => $get_row["position"]
               ,'level'=>"1",'notice'=>(string)$notice,'emClass'=>(string)$emClass,'applicant'=>(string)$applicant);
               echo json_encode($array);
               return;
           }
           case 2:{
               $get_message_level2="SELECT * FROM class_applying_sys.message_list WHERE user_id=$user AND isRead=0";
               $get_message_result_level2=mysqli_query($dbc,$get_message_level2);
               $notice=mysqli_num_rows($get_message_result_level2);
               $get_classroom_applied="SELECT * FROM class_applying_sys.classroom_information WHERE manager_id=$user AND isApplied=1";
               $get_classroom_applied_result=mysqli_query($dbc,$get_classroom_applied);
               $get_classroom_applied_row=mysqli_fetch_array($get_classroom_applied_result,MYSQLI_ASSOC);
               $get_classroom_id=$get_classroom_applied_row["classroom_id"];
               $get_applicant_level2="SELECT * FROM class_applying_sys.applicant WHERE apply_status=0";
               $get_applicant_result_level2=mysqli_query($dbc,$get_applicant_level2);
               $get_classroom_id_in_applicant=mysqli_fetch_array($get_applicant_result_level2,MYSQLI_ASSOC);
               $classroom_id_in_applicant=$get_classroom_id_in_applicant["classroom_id"];
               $count=0;
                for($i=0;$i<count($classroom_id_in_applicant);$i++){
                    for($j=0;$j<count($get_classroom_id);$j++){
                        if($classroom_id_in_applicant[$i]==$classroom_id_in_applicant[$j]){
                            $count++;
                        }
                    }
                }
                $applicant=$count;
               $array = array('status' => "0", 'name' => $get_row["name"], 'tel' => $get_row["tel"], 'mail' => $get_row["mail"], 'qq' => $get_row["qq"], 'position' => $get_row["position"]
               ,'level'=>"2",'notice'=>(string)$notice,'emClass'=>"null",'applicant'=>(string)$applicant);
               echo json_encode($array);
               return;
           }
           case 3:{
               $get_message_level3="SELECT * FROM class_applying_sys.message_list WHERE user_id=$user AND isRead=0";
               $get_message_result_level3=mysqli_query($dbc,$get_message_level3);
               $notice=mysqli_num_rows($get_message_result_level3);
               $get_classroom_level3="SELECT * FROM class_applying_sys.classroom_information WHERE isApplied=0";
               $get_classroom_result_level3=mysqli_query($dbc,$get_classroom_level3);
               $emClass=mysqli_num_rows($get_classroom_result_level3);
               $get_applicant_level3="SELECT * FROM class_applying_sys.applicant WHERE user_id=$user AND apply_status=2";
               $get_applicant_result_level3=mysqli_query($dbc,$get_applicant_level3);
               $applicant=mysqli_num_rows($get_applicant_result_level3);
               $array = array('status' => "0", 'name' => $get_row["name"], 'tel' => $get_row["tel"], 'mail' => $get_row["mail"], 'qq' => $get_row["qq"], 'position' => $get_row["position"]
               ,'level'=>"3",'notice'=>(string)$notice,'emClass'=>(string)$emClass,'applicant'=>(string)$applicant);
               echo json_encode($array);
               return;
           }
       }
    }
    else
        $array=array('status'=>"1");
    echo json_encode($array);
}
