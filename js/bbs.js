window.onload=function(){
	//用户信息展示
	(function(){
		if($(".user").length !== 0){
			var x = $(".user").offset().top + 50;
			var y = $(".user").offset().left - 1;
			$(".userinfo").css("top", x + 'px').css("left", y + "px");
			$('.user').mouseover(function(){
				$('.user').css('background','#fff');
				$('.userinfo').css('display','block');
			});

			$('.user').mouseout(function(){
				$('.user').css('background','#019c73');
				$('.userinfo').css('display','none');
			});

			$('.userinfo').mouseover(function(){
				$('.user').css('background','#fff');
				$('.userinfo').css('display','block');
			});

			$('.userinfo').mouseout(function(){
				$('.user').css('background','#019c73');
				$('.userinfo').css('display','none');
			});
		}
	})();
	

	//用户登录
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

			var x = $(".user").offset().top + 50;
			var y = $(".user").offset().left - 1;
			$(".userinfo").css("top", x + 'px').css("left", y + "px");
		}
	})();

};

//关闭弹窗
$(".closes").click(function(){
		$("#login").fadeOut(100);    //淡出元素
		$("#screen").css("display","none");
});


//弹出登录窗口
$(".denglu").click(function(){
		$("#screen").css("display","block");
		$("#login").fadeIn(200);     //淡入元素
});


//检验表单
function checkForm(){
	var title = $("#title").val();
	var editor = CKEDITOR.instances.text1;
	var content = editor.getData();
	if(title.length > 80){
		alert("标题不能超过80个字！！");
		$("#title").focus();
		return false;
	}
	if(title == ""){
		alert("标题不能为空！！");
		$("#title").focus();
		return false;
	}
	if(content.length == 0){
		alert("内容不能为空！！");
		editor.focus();
		return false;
	}

	return true;	
}



