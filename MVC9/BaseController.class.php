<?php
//包含工厂模型类文件
require_once("./FactoryModel.class.php");

//定义抽象的基础控制器类
abstract class BaseController
{
	//构造方法
	public function __construct()
	{
		//声明网页字符集
		header("Content-Type:text/html;charset=utf-8");
	}

	//受保护的跳转方法
	protected function jump($message,$time=3,$url='?')
	{
		echo "<h2>{$message}</h2>";
		header("refresh:{$time};url={$url}");
		die();		
	}
}