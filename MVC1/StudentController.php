<?php
//声明网页字符集
header("Content-Type:text/html;charset=utf-8");
//(1)包含学生模型类文件
require_once("./StudentModel.class.php");
//(2)获取用户的动作参数
$ac = isset($_GET['ac']) ? $_GET['ac'] : "";
//(3)根据用户不同的动作，调用模型类的不同方法
if($ac=='delete')
{
	//获取地址栏传递的id参数
	$id = $_GET['id'];
	//创建学生模型类对象
	$modelObj = new StudentModel();
	//判断数据是否删除成功
	if($modelObj->delete($id))
	{
		echo "<h2>id={$id}记录删除成功!</h2>";
		header("refresh:3;url=?");
		die();
	}else
	{
		echo "<h2>id={$id}记录删除失败！</h2>";
		header("refresh:3;url=?");
		die();
	}
}else
{
	//创建学生模型类对象
	$modelObj = new StudentModel();	
	//获取多行数据
	$arrs = $modelObj->fetchAll();
	//包含视图文件
	include "./StudentIndexView.html";
}


