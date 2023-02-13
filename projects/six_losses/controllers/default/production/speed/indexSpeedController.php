<?php 
/**
* 
*/
class indexSpeedController extends Controller
{
	function __construct(){
		$this->folder = "default/production/speed";
	}
	function index()
	{
		$this->render('indexSpeed',[]);
	}
	
}
?>