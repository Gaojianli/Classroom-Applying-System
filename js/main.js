var isClicked = false; //判断blocks是否已经被点击
var formerHeight;
var isActived;
$(document).ready(function() {
    popupDiv('loading-div');
})

$("footer").ready(function() {
    setFooterPosition();
    setBlockWidth();
    formerHeight = parseInt($("div.blocks").children("i").css("fontSize"));
    queryToken(function() {
        $("title").html("Welcome! " + user.name + " —Bupt Classroom Applying System of SAU");
        switch (user.level) {
            case "0":
                setAdmin();
                break;
            case "1":
                setLevelOne();
                break;
            case "2":
                setLevelTwo();
                break;
            case "3":
                setLevelThree();
                break;
            default:
                //$("#errorReason").text("未知错误!");
                break;
        }
    });
    inital();
    hideDiv("loading-div");
});
//初始化样式和触发器设定
function inital() {
    $("div.main").ready(function() {
        $("div.main>div").css("padding-left", 0.8 * ($("body").width() - 2 * $("div.blocks").width()) / 2);
    });
    $("div.blocks").mouseenter(function() {
        setOtherBlocksInital.call();
        if (user.level != "2" || (user.level === "2" && $(this).attr("id") != "blocks2")) { // && $(this).children("i").css("fontSize") == "16px") {
            if (isClicked == false) {
                $(this).children("p").fadeOut();
                $(this).css("borderColor", "white");
                $(this).children().filter("i").animate({
                    fontSize: (formerHeight + 30) + "px"
                }, 300);
                $(this).children().filter("h1").animate({
                    fontSize: (formerHeight * 3 + 30) + "px"
                }, 300);
                //				$(this).children().not("p").animate({
                //						fontSize: "+=30px"
                //					},
                //					300);
            }
        }

    });
    $("div.blocks").mouseleave(function() {
        if (user.level != "2" || (user.level === "2" && $(this).attr("id") != "blocks2")) { // && $(this).children("i").css("fontSize") == "46px") {
            if (isClicked == false) {
                $(this).children("p").fadeIn();
                $(this).css("borderColor", $(this).css("backgroundColor"));
                $(this).children().filter("i").animate({
                    fontSize: (formerHeight) + "px"
                }, 300);
                $(this).children().filter("h1").animate({
                    fontSize: (formerHeight * 3) + "px"
                }, 300);
                //				$(this).children().not("p").animate({
                //						fontSize: "-=30px"
                //					},
                //					300);
            }
        };
    });

    function setOtherBlocksInital() {
        if ($("div.blocks").not(this).children("p").css("fontsize") == "46px") {
            $(this).children("p").fadeIn();
            $(this).css("borderColor", $(this).css("backgroundColor"));
            $(this).children().not("p").animate({
                    fontSize: "-=30px"
                },
                300);
        }
    }
    $("div.blocks").css("height", (170 / 783) * $(window).height());
}
$(window).resize(function() {
    setFooterPosition();
    setBlockWidth();
    $("div.main>div").css("padding-left", 0.8 * ($("body").width() - 2 * $("div.blocks").width()) / 2);
    isActived.css({
        height: 0.6 * $(window).height(),
        width: 0.65 * $(window).width()
    });
});

function setFooterPosition() {
    $("footer").css("left", ($(document).width() - $("footer").width()) / 2);
};

function setBlockWidth() {
    $("div.blocks").css("width", 0.3 * $(window).width());
}

function setAdmin() {
    $("#blocks3").children("i").removeClass("fa-check").addClass("fa-user");
    $("#blocks3").children("h1").text("管理");
    if (user.applicant === "0") {
        $("#blocks3").children("p").text("目前没有待处理的申请");
    } else {
        $("#blocks3").children("p").text("共有" + user.applicant + "个待处理申请");
    }
    if (user.notice == "0") {
        $("#blocks1").children("p").text("暂无未读通知");
    } else {
        $("#blocks1").children("p").text("你有" + user.notice + "条未读通知");
    }
    getEmptyClassroom();
}

