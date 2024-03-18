<?php
session_start();
if (isset($_SESSION['last_active_time'])) {
    if (time() - $_SESSION['last_active_time'] > 300) {
        header("Location: ../../logout.php");
        die();
    }
}
$_SESSION['last_active_time'] = time();
if (!isset($_SESSION['user_name'])) {
    header("Location: ../../login.php");
    die();
}

include('../../components/admin-pages-header.php')
?>

<div class="post-header">
    <h3>Holidays and Birthdays</h3>
    <div>
        <a href="../rouhani-dashboard.php"><i class="fa fa-arrow-left"></i></a>
    </div>
</div>
<div class="container post-container">
    <div class="hab-heading">
        <h4>Employee's Birthday</h4>
    </div>
    <div class="table-responsive-lg mb-5">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>D.O.B</th>
                    <th>Status</th>
                    <?php
                    if ($_SESSION['user_name'] == 'Admin') {
                        echo '<th>Wish Mail</th>';
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../../connection/db_config.php');
                $sql = "SELECT * FROM rouhani_users WHERE NOT user_name = 'Admin'";
                $result = mysqli_query($conn, $sql) or die("Query Failed");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td><?php echo $row['user_name'] ?></td>
                            <td><?php echo $row['user_email'] ?></td>
                            <td><?php echo $row["user_dob"] ?></td>
                            <?php
                            if (date('m-d', strtotime($row['user_dob'])) < date('m-d')) {
                                echo '<td><span class="badge bg-success"> complete </span></td>';
                            } elseif (date('m-d', strtotime($row['user_dob'])) == date('m-d')) {
                                echo '<td><span class="badge bg-primary"> today !! </span></td>';
                            } else {
                                echo '<td><span class="badge bg-danger"> coming... </span></td>';
                            }
                            if ($_SESSION['user_name'] == 'Admin') {
                                if ($row['wish_sent'] == 1) {
                                    echo '<td><span class="badge bg-success"> Sent </span> </td>';
                                } else {
                                    echo '<td><span class="badge bg-danger"> Not Send </span></td>';
                                }
                            }
                            ?>
                        </tr>
                <?php
                    }
                } else {
                    echo "<p style='margin-top:100px'>No result found</p>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="hab-heading">
        <h4>Holiday List</h4>
        <?php
        if ($_SESSION['user_name'] == 'Admin') { ?>
            <a href="add-holiday.php"><button>Add Holiday</button></a>
        <?php
        }
        ?>
    </div>
    <?php
    $sql = "SELECT * FROM rouhani_holidays";
    $result = mysqli_query($conn, $sql) or die("Query Failed");
    if (mysqli_num_rows($result) > 0) {
    ?>
        <div class="table-responsive-lg mb-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>Holiday Name</th>
                        <th>Date</th>
                        <th>Status</th>
                        <?php
                        if ($_SESSION['user_name'] == 'Admin') {
                            echo '<th>Wish Mail</th>';
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['holiday_name'] ?></td>
                            <td><?php echo $row['holiday_date'] ?></td>
                            <?php
                            if (date('m-d', strtotime($row['holiday_date'])) < date('m-d')) {
                                echo '<td><span class="badge bg-success"> complete </span></td>';
                            } elseif (date('m-d', strtotime($row['holiday_date'])) == date('m-d')) {
                                echo '<td><span class="badge bg-primary"> today !! </span></td>';
                            } else {
                                echo '<td><span class="badge bg-danger"> coming... </span></td>';
                            }
                            if ($_SESSION['user_name'] == 'Admin') {
                                if ($row['wish_sent'] == 1) {
                                    echo '<td><span class="badge bg-success"> Sent </span></td>';
                                } else {
                                    echo '<td><span class="badge bg-danger"> Not Send </span></td>';
                                }
                            }
                            ?>
                        </tr>
                <?php
                    }
                } else {
                    echo "<h5 style='margin-top: 50px;'>No result found</h5>";
                }
                ?>
                </tbody>
            </table>
        </div>
</div>

<!-- Bootstrap js link below -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Main js file link below! -->
<script src="js/script.js"></script>
</body>

</html>