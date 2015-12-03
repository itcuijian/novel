window.onload = function(){
	//导航
	var title = document.getElementById("title");
	var ol = document.getElementsByTagName("ol");
	var a = ol[0].getElementsByTagName("a");
	for(i=0;i<a.length;i++)
	{
		a[i].className = null;
		if(a[i].innerHTML == title.innerHTML)
			a[i].className = "selected";
	}

	//权限选定
	var level = document.getElementById("userlv");
	var option = document.getElementsByTagName("option");
	for(i=0;i<option.length;i++)
		if(option[i].value == level.value)
			option[i].setAttribute('selected','selected');

}


//验证表单
function checkAddForm()
{
	var add = document.add;
	
	if(add.user.value == "" || add.user.length < 2 || add.user.length > 11)
	{
		alert("警告：用户名不能少于两位或者多于11位！");
		add.user.focus();
		return false;
	}

	if(add.pass.value == "" || add.pass.length < 6)
	{
		alert("警告：密码不能少于6位！");
		add.pass.focus();
		return false;
	}

	if(add.pass.value != add.notpass.value)
	{
		alert("警告：两次输入的密码不一致！");
		add.notpass.focus();
		return false;
	}

	return true;
}


function checkUpdateForm(){
	var update = document.update;

	if(update.pass.value != ""){
		if(update.pass.value.length < 6)
		{
			alert("警告：密码不能少于6位！");
			update.pass.focus();
			return false;
		}
	}

	return true;
}