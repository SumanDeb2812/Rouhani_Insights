<?php
session_start();
//loguot automatically after 5 mins if has no activity
if (isset($_SESSION['last_active_time'])) {
    if (time() - $_SESSION['last_active_time'] > 300) {
        header("Location: ../../logout.php");
        die();
    }
}
$_SESSION['last_active_time'] = time();
//if not login then redirect to login page
if (!isset($_SESSION["emp_id"])) {
    header("Location: ../../login.php");
    die();
}
// if not have authorization redirect to home page and show alert
if ($_SESSION['wb_role_id'] != 1 and $_SESSION['wb_role_id'] != 2) {
    $_SESSION['error_msg'] = 'true';
    header("Location: ../rouhani-dashboard.php");
    die();
};

include('../components/inside-folder-admin-page-header.php');
?>

<div class="admin-header">
    <div class="admin-header-sub">
        <img src="../../images/logo2.png" alt="">
        <div>
            <a href="../rouhani-dashboard.php"><i class="fa fa-arrow-left"></i></a>
        </div>
    </div>
</div>
<div class="dashboarb-body">
    <div class="side-menu-dashboard">
        <div class="admin-side-menu">
            <a class="admin-side-menu-button active-dash-btn" href="rouhani-employee.php"><i class="fa fa-book" style="margin-right: 10px;"></i> Employee Attendance</a>
            <?php
            include('../../connection/db_config.php');
            //web-authorization
            $sql = "SELECT role_id FROM wb_emp_auth WHERE emp_id = '{$_SESSION["emp_id"]}' AND auth_status = 1";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['role_id'] == 1) {
                    echo '<a class="admin-side-menu-button" href="add-employee.php"><i class="fa fa-user-plus" style="margin-right: 10px;"></i> Generate Report</a>';
                }
            }?>
        </div>
    </div>
    <h3>Employee Attendance</h3>
    <div class="employee-list-table">
        <?php
        if($_SESSION['wb_role_id'] == 1){
            $sql2 = "SELECT * FROM hrd_emp_deatils";
        }
        if($_SESSION['wb_role_id'] == 2){
            $sql2 = "SELECT * FROM hrd_emp_deatils WHERE report_auth = '{$_SESSION["emp_id"]}'";
        }
        $result2 = mysqli_query($conn, $sql2) or die("Query Failed");
        if (mysqli_num_rows($result2) > 0) { 
        ?>
        <table>
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Email Id</th>
                    <th>Phone No.</th>
                    <th>D.O.B</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row2 = mysqli_fetch_assoc($result2)) {
                ?>
                    <tr>
                        <td><b><a style="text-decoration: none;" href="employee-detail.php?id=<?php echo bin2hex($row2['emp_id']) ?>"><?php echo $row2['emp_id'] ?></a></b></td>
                        <td><?php echo $row2['emp_fname'] .' '. $row2['emp_mname'] .' '. $row2['emp_lname'] ?></td>
                        <td><?php echo $row2['emp_email'] ?></td>
                        <td><?php echo $row2['emp_phone'] ?></td>
                        <?php
                        if ($row2['emp_dob'] != '0000-00-00') {
                        ?>
                            <td><?php echo date('d-M-Y', strtotime($row2["emp_dob"])) ?></td>
                        <?php
                        }
                        ?>
                    </tr>
                <?php }
                }else {
                    echo "<span class='alert alert-primary d-flex justify-content-center'>No id avaliable !!</span>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>