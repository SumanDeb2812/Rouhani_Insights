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
// if not have authorization redirect to home page
if ($_SESSION['wb_role_id'] != 3) {
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
            <a class="admin-side-menu-button active-dash-btn" href="my-attendance.php"><i class="fa fa-book" style="margin-right: 10px;"></i> My Attendance</a>
            <?php
                include('../../connection/db_config.php');
            ?>
        </div>
    </div>
    <h3>My Attendance</h3>
    <div class="employee-list-table">
        <?php
        $sql = "SELECT * FROM hrd_emp_ad WHERE emp_id = '{$_SESSION["emp_id"]}'";
        $result = mysqli_query($conn, $sql) or die("Query Failed");
        if (mysqli_num_rows($result) > 0) { 
        ?>
        <table>
            <thead>
                <tr class="text-center">
                    <th>Date</th>
                    <th>Attendance</th>
                    <th>Gate In Time</th>
                    <th>Gate Out Time</th>
                    <th>Abnormal Attendance</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr class="text-center">
                        <td><b><?php echo date('d-m-Y', strtotime($row['present_date'])); ?></b></td>
                        <td><?php 
                            if($row['in_time'] != null){
                                echo '<span class="badge bg-success">Present</span>';
                            }else if($row['out_time'] == null){
                                echo '<span class="badge bg-danger">Absent</span>';
                            }
                        ?></td>
                        <td><?php 
                            if($row['in_time'] != null){
                                echo date('h:ia', strtotime($row['in_time']));
                            }else{
                                echo '<p class="text-danger m-0">No date found</p>';
                            }
                        ?></td>
                        <td><?php 
                            if($row['out_time'] != null){
                                echo date('h:ia', strtotime($row['out_time']));
                            }else{
                                echo '<p class="text-danger m-0">No date found</p>';
                            }
                        ?></td>
                        <td><?php
                                if($row['ab_attendance'] == 1){
                                    echo '<i class="fa fa-check" style="color: green"></i>';
                                }else{
                                    echo '<i class="fa fa-times" style="color: red"></i>';
                                }
                        ?></td>
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