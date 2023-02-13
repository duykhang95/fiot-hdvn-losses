<!-- chart_shortDtController -->
<?php 

class chart_shortDtController extends Controller
{
	function __construct(){
		$this->folder = "default/production/shortDt/shortDt_func";
	}
	function index()
	{
		$this->render('chart_shortDt',[]);
	}
	
}
?>