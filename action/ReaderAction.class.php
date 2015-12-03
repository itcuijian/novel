<?php

class ReaderAction extends Action{

	public function __construct(&$tpl){
		parent::__construct($tpl, new ReaderModel());
	}

	public function action(){
		$this->show();
		if(isset($_GET["action"]))
			switch($_GET["action"]){
				case "set":
					$this->set();
					break;

				case "photo":
					$this->photo();
					break;

				case "book":
					$this->book();
					break;

				case "bbs":
					$this->bbs();
					break;

				case "comment":
					$this->comment();
					break;

				default:
					Tool::alertBack("非法操作！！");

			}
		
	}

	private function show(){
		if(isset($_COOKIE["id"])){
			$id = $_COOKIE["id"];
			$reader = $this->model->getOneReader($id);
			$this->tpl->assign("face", $reader->face);
			$this->tpl->assign("email", $reader->email);
			$this->tpl->assign("sex", $reader->sex);
			$this->tpl->assign("pass", $reader->pass);
			$this->tpl->assign("reader", $reader->reader);

			$reader->state == 1 ? $state="允许评论":$state="禁止评论";
			$this->tpl->assign("state", $state);

			$reader->adress == null ? $adress="空":$adress=$reader->adress;
			$this->tpl->assign("adress", $adress);

			$reader->info == null ? $info="暂无简介":$info=$reader->info;
			$this->tpl->assign("info", $info);

		}
		else{
			Tool::closing("请登录！");
		}
	}


	//书架
	private function book(){
		$this->tpl->assign("book", true);
		$id = $_COOKIE["id"];
		$this->tpl->assign("id", "$id");

		parent::__construct($this->tpl, new BookrackModel());
		$kind = new KindModel();
		$section = new SectionModel();
		$author = new AuthorModel();

		//分页
		parent::page($this->model->getNumber($id));

		$object = $this->model->getBookrack($id);
		if(!empty($object))
		foreach($object as $value){
			$value->times = date("m-d H:i", $value->time);
			$value->time = date("Y-m-d H:i:s", $value->time);

			//书名
			if(Validate::checkLength($value->name, 6, "max"))
				$value->names = mb_substr($value->name, 0, 5, "utf8")."...";
			else
				$value->names = $value->name;

			//作者
			$object1 = $author->getOneAuthor($value->aid);
			$value->pseudonym = $object1->pseudonym;
			if(Validate::checkLength($value->pseudonym, 6, "max"))
				$value->pseudonyms = mb_substr($value->pseudonym, 0, 5, "utf8")."...";
			else
				$value->pseudonyms = $value->pseudonym;

			//最新章节
			$object2 = $section->getLatest($value->bid);
			$value->title = $object2->title;
			if(Validate::checkLength($value->title, 20, "max"))
				$value->titles = mb_substr($value->title, 0, 20, "utf8")."...";
			else
				$value->titles = $value->title;
			$value->lid = $object2->id;

			//类型
			$object3 = $kind->getOneKind($value->kid);
			$value->kname = $object3->name;

		}
		$this->tpl->assign("bookrack", $object);
	}


	//修改头像
	private function photo(){
		$this->tpl->assign("photo", true);

		if(isset($_POST["send"])){
			if(!empty($_POST["face"])){
				$face = $_POST["face"];
				$x = round($_POST["x"] * $_POST["p"]);
				$y = round($_POST["y"] * $_POST["p"]);
				$w = round($_POST["w"] * $_POST["p"]);
				$h = round($_POST["h"] * $_POST["p"]);
				$width = 120;                                  //缩放长度
				$height = 120;                                 //缩放高度

				//头像裁剪缩放
				$img = new Image($face, $x, $y, $w, $h, $width, $height);
				$img->thumb();
				$img->out();

				if($this->model->updateFace($_COOKIE["id"], $face)){
					$cookie = new Cookie("face", $face);
					$cookie->setCookie();
					Tool::alertLocation("保存成功！", "reader.php?action=photo");
				}
				else
					Tool::alertBack("保存失败！");

			}
			else
				Tool::alertBack("警告：请先上传头像！");
			
		}
	}


