<?php
    session_start();
    // if not have authorization redirect to home page
    if ($_SESSION['wb_role_id'] != 3) {
        $_SESSION['error_msg'] = 'true';
        header("Location: ../rouhani-dashboard.php");
        die();
    };
    include('../../connection/db_config.php');
    $sql = "INSERT INTO hrd_emp_ad (emp_id, in_time) VALUES ('{$_SESSION["emp_id"]}', DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s'));";
    $result = mysqli_query($conn, $sql) or die("Query Failed");
    if($result){
        echo "<script>
            alert('Your gate in time registered for today');
            window.location.pathname = '/RIPLAdmin/admin/rouhani-dashboard.php';
        </script>";
    }
?>