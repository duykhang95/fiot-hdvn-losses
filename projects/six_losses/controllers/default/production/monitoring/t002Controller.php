<?php 
/**
* 
*/
class t002Controller extends Controller
{
	function __construct(){
		$this->folder = "default/monitoring";
	}
	function index()
	{
		$this->render('t002',[]);
	}
	
}
?>