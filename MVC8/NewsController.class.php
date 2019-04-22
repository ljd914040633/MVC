<?php
//包含基础控制器类文件
require_once("./BaseController.class.php");

//定义最终的新闻控制器类，并继承基础控制器类
final class NewsController extends BaseController
{
	//首页显示方法
	public function index()
	{
		$modelObj = FactoryModel::getInstance("NewsModel");
		$arrs = $modelObj->fetchAll();
		include "./NewsIndexView.html";
	}

	//删除方法
	public function delete()
	{
		$id = $_GET['id'];
		$modelObj = FactoryModel::getInstance("NewsModel");
		if($modelObj->delete($id))
		{
			$this->jump("id={$id}记录删除成功!");
		}else
		{
			$this->jump("id={$id}记录删除失败！");
		}
	}
}

//获取用户的动作参数
$ac = isset($_GET['ac']) ? $_GET['ac'] : "index";
//创建新闻控制器类对象
$controllerObj = new NewsController();
//根据用户不同的动作，调用控制器对象的不同方法
$controllerObj->$ac();
