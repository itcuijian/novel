(function(){
	//用户模块
	if(typeof $("#userf").offset() != 'undefined'){
		var x = $("#userf").offset().top + 49;
		var y = $("#userf").offset().left - 1;
		$("#userinfo").css("top", x + 'px').css("left", y + "px");
	}
	$('#userf').mouseover(function(){
			$('#userf').css('background','#fff');
			$('#userinfo').css('display','block');
		});
	$('#userf').mouseout(function(){
		$('#userf').css('background','#2a2a2a');
		$('#userinfo').css('display','none');
	});

	$('#userinfo').mouseover(function(){
		$('#userf').css('background','#fff');
		$('#userinfo').css('display','block');
	});

	$('#userinfo').mouseout(function(){
		$('#userf').css('background','#2a2a2a');
		$('#userinfo').css('display','none');
	});
})();

//弹出登录窗口
$(".denglu").click(function(){
	$("#screen").css("display","block");
	$("#login").fadeIn(200);     //淡入元素
});

//关闭弹窗
$(".closes").click(function(){
	$("#login").fadeOut(100);    //淡出元素
	$("#screen").css("display","none");
});

(function(){
	var top = (document.documentElement.clientHeight - 350) / 2;
	var left = (document.documentElement.clientWidth - 470) / 2;

	$("#screen").width(document.documentElement.clientWidth);
	$("#screen").height(document.documentElement.clientHeight);

	
	$("#login").css("top",top+'px').css("left",left+'px');

	window.onresize = function(){
		var top = (document.documentElement.clientHeight - 350) / 2;
		var left = (document.documentElement.clientWidth - 470) / 2;

		$("#screen").width(document.documentElement.clientWidth);
		$("#screen").height(document.documentElement.clientHeight);

		
		$("#login").css("top",top+'px').css("left",left+'px');

		var top1 = (document.documentElement.clientHeight - 200)/2;
		var left1 = (document.documentElement.clientWidth - 200)/2;
		$("#tip").css("top",top1+'px').css("left",left1+'px');

		if(typeof $("#userf").offset() != 'undefined'){
			var x = $("#userf").offset().top + 49;
			var y = $("#userf").offset().left - 1;
			$("#userinfo").css("top", x + 'px').css("left", y + "px");
		}

	};
})();