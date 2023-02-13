<?php 
/**
* 
*/
class indexOutputNGController extends Controller
{
	function __construct(){
		$this->folder = "default/production/outputNG";
	}
	function index()
	{
		$this->render('indexOutputNG',[]);
	}
	
}
?>