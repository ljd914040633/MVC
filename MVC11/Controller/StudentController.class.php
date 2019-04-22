<?php
//定义最终的学生控制器类，并继承基础控制器类
final class StudentController extends BaseController
{
	//首页显示方法
	public function index()
	{
		$modelObj = FactoryModel::getInstance("StudentModel");
		$arrs = $modelObj->fetchAll();
		include "./View/Student/index.html";
	}

	//显示添加的表单
	public function add()
	{
		//包含添加视图文件
		include "./View/Student/add.html";
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
			$this->jump("记录插入成功！",'?c=Student');
		}else
		{
			$this->jump("记录插入失败！",'?c=Student');			
		}
	}

	//显示修改的表单
	public function edit()
	{
		//获取地址栏传递的id
		$id = $_GET['id'];

		//创建学生模型类对象
		$modelObj = FactoryModel::getInstance("StudentModel");

		//获取指定ID的数据
		$arr = $modelObj->fetchOne($id);

		//包含视图文件
		include "./View/Student/edit.html";
	}

	//更新数据
	public function update()
	{
		//获取表单数据
		$id = $_POST['id'];
		$data['name']	= $_POST['name'];
		$data['sex']	= $_POST['sex'];
		$data['age']	= $_POST['age'];
		$data['edu']	= $_POST['edu'];
		$data['salary']	= $_POST['salary'];
		$data['bonus']	= $_POST['bonus'];
		$data['city']	= $_POST['city'];

		//创建学生模型类对象
		$modelObj = FactoryModel::getInstance("StudentModel");

		//判断数据是否更新成功
		if($modelObj->update($data,$id))
		{
			$this->jump("id={$id}的记录更新成功！",'?c=Student');
		}else
		{
			$this->jump("id={$id}的记录更新失败！",'?c=Student');
		}
	}

	//删除方法
	public function delete()
	{
		$id = $_GET['id'];
		$modelObj = FactoryModel::getInstance("StudentModel");
		if($modelObj->delete($id))
		{
			$this->jump("id={$id}记录删除成功",'?c=Student');
		}else
		{
			$this->jump("id={$id}记录删除失败",'?c=Student');
		}
	}
}