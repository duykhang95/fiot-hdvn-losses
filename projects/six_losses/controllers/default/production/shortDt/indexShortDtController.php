<?php 
/**
* 
*/
class indexShortDtController extends Controller
{
	function __construct(){
		$this->folder = "default/production/shortDt";
	}
	function index()
	{
		$this->render('indexShortDt',[]);
	}
	
}
?>