var user = new Object();
function queryToken(callback) {
	$.post("Controller/query.php", function(backStream) {
		if (isJSON(backStream)) {
			var data = eval("(" + backStream + ")");
			if (data.status == "1") {
				$.get("Controller/logout.php");
				popupDiv('pop-div');
				$("#errorReason").text("令牌无效，请重新登录！")
			} else if (data.status == "0") {
				for (var props in data) {
					user[props] = data[props];
				}
			}
			callback.call();
		} else {
			popupDiv('pop-div');
			$("#errorReason").text("未知错误!");
		}
	});
}

function isJSON(str) {
	if (typeof str == 'string') {
		try {
			var obj = JSON.parse(str);
			if (str.indexOf('{') > -1) {
				return true;
			} else {
				return false;
			}

		} catch (e) {
			console.log(e);
			return false;
		}
	}
	return false;
}