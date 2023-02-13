<?php 
	class data_changingController extends Controller
	{
		function __construct(){
			$this->folder = "default/production/changing/changing_func";
		}
		function index()
		{
			$this->render('data_changing',[]);
		}
	}
?>