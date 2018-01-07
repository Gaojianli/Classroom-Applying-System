<link rel="stylesheet" href="css/apply.css">
<script src="js/apply.js"></script>
<div id='apply-content' class="content-box" align="center" style="display: none;">
    <p id="popTitle" align="center">驳回理由</p>
    <textarea id="refuseBecuse" class="input"></textarea>
    <div align="center" class="closeButtonInline">
        <div>
            <div class="closeButton-common closeButton-apply" onclick="hideDiv('apply-content')">驳回</div>
            <div class="closeButton-common closeButton-close" onclick="hideDiv('apply-content')">取消</div>
        </div>
        <div>
        </div>
    </div>
</div>
<div class="hidden" style="display:none;">
<?php
define("HOST", "localhost");
define("USER", "");
define("PASS", "");
define("DBNAME", "class_applying_sys");
$dbc = mysqli_connect(HOST, USER, PASS, DBNAME);
mysqli_set_charset($dbc, 'utf8');
$user_id=$_COOKIE["uid"];
$token=$_COOKIE["token"];
if(!isset($token)){
    echo "<script>
        popError(\"权限不足，请重新登陆\");
        </script>";
}
$get_level="SELECT * FROM class_applying_sys.user_information WHERE user_id=$user_id";
$get_level_result=mysqli_query($dbc,$get_level);
$get_level_row=mysqli_fetch_array($get_level_result,MYSQLI_ASSOC);
$level=$get_level_row["level"];
$name=$get_level_row["name"];
$get_apply_num="SELECT * FROM class_applying_sys.applicant";
$get_apply_num_result=mysqli_query($dbc,$get_apply_num);
$real_num=mysqli_num_rows($get_apply_num_result);
if($real_num==0){
    echo "<p style=\"color:white;font-size:2em;text-align:center\">没有更多申请了</p>
";
}
else {
    switch ($level) {
        case 0:
            $get_my_apply_list = "SELECT * FROM class_applying_sys.applicant";
            $get_my_apply_list_result = mysqli_query($dbc, $get_my_apply_list);
            $classroom_id = array();
            $apply_status = array();
            $apply_id = array();
            $count_number = 0;
            while ($get_my_apply_list_row = mysqli_fetch_array($get_my_apply_list_result, MYSQLI_ASSOC)) {
                $classroom_id[$count_number] = $get_my_apply_list_row["classroom_id"];
                $apply_status[$count_number] = $get_my_apply_list_row["apply_status"];
                $apply_id[$count_number] = $get_my_apply_list_row["apply_id"];
                $count_number++;
            }
            $test_number=0;
            for ($a=0;$a<$count_number;$a++){
                if ($apply_status[$a]==2){
                    $test_number++;
                }
            }
            if($test_number==0){
                echo "<p style=\"color:white;font-size:2em;text-align:center\">没有更多申请了</p>
";
            }
            else {
                $classroom_identifier = array();
                $classroom_location = array();
                $classroom_manager_id = array();
                for ($i = 0; $i < $count_number; $i++) {
                    $classroom_query = "SELECT * FROM class_applying_sys.classroom_information WHERE classroom_id=$classroom_id[$i]";
                    $classroom_query_result = mysqli_query($dbc, $classroom_query);
                    $classroom_row = mysqli_fetch_array($classroom_query_result, MYSQLI_ASSOC);
                    $classroom_identifier[$i] = $classroom_row["class_identifier"];
                    $classroom_location[$i] = $classroom_row["location"];
                    $classroom_manager_id[$i] = $classroom_row["manager_id"];
                }
                $manager_name = array();
                for ($j = 0; $j < $count_number; $j++) {
                    $manager_query = "SELECT * FROM class_applying_sys.user_information WHERE user_id=$classroom_manager_id[$j]";
                    $manager_query_result = mysqli_query($dbc, $manager_query);
                    $manager_query_row = mysqli_fetch_array($manager_query_result, MYSQLI_ASSOC);
                    $manager_name[$j] = $manager_query_row["name"];
                }
                for ($k = 0; $k < $count_number; $k++) {
                    if ($apply_status[$k] == 2) {
                        echo "<div class=\"items\" id=\"$apply_id[$k]\">
            <div style=\"margin-left: 5px\">$classroom_identifier[$k]</div>
            <div class=\"classRoomStatus waitting\">
                <p>待审核</p>
            </div>
            <div>$classroom_location[$k]</div>
            <div>$manager_name[$k]</div>
            <div>N/A</div>
            <div class=\"applyButton applyButtonLittle apply-refuse\" onclick=\"cancel($(this))\">
                <p>删除</p>
            </div>
            <div class=\"applyButton applyButtonLittle apply-allown\" onclick=\"checkout($(this))\">
                <p>通过</p>
            </div>
        </div>";
                    }
                }
            }
            break;
        case 1:
            $get_my_apply_list = "SELECT * FROM class_applying_sys.applicant";
            $get_my_apply_list_result = mysqli_query($dbc, $get_my_apply_list);
            $classroom_id = array();
            $apply_status = array();
            $apply_id = array();
            $count_number = 0;
            while ($get_my_apply_list_row = mysqli_fetch_array($get_my_apply_list_result, MYSQLI_ASSOC)) {
                $classroom_id[$count_number] = $get_my_apply_list_row["classroom_id"];
                $apply_status[$count_number] = $get_my_apply_list_row["apply_status"];
                $apply_id[$count_number] = $get_my_apply_list_row["apply_id"];
                $count_number++;
            }
            $test_number=0;
            for ($a=0;$a<$count_number;$a++){
                if ($apply_status[$a]==2){
                    $test_number++;
                }
            }
            if($test_number==0){
                echo "<p style=\"color:white;font-size:2em;text-align:center\">没有更多申请了</p>
";
            }
            else {
                $classroom_identifier = array();
                $classroom_location = array();
                $classroom_manager_id = array();
                for ($i = 0; $i < $count_number; $i++) {
                    $classroom_query = "SELECT * FROM class_applying_sys.classroom_information WHERE classroom_id=$classroom_id[$i]";
                    $classroom_query_result = mysqli_query($dbc, $classroom_query);
                    $classroom_row = mysqli_fetch_array($classroom_query_result, MYSQLI_ASSOC);
                    $classroom_identifier[$i] = $classroom_row["class_identifier"];
                    $classroom_location[$i] = $classroom_row["location"];
                    $classroom_manager_id[$i] = $classroom_row["manager_id"];
                }
                $manager_name = array();
                for ($j = 0; $j < $count_number; $j++) {
                    $manager_query = "SELECT * FROM class_applying_sys.user_information WHERE user_id=$classroom_manager_id[$j]";
                    $manager_query_result = mysqli_query($dbc, $manager_query);
                    $manager_query_row = mysqli_fetch_array($manager_query_result, MYSQLI_ASSOC);
                    $manager_name[$j] = $manager_query_row["name"];
                }
                for ($k = 0; $k < $count_number; $k++) {
                    if ($apply_status[$k] == 2) {
                        echo "<div class=\"items\" id=\"$apply_id[$k]\">
            <div style=\"margin-left: 5px\">$classroom_identifier[$k]</div>
            <div class=\"classRoomStatus waitting\">
                <p>待审核</p>
            </div>
            <div>$classroom_location[$k]</div>
            <div>$manager_name[$k]</div>
            <div>N/A</div>
            <div class=\"applyButton applyButtonLittle apply-refuse\" onclick=\"reject($(this))\">
                <p>驳回</p>
            </div>
            <div class=\"applyButton applyButtonLittle apply-allown\" onclick=\"checkout($(this))\">
                <p>通过</p>
            </div>
        </div>";
                    }
                }
            }
            break;
        case 2:
            $get_my_apply_list = "SELECT * FROM class_applying_sys.applicant";
            $get_my_apply_list_result = mysqli_query($dbc, $get_my_apply_list);
            $classroom_id = array();
            $apply_status = array();
            $apply_id = array();
            $count_number = 0;
            while ($get_my_apply_list_row = mysqli_fetch_array($get_my_apply_list_result, MYSQLI_ASSOC)) {
                $classroom_id[$count_number] = $get_my_apply_list_row["classroom_id"];
                $apply_status[$count_number] = $get_my_apply_list_row["apply_status"];
                $apply_id[$count_number] = $get_my_apply_list_row["apply_id"];
                $count_number++;
            }
            $classroom_identifier = array();
            $classroom_location = array();
            $classroom_manager_id = array();
            for ($i = 0; $i < $count_number; $i++) {
                $classroom_query = "SELECT * FROM class_applying_sys.classroom_information WHERE classroom_id=$classroom_id[$i]";
                $classroom_query_result = mysqli_query($dbc, $classroom_query);
                $classroom_row = mysqli_fetch_array($classroom_query_result, MYSQLI_ASSOC);
                $classroom_identifier[$i] = $classroom_row["class_identifier"];
                $classroom_location[$i] = $classroom_row["location"];
                $classroom_manager_id[$i] = $classroom_row["manager_id"];
            }
            $manager_name = array();
            for ($j = 0; $j < $count_number; $j++) {
                $manager_query = "SELECT * FROM class_applying_sys.user_information WHERE user_id=$classroom_manager_id[$j]";
                $manager_query_result = mysqli_query($dbc, $manager_query);
                $manager_query_row = mysqli_fetch_array($manager_query_result, MYSQLI_ASSOC);
                $manager_name[$j] = $manager_query_row["name"];
            }
            for ($k = 0; $k < $count_number; $k++) {
                if ($apply_status[$k] == 0 && $classroom_manager_id[$k] == $user_id) {
                    $have_club_id = "SELECT * FROM class_applying_sys.applicant WHERE apply_id=$apply_id[$k]";
                    $have_club_id_result = mysqli_query($dbc, $have_club_id);
                    $have_club_id_row = mysqli_fetch_array($have_club_id_result, MYSQLI_ASSOC);
                    $club_id = $have_club_id_row["user_id"];
                    $have_club_name = "SELECT * FROM class_applying_sys.user_information WHERE user_id=$club_id";
                    $have_club_name_result = mysqli_query($dbc, $have_club_name);
                    $have_club_name_row = mysqli_fetch_array($have_club_name_result, MYSQLI_ASSOC);
                    $club_name = $have_club_name_row["name"];
                    echo "<div class=\"items\" id=\"$apply_id[$k]\">
            <div style=\"margin-left: 5px\">$classroom_identifier[$k]</div>
            <div class=\"classRoomStatus free\">
                <p>已通过</p>
            </div>
            <div>$classroom_location[$k]</div>
            <div>$manager_name[$k]</div>
            <div>$club_name</div>
        </div>";
                }
            }
            break;
        case 3:
            $get_my_apply_list = "SELECT * FROM class_applying_sys.applicant WHERE user_id=$user_id";
            $get_my_apply_list_result = mysqli_query($dbc, $get_my_apply_list);
            $my_real_num = mysqli_num_rows($get_my_apply_list_result);
            if ($my_real_num == 0) {
                echo "<p style=\"color:white;font-size:2em;text-align:center\">没有更多申请了</p>
";
            } else {
                $classroom_id = array();
                $apply_status = array();
                $apply_id = array();
                $count_number = 0;
                while ($get_my_apply_list_row = mysqli_fetch_array($get_my_apply_list_result, MYSQLI_ASSOC)) {
                    $classroom_id[$count_number] = $get_my_apply_list_row["classroom_id"];
                    $apply_status[$count_number] = $get_my_apply_list_row["apply_status"];
                    $apply_id[$count_number] = $get_my_apply_list_row["apply_id"];
                    $count_number++;
                }
                $classroom_identifier = array();
                $classroom_location = array();
                $classroom_manager_id = array();
                for ($i = 0; $i < $count_number; $i++) {
                    $classroom_query = "SELECT * FROM class_applying_sys.classroom_information WHERE classroom_id=$classroom_id[$i]";
                    $classroom_query_result = mysqli_query($dbc, $classroom_query);
                    $classroom_row = mysqli_fetch_array($classroom_query_result, MYSQLI_ASSOC);
                    $classroom_identifier[$i] = $classroom_row["class_identifier"];
                    $classroom_location[$i] = $classroom_row["location"];
                    $classroom_manager_id[$i] = $classroom_row["manager_id"];
                }
                $manager_name = array();
                for ($j = 0; $j < $count_number; $j++) {
                    $manager_query = "SELECT * FROM class_applying_sys.user_information WHERE user_id=$classroom_manager_id[$j]";
                    $manager_query_result = mysqli_query($dbc, $manager_query);
                    $manager_query_row = mysqli_fetch_array($manager_query_result, MYSQLI_ASSOC);
                    $manager_name[$j] = $manager_query_row["name"];
                }
                for ($k = 0; $k < $count_number; $k++) {
                    if ($apply_status[$k] == 0) {
                        echo "<div class=\"items\" id=\"$apply_id[$k]\">
            <div style=\"margin-left: 5px\">$classroom_identifier[$k]</div>
            <div class=\"classRoomStatus free\">
                <p>已通过</p>
            </div>
            <div>$classroom_location[$k]</div>
            <div>$manager_name[$k]
                <i class=\"fa fa-phone size-fa\" onclick=\"call($(this))\"></i>
            </div>
            <div>$name</div>


            <div class=\"applyButton applyButtonLittle apply-refuse\" onclick=\"cancel($(this))\">
                <p>取消</p>
            </div>
        </div>";
                    } else if ($apply_status[$k] == 1) {
                        echo "<div class=\"items\" id=\"$apply_id[$k]\">
            <div style=\"margin - left: 5px\">$classroom_identifier[$k]</div>
            <div class=\"classRoomStatus free\">
                <p>已驳回</p>
            </div>
            <div>$classroom_location[$k]</div>
            <div>$manager_name[$k]
                <i class=\"fa fa - phone size - fa\" onclick=\"call($(this))\"></i>
            </div>
            <div>$name</div>
            </div>";
                    } else {
                        echo "<div class=\"items\" id=\"$apply_id[$k]\">
            <div style=\"margin - left: 5px\">$classroom_identifier[$k]</div>
            <div class=\"classRoomStatus free\">
                <p>待审核</p>
            </div>
            <div>$classroom_location[$k]</div>
            <div>$manager_name[$k]
                <i class=\"fa fa - phone size - fa\" onclick=\"call($(this))\"></i>
            </div>
            <div>$name</div>
             <div class=\"applyButton applyButtonLittle apply-refuse\" onclick=\"cancel($(this))\">
                <p>取消</p>
            </div>
            </div>";
                    }
                }
                break;
            }
    }
}
?>
    <script>

        $(".list-body").ready(() => {

            $(".list-body").niceScroll({

            cursorcolor: "#ccc",

            cursoropacitymax: 1,

            // touchbehavior: true,

            cursorwidth: "5px",

            cursorborder: "0",

            cursorborderradius: "5px",

            autohidemode: true,



        });

        setTimeout(() => {

            $('.list-body').niceScroll().resize();

        }, 500);

        })

$('div.blocks').children('div.apply').children('div').not('#apply-content').fadeIn(500)
    </script>
