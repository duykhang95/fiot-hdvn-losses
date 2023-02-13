<?php
	//Open connection
	require_once "config/config.php";
    $connect = $GLOBALS['connect'];

	$select_line = isset($_GET['select_line']) ? $_GET['select_line'] : NULL;
	//Show HCM date & time format like 2015-07-22 08:30:30 
	echo 'Vietnam, HoChiMinh now time is ', date("Y-m-d H:i:s");
	$date = getdate();
	
	//Time stamp (seconds since 1970-01-01)
	$now_time = time(); //at the moment when run this code
	$now = date("Y-m-d H:i:s", $now_time);
	$today_00h = mktime("00", "00", "00", "$date[mon]", "$date[mday]", "$date[year]");
	$today_06h = $today_00h + 6*3600;
	$w_06h_00daybefore = date("Y-m-d H:i:s", $today_06h - 0*24*3600);
	$w_06h_01daybefore = date("Y-m-d H:i:s", $today_06h - 1*24*3600);
	$w_06h_30daybefore = date("Y-m-d H:i:s", $today_06h - 35*24*3600);
	$date_6h_30daybefore = strtotime($w_06h_30daybefore);
	
	//STEP-1: Get Datetime of oldest record in database <data_aw2> like 2017-11-06 08:25:12
	$r_aw2 = mysqli_query($connect,"SELECT time FROM " . $select_line . "_output_5_2 " . "ORDER BY id ASC LIMIT 1");	
	while ($row = $r_aw2->fetch_assoc()) {
        $first_aw2 = $row['time'];
    }                   
    
    echo '<br>Datetime of oldest record in table data_aw2 is ', $first_aw2;
	$first_timestamp_aw2 = strtotime($first_aw2);                                       
    echo '<br>Convert to timestamp is ', $first_timestamp_aw2;
	
	//STEP-2: Make Datetime of oldest record round down to nearest hour like 2017-11-06 08:00:00
	$first_timestamp_aw2_fix = $first_timestamp_aw2 - ($first_timestamp_aw2 % 3600);    
    echo '<br>Round down to full hour is ', $first_timestamp_aw2_fix;
	$first_aw2_fix = date("Y-m-d H:i:s", $first_timestamp_aw2_fix);                     
    echo '<br>Reconvert to datetime is ', $first_aw2_fix;
	
	//STEP-3: Get Datetime of newest record in table hourly_aw2 like 2017-11-29 14:00:00
	$q_aw2 = mysqli_query($connect,"SELECT time FROM " . $select_line . "_hourly_output " . "ORDER BY time DESC LIMIT 1");
	while ($row = $q_aw2->fetch_assoc()) {$last_hourly_aw2 = $row['time'];}				
    echo '<br>Datetime of newest record in table hourly_aw2 is ', $last_hourly_aw2;
	$last_timestamp_hourly_aw2 = strtotime($last_hourly_aw2);							
    echo '<br>Convert to timestamp is ', $last_timestamp_hourly_aw2;
	
	//STEP-4: Archive hourly output from table data_aw2 and add to table hourly_aw2
	echo '<br>--------------------------------------';
	if ($first_timestamp_aw2 == 0)
	{
		echo '<br>Nothing to archive in table data_aw2!';
	}
	else
	{
		if (($first_timestamp_aw2_fix + 3600) >= $last_timestamp_hourly_aw2)
		{
			$h = $first_timestamp_aw2_fix;
			$h1 = $h + 3600;
		}
		else
		{
			$h = $last_timestamp_hourly_aw2 - ($last_timestamp_hourly_aw2 % 3600);
			$h1 = $h + 3600;
		}
		//$h2 = $h + 14400;
		//while($h1 <= $h2)
		while($h1 <= $today_06h)
	    {
	        $l = date("Y-m-d H:i:s", $h);
	        $l1 = date("Y-m-d H:i:s", $h1);
	        //$hourly_output = mysqli_num_rows(mysqli_query($connect,"select * from data_aw2 where time>='$l' AND time<'$l1'"));
	        $q_hourly_output = mysqli_query($connect,"select sum(output) AS value_sum from " . $select_line . "_output_5_2 " . "where time >='$l' AND time<'$l1'"); 
            while ($row = $q_hourly_output->fetch_assoc()) {
                $hourly_output = $row['value_sum'];
                $hourly_output = round($hourly_output);
            }
			
			$archive = mysqli_query($connect,"INSERT INTO " . $select_line . "_hourly_output (output, time) VALUES ($hourly_output, '$l1')");
			
	        echo '<br>Output from (and include) ', $l,' to ', $l1, ' is ', $hourly_output, ' pcs.';
	        $h = $h + 3600;
	        $h1 = $h1 + 3600;
	    }
	}
    
    //STEP-5: Delete records older than 2 weeks in aw2_output_5_2
	//Check last_timestamp_hourly in table aw2_hourly_output
	$hourly_output5 = mysqli_query($connect,"SELECT time FROM " . $select_line . "_hourly_output ORDER BY time DESC LIMIT 1");
	while ($row = $hourly_output5->fetch_assoc()) {
	    $last_hourly_output5 = $row['time'];
	}
	echo '<br>Last record is ', $last_hourly_output5;
	
	$last_datetime_output5 = strtotime($last_hourly_output5);
	echo '<br>Convert last datetime output is ', $last_datetime_output5;
	
	$output5_30daysbefore = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM " . $select_line . "_output_5_2 WHERE time < '$w_06h_30daybefore'"));
	echo '<br>Count records: ',$output5_30daysbefore;
	
	if ($last_datetime_output5 > $date_6h_30daybefore)
    {
        echo 'abc';
    	if ($output5_30daysbefore > 0) 
    	{
    		$delete_output5_30daysbefore = mysqli_query($connect,"DELETE FROM " . $select_line . "_output_5_2 WHERE `time` < '$w_06h_30daybefore'"); 
    		echo '<br>It cleaned ', $output5_30daysbefore, ' old records of `aw2_output_5_2`';
    	} 
    	else 
    	{
    		echo '<br>Nothing to do!';
    	}
    }
    else 
    {
    	echo '<br>You must archive old records of $select_line_output_5 before delete it';
    }
    //Count how many records older than 30 days
	//$m107_30daybefore = mysqli_num_rows(mysqli_query($connect,"select * from data_aw2 where time<'$w_06h_30daybefore'"));
	
	//Summary detail outputs from data_aw2 table to store in hourly_aw2
	
	//Clean all records older than 30 days if any
	//if ($m107_30daybefore > 0) {$q_aw2 = mysqli_query($connect,"DELETE from data_aw2 WHERE time<'$w_06h_30daybefore'"); echo '<br>Already cleaned: ', $m107_30daybefore, ' old records of M.107';} else {echo '<br>Nothing to clean for M.107!';}
?>
