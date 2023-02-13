<?php 
/**
* 
*/
class indexPreparingController extends Controller
{
	function __construct(){
		$this->folder = "default/production/preparing";
	}
	function index()
	{
		$this->render('indexPreparing',[]);
	}
	
}
?>