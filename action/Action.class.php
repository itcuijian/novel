<?php

//控制基类
class Action{
	protected $tpl;
	protected $model;

	public function __construct(&$tpl, &$model=null){
		$this->tpl = $tpl;
		$this->model = $model;
	}

	//分页
	protected function page($total,$pagesize=PAGE_SIZE)
	{
		$page = new Page($total,$pagesize);
		$this->model->limit = $page->limit;
		$this->tpl->assign("page",$page->showpage());
		$this->tpl->assign("num",($page->page-1)*$pagesize);
	}
}

?>