	//账号设置
	private function set(){
		$this->tpl->assign("set", true);

		if(isset($_POST["send"])){
			//验证
			if(Validate::checkNull($_POST["pass"]))
					$pass = $_POST["npass"];
				elseif(Validate::checkLength($_POST["pass"], 6, "min"))
					Tool::alertBack("警告：密码不能少于6位！");
				else
					$pass = sha1($_POST["pass"]);

			if(!Validate::checkEquals($_POST["reader"], $_POST["nreader"])){
				$reader = $_POST["nreader"];
			}
			elseif(Validate::checkNull($_POST["reader"]))
					Tool::alertBack("警告：昵称不能为空！");
			elseif(Validate::checkLength($_POST["reader"], 2, "min"))
					Tool::alertBack("警告：昵称不能少于两位！");
			elseif(Validate::checkLength($_POST["reader"], 11, "max"))
					Tool::alertBack("警告：昵称不能多于11位！");
			elseif($this->model->checkReader($_POST["reader"], $_COOKIE["id"]))
					Tool::alertBack("警告：此昵称已被注册，请另起一个！");
			else
				$reader = $_POST["reader"];

			if(Validate::checkLength($_POST["info"], 200, "max"))
				Tool::alertBack("警告：个人简介不能超过200位！");
			
			$id = $_COOKIE["id"];
			$sex = $_POST["sex"];
			$adress = $_POST["adress"];
			$info = $_POST["info"];

			if($this->model->updateFront($id, $reader, $adress, $sex, $pass, $info))
				Tool::alertLocation("保存成功！", "reader.php?action=set");
			else
				Tool::alertLocation("保存失败！", "reader.php?action=set");
		}
	}


	//帖子
	private function bbs(){
		$this->tpl->assign("bbs", true);
		parent::__construct($this->tpl, new BbsModel());

		//分页
		parent::page($this->model->getNumberByRid($_COOKIE['id']));

		//获取数据
		$object1 = $this->model->getAllByRid($_COOKIE['id']);
		if(!empty($object1))
			foreach($object1 as $value){
				$value->time = date("Y-m-d H:i:s", $value->time);
				if(Validate::checkLength($value->title, 50, 'max'))
					$value->titles = mb_substr($value->title, 0, 50, 'utf8');
				else
					$value->titles = $value->title;
			}
		$this->tpl->assign("AllBBS", $object1);
	}


	//评论
	private function comment(){
		$this->tpl->assign("comment", true);
		
		parent::__construct($this->tpl, new CommentModel());

		//分页
		parent::page($this->model->getNumberByReader($_COOKIE["id"]));

		$object = $this->model->getAllByReader($_COOKIE["id"]);
		$bbs = new BbsModel();
		$book = new BookModel();
		$section = new SectionModel();

		if(is_array($object))
		foreach($object as $value){
			$value->time = date("Y-m-d H:i:s", $value->time);
			if($value->attr == "bbs"){
				$object1 = $bbs->getBBs($value->oid);
				if(Validate::checkLength($object1->title, 30, 'max'))
					$value->titles = mb_substr($object1->title, 0, 30, 'utf8').'...';
				else
					$value->titles = $object1->title;
				$value->title = $object1->title;
				$value->href = "details.php?action=show&oid=".$value->oid;
			}
			elseif($value->attr == "b"){
				$object1 = $book->getBook($value->oid);
				$value->titles = '《'.$object1->name.'》';
				$value->title = '《'.$object1->name.'》';
				$value->href = "book.php?id=".$value->oid;
			}
			elseif($value->attr == "s"){
				$object1 = $section->getDetails($value->oid);
				$value->titles = $object1->name.'：'.$object1->vname.' '.$object1->title;
				$value->title = $object1->name.'：'.$object1->vname.' '.$object1->title;
				$value->href = "section.php?id=".$value->oid;
			}
		}
		$this->tpl->assign("AllComment", $object);
	}
}

?>