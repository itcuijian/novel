<?php

//模板解析类
class Parser
{
	private $tpl;     //模板


	//创建构造方法
	public function __construct($_url)
	{
		//获取模板文件内容
		if(!$this->tpl= file_get_contents($_url))
		exit('error:获取模板内容失败！');	
	}


	//解析普通变量
	private function parVar()
	{
		$_str='/\{\$([\w]+)\}/';
		if(preg_match($_str,$this->tpl))
		{
			$this->tpl=preg_replace($_str, "<?php echo \$this->_vars['$1'];?>", $this->tpl);
		}
	}


	//解析include语句
	private function parInclude()
	{
	   $str="/\{include\s+file=(\"|\')([\w\.\-\/]+)(\"|\')\}/";
	   
	   if (preg_match_all($str,$this->tpl,$_file))
	   {
	       foreach($_file[2] as $value)
		   {
		   	if(!file_exists("templates/".$value))
			{
				exit("error：包含文件出错！！");
			}
			
			$this->tpl = preg_replace($str,"<?php \$tpl->create('$2')?>",$this->tpl);
			
		   }
	   }
	}



	   //解析if语句
	private function parIf()
	{
		
		$_pattenIf = '/\{if\s+\$([\w]+)\}/';
		$_pattenEndIf = '/\{\/if\}/';
		$_pattenElse = '/\{else\}/';
		if (preg_match($_pattenIf,$this->tpl)) {
			if (preg_match($_pattenEndIf,$this->tpl)) {
				$this->tpl = preg_replace($_pattenIf,"<?php if (@\$this->_vars['$1']) {?>",$this->tpl);
				$this->tpl = preg_replace($_pattenEndIf,"<?php } ?>",$this->tpl);
				if (preg_match($_pattenElse,$this->tpl)) {
					$this->tpl = preg_replace($_pattenElse,"<?php } else { ?>",$this->tpl);
				}
			} else {
				exit('ERROR：if语句没有关闭！');
			}
		}
	}


	//解析iff语句，foreach里面嵌套使用
	private function parIff()
	{
		
		$_pattenIf = '/\{iff\s+\@([\w\-\>]+)\}/';
		$_pattenEndIf = '/\{\/iff\}/';
		$_pattenElse = '/\{else\}/';
		if (preg_match($_pattenIf,$this->tpl)) {
			if (preg_match($_pattenEndIf,$this->tpl)) {
				$this->tpl = preg_replace($_pattenIf,"<?php if (\$$1) {?>",$this->tpl);
				$this->tpl = preg_replace($_pattenEndIf,"<?php } ?>",$this->tpl);
				if (preg_match($_pattenElse,$this->tpl)) {
					$this->tpl = preg_replace($_pattenElse,"<?php } else { ?>",$this->tpl);
				}
			} else {
				exit('ERROR：if语句没有关闭！');
			}
		}
	}


	//解析foreach语句
	private function parForeach() 
	{
		$_pattenForeach = '/\{foreach\s+\$([\w]+)\(([\w]+),([\w]+)\)\}/';
		$_pattenEndForeach = '/\{\/foreach\}/';
		$_pattenVar = '/\{@([\w]+)([\w\-\>\+]*)\}/';
		if (preg_match($_pattenForeach,$this->tpl)) {
			if (preg_match($_pattenEndForeach,$this->tpl)) {
				$this->tpl = preg_replace($_pattenForeach,"<?php foreach (\$this->_vars['$1'] as \$$2=>\$$3) { ?>",$this->tpl);
				$this->tpl = preg_replace($_pattenEndForeach,"<?php } ?>",$this->tpl);
				if (preg_match($_pattenVar,$this->tpl)) {
					$this->tpl = preg_replace($_pattenVar,"<?php echo \$$1$2?>",$this->tpl);
				}
			} else {
				exit('ERROR：foreach语句必须有结尾标签！');
			}
		}	
	}


	//解析for语句，用于内嵌循环
	public function parFor()
	{
		$_pattenFor = '/\{for\s+\@([\w\-\>]+)\(([\w]+),([\w]+)\)\}/';
		$_pattenEndFor = '/\{\/for\}/';
		$_pattenVar = '/\{@([\w]+)([\w\-\>\+]*)\}/';
		if (preg_match($_pattenFor,$this->tpl)) {
			if (preg_match($_pattenEndFor,$this->tpl)) {
				$this->tpl = preg_replace($_pattenFor,"<?php foreach (\$$1 as \$$2=>\$$3) { ?>",$this->tpl);
				$this->tpl = preg_replace($_pattenEndFor,"<?php } ?>",$this->tpl);
				if (preg_match($_pattenVar,$this->tpl)) {
					$this->tpl = preg_replace($_pattenVar,"<?php echo \$$1$2?>",$this->tpl);
				}
			} else {
				exit('ERROR：for语句必须有结尾标签！');
			}
		}
	}


	//PHP代码注释
	private function parCommon() 
	{		
		$_patten = '/\{#\}(.*)\{#\}/';
		if (preg_match($_patten,$this->tpl)) {
			$this->tpl = preg_replace($_patten,"<?php /* $1 */?>",$this->tpl);
		}			
	}


	//对外的公共方法
	public function compile($_parFile)
	{
		$this->parIf();
		$this->parVar();
		$this->parFor();
		$this->parInclude();
		$this->parIff();
		$this->parForeach();
		$this->parCommon();
		
		//生成编译文件
		if(!file_put_contents($_parFile,$this->tpl))
		exit('error:生成编译文件失败！');
	
	}
}

?>