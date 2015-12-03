window.onload=function(){
	//性别
	(function(){
		if($("#sex1").val() == $("#radio1").val())
			$("#radio1").attr("checked", "checked");
		if($("#sex1").val() == $("#radio2").val())
			$("#radio2").attr("checked", "checked");
	})();
	

	//左边导航栏
	(function(){
		var li= $("#ulmenu li");
		var a = li.children("a");
		for(i=0;i<a.length;i++){
			if(String(window.location).indexOf(a[i].href) > -1){
				$("#ulmenu").children("li").attr("class", "");
				li[i].className="active";
			}
		}
	})();
	

	//导航栏与内容模块等高
	(function(){
		if($(".menu").outerHeight() < $(".mymain").outerHeight(true)){
			$(".menu").css("position", "absolute");
			$(".bottom").css("position", "relative");
		}
	})();
	
};


//上传插件初始化
$(function(){
	$("#uploads").uploadify({
		'auto'				: true,
		'multi'				: false,
		'uploadLimit'		: 10,
		'buttonText'		: '请选择图片',
		'height'			: 30,
		'width'				: 100,
		'removeCompleted'	: false,
		'fileObjName'       : "Filedata",
		'method'            : 'post',
		'swf'				: 'uploadify/uploadify.swf',
		'uploader'			: 'uploadify/uploadify.php',
		'fileTypeExts'		: '*.gif; *.jpg; *.jpeg; *.png;',
		'fileSizeLimit'		: '1024KB',
		'onUploadSuccess'   : function(file, data, response) {
			var msg = $.parseJSON(data);
			if( msg.result_code == 1 ){
				$("#face").attr("value",msg.result_des);
				$("#element_id").attr("src",msg.result_des);
				$(".preview").attr("src",msg.result_des);
				$(".preview").css("display","block");
				changImg();
				$('#element_id').Jcrop({
									    setSelect: [0,0,120,120],
									    aspectRatio: 1,
									    onChange: updatePreview,
										onSelect: updatePreview,
									    onSelect: updateCoords
									  });

			}
			else if(msg.result_code == 101)
				{$("#text").val(msg.result_des);}
			else
				{
					alert("shangchuanshibai");
				}
		}
})
});


function changImg(){
	$("#element_id").on("load",function(){
        var w = $(this).width();
        var h = $(this).height();
        if(w > h){
		x = 300 / w;
		w = 300;
		h = x*h;
		$("#p").attr("value", 1 / x);
		$("#element_id").css("width", w + "px").css("height", h + "px");
		$(".pic1").css("padding-top", Math.round((300 - h)/2 + 2) + "px");
	}
	else if(h > w){
		x = 300 / h;
		h = 300;
		w = x*w;
		$("#p").attr("value", 1 / x);
		$("#element_id").css("width", w + "px").css("height", h + "px");
		$(".pic1").css("padding-left", Math.round((300 - w)/2 + 2) + "px");
	}
    });
};


  
function updateCoords(c){
  $('#x').val(c.x);
  $('#y').val(c.y);
  $('#w').val(c.w);
  $('#h').val(c.h);
};

  
function checkCoords(){
  if (parseInt($('#w').val())) {
    return true;
  };
  alert('请先选择要裁剪的区域后，再提交。');
  return false;
};

//缩略图,120px和60像素的
function updatePreview(c){
	boundx = $("#element_id").width();
	boundy = $("#element_id").height();
		if (parseInt(c.w) > 0){
			var rx = 120 / c.w;
			var ry = 120 / c.h;
			$('#preview').css({
				width: Math.round(rx * boundx) + 'px',
            	height: Math.round(ry * boundy) + 'px',
            	marginLeft: '-' + Math.round(rx * c.x) + 'px',
            	marginTop: '-' + Math.round(ry * c.y) + 'px'
			});
		}
		{
			var rx = 60 / c.w;
			var ry = 60 / c.h;
			$('#preview2').css({
            	width: Math.round(rx * boundx) + 'px',
            	height: Math.round(ry * boundy) + 'px',
            	marginLeft: '-' + Math.round(rx * c.x) + 'px',
            	marginTop: '-' + Math.round(ry * c.y) + 'px'
			});
		}
};


//移出书架
$(".delete").click(function(){
	var span = $(this).parent();
	var input = span.children("input");
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
				$("#p").text("移出失败！");
			}
		}
	};
	var url = './ajax/bookrack.php?rand='+Math.random()+"&action=delete"+'&rid='+$("#rid").val()+'&bid='+input[0].value;
	xhr.open('get', url, true);
	xhr.send(null);

	//计时器
	countTime();
	
});

//删除评论
$(".delcomment").click(function(){
	var div = $(this).parent();
	var input = div.children('input');
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
				$("#p").text('删除失败！');
			}
		}
	};
	var url = './ajax/comment.php?rand='+Math.round()+'&id='+input[0].value;
	xhr.open('get', url, true);
	xhr.send(null);

	//计时器
	countTime();
});


//删除帖子
$(".delbbs").click(function(){
	var li = $(this).parent();
	var input = li.children('input');
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
				$("#p").text('删除失败！');
			}
		}
	};
	var url = './ajax/bbs.php?rand='+Math.random()+'&id='+input[0].value;
	xhr.open('get', url, true);
	xhr.send(null);

	//计时器
	countTime();
});


//关闭弹出框
$("#sure").click(function(){
	$("#screen").css("display", "none");
	$("#tip").css("display", "none");
	window.location.reload();
});


//计时器
function countTime(){
	setTimeout(function(){
		$("#screen").css("display", "none");
		$("#tip").css("display", "none");
		window.location.reload();
	}, 4000);
};


//提示框
(function(){
	$("#tip").css("top", (document.documentElement.clientHeight-100)/2 + 'px');
	$("#tip").css("left", (document.documentElement.clientWidth-100)/2 + 'px');
})();




