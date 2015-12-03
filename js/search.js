(function(){
	var option = $('#select').children('option');
	for(var i=0;i<option.length;i++){
		if(option[i].value == $('#type').val()){
			option[i].setAttribute('selected', 'selected');
		}
	}
})();

$('.rack').click(function(){
	var div = $(this).parent();
	var input = $(div).children('input');
	var bid = input[0].value;
	var sid = input[1].value;
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
	var url = './ajax/bookrack.php?rand='+Math.random()+'&sid='+sid+'&bid='+bid+'&aid='+$("#rid").val();
	xhr.open('get', url, true);
	xhr.send(null);
});


//关闭弹窗
$("#sure").click(function(){
	$("#screen").css("display", "none");
	$("#tip").css("display", "none");
});


//获取位置
(function(){
	$("#tip").css("top", (document.documentElement.clientHeight-100)/2 + 'px');
	$("#tip").css("left", (document.documentElement.clientWidth-100)/2 + 'px');
})();
