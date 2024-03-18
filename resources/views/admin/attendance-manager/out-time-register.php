<?php
    session_start();
    // if not have authorization redirect to home page
    if ($_SESSION['wb_role_id'] != 3) {
        $_SESSION['error_msg'] = 'true';
        header("Location: ../rouhani-dashboard.php");
        die();
    };
    include('../../connection/db_config.php');
    $sql = "UPDATE hrd_emp_ad SET out_time = DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s') WHERE emp_id = '{$_SESSION['emp_id']}' AND DATE_FORMAT(in_time, '%d-%m') = DATE_FORMAT(NOW(), '%d-%m')";
    $result = mysqli_query($conn, $sql) or die("Query Failed");
    if($result){
        echo "<script>
            alert('Your gate out time registered for today');
            window.location.pathname = '/RIPLAdmin/admin/rouhani-dashboard.php';
        </script>";
    }
?>