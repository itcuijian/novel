<?php
class Image{
	private $file;     //图片地址
	private $img;      //原图片资源句柄
	private $new ;     //新图片地址
	private $copy;     //复制的图片句柄
	private $x;        //裁剪横坐标
	private $y;        //裁剪纵坐标
	private $w;        //裁剪长度
	private $h;        //裁剪宽度
	private $width;    //缩放长度
	private $height;   //缩放宽度


	public function __construct($file, $x, $y, $w, $h, $width, $height){
		$this->file = substr($_SERVER["DOCUMENT_ROOT"], 0, -1).$file;
		$arr = getimagesize($this->file);
		$type = $arr[2];
		$this->img = $this->getFromImg($this->file, $type);
		$this->x = $x;
		$this->y = $y;
		$this->w = $w;
		$this->h = $h;
		$this->width = $width;
		$this->height = $height;
	}


	//裁剪缩放
	public function thumb(){
		$this->copy = imagecreatetruecolor($this->w, $this->h);  //创建一个新的图像句柄，作为中间图像
		$this->new = imagecreatetruecolor($this->width, $this->height); //创建一个新的图像句柄，作为输出的图像
		imagecopy($this->copy, $this->img, 0, 0, $this->x, $this->y, $this->w, $this->h); //将原图像按照接受的长度和宽度裁剪
		imagecopyresampled($this->new, $this->copy, 0, 0, 0, 0, $this->width, $this->height, $this->w, $this->h); //按要求长度和宽度缩放
	}


	//输出
	public function out(){
		imagejpeg($this->new, $this->file);
		imagedestroy($this->img);
		imagedestroy($this->copy);
		imagedestroy($this->new);
	}


	//各种类型的图片加载，返回资源句柄
	private function getFromImg($file,$type)
	{
 		switch($type)
 		{
 			case 1:
	 			$img = imagecreatefromgif($file);
	 			break;
 			case 2:
	 			$img = imagecreatefromjpeg($file);
	 			break;
 			case 3:
	 			$img = imagecreatefrompng($file);
	 			break;
 			default:
 				Tool::alertBack("警告：不支持此图片类型！");
 		}

 		//返回资源句柄
 		return $img;	
	}
}


?>