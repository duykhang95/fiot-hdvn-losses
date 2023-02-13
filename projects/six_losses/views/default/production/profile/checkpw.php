<?php
if(isset($_POST['checkpw']) && $_POST['checkpw'] == "yes"){
    $data_load = array();
    $data_check = "no";
    $current_pw_1 = $_POST['curent_pw_js']; 
    $new_pw_1 = $_POST['new_pw_js'];
    if(password_verify($new_pw_1,$current_pw_1)){
        $data_check = "yes";
    }
	array_push($data_load, $data_check);
	echo json_encode($data_load);
}else {
	echo '<script>history.back()</script>';
}
?>