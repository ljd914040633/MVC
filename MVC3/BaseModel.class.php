<?php
//包含数据库工具类
require_once("./Db.class.php");

//定义抽象的基础模型类
abstract class BaseModel
{
	//受保护的数据库对象的属性
	protected $db = NULL;

	//公共的构造方法
	public function __construct()
	{
		//创建数据库类的对象
		$arr = array(
			'db_host' => 'localhost',
			'db_port' => '3306',
			'db_user' => 'root',
			'db_pass' => 'root',
			'db_name' => 'itcast',
			'charset' => 'utf8'
		);
		$this->db = Db::getInstance($arr);
	}	
}