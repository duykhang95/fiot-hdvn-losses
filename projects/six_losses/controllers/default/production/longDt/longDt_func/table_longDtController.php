<?php 
	class table_longDtController extends Controller
	{
		function __construct(){
			$this->folder = "default/production/longDt/longDt_func";
		}
		function index()
		{
			$this->render('table_longDt',[]);
		}
		
	}
?>