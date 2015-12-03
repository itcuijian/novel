//新增模块
$('.add').click(function(){
	$('#addata').slideDown();
	$('.screen').css('display', 'block');
});


function upd(file,id){
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4){
			if(xhr.status == 200){
				var arr = JSON.parse(xhr.responseText);
				out(arr);
				$('#update').slideDown();
				$('.screen').css('display', 'block');
			}
			else{
				alert(xhr.responseText);
			}
		}
	};
	var url = '../ajax/admin.php?rand='+Math.random()+'&file='+file+'&id='+id;
	xhr.open('get', url, true);
	xhr.send(null);

	$('#id').val(id);
};


//输出数据
function out(arr){
	if(typeof arr['name'] != 'undefined'){
		$('.uname').val(arr['name']);
		$('.utname').val(arr['name']);
		$('.utitle').val(arr['name']);
	}
	if(typeof arr['pass'] != 'undefined')
		$('#npass').val(arr['pass']);

	if(typeof arr['state'] != 'undefined')
		$('#rstate').val(arr['state']);

	if(typeof arr['info'] != 'undefined'){
		$('.sim').val(arr['info']);
		if(typeof CKEDITOR != 'undefined')
			CKEDITOR.instances['text2'].setData(arr['info']);
	}

	if(typeof arr['email'] != 'undefined')
		$('.uemail').val(arr['email']);

	if(typeof arr['pseudonym'] != 'undefined')
		$('#pseudonym').val(arr['pseudonym']);

	if(typeof arr['attr'] != 'undefined')
		$('.uattr').val(arr['attr']);

	if(typeof arr['href'] != 'undefined')
		$('.uhrf').val(arr['href']);

	var option  = $('#sel').children('option');
	for(var i=0;i<option.length;i++){
		if($(option[i]).val() == arr['state'])
			$(option[i]).attr('selected', 'selected');
	}
}


//关闭弹出
$('.d').click(function(){
	$('.oprate').slideUp(300);
	$('.screen').css('display', 'none');
});

$('.closes').click(function(){
	$('.oprate').slideUp();
	$('.screen').css('display', 'none');
});


//获取位置
(function(){
	var left = (document.documentElement.clientWidth - $('.oprate').width()) / 2;
	$('.oprate').css('left', left + 'px').css('top', '50px');
	$('.screen').css('width', document.documentElement.clientWidth + 'px');
	$('.screen').css('height', document.documentElement.clientHeight + 'px');
	
})();


window.onresize = function(){
	var left = (document.documentElement.clientWidth - $('.oprate').width()) / 2;
	$('.oprate').css('left', left + 'px').css('top', '50px');
	$('.screen').css('width', document.documentElement.clientWidth + 'px');
	$('.screen').css('height', document.documentElement.clientHeight + 'px');
};



//新增检验菜单
$('#add').click(function(){
	try{
		return checkForm(document.add, false);
	}
	catch(ex){
		alert(ex);
		return false;
	}

	return true;
});


//新增检验菜单
$('#add1').click(function(){
	try{
		return checkForm(document.add1, false);
	}
	catch(ex){
		alert(ex);
		return false;
	}

	return true;
});


//更新检查菜单
$('#updat').click(function(){
	return checkForm(document.update, true);
	return true;
});


//检验密码
function checkPass(object){
	var pass = object.pass;
	var notpass = object.notpass;

	if(typeof pass != 'undefined')
		if(pass.value == ''){
			alert("密码不能为空！");
			$('.pass').focus();
			return false;
		}

	if(typeof pass != 'undefined')
		if(pass.value.length < 6){
			alert("密码不能少于6位！");
			$('.pass').focus();
			return false;
		}
	
	if(typeof notpass != 'undefined')
		if(pass.value != notpass.value){
			alert("两次输入的密码不一致！");
			$('.notpass').focus();
			return false;
		}

}


