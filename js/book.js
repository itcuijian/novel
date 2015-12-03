//加入书架
$("#addbook").click(function(){
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4){
			if(xhr.status == 200){
				$("#screen").css("display", "block");
				$("#tip").css("display", "block");
				$("#p").text(xhr.responseText);
			}
			else{
				$("#screen").css("display", "block");
				$("#tip").css("display", "block");
				$("#p").text("添加失败！");
			}
		}
	};
	var url = './ajax/bookrack.php?rand='+Math.random()+'&sid='+$("#sid").val()+'&bid='+$("#bid").val()+'&aid='+$("#aid").val();
	xhr.open('get', url, true);
	xhr.send(null);

	t = countTime();
});

//发表书评
$("#publish").click(function(){
	if($('#content').val() == ''){
		$("#screen").css("display", "block");
		$("#tip").css("display", "block");
		$("#p").text("内容不能为空！");
	}
	else{
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function(){
			if(xhr.readyState = 4){
				if(xhr.status = 200){
					$("#screen").css("display", "block");
					$("#tip").css("display", "block");
					$("#p").text(xhr.responseText);
				}
				else{
					$("#screen").css("display", "block");
					$("#tip").css("display", "block");
					$("#p").text("发表失败！");
				}
			}
		};
		var url = './ajax/publish.php?rand='+Math.random()+'&content='+$('#content').val()+'&rid='+$('#aid').val()+'&attr=b'+'&oid='+$("#bid").val();
		xhr.open('get', url, true);
		xhr.send(null);
	}

	//计时器
	t = countTime();
});

//关闭弹窗
$("#sure").click(function(){
	$("#screen").css("display", "none");
	$("#tip").css("display", "none");
	if($("#aid").val() != ""){
		window.location.reload();
	}

	clearTimeout(t);
});

//获取位置
(function(){
	$("#tip").css("top", (document.documentElement.clientHeight-100)/2 + 'px');
	$("#tip").css("left", (document.documentElement.clientWidth-100)/2 + 'px');
})();

//计时器
function countTime(){
	return setTimeout(function(){
		$("#screen").css("display", "none");
		$("#tip").css("display", "none");
		window.location.reload();
	}, 4000);
};
