<?php
//获取路由参数
$p = isset($_GET['p']) ? $_GET['p'] : "Home";    //平台参数
$c = isset($_GET['c']) ? $_GET['c'] : "Student"; //控制器
$a = isset($_GET['a']) ? $_GET['a'] : "index";   //用户动作
define("PLAT",$p); //平台常量
define("CONTROLLER",$c);//控制器常量

//定义目录常量
define("DS",DIRECTORY_SEPARATOR); //目录分割符，在windows下为'\'，在linux下为'/'
define("ROOT_PATH",getcwd().DS); //网站根目录
define("FRAME_PATH",ROOT_PATH . "Frame" . DS); //Frame目录
define("VIEW_PATH",ROOT_PATH."App".DS.PLAT.DS."View".DS.CONTROLLER.DS);
define("CONTROLLER_PATH",ROOT_PATH."App".DS.PLAT.DS."Controller".DS);
define("MODEL_PATH",ROOT_PATH."App".DS.PLAT.DS."Model".DS);

//类的自动加载
spl_autoload_register(function($className){
	//构建类文件路径数组
	$arr = array(
		FRAME_PATH . "$className.class.php",
		MODEL_PATH . "$className.class.php",
		CONTROLLER_PATH . "$className.class.php",
	);

	//循环类文件数组
	foreach($arr as $filename)
	{
		//如果类文件存在，则包含
		if(file_exists($filename))
		{
			echo $filename."<br>";
			require_once($filename);
		}
	}
});

//创建控制器类对象：构建动态的控制器类名称
$controllerClassName = $c."Controller"; //例如：StudentController
$controllerObj = new $controllerClassName();
//根据用户不同的动作，调用控制器对象的不同方法
$controllerObj->$a();