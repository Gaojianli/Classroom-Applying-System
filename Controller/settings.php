<script type="text/javascript" src="js/setting.js"></script>
<link href="css/password.css" rel="stylesheet" type="text/css" />
<div id='password-content' class="content-box pop" align="center" style="display: none;position: absolute">
    <p id="popTitle" align="center">更改密码</p>
    <div class="password-inputbox" align="center">
        <div class="inputPassword">
            <div style="min-height: 54px;" align="center">
                <input type="password" id="password" class="inputPassword" placeholder="新密码" />
            </div>
        </div>
        <div class="inputPassword">
            <div style="min-height: 54px;" align="center">
                <input type="password" id="repassword" class="inputPassword" placeholder="确认新密码" />
            </div>
            <p id="wrongPassword" style="color: red;font-size: 0.8em;">两次输入的密码不一致</p>
        </div>
    </div>
    <div align="center" class="closeButtonInline" style="margin-top:2em;">
        <div align="center" style="height:50px;margin: 20px auto;">
            <div class="closeButton-common closeButton-close" onclick="checkPassword()">
                <p>确定</p>
            </div>
            <div class="closeButton-common closeButton-apply" onclick="hideDiv('password-content')">
                <p>取消</p>
            </div>
        </div>
    </div>
</div>
<div id='email-content' class="content-box pop" align="center" style="display: none;position: absolute">
    <p id="popTitle" align="center">更改email</p>
    <div class="email-inputbox" align="center">
        <div class="inputEmail">
            <div style="min-height: 54px;" align="center">
                <input id="email" class="inputEmail" placeholder="新电子邮件地址" />
            </div>
        </div>
    </div>
    <div align="center" class="closeButtonInline" style="margin-top:3em;">
        <div align="center" style="height:50px;margin: 20px auto;">
            <div class="closeButton-common closeButton-close" onclick="postemail()">
                <p>确定</p>
            </div>
            <div class="closeButton-common closeButton-apply" onclick="hideDiv('email-content')">
                <p>取消</p>
            </div>
        </div>
    </div>
</div>
<div id='tel-content' class="content-box pop" align="center" style="display: none;position: absolute">
    <p id="popTitle" align="center">更改手机号</p>
    <div class="email-inputbox" align="center">
        <div class="inputEmail">
            <div style="min-height: 54px;" align="center">
                <input id="telNum" class="inputEmail" placeholder="新手机号" />
            </div>
        </div>
    </div>
    <div align="center" class="closeButtonInline" style="margin-top:3em;">
        <div align="center" style="height:50px;margin: 20px auto;">
            <div class="closeButton-common closeButton-close" onclick="changeTelNum()">
                <p>确定</p>
            </div>
            <div class="closeButton-common closeButton-apply" onclick="hideDiv('tel-content')">
                <p>取消</p>
            </div>
        </div>
    </div>
</div>
<div class="hidden" style="display:none;"> <br>
    <div id="user-info">
        <div class="sets" id="basic-info">
            <div><i class="fa fa-drivers-license"></i></div>
            <?php
            define("HOST", "localhost");
            define("USER", "");
            define("PASS", "");
            define("DBNAME", "class_applying_sys");
            $dbc = mysqli_connect(HOST, USER, PASS, DBNAME);
            mysqli_set_charset($dbc, 'utf8');
            $user_id=$_COOKIE["uid"];
            $get_user_information="SELECT * FROM class_applying_sys.user_information WHERE user_id=$user_id";
            $get_user_information_result=mysqli_query($dbc,$get_user_information);
            $get_user_information_row=mysqli_fetch_array($get_user_information_result,MYSQLI_ASSOC);
            $name=$get_user_information_row["name"];
            $position=$get_user_information_row["position"];
            $tel=$get_user_information_row["tel"];
            $email=$get_user_information_row["mail"];
            echo "<div>姓名</div>
            <div id=\"name-setting\">$name</div>
        </div>
        <div class=\"sets\" id=\"basic-info\">
            <div><i class=\"fa fa-graduation-cap\"></i></div>
            <div>职位</div>
            <div id=\"postion-setting\">$position</div>
        </div>
        <div class=\"sets\" id=\"tel\">
            <div><i class=\"fa fa-mobile\"></i></div>
            <div>手机号码</div>
            <div>$tel</div>
            <div class=\"changable\" onclick=\"popupDiv('tel-content')\">更改</div>
        </div>
        <div class=\"sets\" id=\"email\">
            <div><i class=\"fa fa-envelope\"></i></div>
            <div>电子邮件</div>
            <div>$email</div>
            <div class=\"changable\" onclick=\"changeEmail()\">更改</div>
        </div>
    </div>";
            ?>
    <div id="otherButtons">
        <div class="password" id="1">
            <div><i class="fa fa-key"></i></div>
            <div class="changable" onclick="changePassword()">更改密码</div>
        </div>
        <div>
            <div><i class="fa fa-comment"></i></div>
            <div class="changable" onclick="window.location.href='mailto:13540285982@msn.cn'">联系开发者</div>
        </div>
        <div>
            <div><i class='fa fa-reply'></i></div>
            <div class="changable" onClick="logout()">退出登录</div>
        </div>
    </div>
</div>
<script>$('div.blocks').children('div.settings').children('div').not('.pop').fadeIn(500)</script>