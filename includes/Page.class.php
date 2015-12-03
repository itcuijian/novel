	<?php

//分页类
class Page{

	private $total;                   //总记录
   	private $pagesize;                 //每页显示数量
   	private $limit;                   //limit
   	private $page;                    //获取当前页码
   	private $pagenum;                 //总页码
   	private $url;                     //地址
   	private $bothnum;                 //两边保持数字分页的量
   	
   	
   	//构造方法，初始化
   	public function __construct($total,$pagesize)
	{
		$this->total = $total ? $total:1;
		$this->pagesize = $pagesize;
		$this->pagenum = ceil($this->total/$this->pagesize);
		$this->page = $this->setPage();
		$this->limit = "LIMIT ".($this->page-1)*$this->pagesize.",".$this->pagesize;
		$this->url = $this->setUrl();
		$this->bothnum = 2;
	}
	
	//拦截器
	public function __get($_key)
	{
		return $this->$_key;
	}
	
	private function setPage()
	{
		if (!empty($_GET['page']))
		{
			if ($_GET['page'] > 0)
			{
				if ($_GET['page'] < $this->pagenum)
				return $_GET['page'];
				else
					return $this->pagenum;
			}
			else
					return 1;					
		}
		else
				return 1;
	}
	
	//获取地址
	private function setUrl()
	{
		//获取当前请求地址
		$url = $_SERVER["REQUEST_URI"];                                 //预定义服务器变量，获取当前URL地址
		$par = parse_url($url);                                         //解析地址，返回数组
		
		if (isset($par['query']))
		{
			parse_str($par['query'],$query);                            //将$par['query']分割，以$query返回
			unset($query['page']);                                      //将$query数组中的page元素删除
			$url = $par['path'].'?'.http_build_query($query);           //将已经拆分的地址数组再组合成地址字符串
		}
		return $url;
	}
	
	//数字目录
	private function pageList()
	{
		$pagelist = "";
		for ($i=$this->bothnum;$i>=1;$i--)
		{
			$page = $this->page-$i;
			if ($page < 1)
			continue;
			$pagelist .= '<li><a href="'.$this->url.'&page='.$page.'">'.$page.'</a></li>';
		}
		$pagelist .= '<li class="active"><span>'.$this->page.'</span><li>';
		for ($i=1;$i<=$this->bothnum;$i++)
		{
			$page = $this->page+$i;
			if ($page > $this->pagenum)
			break;
			$pagelist .= '<li><a href="'.$this->url.'&page='.$page.'">'.$page.'</a><li>';
		}
		return $pagelist;
	}
	 

	//首页
	private function first()
	{
		if ($this->page > $this->bothnum+1)
		return '<li><a href="'.$this->url.'">1</a></li><li><span>...</span></li>';
	}

	
	//上一页
	private function prev()
	{
		if ($this->page == 1)
		return '<li class="disabled"><span>&laquo;</span></li>';
		
		return '<li><a href="'.$this->url.'&page='.($this->page-1).'">&laquo;</a></li>';
	}
	
	//下一页
	private function next()
	{
		if ($this->page == $this->pagenum)
		return '<li class="disabled"><span>&raquo;</span></li>';
		
		return '<li><a href="'.$this->url.'&page='.($this->page+1).'">&raquo;</a></li>';
	}


	//尾页
	private function last()
	{
		if ($this->pagenum - $this->page > $this->bothnum)
		{
			return '<li><span>...</span></li><li><a href="'.$this->url.'&page='.$this->pagenum.'">'.$this->pagenum.'</a></li>';
		}
		
	}
	
	
	
	//展示分页信息
	public function showpage()
	{
		$_page = '<ul class="pagination pagination-sm">';
		$_page .= $this->prev();
		$_page .= $this->first();
		$_page .= $this->pageList();
		$_page .= $this->last();
		$_page .= $this->next();
		$_page .= '</ul>';
		
		return $_page;
		
	}
}

?>