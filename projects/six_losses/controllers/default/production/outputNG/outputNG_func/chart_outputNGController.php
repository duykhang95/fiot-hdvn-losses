<?php 
	class chart_outputNGController extends Controller
	{
		function __construct(){
			$this->folder = "default/production/outputNG/outputNG_func";
		}
		function index()
		{
			$this->render('chart_outputNG',[]);
		}
		
	}
?>