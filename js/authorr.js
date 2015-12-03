function checkForm(){
	var fm = document.register;

	if(!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(fm.email.value))
	{
		alert("邮箱输入不合法！");
		fm.email.value = "";
		fm.email.focus();
		return false;
	}

	if(fm.name.value.length < 2)
	{
		alert("警告：请输入正确的名字！！");
		fm.name.focus();
		return false;
	}

	if(fm.pass.value.length < 6)
	{
		alert("警告：密码不能少于6位！！");
		fm.pass.focus();
		return false;
	}

	if(fm.pass.value != fm.notpass.value)
	{
		alert("警告：两次输入的密码不一致！");
		fm.notpass.focus();
		return false;
	}

	if(fm.pseudonym.value.length < 2 || fm.pseudonym.value.length > 11)
	{
		alert("警告：笔名不能少于两位，多于11位！！");
		fm.pseudonym.focus();
		return false;
	}

	return true;
}