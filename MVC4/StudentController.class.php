<?php
//声明网页字符集
header("Content-Type:text/html;charset=utf-8");
//(1)包含工厂模型类文件
require_once("./FactoryModel.class.php");

//定义最终的学生控制器类
final class StudentController
{
	//删除方法
	public function delete(){
		$id = $_GET['id'];
		$modelObj = FactoryModel::getInstance("StudentModel");
		if($modelObj->delete($id)){
			echo "<h2>id={$id}记录删除成功!</h2>";
			header("refresh:3;url=?");
			die();
		}else{
			echo "<h2>id={$id}记录删除失败！</h2>";
			header("refresh:3;url=?");
			die();
		}
	}
	//首页显示方法
	public function index(){
		$modelObj = FactoryModel::getInstance("StudentModel");
		$arrs = $modelObj->fetchAll();
		include "./StudentIndexView.html";
	}
}

//获取用户的动作参数
$ac = isset($_GET['ac']) ? $_GET['ac'] : "";

//创建学生控制器类对象
$controllerObj = new StudentController();
//根据用户不同的动作，调用控制器对象的不同方法
if($ac=='delete')
{
	$controllerObj->delete();
}else{
	$controllerObj->index();
}


