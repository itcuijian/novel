<?php

class KindAction extends Action{
	//构造方法
	public function __construct(&$tpl){
		parent::__construct($tpl, new KindModel());
	}


	public function action(){
		if(isset($_GET["action"]))
			switch($_GET["action"]){
				case "show":
					$this->show();
					break;

				case "add":
					$this->add();
					break;

				case "delete":
					$this->delete();
					break;

				case "update":
					$this->update();
					break;

				case "showchild":
					$this->showchild();
					break;
			}
	}


	//显示主类别
	private function show(){
		$this->tpl->assign("titl", "列表");

		//模糊搜索
		if(isset($_GET['search'])){
			parent::page($this->model->getKindToatal($_GET['key']));
			$object = $this->model->getAllKind($_GET['key']);
		}
		else{
			parent::page($this->model->getKindToatal());
			$object = $this->model->getAllKind();
		}

		if(is_array($object))
		foreach($object as $value){
			if($value->info == null)
				$value->info = "暂无描述";
		}
		$this->tpl->assign("AllKind", $object);

		$this->tpl->assign("show", true);
	}


	//显示子类别
	private function showchild(){
		$this->tpl->assign("titl", "子类别列表");
		$this->tpl->assign("showchild", true);
		$pid = $_GET["id"];

		//模糊搜索
		if(isset($_GET['search'])){
			parent::page($this->model->getChildTotal($pid, $_GET['key']));
			$object = $this->model->getAllChild($pid, $_GET['key']);
		}
		else{
			parent::page($this->model->getChildTotal($pid));
			$object = $this->model->getAllChild($pid);
		}

		if(is_array($object))
		foreach($object as $value){
			if($value->info == null)
				$value->info = "暂无描述";
		}
		$this->tpl->assign("AllChild", $object);
		$this->tpl->assign("id", $_GET["id"]);

		$kind = $this->model->getOneKind($_GET["id"]);
		$this->tpl->assign("prev_name", $kind->name);
	}


	//增加主类别
	private function add(){
		if (isset($_POST['send']))
		  {
			  			      			  
			   //判断输入的数据是否合法
			  if (Validate::checkNull($_POST['kname']))
			  Tool::alertBack("警告：名称不能为空！！");
			  
			  if (Validate::checkLength($_POST['kname'],4,"equal"))
			  Tool::alertBack("警告：名称只能是4位！！");
			  
			  if (Validate::checkLength($_POST['kinfo'],200,"max"))
			  Tool::alertBack("警告：描述不能多于200位！！");			  	
		
			  $name=$_POST['kname'];
			  
			  //判断导航名称是否已经存在
			  if ($this->model->checkName($name))
			  Tool::alertBack("该名称已经存在，请另起一个名称！！");
			  
			  $info=$_POST['kinfo'];
			  $pid = $_POST['pid'];

			  //判断pid是否存在，如果存在就返回到子类别的列表，如果不存在就返回到主类别的列表
			  $returnurl = $pid ? 'kind.php?action=showchild&id='.$pid.'&page='.($this->model->getChildTotal($pid) / 10 + 1)
			  :'kind.php?action=show'.'&page='.($this->model->getKindToatal() / 10 + 1);
              
              //开始新增数据
			  if ($this->model->add($name, $info, $pid))
			 {
				Tool::alertLocation('新增成功！！',$returnurl);
			 }
			  else
			  {
				Tool::alertBack("新增失败！！请重新输入！！");
			  }
		   }
	}


	//更新
	private function update(){
	
		$kind = $this->model->getOneKind($_POST["id"]);
		is_object($kind) ? TRUE:Tool::alertBack("该导航不存在！！");

		if(isset($_POST["send"])){
			//判断输入的数据是否合法
			if (Validate::checkNull($_POST['kname']))
			Tool::alertBack("警告：名称不能为空！！");
			  
			if (Validate::checkLength($_POST['kname'],4,"equal"))
			Tool::alertBack("警告：名称只能是4位！！");
			  
			if (Validate::checkLength($_POST['kinfo'],200,"max"))
			Tool::alertBack("警告：描述不能多于200位！！");

			$id = $_POST["id"];
			$name = $_POST["kname"];
			$info = $_POST["kinfo"];

			if($this->model->update($id, $name, $info))
				Tool::alertBack("修改成功！");
			else
				Tool::alertBack("修改失败！");
		}
	}
	



	//删除
	private function delete(){
		if(isset($_GET['id']))
		   {
			   if(!!$this->model->delete($_GET["id"]))
					Tool::alertBack("删除成功！");
				else
					Tool::alertBack("删除失败！");
		   }
		   else
		   	{
		   		Tool::alertBack("非法操作！！");
		   	}
	}
}

?>