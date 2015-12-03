<?php

require substr(dirname(__FILE__), 0, -5)."/init.inc.php";

if(is_array($_GET)){
	if(isset($_GET['file'])){
		if($_GET['file'] == 'manage'){
			echo(json_encode(manage($_GET['id'])));
		}
		elseif($_GET['file'] == 'author'){
			echo(json_encode(author($_GET['id'])));
		}
		elseif($_GET['file'] == 'reader'){
			echo(json_encode(reader($_GET['id'])));
		}
		elseif($_GET['file'] == 'kind'){
			echo(json_encode(kind($_GET['id'])));
		}
		elseif($_GET['file'] == 'notice'){
			echo(json_encode(notice($_GET['id'])));
		}
		elseif($_GET['file'] == 'recommend'){
			echo(json_encode(recommend($_GET['id'])));
		}
		else{
			echo "参数错误！";
		}
	}
	else
		echo "接受数据失败！！";
}


function manage($id){
	$manage = new ManageModel();
	$arr = array();
	$object = $manage->getOneManage($id);
	$arr['name'] = $object->user;
	$arr['pass'] = $object->pass;
	$arr['state'] = $object->level;
	return $arr;
}


function author($id){
	$author = new AuthorModel();
	$arr = array();
	$object = $author->getOneAuthor($id);
	$arr['name'] = $object->name;
	$arr['pass'] = $object->pass;
	$arr['email'] = $object->email;
	$arr['pseudonym'] = $object->pseudonym;
	return $arr;
}

function reader($id){
	$reader = new ReaderModel();
	$arr = array();
	$object = $reader->getOneReader($id);
	$arr['name'] = $object->reader;
	$arr['pass'] = $object->pass;
	$arr['email'] = $object->email;
	$arr['state'] = $object->state;
	return $arr;
}

function kind($id){
	$kind = new KindModel();
	$arr = array();
	$object = $kind->getOneKind($id);
	$arr['name'] = $object->name;
	$arr['info'] = $object->info;
	return $arr;
}

function notice($id){
	$notice = new BbsModel();
	$arr = array();
	$object = $notice->getBBs($id);
	$arr['name'] = $object->title;
	$arr['info'] = html_entity_decode($object->content);
	return $arr;
}

function recommend($id){
	$recommend = new RecommendModel();
	$arr = array();
	$object = $recommend->getOneRecommend($id);
	$arr['name'] = $object->title;
	$arr['attr'] = $object->attr;
	$arr['href'] = $object->href;
	return $arr;
}

?>