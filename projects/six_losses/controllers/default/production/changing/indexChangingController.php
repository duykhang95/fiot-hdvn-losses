<?php 
/**
* 
*/
class indexChangingController extends Controller
{
	function __construct(){
		$this->folder = "default/production/changing";
	}
	function index()
	{
		$this->render('indexChanging',[]);
	}
	
}
?>