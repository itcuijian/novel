function checkForm(){
	var fm = document.register;

	if(!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(fm.email.value))
	{
		alert("邮箱输入不合法！");
		fm.email.value = "";
		fm.email.focus();
		return false;
	}

	if(fm.reader.value.length < 2)
	{
		alert("警告：昵称不能少于两位！");
		fm.reader.focus();
		return false;
	}

	if(fm.reader.value.length > 11)
	{
		alert("警告：昵称不能对于11位！");
		fm.reader.focus();
		return false;
	}

	if(fm.pass.value.length < 6)
	{
		alert("警告：昵称不能对于11位！");
		fm.pass.focus();
		return false;
	}

	if(fm.pass.value != fm.notpass.value)
	{
		alert("警告：两次输入的密码不一致！");
		fm.notpass.focus();
		return false;
	}

	return true;
}