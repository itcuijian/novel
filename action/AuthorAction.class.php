<?php

class AuthorAction extends Action{
	public function __construct(&$tpl){
		parent::__construct($tpl, new BookModel());
	}

	public function action(){
		$this->tpl->assign("pseudonym", $_SESSION["author"]["pseudonym"]);
		if(isset($_GET["action"]))
			switch($_GET["action"]){
				case "add":
					$this->add();
					break;

				case "manage":
					$this->manage();
					break;

				case "update":
					$this->update();
					break;

				case "surface":
					$this->surface();
					break;

				case "volume":
					$this->volume();
					break;

				case "section":
					$this->section();
					break;

				case "addsection":
					$this->addsection();
					break;

				case "delete":
					$this->delete();
					break;

				case "logout":
					$this->logout();
					break;

				default:
					Tool::alertBack("警告：非法操作!");

			}
	}



	//删除作品
	private function delete(){
		if(isset($_GET["id"])){
			$id = $_GET["id"];
			$valume = new VolumeModel();
			$section = new SectionModel();
			if($this->model->delete($id) || $valume->deleteByBid($id) || $section->deleteByBid($id))
				Tool::alertBack("删除成功！");
			else
				Tool::alertBack("删除失败！");
		}
	}


	//管理作品
	private function manage(){
		$this->tpl->assign("manage", true);

		$aid = $_SESSION["author"]["id"];
		parent::page($this->model->getAllBookOfAtotal($aid));

		$object = $this->model->getAllBookOfAuthor($aid);
		$section = new SectionModel();
		if(is_array($object))
		foreach($object as $value){
			$value->time = date("Y-m-d H:i:s", $value->time);
			$latest = $section->getLatest($value->id);
			if($latest != null){
				$value->section = $latest->name." ".$latest->title;
				$value->time = date("Y-m-d H:i:s", $latest->time);

				//修改作品状态
				if($value->state == "初始")
					$this->model->updateState($value->id, "连载中");
			}
			else
				$value->section = "暂无章节";
		}
		$this->tpl->assign("AllBookOfAuthor", $object);
	}


	//修改封面
	private function surface(){
		if(isset($_GET["id"])){
			$id = $_GET["id"];
			$this->tpl->assign("surface", true);
			$this->tpl->assign("id", $id);
			$this->tpl->assign("surface", $this->model->getOneBook($id)->surface);

			if(isset($_POST["send"])){
				if($_POST["surface"] == null)
					Tool::alertBack("请上传图片！");

				$surface = $_POST["surface"];
				$arr = getimagesize(substr($_SERVER["DOCUMENT_ROOT"], 0, -1).$surface);
				$width = $arr[0];
				$height = $arr[1];
				$img = new Image($surface, 0, 0, $width, $height, 240, 320);
				$img->thumb();
				$img->out();

				if($this->model->updateSurface($id, $surface))
					Tool::alertLocation("上传成功！", "author.php?action=surface&id=".$id);
				else
					Tool::alertBack("上传失败！");
			}
		}
	}


	//管理分卷
	private function volume(){
		if(isset($_GET["id"])){
			$id = $_GET["id"];
			$this->tpl->assign("volume", true);
			$this->tpl->assign("id", $id);


			parent::__construct($this->tpl, new VolumeModel());
			parent::page($this->model->getAllVolumeTotal($id));

			$object = $this->model->getAllVolume($id);
			if(is_array($object))
				foreach($object as $value){
					$value->time = date("Y-m-s H:i:s", $value->time);
				}
			else
				$object=null;

			$this->tpl->assign("AllVolume", $object);

			if(isset($_GET["type"])){
				if($_GET["type"] == "add"){
					if(Validate::checkLength($_POST["addname"], 20, "max"))
						Tool::alertBack("警告：分卷名字只能在20个字符以内！");
					$name = $_POST["addname"];
					$time = time();

					if($this->model->add($id, $name, $time))
						Tool::alertLocation("添加成功！", "author.php?action=volume&id=".$id);

					else
						Tool::alertBack("添加失败！");
				}
				if($_GET["type"] == "update"){
					if(Validate::checkLength($_POST["updatename"], 20, "max"))
						Tool::alertBack("警告：分卷名字只能在20个字符以内！");
					$name = $_POST["updatename"];

					if($this->model->update($_POST["id"], $name))
						Tool::alertLocation("修改成功！", "author.php?action=volume&id=".$id);
					else
						Tool::alertBack("修改失败！");

				}
				if($_GET["type"] == "delete"){
					if($this->model->delete($_GET["vid"]))
						Tool::alertLocation("删除成功！", "author.php?action=volume&id=".$id);
					else
						Tool::alertBack("删除失败！");
				}
			}
			
		}
	}


