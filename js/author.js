window.onload=function(){
	$(".left").css("height",document.documentElement.clientHeight);
	$(".top").css("width",document.documentElement.clientWidth-150);
	$(".navs").css("width",document.documentElement.clientWidth-150);
	window.onresize=function(){
		$(".left").css("height",document.documentElement.clientHeight);	
		$(".top").css("width",document.documentElement.clientWidth-150);
		$(".navs").css("width",document.documentElement.clientWidth-150);	
	};

	var li1 = $("#ul1 li");
	var a1 = li1.children("a");
	for(i=0;i<a1.length;i++){
		if(a1[i].href == String(window.location))
		{
			$("#ul1").children("li").attr("class", "");
			li1[i].className = "active";
		}
	}


	var option = $("#vid").children("option");
	for(i=0;i<option.length;i++){
		if(option[i].value == $("#vol").val()){
			option[i].setAttribute('selected','selected');
		}
	}

	//update的checkbox选定
	var li = $("#ch");
	var check = li.children("input");
	var k = $("#keyword").val();
	var keyword = k.split(',');
	for(var i=0;i<check.length;i++)
		for(var j=0;j<keyword.length;j++)
			if(check[i].value == keyword[j])
				check[i].checked = true;


    //textarea换行符置换
	var str = $("#area").val();
    str = str.replace(/<br\/>/gm, '\n');
	$("#area").html(str);
};




//上传插件
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
				$("#surface").attr("value",msg.result_des);
				$("#pic").attr("src", msg.result_des);
			}
			else if(msg.result_code == 101)
				{$("#text").val(msg.result_des);}
			else
				{
					alert("上传失败！");
				}
		}

})
});




//章节字数统计
$("#charcount").css("color", "red");

if($("#charcount").text() == "")
	$("#charcount").html("0");

if($("#text1").length > 0){
	CKEDITOR.replace("text1");
var editor = CKEDITOR.instances.text1;//获取编辑器对象,editor1 为 textarea 的ID
editor.on("change", function(){
	var content = editor.getData();
	content = content.replace(/<[^>]+>/g,"");
	content = content.replace(/&nbsp;/g,"");
	content = content.replace(/ /g,"");
	content = content.replace(/  /g,"");
	$("#charcount").html(content.length);
	$("#count").attr("value", content.length);
});
}




//textarea置换换行符
function subclick(){
	var str = $("#area").val();
	$("#area").val(str.replace(/\n/gm, '<br/>'));	
}