function setLevelOne() {
    $("#blocks3").children("h1").text("审批");
    if (user.applicant === "0") {
        $("#blocks3").children("p").text("目前没有待处理的申请");
    } else {
        $("#blocks3").children("p").text("共有" + user.applicant + "个待处理申请");
    }
    if (user.notice == "0") {
        $("#blocks1").children("p").text("暂无未读通知");
    } else {
        $("#blocks1").children("p").text("你有" + user.notice + "条未读通知");
    }
    getEmptyClassroom();
}

function setLevelTwo() {
    $("#blocks3").children("h1").text("任务");
    if (user.applicant === "0") {
        $("#blocks3").children("p").text("目前没有开门请求");
    } else {
        $("#blocks3").children("p").text("你一共有" + user.applicant + "个开门请求");
    }
    if (user.notice == "0") {
        $("#blocks1").children("p").text("暂无未读通知");
    } else {
        $("#blocks1").children("p").text("你有" + user.notice + "条未读通知");
    }
    $("#blocks2").addClass("disabled");
    $("#blocks2").css({
        backgroundColor: "#787D7B",
        borderColor: "#787D7B",
    });
    $("#blocks2").children("i").removeClass("fa-university").addClass("fa-close");
    $("#blocks2").children("p").text("你没有权限查看");
    $("#blocks2").children("h1").text("不可用");
}

function setLevelThree() {
    if (user.applicant === "0") {
        $("#blocks3").children("p").text("目前没有待通过的申请");
    } else {
        $("#blocks3").children("p").text("你有" + user.applicant + "个申请待处理");
    }
    if (user.notice == "0") {
        $("#blocks1").children("p").text("暂无未读通知");
    } else {
        $("#blocks1").children("p").text("你有" + user.notice + "条未读通知");
    }
    getEmptyClassroom();
}

function getEmptyClassroom() {
    if (user.emClass == "0") {
        $("#blocks2").children("p").text("目前没有可用的教室");
        $("#blocks2").addClass("disabled");
        $("#blocks2").css({
            backgroundColor: "#787D7B",
            borderColor: "#787D7B",
        });
    } else {
        $("#blocks2").children("p").text("目前剩余" + user.emClass + "间教室/活动室可申请");
    }
}
$("div.blocks").click(function() {
    isActived = $(this);
    if ($(this).hasClass("disabled")) {
        console.log("Permission denied. You have no right to access this list");
    } else {
        if (isClicked == false) {
            $(this).mouseenter();
            $(this).children("h1,p").hide();
            $("i,h1").hide();
            $(this).removeClass("blocks-ori");
            $("div.blocks").not(this).children().hide();
            $("div.disabled").children().hide();
            $("div.disabled").not(this).hide(500);
            $("div.blocks").not(this).hide(500);
            $(this).animate({
                height: 0.6 * $(window).height(),
                width: 0.65 * $(window).width()
            });
            $(this).css("borderColor", $(this).css("backgroundColor"));
            $(this).align = "center";
            $(this).children("h1").animate({
                fontSize: "-=30px"
            }, 0).fadeIn(500).html("<i></i>" + $(this).children("h1").text());
            $("div.main").animate({
                paddingTop: "-=5%",
            }, 200);
            $(this).children("h1").children("i").addClass($(this).children("i").attr("class"));
            $(this).prepend("<div><i></i></div>");
            $(this).children("div").first().addClass("arrow");
            $(this).children("div").first().children("i").addClass("fa fa-arrow-left");
            if ($(this).attr("id") == "blocks2") { //判断是否为教室块
                // $(this).load("Controller/check.html");
                $(this).append("<div></div>");
                $(this).children("div").last().addClass("list"); //添加div及元素
                let timeDefault = Math.round(new Date().getTime() / 1000) + 3600 * 24 * 7;
                $(this).children("div.list").load("Controller/list.php?time=" + timeDefault);
                $(this).children("div.list").before("<div></div>");
                $(this).children("div.list").prev().addClass("classroom-time-check-head");
                $(this).children("div.classroom-time-check-head").load("Controller/check.html").css("display", "none");
                //setTimeout("$('div.blocks').children('div.list').children('div').fadeIn(500)", 600);
            } else if ($(this).attr("id") == "blocks4") { //判断是否为设置块
                $(this).append("<div></div>");
                $(this).children("div").last().addClass("settings"); //添加div及元素
                $(this).children("div.settings").load("Controller/settings.php");
                $('div.blocks').children('div.settings').children("div>div>div.sets").children("#name-setting").text(user.name);
                $('div.blocks').children('div.settings').children("div>div>div.sets").children("#name-postion").text(user.postion);
                //setTimeout("$('div.blocks').children('div.settings').children('div').not('.pop').fadeIn(500)", 600);
            } else if ($(this).attr("id") == "blocks1") { //判断是否为通知块
                $(this).append("<div></div>");
                $(this).children("div").last().addClass("notices"); //添加div及元素
                $(this).children("div.notices").load("Controller/message.php");
                //setTimeout("$('div.blocks').children('div.notices').children('div').not('#notice-content').fadeIn(500)", 1000);
            } else if ($(this).attr("id") == "blocks3") { //判断是否为申请/审批块
                $(this).append("<div></div>");
                $(this).children("div").last().addClass("apply"); //添加div及元素
                $(this).children("div.apply").load("Controller/apply_list.php");
                //setTimeout("$('div.blocks').children('div.apply').children('div').not('#apply-content').fadeIn(500)", 800);

            }
        }
        isClicked = true;
        $("div.arrow").attr("onclick", "clickArrow();");
    }
});