	//管理章节
	private function section(){
		if(isset($_GET["id"])){
			$id = $_GET["id"];
			$this->tpl->assign("section", true);
			$this->tpl->assign("id", $id);

			parent::__construct($this->tpl, new SectionModel());
			parent::page($this->model->getAllSectionTotal($id));

			$object = $this->model->getAllSection($id);
			if(is_array($object))
			foreach($object as $value){
				if($value->state == 0)
					$value->state = "未审核";
				elseif($value->state == 1)
					$value->state = "已审核";

				$value->time = date("Y-m-s H:i:s", $value->time);
			}
			$this->tpl->assign("AllSection", $object);


			if(isset($_GET["type"])){
				if($_GET["type"] == "update"){
					$sid = $_GET["sid"];
					$this->updateSection($sid, $id);
				}
				elseif($_GET["type"] == "delete"){
					$sid = $_GET["sid"];
					if($this->model->delete($sid))
						Tool::alertLocation("删除成功！", "author.php?action=section&id=".$id);
					else
						Tool::alertBack("删除失败！");
				}
			}
		}
	}


	//更新章节
	private function updateSection($id, $bid){
		$this->tpl->assign("id", $bid);
		$this->tpl->assign("sid", $id);
		$this->tpl->assign("updatesection", true);
		$this->tpl->assign("section", false);

		$volumes = new VolumeModel();
			$object = $volumes->getVolumes($bid);
			if(is_array($object))
				$this->tpl->assign("volumes", $object);

		parent::__construct($this->tpl, new SectionModel());
		$section = $this->model->getOneSection($id);
		$this->tpl->assign("title", $section->title);
		$this->tpl->assign("content", $section->content);
		$this->tpl->assign("count", $section->count);
		$this->tpl->assign("vid", $section->vid);

		if(isset($_POST["send"])){
			if(Validate::checkNull($_POST["vid"]))
					Tool::alertBack("警告：请选择所属的分卷");
			if(Validate::checkNull($_POST["name"]))
				Tool::alertBack("警告：章节名不能为空");

			$title = $_POST["name"];
			$content = $_POST["content"];
			$count = $_POST["count"];
			$vid = $_POST["vid"];
			$time = time();

			if($this->model->update($id, $title, $content, $count, $vid, $time)){
				//更新作品总字数
				$book = new BookModel();
				$object2 = $book->getOneBook($bid);
				$count2 = $object2->count - $section->count + $count;
				$book->updateCount($bid, $count2);

				Tool::alertLocation("修改成功！", "author.php?action=section&id=".$bid);
			}
			else
				Tool::alertBack("修改失败！");
		}
	}


	//新增章节
	private function addsection(){
		if(isset($_GET["id"])){
			$id = $_GET["id"];
			$this->tpl->assign("addsection", true);
			$this->tpl->assign("id", $id);

			//分页
			parent::__construct($this->tpl, new SectionModel());

			$volumes = new VolumeModel();
			$object = $volumes->getVolumes($id);
			if(is_array($object))
				$this->tpl->assign("volumes", $object);

			if(isset($_POST["send"])){
				//验证
				if(Validate::checkNull($_POST["vid"]))
					Tool::alertBack("警告：请选择所属的分卷");
				if(Validate::checkNull($_POST["name"]))
					Tool::alertBack("警告：章节名不能为空");
				

				//获取数据
				$title = $_POST["name"];
				$content = $_POST["content"];
				$count = $_POST["count"];
				$vid = $_POST["vid"];
				$time = time();

				//向数据模型提交数据
				if($this->model->add($title, $vid, $content, $count, $id, $time)){
					$book = new BookModel();
					$object2 = $book->getOneBook($id);
					if($object2->state == "完结")
						Tool::alertBack("对不起，本书已经完结，不能再新建章节！");
					if($_POST["attr"] == 1)
						$book->updateState($id, "完结");
					//更新作品总字数
					$count2 = $object2->count + $count;
					$book->updateCount($id, $count2);

					Tool::alertLocation("上传成功！", "author.php?action=section&id=".$id);
				}
				else
					Tool::alertBack("上传失败！");
			}
		}
	}


