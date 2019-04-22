<?php
//包含数据库工具类
require_once("./Db.class.php");
//定义最终的学生模型类
final class StudentModel
{
	//私有的保存数据库对象的属性
	private $db = NULL;

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

	//获取多行数据
	public function fetchAll()
	{
		//构建查询的SQL语句
		$sql = "SELECT * FROM student ORDER BY id DESC";
		//执行SQL语句，并返回结果(二维数组)
		return $this->db->fetchAll($sql);
	}

	//删除记录的方法
	public function delete($id)
	{
		//构建删除的SQL语句
		$sql = "DELETE FROM student WHERE id={$id}";
		//执行SQL语句，并返回结果(布尔值)
		return $this->db->exec($sql);
	}
}