function read(noticeItems) {
	let noticeId = noticeItems.parent().attr('id');
	$("div.content-text").load("Controller/content.php?id=" + noticeId, () => {
		$(".content-text").ready(() => {
			$(".content-text").niceScroll({
				cursorcolor: "#ccc",
				cursoropacitymax: 1,
				cursorwidth: "5px",
				cursorborder: "0",
				cursorborderradius: "5px",
				autohidemode: true,
			});
			setTimeout(() => {
				$('.content-text').niceScroll().resize();
			}, 600);
		})
	});
	popupDiv("notice-content")
}

function hideDivAndReloadNiceScroll(divId) {
	$('div[class^=nicescroll]').remove();
	$(".notice-list").niceScroll({
		cursorcolor: "#ccc",
		cursoropacitymax: 1,
		cursorwidth: "5px",
		cursorborder: "0",
		cursorborderradius: "5px",
		autohidemode: true,
	});
	setTimeout(() => {
		$('.notice-list').niceScroll().resize();
	}, 500);
	hideDiv(divId);
}