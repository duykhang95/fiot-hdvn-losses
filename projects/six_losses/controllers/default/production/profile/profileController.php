<?php 
/**
* 
*/
class profileController extends Controller
{
	function __construct(){
		$this->folder = "default/profile";
	}
	function index()
	{
		$this->render('profile',[]);
	}
	
}
?>