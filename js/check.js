var day = "";
var time = "";
var timelist = {
    01: "08:00-08:50",
    02: "09:00-09:50",
    03: "10:00-10:50",
    04: "11:00-11:50",
    05: "13:30-14:20",
    06: "14:30-15:20",
    07: "15:30-16:20",
    08: "16:30-17:20",
    09: "17:30-18:20",
    10: "18:30-19:20",
    11: "19:30-20:20",
    12: "20:30-21:20"
};
var allownClass = {
    1: ["9-12", "(一)"],
    2: ["9-12", "(二)"],
    3: ["9-12", "(三)"],
    4: ["9-12", "(四)"],
    5: ["9-12", "(五)"],
    6: ["1-12", "(六)"],
    0: ["", "(日)"]
};
var thisTime = Math.round(new Date().getTime() / 1000);
// 时间戳获取
function human2unix(n, y, r, s, f, m) {
    var a = new Date(Date.UTC(
        n,
        (stripLeadingZeroes(y) - 1),
        stripLeadingZeroes(r),
        stripLeadingZeroes(s),
        stripLeadingZeroes(f),
        stripLeadingZeroes(m)
    ));
    return a.getTime() / 1000 - 8 * 60 * 60
}

function stripLeadingZeroes(a) {
    if ((a.length > 1) && (a.substr(0, 1) == "0")) {
        return a.substr(1);
    } else {
        return a;
    }
}
$(".li-3").ready(() => {
    day = $(".li-1").children("label").html() == "选择日期" ? "" : $(".li-1").children("label").html();
    time = $(".li-2").children("label").html() == "选择时间" ? "" : $(".li-1").children("label").html();
    setTimeout(() => {
        $('div.classroom-time-check-head').fadeIn(500);
    }, 600);
    // 自动加载下一周日期
    // 自动加载最近两周时间
    setWeek();
    document.styleSheets[0].addRule("#weekday-check:checked~.week", "height: calc(20px*" + $(".li-1").children(".check-list").children("div").length + ")");
    document.styleSheets[0].addRule("#time-check:checked~.time", "height: calc(20px*" + $(".li-2").children(".check-list").children("div").length + ")");
})

function setWeek() {
    var UTCTime = new Date();
    UTCTime.setTime(UTCTime.getTime() + 8 * 60 * 60 * 1000);
    UTCTime.setTime(UTCTime.getTime() - (UTCTime.getDay() == 0 ? 7 : UTCTime.getDay() - 1) * 24 * 60 * 60 * 1000);
    console.log(UTCTime.toDateString());
    switch (isActived.attr("id")) {
        case "blocks2":
            {
                var i = 13;
                var b = 7;
            }
            break;
        case "blocks3":
            {
                var i = 13;
                var b = 7;
            }
            break;
        default:
            break;
    }
    for (; b <= i; i--) {
        let TCTime = new Date();
        TCTime.setTime(UTCTime.getTime() + i * 24 * 60 * 60 * 1000);
        $(".week").append("<div class='check-lo' timelist='" + allownClass[(i + 1) % 7][0] + "' onclick='setDay(this)'>" + TCTime.getFullYear() + "-" + (parseInt(TCTime.getMonth()) + 1) + "-" + TCTime.getDate() + " " + allownClass[(i + 1) % 7][1] + "</div>")
    }

}
$(".check-list").niceScroll({
    cursorcolor: "#ccc",
    cursoropacitymax: 1,
    // touchbehavior: true,
    cursorwidth: "5px",
    cursorborder: "0",
    cursorborderradius: "5px",
    autohidemode: true,

});
$('.check-list').niceScroll().resize();
jQuery.fn.shake = function(intShakes /*Amount of shakes*/ , intDistance /*Shake distance*/ , intDuration /*Time duration*/ ) {
        this.each(function() {
            var jqNode = $(this);
            var left = parseInt(jqNode.css("marginLeft"));
            // jqNode.css({ position: 'relative' });
            for (var x = 1; x <= intShakes; x++) {
                jqNode.animate({ marginLeft: (left + intDistance * -1) }, (((intDuration / intShakes) / 4)))
                    .animate({ marginLeft: left + intDistance }, ((intDuration / intShakes) / 2))
                    .animate({ marginLeft: left }, (((intDuration / intShakes) / 4)));
            }
        });
        return this;
    }
    // 定义两个选择
function setDay(obj) {
    day = $(obj).html();
    $(".li-1").css("backgroundColor", "rgba(255, 255, 255, .5)").children("label").css("color", "black").html(day);
    $("#weekday-check").click();
    $(".time").html("");
    this.begin = parseInt($(obj).attr("timelist").split("-")[0]);
    this.end = parseInt($(obj).attr("timelist").split("-")[1]);
    for (let i = 0; i <= this.end - this.begin; i++) {
        $(".time").append("<div class='check-lo' onclick='setTime(" + (this.begin + i) + ")'>" + timelist[this.begin + i] + "</div>");
    }
    document.styleSheets[0].addRule("#time-check:checked~.time", "height: calc(20px*" + $(".li-2").children(".check-list").children("div").length + ")");
    $(".check-list").niceScroll({
        cursorcolor: "#ccc",
        cursoropacitymax: 1,
        touchbehavior: true,
        cursorwidth: "5px",
        cursorborder: "0",
        cursorborderradius: "5px",
        autohidemode: true,
        //cursorminheight: 20 * $(".li-2").children(".check-list").children("div").length > 140 ? 140 : 20 * $(".li-2").children(".check-list").children("div").length
    });
    if (time >= this.begin) {} else {
        console.log(this.end);
        console.log(this.begin);
        $(".li-2").css("backgroundColor", "rgba(255, 255, 255, .5)").children("label").css("color", "black").html("选择时间");
        time = 0;
    }
}

function setTime(i) {
    time = i;
    $(".li-2").css("backgroundColor", "rgba(255, 255, 255, .5)").children("label").css("color", "black").html(timelist[time]);
    $("#time-check").click();
}
// 滚动条刷新
$(".check-li").children("label").click(() => {
        setTimeout(() => {
            $('.check-list').niceScroll().resize();
        }, 500);
    })
    // 重载这一页
function reloadThis() {
    if (day && time) {
        thisTime = human2unix(
            day.split(" ")[0].split("-")[0],
            day.split(" ")[0].split("-")[1],
            day.split(" ")[0].split("-")[2],
            timelist[time].split("-")[0].split(":")[0],
            timelist[time].split("-")[0].split(":")[1], 0
        )
        this.reLoadThisList(thisTime)
    } else {
        if (day) {
            $(".li-2").shake(2, 10, 400).css("backgroundColor", "rgb(252, 159, 77)").children("label").css("color", "rgb(255, 255, 255)").html("请选择");
        } else {
            $(".li-1").shake(2, 10, 400).css("backgroundColor", "rgb(252, 159, 77)").children("label").css("color", "rgb(255, 255, 255)").html("请选择");
        }
    }
}

function apply(classroom) {
    let c_id = classroom.parent().attr("id");
    $.post('Controller/apply.php', {
        classroomId: c_id,
        time: thisTime,
    }, function(data) {
        if (data == "0") {
            popSucceed("成功");
        } else {
            popError("出错");
        }
    });
}