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
    $('.list-body').niceScroll().resize();
});

function cancel(apply) {
    let apply_id = apply.parent().attr("id");
    reCertification(() => {
        $.post("Controller/delete.php", {
                id: apply_id,
            })
            // apply.parent().css("max-height", apply.parent().height()+"px");
        apply.parent().addClass("items-remove");
        setTimeout(() => { apply.parent().remove(); }, 500);

    });
};

function checkout(apply) {
    let apply_id = apply.parent().attr("id");
    $.post("Controller/checkout.php", {
        id: apply_id,
        status: "0",
    });
    apply.parent().children(".classRoomStatus").removeClass("waitting").addClass("free").children("p").html("已通过");
    apply.attr("onclick", "").prev().attr("onclick", "");
    setTimeout(() => {
        apply.parent().addClass("items-remove");
        setTimeout(() => { apply.parent().remove(); }, 500);
    }, 300);
};

function call(apply) {
    let apply_id = apply.parent().parent().attr("id");
    $.post("Controller/call.php", {
        id: apply_id,
    });
};
var napply;

function reject(noticeItems) {
    napply = noticeItems;
    let noticeId = noticeItems.parent().attr('id');
    // $("div.content-text").load("Controller/content.html?id="+noticeId);
    popupDiv("apply-content")
    $(".closeButton-common.closeButton-apply").attr("onclick", "realReject(" + noticeId + ")")
}

function realReject(params) {
    $.post("Controller/checkout.php", {
        id: params,
        status: "1" + $("#refuseBecuse").val(),
    })
    hideDiv('apply-content');
    napply.parent().children(".classRoomStatus").removeClass("waitting").addClass("refuse").children("p").html("已驳回");
    setTimeout(() => {
        napply.parent().addClass("items-remove");
        setTimeout(() => { napply.parent().remove(); }, 500);
    }, 800);
}

function reCertification(ifAllown, ifCancel = () => {}) {
    $("body").before(`
        <div class="head-flag">
            <div class="head-flag-text">该操作无法撤销，请确定是否继续。</div>
            <div class="head-flag-btn cancel">取消</div>
            <div class="head-flag-btn allown">执行</div>
        </div>
        
    `);
    $(".head-flag").css("display", "block");
    setTimeout(() => { $(".head-flag").addClass("head-flag-show"); }, 20);
    $(".head-flag-btn.allown").click(() => {
        ifAllown();
        $(".head-flag").removeClass("head-flag-show");
        setTimeout(() => {
            $(".head-flag").remove();
        }, 500)
    });
    $(".head-flag-btn.cancel").click(() => {
        ifCancel();
        $(".head-flag").removeClass("head-flag-show");
        setTimeout(() => {
            $(".head-flag").remove();
        }, 500)
    });
};