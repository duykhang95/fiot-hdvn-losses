<?php 
	class data_preparingController extends Controller
	{
		function __construct(){
			$this->folder = "default/production/preparing/preparing_func";
		}
		function index()
		{
			$this->render('data_preparing',[]);
		}
	}
?>