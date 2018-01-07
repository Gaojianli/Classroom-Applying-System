$("footer").ready(function() {
	setFooterPosition();
});
$(window).resize(function() {
	setFooterPosition();
});
function setFooterPosition(){
	$("footer").css("left",($(document).width()-$("footer").width())/2);
};
$("footer").ready(function() {
	$(".inputBox").css("padding-left",0.7*($(".inputBox").width()-($("#username").width()+$(".logo2").width()))/2);
});
var setBack=function(){
	$(".loginButton").css("backgroundColor","#39B54A");
	$("div.loginButton>p").text("登录");
}
function login(userID, password){
	"use strict";
	var salt1 = "dkhugfuywt278q123$%^&^$";
	var salt2 = userID + "234323afsa";
	password = md5(password + salt1);
	password = md5(salt2 + salt1 + password + salt2 + "214231sdkfgewg");
	$.post("Controller/login.php", {
			uid: userID,
			passwd: password,
		},
		function (data, status) {
			if (data === "1") {
				popError("密码错误，请重新检查！");
				setBack();
			}
			else if (data==="0") {
				window.location.href="/cas"; 
			}
			else if (data=="2") {
				popError("用户名不存在，请重新检查！");
				setBack();
			}
			else if(data==="3"){
				popError("未知错误");
				setBack();
			}
			else if (status=="failed") {
				popError("网络错误");
			}
		});
};
$("input").bind('keyup', function(event) {
        if (event.keyCode == "13") {
            $(".loginButton").click();
        }
    });
$("#closeButton").click(function() {
	hideDiv('pop-div');
});
$(".loginButton").click(function() {
			let username=$("#username").val();
			let passwd=$("#password").val();
			if(username==null||username==undefined||username==""){
				popError("请输入用户名！")
			}else if (passwd==null||passwd==undefined||passwd==""){
				popError("请输入密码！");
			}else
			{
				$(".loginButton").css("backgroundColor","#36563C");
				$(this).children().text("登录中...");
				login(username,passwd);
			}
		});