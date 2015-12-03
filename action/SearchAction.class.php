<?php 
//前台搜索控制类
class SearchAction extends Action{
	private $ty;
	
	public function __construct(&$tpl){
		parent::__construct($tpl, new BookModel());
	}

	public function action(){
		if(isset($_COOKIE["id"])){
			$rid = $_COOKIE["id"];
			$this->tpl->assign("rid", $rid);
		}
		else
			$this->tpl->assign("rid", null);

		if(isset($_GET['type']) && isset($_GET['key'])){
			$type = $_GET['type'];
			$this->ty = $_GET['type'];
			$key = trim($_GET['key']);
			if($key == '')
				Tool::alertBack('请输入你要搜索的内容！！');

			$this->getModelByType($type, $key);
			$this->tpl->assign('type', $type);
			$this->tpl->assign('key', $key);
		}

	}


	//根据type来决定model
	private function getModelByType($type, $key){
		switch($type){
			case 'all':
				parent::page($this->model->getNumberByKey($key));
				$object = $this->model->getBookByKey($key);
				$this->getData($object, $key);
				break;

			case 'book':
				parent::page($this->model->getNumberByName($key));
				$object = $this->model->getBookByName($key);
				$this->getData($object, $key);
				break;

			case 'author':
				parent::page($this->model->getNumberByAuthor($key));
				$object = $this->model->getBookByAuthor($key);
				$this->getData($object, $key);
				break;

			case 'keyword':
				parent::page($this->model->getNumberByWord($key));
				$object = $this->model->getBookByWord($key);
				$this->getData($object, $key);
				break;

			case 'kind':
				parent::page($this->model->getNumberByKind($key));
				$object = $this->model->getBookByKind($key);
				$this->getData($object, $key);
				break;

			default:
				Tool::alertBack('非法操作！！');
		}
	}


	//获取数据
	private function getData($object, $key){
		$section = new SectionModel();
		$keyword = array();
		if(!empty($object))
		foreach($object as $value){
			$object1 = $section->getLatest($value->id);
			$value->title = $object1->title;
			$value->lid = $object1->id;
			$value->time = date('Y-m-d', $object1->time);
			$value->fid = $section->getFirst($value->id)->id;
			$value->name = $this->addTagForName($value->name, $key, $value->id);
			$value->kname = $this->addTag($value->kname, 'kind', $key);
			$value->pseudonym = $this->addTag($value->pseudonym, 'author', $key);

			if(Validate::checkLength($value->info, 160, 'max'))
				$value->info = mb_substr(Tool::trimspecial($value->info), 0, 160,"utf8")."...";
			else
				$value->info = Tool::trimspecial($value->info);

			//关键字
			$keyword = explode(',', $value->keyword);
			$value->word = '';
			for($i=0;$i<count($keyword);$i++){
				if(strpos($keyword[$i], $key) !==false){
					$value->word = $this->addTag($keyword[$i], 'keyword', $key);
					break;
				}
				else
					$value->word .= $this->addTag($keyword[$i], 'keyword', $key);
			}
		}

		$this->tpl->assign('Result', $object);
	}


	//加tag
	private function addTag(&$value, $type, $key){
		if(strpos(trim($value), $key) !==false){
			$a = $this->change($key, $value, $type);
			$value = '<a href="search.php?type='.$type.'&key='.$value.'">'.$a.'</a>';
		}
		else
			$value = '<a href="search.php?type='.$type.'&key='.$value.'">'.$value.'</a>';
		return $value;

	}

	//type为book的书名链接加tag
	private function addTagForName(&$value, $key, $id){
		if(strpos(trim($value), $key) !==false){
			$a = $this->change($key, $value, 'book');
			$value = '<a href="book.php?id='.$id.'" target="_blank">'.$a.'</a>';
		}
		else
			$value = '<a href="book.php?id='.$id.'" target="_blank">'.$value.'</a>';
		return $value;
	}
	
	
	private function change($key, $value, $type){
		$arr = array();
		$vb = '';
		$arr = explode($key, $value);
		for($i=0;$i<count($arr);$i++){
			if($i % 2 == 0){
				if($this->ty == $type || $this->ty == 'all')
					$arr[$i] = $arr[$i].'<span class="red">'.$key.'</span>';
				else
					$arr[$i] = $arr[$i].$key;
			}
				
			$vb .= $arr[$i];
		}
		return $vb;
	}

}

?>