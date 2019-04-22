<?php
//包含基础控制器类文件
require_once("./BaseController.class.php");

//定义最终的学生控制器类，并继承基础控制器类
final class StudentController extends BaseController
{
	//首页显示方法
	public function index()
	{
		$modelObj = FactoryModel::getInstance("StudentModel");
		$arrs = $modelObj->fetchAll();
		include "./StudentIndexView.html";
	}

	//删除方法
	public function delete()
	{
		$id = $_GET['id'];
		$modelObj = FactoryModel::getInstance("StudentModel");
		if($modelObj->delete($id))
		{
			$this->jump("id={$id}记录删除成功");
		}else
		{
			$this->jump("id={$id}记录删除失败");
		}
	}

	//显示添加的表单
	public function add()
	{
		//包含添加视图文件
		include "./StudentAddView.html";
	}

	//插入数据
	public function insert()
	{
		//获取表单提交值
		$data['name']	= $_POST['name'];
		$data['sex'] 	= $_POST['sex'];
		$data['age'] 	= $_POST['age'];
		$data['edu'] 	= $_POST['edu'];
		$data['salary'] = $_POST['salary'];
		$data['bonus'] 	= $_POST['bonus'];
		$data['city'] 	= $_POST['city'];

		//创建学生模型类对象
		$modelObj = FactoryModel::getInstance('StudentModel');

		//判断数据是否插入成功
		if($modelObj->insert($data))
		{
			$this->jump("记录插入成功！");
		}else
		{
			$this->jump("记录插入失败！");			
		}
	}


}

//获取用户的动作参数
$ac = isset($_GET['ac']) ? $_GET['ac'] : "index";
//创建学生控制器类对象
$controllerObj = new StudentController();
//根据用户不同的动作，调用控制器对象的不同方法
$controllerObj->$ac();