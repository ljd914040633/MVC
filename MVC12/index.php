<?php
//获取路由参数
$p = isset($_GET['p']) ? $_GET['p'] : "Home";    //平台参数
$c = isset($_GET['c']) ? $_GET['c'] : "Student"; //控制器
$a = isset($_GET['a']) ? $_GET['a'] : "index";   //用户动作

//包含所有类文件
require_once("./Frame/Db.class.php");
require_once("./Frame/BaseController.class.php");
require_once("./Frame/BaseModel.class.php");
require_once("./Frame/FactoryModel.class.php");
require_once("./App/$p/Model/StudentModel.class.php");
require_once("./App/$p/Model/NewsModel.class.php");
require_once("./App/$p/Controller/StudentController.class.php");
require_once("./App/$p/Controller/NewsController.class.php");

//创建控制器类对象：构建动态的控制器类名称
$controllerClassName = $c."Controller"; //例如：StudentController
$controllerObj = new $controllerClassName();
//根据用户不同的动作，调用控制器对象的不同方法
$controllerObj->$a();