//检查表单
function checkForm(obj, type){
	var email = obj.email;
	var user =  obj.user;
	var info =  obj.kinfo;
	var aname =  obj.aname;
	var pseudonym =  obj.pseudonym;
	var reader =  obj.reader;
	var kname =  obj.kname;
	var title = obj.ntitle;
	var rtitle = obj.rtitle;
	var hrf = obj.hrf;
	var attr = obj.attr;

	if(typeof CKEDITOR != 'undefined' && typeof CKEDITOR.instances['text2'] != 'undefined' || typeof CKEDITOR.instances['text1'] != 'undefined'){
		var content1 = CKEDITOR.instances['text1'].getData();
		var content2 = CKEDITOR.instances['text2'].getData();
	}
	

	// alert(content2.length == 0);
	// return false;
	if(typeof email != 'undefined')
		if(email.value == ''){
			alert("邮箱不能为空！");
			$('.email').focus();
			return false;
		}
	
	if(typeof email != 'undefined')
		if(!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(email.value)){
			alert("邮箱格式不正确！");
			$('.email').focus();
			return false;
		}
	
	if(typeof user != 'undefined')
		if(user.value == ''){
			alert("用户名不能为空！");
			$('.name').focus();
			return false;
		}
	
	if(typeof user != 'undefined')
		if(user.value.length < 2 || user.value.length > 11){
			alert("用户名不能少于两位或者超过11位！");
			$('.name').focus();
			return false;
		}

	if(typeof title != 'undefined')
		if(title.value == ''){
			alert("标题不能为空！");
			$('.title').focus();
			return false;
		}
	
	if(typeof title != 'undefined')
		if(title.value.length > 80){
			alert("标题不能超过80个字！");
			$('.title').focus();
			return false;
		}


	if(typeof rtitle != 'undefined')
		if(rtitle.value == ''){
			alert("标题不能为空！");
			$('.title').focus();
			return false;
		}


	if(typeof rtitle != 'undefined')
		if(rtitle.value.length > 12){
			alert("标题不能超过12个字！");
			$('.title').focus();
			return false;
		}


	if(typeof attr != 'undefined')
		if(attr.value == ''){
			alert("属性不能为空！");
			$('.attr').focus();
			return false;
		}


	if(typeof attr != 'undefined')
		if(attr.value.length != 2){
			alert("属性只能是两个字！");
			$('.attr').focus();
			return false;
		}

	if(typeof hrf != 'undefined')
		if(hrf.value == ''){
			alert("链接不能为空！");
			$('.hrf').focus();
			return false;
		}


	if(typeof reader != 'undefined')
		if(reader.value == ''){
			alert("昵称不能为空！");
			$('.name').focus();
			return false;
		}
	
	if(typeof reader != 'undefined')
		if(reader.value.length < 2 || reader.value.length > 11){
			alert("昵称不能少于两位或者超过11位！");
			$('.name').focus();
			return false;
		}

	if(typeof pseudonym != 'undefined')
		if(pseudonym.value == ''){
			alert("笔名不能为空！");
			$('.name').focus();
			return false;
		}

	
	if(typeof pseudonym != 'undefined')
		if(pseudonym.value.length < 2 || pseudonym.value.length > 11){
			alert("名称不能少于两位或者超过11位！");
			$('.name').focus();
			return false;
		}
	
	if(typeof info != 'undefined')
		if(info.value.length > 200){
			alert("描述不能超过200个字！");
			$('.sim').focus();
			return false;
		}

	if(typeof kname != 'undefined')
		if(kname.value.length != 4){
			alert("名称必须是四位！");
			$('.name').focus();
			return false;
		}

	if(typeof aname != 'undefined')
		if(aname.value.length < 2){
			alert("请输入真实的姓名！");
			$('.tname').focus();
			return false;
		}


	if(type){
		if($('#pass').val() != ''){
			return checkPass(obj);
		}

		if(typeof content2 != 'undefined')
			if(content2.length != 0){
				alert("内容不能为空！");
				CKEDITOR.instances['text2'].focus();
				return false;
			}
	}
	else{
		if(typeof content1 != 'undefined')
			if(content1.length == 0){
				alert("内容不能为空！");
				CKEDITOR.instances['text1'].focus();
				return false;
			}

		return checkPass(obj);
	}
}


function show(id,name){
	$('#pid').val(id);
	$('#prev_name').val(name);
	$('#addata1').slideDown();
	$('.screen').css('display', 'block');
}