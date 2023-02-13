<?php 
/**
* 
*/
class t001Controller extends Controller
{
	function __construct(){
		$this->folder = "default/monitoring/";
	}
	function index()
	{
		$this->render('t001',[]);
	}
	
}
?>