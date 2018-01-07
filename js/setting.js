function logout() {
    $.get("Controller/logout.php", function(result) {
        if (result === "0") {
            window.location.href = "/cas";
        } else {
            popError("未知错误");
        }
    });
}

function changePassword() {
    popupDiv("password-content");
    $("#wrongPassword").hide();
}

function checkPassword() {
    var pwd = $("#password").val();
    var rpwd = $("#repassword").val();
    if (pwd == null) {
        $("wrongPassword").text("输入密码不能为空");
        $("#wrongPassword").show();
        return;
    } else if (pwd == rpwd && pwd != " ") {
        $.post("Controller/changePassword.php", { password: pwd });
        notification();
        hideDiv('password-content');
    } else {
        $("wrongPassword").text("两次输入密码不一致");
        $("#wrongPassword").show();
    }
}

function changeEmail() {
    popupDiv("email-content")
}

function postemail() {
    var newem = $("#email").val();
    $.post("Controller/changeEmail.php", { email: newem });
    notification();
    hideDiv('email-content');
}

function changeTelNum() {
    let newTelNum = $("#telNum").val();
    $.post("Controller/changeTel.php", { tel: newTelNum });
    notification();
    hideDiv('tel-content');
}

function notification() {
    $("body").before(`
    <div class="head-flag">
        <div class="head-flag-text">修改成功</div>
        <div class="head-flag-btn allown">确定</div>
    </div>
    `);
    $(".head-flag").css("display", "block");
    setTimeout(() => { $(".head-flag").addClass("head-flag-show"); }, 20);
    $(".head-flag-btn.allown").click(() => {
        $(".head-flag").removeClass("head-flag-show");
        setTimeout(() => {
            $(".head-flag").remove();
        }, 500)
    });
}