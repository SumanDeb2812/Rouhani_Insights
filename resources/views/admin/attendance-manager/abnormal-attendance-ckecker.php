<?php
    include('../../connection/db_config.php');
    date_default_timezone_set('Asia/Kolkata');
    $time = date('23:59');
    // echo $time . '<br>';
    // echo date('H:i');
    if($time == date('H:i')){
        $result = mysqli_query($conn, "SELECT * FROM hrd_emp_ad WHERE DATE_FORMAT(in_time, '%d-%m') = DATE_FORMAT(NOW(), '%d-%m')") or die("Query Failed");
        if(mysqli_num_rows($result) > 0){
            // echo '<pre>';
            // print_r($row);
            $sql = "UPDATE hrd_emp_ad SET ab_attendance = 1 WHERE out_time IS NULL AND in_time IS NOT NULL";
            mysqli_query($conn, $sql) or die("Query Failed");
        }
    }
?>