	//修改作品
	public function update(){
		if(isset($_GET["id"])){
			$id = $_GET["id"];
			$this->tpl->assign("update", true);
			$this->tpl->assign("id", $id);
			
			//获取书籍信息
			$object = $this->model->getOneBook($id);
			$this->kind($object->kid);
			
			$this->tpl->assign("keyword", $object->keyword);
			$this->tpl->assign("name", $object->name);
			$this->tpl->assign("state", $object->state);
			$this->tpl->assign("info", $object->info);

			if(isset($_POST["send"]))
			{
				//验证
				if(Validate::checkNull($_POST["name"]))
					Tool::alertBack("警告：书名不能为空！");
				if(Validate::checkLength($_POST["name"], 12, "max"))
					Tool::alertBack("警告：书名不能多于12位！");
				if(Validate::checkLength($_POST["info"], 400, "max"))
					Tool::alertBack("警告：内容简介不能超过400位");

				if($this->model->checkExName($id, $_POST["name"]))
					Tool::alertBack("警告；该书名已经存在，请另起一个！");

				if(isset($_POST["keyword"]))
					$keyword = implode(',', $_POST["keyword"]);
				else
					$keyword = "空";

				$name = $_POST["name"];
				$info = $_POST["info"];
				$time = time();

				if($this->model->update($id, $name, $keyword, $info, $time))
					Tool::alertLocation("修改成功！", "author.php?action=manage");
				else
					Tool::alertBack("修改失败！");
			}

		}
	}


	//添加作品
	private function add(){
		$this->tpl->assign("add", true);
		$this->kind();

		if(isset($_POST["send"])){
			//验证
			if(Validate::checkNull($_POST["name"]))
				Tool::alertBack("警告：书名不能为空！");
			if(Validate::checkLength($_POST["name"], 12, "max"))
				Tool::alertBack("警告：书名不能多于12位！");
			if(Validate::checkNull($_POST["kid"]))
				Tool::alertBack("警告：必须选择一种作品类型！");
			if(Validate::checkLength($_POST["info"], 400, "max"))
				Tool::alertBack("警告：内容简介不能超过400位");
				
			//选择关键字
			if(isset($_POST["keyword"]))
				$keyword = implode(',', $_POST["keyword"]);
			else
				$keyword = "空";

			//获取数据
			$name = $_POST["name"];
			$kid = $_POST["kid"];
			$aid = $_SESSION["author"]["id"];
			$info = $_POST["info"];
			$publish = $_POST["publish"];
			$time = time();

			//检查书名是否已经存在
			if($this->model->checkName($name))
				Tool::alertBack("警告；该书名已经存在，请另起一个！");

			//想数据模型提交数据
			if($this->model->add($name, $kid, $aid, $keyword, $info, $publish, $time))
				Tool::alertLocation("新增成功！", "author.php?action=manage");
			else
				Tool::alertBack("新增失败！");
		}
		
	}


	//作者登出
	private function logout(){
		Tool::unSession();
		Tool::alertLocation(null, "authorr.php?type=author&action=login");
	}


	//kind()，类别下拉框
	private function kind($k=0){
		$kind = new KindModel();
		$html = "";
		foreach($kind->getFronKind() as $object){
			$html .= '<optgroup label="'.$object->name.'">';
			$pid = $object->id;
			if(!!$child = $kind->getFronKChild($pid))
				foreach($child as $object){
					$selected = "";
					if($k == $object->id)
						$selected = 'selected="selected"';

					$html .= '<option '.$selected.' value="'.$object->id.'">'.$object->name.'</option>';
					$selected = "";
				}
				$html .= '</optgroup>';
		}

		$this->tpl->assign("kind", $html);
	}
}

?>