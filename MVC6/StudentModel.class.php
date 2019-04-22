<?php
//包含基础模型类
require_once("./BaseModel.class.php");

//定义最终的学生模型类，并继承基础模型类
final class StudentModel extends BaseModel
{
	//获取多行数据
	public function fetchAll()
	{
		//构建查询的SQL语句
		$sql = "SELECT * FROM student ORDER BY id DESC";
		//执行SQL语句，并返回结果(二维数组)
		return $this->db->fetchAll($sql);
	}

	//插入数据
	public function insert($data)
	{
		//构建字段名列表和字段值列表
		$fields = "";
		$values = "";
		foreach($data as $key=>$value)
		{
			$fields .= "$key,";
			$values .= "'$value',";
		}
		//去除结尾的逗号
		$fields = rtrim($fields,',');
		$values = rtrim($values,',');

		//构建插入的SQL语句
		$sql = "INSERT INTO student({$fields}) VALUES({$values})";
	
		//执行SQL语句，并返回结果(布尔值)
		return $this->db->exec($sql);
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