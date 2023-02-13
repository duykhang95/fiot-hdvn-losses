<?php
	class Controller
	{
		protected $folder;

		function render($file, $data = array(), $title = null, $admin = null)
		{
			$file_path = "projects/six_losses/views/" . $this->folder . "/" . $file . ".php";
			if (file_exists($file_path)) {
				ob_start(); //start output buffering
				require_once($file_path);
				$content = ob_get_clean(); // gui toan bo code len server va luu vao bien content
				if ($admin == null && $file != 'table_shortDT' && $file != 'chart_shortDt' && $file != 'data_shortDT'
					&& $file != 'table_longDt' && $file != 'chart_longDt' && $file != 'data_longDt'
					&& $file != 'table_outputNG' && $file != 'chart_outputNG'
					&& $file != 'data_preparing' && $file != 'data_changing'
					&& $file != 'chart_oee_monthly' && $file != 'data_chart_monthly' && $file != 'data_oee' && $file != 'data_oee_history'
					&& $file != 'data_indexSX' && $file != 'chart_perform_monthly' && $file != 'chart_losses_monthly'
					&& $file != 'chart_speed' && $file != 'data_speed' && $file != 'data_historyInterval' 
					&& $file != 'data_email') {
					$active_page_sub = $file;
					require_once 'projects/common/views/layouts/application.php';
					require_once 'projects/common/views/layouts/alert.php';
				} else {
					require_once 'projects/common/views/layouts/admin.php';
				}
			} else {
				echo "Khong tim thay view";
				echo "<br>" . $file_path;
			}
		}
	}
?>