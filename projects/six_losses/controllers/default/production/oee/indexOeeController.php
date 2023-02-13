<?php 
/**
* 
*/
class indexOeeController extends Controller
{
	function __construct(){
		$this->folder = "default/production/oee";
	}
	function index()
	{
		$this->render('indexOee',[]);
	}
	
}
?>