<?php 
	class data_outputNGController extends Controller
	{
		function __construct(){
			$this->folder = "default/production/outputNG/outputNG_func";
		}
		function index()
		{
			$this->render('data_outputNG',[]);
		}
	}
?>