function reLoadThisList(time) {
    isActived.children("div.list").fadeOut(200, () => {
        $("div.arrow").parent().children("div.list").remove();
        isActived.append("<div></div>");
        isActived.children("div").last().addClass("list"); //添加div及元素
        isActived.children("div.list").load("Controller/list.php?time=" + time, () => {
            console.log(12);
            isActived.children("div.list").children('div').fadeIn(500);
        });

    });

}

function clickArrow() {
    isActived = null;
    $('div[class^=nicescroll]').remove(); //移除之前画的所有进度条
    $("div.arrow").parent().children("div.classroom-time-check-head").remove();
    $("div.arrow").parent().children("div.list").remove();
    $("div.arrow").parent().children("div.settings").remove();
    $("div.arrow").parent().children("div.notices").remove();
    $("div.arrow").parent().children("div.apply").remove();
    $("div.arrow").parent().animate({
        height: $("div.blocks").not($("div.arrow").parent()).height(), //0.2165 * $(window).height(),
        width: $("div.blocks").not($("div.arrow").parent()).width() //0.3020 * $(window).width()
    }, (500));
    $("div.blocks").show(500);
    $("div.arrow").next("i").animate({
            fontSize: "-=30px"
        },
        0);
    $("div.arrow").parent().css("borderColor", "white");
    $("div.arrow").parent().children().not("p").animate({
            fontSize: "+=30px"
        },
        300);
    $("div.arrow").parent().addClass("blocks-ori");
    $("div.blocks>p").not($("div.arrow").parent().children("p")).fadeIn();
    let blocksToClicked = $('div.arrow').parent();
    $("div.arrow").remove();
    $("h1>i").remove();
    $("i,h1").show();
    $("div.blocks").children().filter("i").animate({
        fontSize: (formerHeight) + "px"
    }, 300);
    $("div.blocks").children().filter("h1").animate({
        fontSize: (formerHeight * 3) + "px"
    }, 300);
    $("div.blocks").children("p").fadeIn();
    blocksToClicked.css('borderColor', blocksToClicked.css('backgroundColor'));
    setTimeout("isClicked=false", 500);
};