<?php 
/**
* 
*/
class checkpwController extends Controller
{
	function __construct(){
		$this->folder = "default/profile";
	}
	function index()
	{
		$this->render('checkpw',[]);
	}
	
}
?>