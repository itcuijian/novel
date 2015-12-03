<?php

//验证码类
class ValidateCode{
	private $charset = "abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789";    //随机因子
   	private $code;                  //验证码
   	private $codelen = 4;           //验证码长度
   	private $width = 130;           //宽度
   	private $height = 50;           //高度
   	private $img;                   //图像资源句柄
   	private $font;                  //指定的字体
   	private $fontsize = 20;              //指定字体的大小
   	private $fontcolor;             //指定字体的颜色


   	//构造方法
   	public function __construct()
   	{
   		$this->font = ROOT_PATH."/fonts/elephant.ttf";
   	}

   	//生成随机码
   	private function createCode()
   	{
   		$this->code = "";
   		$len = strlen($this->charset) - 1;
   		for($i=0;$i<$this->codelen;$i++)
   		{
   			$this->code .= $this->charset[mt_rand(0,$len)];
   		}
   		
   		return $this->code;
   	}


   	//生成背景
   	private function createBg()
   	{
   		$this->img = imagecreatetruecolor($this->width, $this->height);
   		$color = imagecolorallocate($this->img, mt_rand(157,255), mt_rand(157,255), mt_rand(157,255));
   		imagefilledrectangle($this->img, 0, $this->height, $this->width, 0, $color);
   	}

   	//输出背景
	private function outPut()
	{
		// ob_clean();
	    header('Content-type:image/png');
  		imagepng($this->img);
  		imagedestroy($this->img);

	}

	//生成字体
	private function createFont()
	{
		
		$x = $this->width / 4;
		for($i=0;$i<$this->codelen;$i++)
         {
         	$this->fontcolor = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
         	imagettftext($this->img, $this->fontsize, mt_rand(-30,30), $x*$i+mt_rand(1,5), $this->height/1.4, $this->fontcolor, $this->font, $this->code[$i]);
         }		
	}


	//生成线条和雪花
	private function createLine()
	{
		for($i=0;$i<6;$i++)
		{
			$color = imagecolorallocate($this->img, mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
			imageline($this->img, mt_rand(0,$this->width), mt_rand(0,$this->height), mt_rand(0,$this->width), mt_rand(0,$this->height), $color);
		}
        
        // for($i=0;$i<100;$i++)
        // {
        // 	$color = imagecolorallocate($this->img, mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
        // 	imagestring($this->img, mt_rand(1,5), mt_rand(0,$this->width), mt_rand(0,$this->height), '*', $color);
        // }


	}

	//对外生成
	public function doimg()
	{
		$this->createBg();
		$this->createCode();	
		$this->createLine();
    	$this->createFont();
		$this->outPut();
	}

	//获取验证码
	public function getCode()
	{
		return strtolower($this->code);
	}

}

?>