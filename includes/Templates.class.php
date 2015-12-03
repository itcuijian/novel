<?php

//模板类
class Templates
{

	//创建一个数组，用来接收注入的变量
	private $_vars=array();



	//创建构造方法，验证各个目录路径是否存在
	public function __construct()
	{
		if(!is_dir(TPL_DIR) || !is_dir(TPL_C_DIR) || !is_dir(CACHE))
		{
			exit("error:模板目录或者编译目录或者缓存目录不存在！请添加!!");
		}
	}


	//注入变量的方法
	public function assign($_var,$_value)
	{
		
		//$_var必须跟模板里设置的变量名一样
		if(isset($_var) && !empty($_var))
		{
			$this->_vars[$_var] = $_value;
		}
		else
			{
				exit('error:请设置模板变量');
			}

	}



	//cache() 缓存方法,跳转到缓存文件
	public function cache($_file)
	{
		$_url=TPL_DIR.$_file;

		//判断一下模板是否存在
		if(!file_exists($_url))
		{
			exit('error:the template is not existent');
		}


		//生成编译文件时.php?后面的参数变量会消去，每次加载时会重新加载，而缓存文件只加载一个
		//编译和缓存效果没有达到，所以得在文件名后面加入参数变量，不同的参数变量生成不同的缓存文件
		//是否加入参数变量
		if(!empty($_SERVER["QUERY_STRING"]))
		{
			$_file .= $_SERVER["QUERY_STRING"];
		}
				
		//生成编译文件（首先判断一下编译文件是否已经存在，还有判断模板文件在编译文件生成之后有没有更新）
		$_parFile=TPL_C_DIR.md5($_file).$_file.'.php';
		
		//生成缓存文件
		$_cache=CACHE.md5($_file).$_file.'.html';
		
		//判断缓存文件是否已经存在
		if (IS_CACHE && file_exists($_cache))
		{
			//判断模板文件是否被修改过，编译文件是否被修改过
			if (filemtime($_url) <= filemtime($_parFile) && filemtime($_parFile) <= filemtime($_cache))
			{
				//加载缓存文件
				include $_cache;
				exit();
			}
		}
	}



	//创建diplay()方法，用来生成编译文件
	public function display($_file)
	{
		$_url=TPL_DIR.$_file;
		
		//给include进来的tpl传一个模板操作的对象
		$tpl=$this;
		
		//判断一下模板是否存在
		if(!file_exists($_url)){
			exit('error:the template is not existent');
		}

		//生成编译文件时.php?后面的参数变量会消去，每次加载时会重新加载，而缓存文件只加载一个
		//编译和缓存效果没有达到，所以得在文件名后面加入参数变量，不同的参数变量生成不同的缓存文件
		//是否加入参数变量
		if(!empty($_SERVER["QUERY_STRING"])){

			$_file .= $_SERVER["QUERY_STRING"];
		}
				
		//生成编译文件（首先判断一下编译文件是否已经存在，还有判断模板文件在编译文件生成之后有没有更新）
		$_parFile=TPL_C_DIR.md5($_file).$_file.'.php';
		
		//生成缓存文件
		$_cache=CACHE.md5($_file).$_file.'.html';
		
		
		//判断编译文件是否存在，是否被修改过	
		if(!file_exists($_parFile) || filemtime($_parFile) < filemtime($_url))
		{
			//引入模板解析类
			require_once ROOT_PATH.'/includes/Parser.class.php';
			$_parser=new Parser($_url);
			$_parser->compile($_parFile);
		}
		
		//引入编译文件
		include $_parFile;
		
		//判断缓冲区是否开启
		if (IS_CACHE){
		    //获取缓冲区的数据，创建缓存文件
			file_put_contents($_cache, ob_get_contents());
			
			//清除缓冲区，也就是清除编译文件的加载内容
			ob_end_clean();
			
			//加载缓存文件
			include $_cache;
		}
			
	}


	//创建create方法，用于解析模板引入之类的方法，例如header.tpl和footer.tpl，而不用生成它们的缓存文件
	public function create($_file)
	{
		$_url=TPL_DIR.$_file;
		
		//判断一下模板是否存在
		if(!file_exists($_url))
		{
			exit('error:the template is not existent');
		}
				
		//生成编译文件（首先判断一下编译文件是否已经存在，还有判断模板文件在编译文件生成之后有没有更新）
		$_parFile=TPL_C_DIR.md5($_file).$_file.'.php';
		if(!file_exists($_parFile) || filemtime($_parFile) < filemtime($_url))
		{
			//引入模板解析类
			require_once ROOT_PATH.'/includes/Parser.class.php';
			$_parser=new Parser($_url);
			$_parser->compile($_parFile);
		}
		
		//引入编译文件
		include $_parFile;
	}


}

?>