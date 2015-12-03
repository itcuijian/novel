<?php

//cookie类
class Cookie{
	private $time;
	private $name;
	private $value;

	public function __construct($name, $value=''){
		$this->name = $name;
		$this->value = $value;
		$this->time = time() + 604800;
	}

	//创建cookie
	public function setCookie(){
		setcookie($this->name, $this->value, $this->time);
	}

	//获取cookie
	public function getCookie(){
		return @$_COOKIE['$this->name'];
	}

	//移除
	public function unCookie(){
		setcookie($this->name, '', -1);
	}
}

?>