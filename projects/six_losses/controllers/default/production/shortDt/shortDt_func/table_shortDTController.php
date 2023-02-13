<?php 
	class table_shortDTController extends Controller
	{
		function __construct(){
			$this->folder = "default/production/shortDt/shortDt_func";
		}
		function index()
		{
			$this->render('table_shortDT',[]);
		}
		
	}
?>