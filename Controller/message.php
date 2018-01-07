<script type="text/javascript" src="js/notice.js"></script>
<link href="css/notice.css" rel="stylesheet" type="text/css" />
<div id='notice-content'  class="content-box" align="center" style="display: none;">
    <p id="popTitle" align="center">查看全文</p>
    <div class="content-text" align="left">
    </div>
    <div class="closeButton-notice" id="closeButton">
        <p align="center" onclick="hideDivAndReloadNiceScroll('notice-content')">确定</p>
    </div>
</div>
<?php
define("HOST", "localhost");
define("USER", "");
define("PASS", "");
define("DBNAME", "class_applying_sys");
$dbc = mysqli_connect(HOST, USER, PASS, DBNAME);
mysqli_set_charset($dbc, 'utf8');
$user_id=$_COOKIE["uid"];
$search_own_message="SELECT * FROM class_applying_sys.message_list WHERE user_id=$user_id";
$search_own_message_result=mysqli_query($dbc,$search_own_message);
$real_num=mysqli_num_rows($search_own_message_result);
if($real_num==0){
    echo "<p style=\"color:white;font-size:2em;text-align:center\">没有更多通知了</p>
";
}
else {
    echo "<div class=\"hidden\" style=\"display:none;\">
        <div class=\"notice-list\">";
    $search_message_id = array();
    $search_title = array();
    $search_message_time = array();
    $count_number = 0;
    while ($search_own_message_row = mysqli_fetch_array($search_own_message_result, MYSQLI_ASSOC)) {
        $search_message_id[$count_number] = $search_own_message_row["message_id"];
        $search_title[$count_number] = $search_own_message_row["title"];
        $search_message_time[$count_number] = $search_own_message_row["message_time"];
        $count_number++;
    }
    for ($i = 0; $i<$count_number; $i++) {
        echo "

	<div class=\"notice\" id=\"$search_message_id[$i]\">
		<div class=\"notice-title\">$search_title[$i]</div>
		<div class=\"ReadButton\" onclick=\"read($(this))\">
			<p>阅读全文</p>
		</div>
		<div class=\"notice-time\"> 
			$search_message_time[$i];
		</div>
	</div>	
";
    }
    echo "</div>";
    echo "</div>";
}
?>
<script>
    $('div.blocks').children('div.notices').children('div').not('#notice-content').fadeIn(500);
    $(".notice-list").ready(() => {
            $(".notice-list").niceScroll({
                cursorcolor: "#ccc",
                cursoropacitymax: 1,
                // touchbehavior: true,
                cursorwidth: "5px",
                cursorborder: "0",
                cursorborderradius: "5px",
                autohidemode: true,
            });
            setTimeout(() => {
                $('.notice-list').niceScroll().resize();
            }, 500);
    });
</script>