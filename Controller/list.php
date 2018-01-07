<div class="list hidden">
    <!--表头部分，无需修改-->
    <div class="list-header">
        <div id="number-header">编号</div>
        <div>状态</div>
        <div>位置</div>
        <div>负责人</div>
        <div>占用社团</div>
    </div>
    <!--表头结束-->
    <div class="list-body">
<?php
header('Content-type: text/html;charset=UTF-8');
define("HOST", "localhost");
define("USER", "admin");
define("PASS", "ys123");
define("DBNAME", "class_applying_sys");
$dbc = mysqli_connect(HOST, USER, PASS, DBNAME);
mysqli_set_charset($dbc, 'utf8');
$user_id = $_COOKIE["uid"];
$token = $_COOKIE["token"];
$classroom_time_requested = $_GET["time"];
$check_it = "SELECT * FROM class_applying_sys.user_information WHERE user_id=$user_id";
$check_it_result = mysqli_query($dbc, $check_it);
$check_it_row = mysqli_fetch_array($check_it_result, MYSQLI_ASSOC);
$check_token = $check_it_row["token"];
if (!isset($token)) {
    echo "<script>
        popError(\"权限不足，请重新登陆\");
        </script>";
} else if ($check_token != $token) {
    echo "<script>
        popError(\"权限不足，请重新登陆\");
        </script>";
} else {
    $search_classroom = "SELECT * FROM class_applying_sys.classroom_information";
    $search_result = mysqli_query($dbc, $search_classroom);
    $line_number = mysqli_num_rows($search_result);
    $condition=array();
    $identifier=array();
    $location=array();
    $classroom_id=array();
    $manager=array();
    $column=0;
    while ($classroom_row = mysqli_fetch_array($search_result, MYSQLI_ASSOC)){
        $identifier[$column]=$classroom_row["class_identifier"];
        $condition[$column]=$classroom_row["isApplied"];
        $location[$column]=$classroom_row["location"];
        $classroom_id[$column]=$classroom_row["classroom_id"];
        $manager[$column]=$classroom_row["manager_id"];
        $column++;
    }
    for ($i = 0; $i < $line_number; $i++) {
        $search_manager = "SELECT * FROM class_applying_sys.user_information WHERE user_id=$manager[$i]";
        $search_manager_result = mysqli_query($dbc, $search_manager);
        $manager_row = mysqli_fetch_array($search_manager_result, MYSQLI_ASSOC);
        $manager_name = $manager_row["name"];
        if (!$condition) {
            echo "<div class=\"items\" id=\"$classroom_id[$i]\">
                       <div style=\"margin-left: 5px\">$identifier[$i]</div>
                       <div class=\"classRoomStatus free\"><p>FREE</p></div>
                       <div>$location[$i]</div>
                       <div>$manager_name</div>
                       <div>N/A</div>
                       <div class=\"applyButton apply-enabled\" onclick='apply($(this))'><p>Apply</p></div>
                       </div>";
        } else {
            $check_time = "SELECT * FROM class_applying_sys.applicant WHERE classroom_id=$classroom_id[$i]";
            $check_time_result = mysqli_query($dbc, $check_time);
            $get_essential_time=array();
            $get_essential_id=array();
            $check_column=0;
            while ($check_row = mysqli_fetch_array($check_time_result, MYSQLI_ASSOC)){
                $get_essential_time[$check_column]=$check_row["apply_time"];
                $get_essential_id[$check_column]=$check_row["user_id"];
                $check_column++;
            }
            for ($j = 0; $j < count($get_essential_time); $j++) {
                if ($get_essential_time[$j] == $classroom_time_requested) {
                    $get_club_name = "SELECT * FROM class_applying_sys.user_information WHERE user_id=$get_essential_id[$j]";
                    $get_club_name_result = mysqli_query($dbc, $get_club_name);
                    $club_name_row = mysqli_fetch_array($get_club_name_result, MYSQLI_ASSOC);
                    $club_name = $club_name_row["name"];
                    echo " <div class=\"items\" id=\"$classroom_id[$i]\">
        <div style=\"margin-left: 5px\">$identifier[$i]</div>
        <div class=\"classRoomStatus occupied\"><p>OCCUPIED</p></div>
        <div>$location[$i]</div>
        <div>$manager_name</div>
        <div>$club_name</div>
        <div class=\"applyButton apply-disabled\"><p>N/A</p></div>
    </div>";
                    break;
                }
            }
            echo "<div class=\"items\" id=\"$classroom_id[$i]\">
                       <div style=\"margin-left: 5px\">$identifier[$i]</div>
                       <div class=\"classRoomStatus free\"><p>FREE</p></div>
                       <div>$location[$i]</div>
                       <div>$manager_name</div>
                       <div>N/A</div>
                       <div class=\"applyButton apply-enabled\" onclick='apply($(this))'><p>Apply</p></div>
                       </div>";
        }
    }
}
?>
    </div>
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
        $('div.blocks').children('div.list').children('div').fadeIn(500)

    </script>