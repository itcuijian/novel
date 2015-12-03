
function aclick(){
	$("#screen").css("display","block");
	$("#tip").css("display", "block");
}


$("#shut").click(function(){
	$("#screen").css("display","none");
	$("#tip").css("display", "none");
});


//获取位置
(function(){
	$("#tip").css("top",(document.documentElement.clientHeight-200)/2 + 'px');
	$("#tip").css("left",(document.documentElement.clientWidth-200)/2 + 'px');
	$("#say").css("top", (document.documentElement.clientHeight-100)/2 + 'px');
	$("#say").css("left", (document.documentElement.clientWidth-100)/2 + 'px');
})();


//订阅书籍
$("#add_book").click(function(){
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4){
			if(xhr.status == 200){
				$("#screen").css("display", "block");
				$("#say").css("display", "block");
				$("#p").text(xhr.responseText);
			}
			else{
				$("#screen").css("display", "block");
				$("#say").css("display", "block");
				$("#p").text("订阅失败！");
			}
		}
	};
	var url = './ajax/bookrack.php?rand='+Math.random()+'&sid='+$("#sid").val()+'&bid='+$("#bid").val()+'&aid='+$("#aid").val();
	xhr.open('get', url, true);
	xhr.send(null);

	//计时器
	c = countTime();
});


//发表书评
$("#publish").click(function(){
	if($('#content').val() == ''){
		$("#screen").css("display", "block");
		$("#say").css("display", "block");
		$("#p").text("内容不能为空！");
	}
	else{
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function(){
			if(xhr.readyState = 4){
				if(xhr.status = 200){
					$("#screen").css("display", "block");
					$("#say").css("display", "block");
					$("#p").text(xhr.responseText);
				}
				else{
					$("#screen").css("display", "block");
					$("#say").css("display", "block");
					$("#p").text("发表失败！");
				}
			}
		};
		var url = './ajax/publish.php?rand='+Math.random()+'&content='+$('#content').val()+'&rid='+$('#aid').val()+'&attr=s'+'&oid='+$("#sid").val();
		xhr.open('get', url, true);
		xhr.send(null);
	}

	//计时器
	c= countTime();
});

//关闭弹窗
$("#sure").click(function(){
	$("#screen").css("display", "none");
	$("#say").css("display", "none");
	clearTimeout(c);
	if($("#aid").val() != ""){
		window.location.reload();
	}
});


//截取章节内容
(function(){
	var text = $("#hard").html();
	if(text != null){
		text = text.substring(0, 500);
		var num1 = text.lastIndexOf('&', 499);
		var num2 = text.lastIndexOf('<', 499);

		if(num1 > 493)
			text = text.substring(0, num1) + " . . . . . .";
		else if(num2 > 496)
			text = text.substring(0, num2) + " . . . . . .";
			text = text + " . . . . . .";

		$("#hard").html(text);
	}
})();


//计时器
function countTime(){
	return setTimeout(function(){
		$("#screen").css("display", "none");
		$("#say").css("display", "none");
		window.location.reload();
	}, 4000);
};


//右边导航栏
(function(){
	var left = $('.content').offset().left + 980;
	$('.sidebar').css('left', left + 'px');
	$(window).scroll(function(){
		var t = $(window).scrollTop() + 124;
		if(t > $('.content').height()){
			$('.sidebar').css('position', 'absolute');
			$('.sidebar').css('top', $('.content').height()-75+'px')
		}
		else if($(window).scrollTop() < 80){
			$('.sidebar').css('position', 'absolute');
			$('.sidebar').css('top', '124px');
		}
		else{
			$('.sidebar').css('position', 'fixed').css('top', '50px');
		}
	});
	
	window.onresize = function(){
		left = $('.content').offset().left + 980;
		$('.sidebar').css('left', left + 'px');
	}
	
})();
