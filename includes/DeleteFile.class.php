<?php

//目录下文件的删除类

class DeleteFile 
{  
//循环目录下的所有文件  
  static public function delFileUnderDir($dirName)  
  {  

  if($handle = opendir("$dirName"))              //打开一个目录，返回句柄
  {
	//readdir()从句柄中读取条目  
    while ( false !== ($file = readdir($handle))){   //判断readdir()返回值是不是在类型和值上都不等于false，是的话就遍历
      if($file != "." && $file != ".."){       //判断文件$file是不是回到上级的"."（当前目录）和".."（上级目录）
        if(is_dir("$dirName/$file")){  
            delFileUnderDir("$dirName/$file");      //递归调用
        } 
        else{  
             if(unlink("$dirName/$file"))          //删除$dirName下的文件
                echo "成功删除文件： $dirName/$file<br />\n";
        }  
      }  
    } 

    closedir($handle);                              //关闭目录流

   }  
  }  
}  
?>