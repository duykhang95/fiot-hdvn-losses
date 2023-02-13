<?php 
/**
* 
*/
class indexLongDtController extends Controller
{
	function __construct(){
		$this->folder = "default/production/longDt";
	}
	function index()
	{
		$this->render('indexLongDt',[]);
	}
	
}
?>