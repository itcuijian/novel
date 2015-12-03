<?php

class IndexAction extends Action{
	public function __construct(&$tpl){
		parent::__construct($tpl);
	}

	public function action(){

		//显示
		$this->show();

		if(isset($_GET["action"]))
			switch($_GET["action"]){
				case "login":
					$this->login();
					break;

				case "logout":
					$this->logout();
					break;

			}
	}


	//显示内容
	private function show(){
		//最近更新
		$this->lastUpdate();

		//分类推荐
		$this->recommend();

		//排行
		$this->rank();

		//最新推荐(4本)
		$this->fourRec();

		//内容推荐
		$this->rec();
	}


	//内容推荐
	private function rec(){
		parent::__construct($this->tpl, new RecommendModel());

		//第一条推荐
		$first = $this->model->getOneBy(0);
		$this->tpl->assign('firstTitle', $first->title);
		$this->tpl->assign('firstHref', $first->href);

		//第二至第九条推荐
		$object1 =  $this->model->getMoreBy(1);
		$this->tpl->assign('FirstMore', $object1);

		//第10条推荐
		$next = $this->model->getOneBy(9);
		$this->tpl->assign('NextTitle', $next->title);
		$this->tpl->assign('NextHref', $next->href);

		//十一至十八条
		$object2 =  $this->model->getMoreBy(10);
		$this->tpl->assign('NextMore', $object2);
	}


	//最新推荐
	private function fourRec(){
		parent::__construct($this->tpl, new BookModel());

		$object = $this->model->getFour();
		foreach($object as $value){
			$value->infos = Tool::trimspecial($value->info);
			$value->info = Tool::trimspecial($value->info);
			if(Validate::checkLength($value->info, 55, "max"))
				$value->info = mb_substr($value->info, 0, 55, "utf8")."...";
		}
		$this->tpl->assign('Four', $object);
	}


	//排行榜
	private function rank(){
		$book = new BookModel();
		$book->limit = "LIMIT 0,10";
		//点击榜
		$object1 = $book->getRankOfClick();
		$this->tpl->assign("click", $object1);

		//订阅榜
		$object2 = $book->getRankOfRack();
		$bookrack = new BookrackModel();
		foreach($object2 as $value){
			$value->number = $bookrack->getRacks($value->id);
		}
		$this->tpl->assign("rack", $object2);

		//新书推送榜
		$object3 = $book->getRankOfNew();
		$this->tpl->assign("new", $object3);
	}


	//分类推荐
	private function recommend(){
		parent::__construct($this->tpl, new BookModel());

		//分类
		$kind = new KindModel();
		$object1 = $kind->getSixKind();
		$this->tpl->assign("SixKind", $object1);

		//推荐
		foreach($object1 as $value){
			$kid = $value->id;

			//第一条推荐
			$object2 = $this->model->getFirst($kid);		
			$value->bname1 = $object2->bname;			
			$value->surface = $object2->surface;

			if(Validate::checkLength($object2->pseudonym, 4, "max"))
				$value->pseudonyms = mb_substr($object2->pseudonym, 0, 4, "utf8")."...";
			else
				$value->pseudonyms = $object2->pseudonym;

			$value->pseudonym = $object2->pseudonym;

			if(Validate::checkLength($object2->info, 35, "max"))
				$value->infos = mb_substr(Tool::trimspecial($object2->info), 0, 35, "utf8")."...";
			else
				$value->infos = Tool::trimspecial($object2->info);

			$value->info = Tool::trimspecial($object2->info);
			$value->bid = $object2->bid;


			//第二至第6条推荐
			$object3 = $this->model->getNext($kid);
			foreach($object3 as $value3){
				if(Validate::checkLength($value3->bname, 7, "max"))
					$value3->bnames = mb_substr($value3->bname, 0, 6, "utf8")."...";
				else
					$value3->bnames = $value3->bname;
				$value3->bname = $value3->bname;
			}
			$value->next = $object3;
		}
	}


	//最近更新
	private function lastUpdate(){
		parent::__construct($this->tpl, new BookModel());
		$object2 = $this->model->getBookOfindex();
		$section = new SectionModel();
		if(!empty($object2))
		foreach($object2 as $value){
			$object3 = $section->getLatest($value->id);
			$value->vname = $object3->name;
			$value->titlel = $object3->title;
			$value->sid = $object3->id;
			if(Validate::checkLength($object3->name.$object3->title, 20, "max"))
				$value->title = mb_substr($object3->title, 0, 10, "utf8")."...";
			else
				$value->title = $object3->title;
			

			$value->times = date("m-d H:i", $value->time);
			$value->timel = date("Y-m-d H:i:s", $value->time);

			if(Validate::checkLength($value->pseudonym, 4, "max"))
				$value->pseudonyms = mb_substr($value->pseudonym, 0, 4, "utf8")."...";
			else
				$value->pseudonyms = $value->pseudonym;

		}
		$this->tpl->assign("AllBook", $object2);
	}


	//登录
	private function login(){
		if(isset($_POST["send"])){
			parent::__construct($this->tpl, new ReaderModel());

			if (Validate::checkEquals(strtolower($_POST['code']),$_SESSION['code']))
					Tool::alertBack("验证码输入不正确！！");

			$email = $_POST["email"];
			$pass = sha1($_POST["pass"]);

			if($this->model->checkLogin($email, $pass)){
				$reader = $this->model->checkLogin($email, $pass);

				$cookie = new Cookie("reader", $reader->reader);
				$cookie->setCookie();
				$cookie = new Cookie("face", $reader->face);
				$cookie->setCookie();
				$cookie = new Cookie("id", $reader->id);
				$cookie->setCookie();

				echo "<script type='text/javascript'>history.back();</script>";
			}
			else
				Tool::alertBack("登录失败，账号或密码错误！");

		}

	}


	//退出
	private function logout(){
		$cookie = new Cookie("reader");
		$cookie->unCookie();
		$cookie = new Cookie("face");
		$cookie->unCookie();
		$cookie = new Cookie("id");
		$cookie->unCookie();

		echo "<script type='text/javascript'>history.back();</script>";

	}
}

?>