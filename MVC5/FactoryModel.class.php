<?php
//包含所有模型类
require_once("./StudentModel.class.php");
require_once("./NewsModel.class.php");

//定义最终的工厂模型类
final class FactoryModel
{
	//私有的静态的保存不同模型类对象的数组
	private static $arr = array();
	/*
		$arr['StudentModel'] = 学生模型类对象
		$arr['NewsModel']    = 新闻模型类对象
	 */
	//公共的静态创建不同模型类对象的方法
	public static function getInstance($className)
	{
		//判断当前模型类对象是否存在
		if(empty(self::$arr[$className]))
		{
			//如果模型类对象不存在，创建并保存它
			self::$arr[$className] = new $className;
		}
		//返回当前模型类对象
		return self::$arr[$className];
	}
}