<?php
//定义最终的框架初始类
final class Frame
{
	//公共的静态的框架初始化方法
	public static function run()
	{
		self::initCharset(); //字符集初始化
		self::initConfig(); //初始化配置文件
		self::initRoute(); //初始化路由参数
		self::initConst(); //初始化常量定义
		self::initAutoLoad(); //初始化类的自动加载
		self::initDispatch(); //初始化请求分发
	}

	//私有的静态的字符集初始化方法
	private static function initCharset()
	{
		//声明网页字符集
		header("Content-Type:text/html;charset=utf-8");		
	}

	//私有的静态的初始化配置文件
	private static function initConfig()
	{
		$GLOBALS['config'] = require_once("./App/Conf/Config.php");
	}

	//私有的静态的初始化路由参数
	private static function initRoute()
	{
		$p = isset($_GET['p']) ? $_GET['p'] : $GLOBALS['config']['default_platform']; //平台参数
		$c = isset($_GET['c']) ? $_GET['c'] : $GLOBALS['config']['default_controller']; //控制器
		$a = isset($_GET['a']) ? $_GET['a'] : $GLOBALS['config']['default_action'];   //用户动作
		define("PLAT",$p); //平台常量
		define("CONTROLLER",$c);//控制器常量
		define("ACTION",$a); //动作常量
	}

	//私有的静态的初始化常量定义
	private static function initConst()
	{
		define("DS",DIRECTORY_SEPARATOR); //目录分割符，在windows下为'\'，在linux下为'/'
		define("ROOT_PATH",getcwd().DS); //网站根目录
		define("FRAME_PATH",ROOT_PATH . "Frame" . DS); //Frame目录
		define("VIEW_PATH",ROOT_PATH."App".DS.PLAT.DS."View".DS.CONTROLLER.DS);
		define("CONTROLLER_PATH",ROOT_PATH."App".DS.PLAT.DS."Controller".DS);
		define("MODEL_PATH",ROOT_PATH."App".DS.PLAT.DS."Model".DS);		
	}

	//私有的静态的类的自动加载
	private static function initAutoLoad()
	{
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
				if(file_exists($filename)) require_once($filename);
			}
		});		
	}

	//私有的静态的初始化请求分发
	//创建哪个控制器类的对象？
	//调用哪个控制器对象的方法？
	private static function initDispatch()
	{
		//创建控制器类对象：构建动态的控制器类名称
		$controllerClassName = CONTROLLER."Controller"; //例如：StudentController
		$controllerObj = new $controllerClassName();
		//根据用户不同的动作，调用控制器对象的不同方法
		$action_name = ACTION;
		$controllerObj->$action_name();
	}
}