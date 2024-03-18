<?php
    session_start();
    if(isset($_SESSION['last_active_time'])){
        if(time()-$_SESSION['last_active_time'] > 300){
            header("Location: ../../logout.php");
            die();
        }
    }
    $_SESSION['last_active_time'] = time();
    if(!isset($_SESSION['user_name'])){
        header("Location: ../../login.php");
        die();
    }

    include('../../components/admin-pages-header.php');
?>

<div class="post-header">
    <h3>Add Holiday</h3>
    <div>
        <a href="holidays-and-birthdays.php"><i class="fa fa-arrow-left"></i></a>
    </div>
</div>
<div class="container post-container d-flex justify-content-center">
    <div class="add-holiday-form-box">
        <?php
            $holiday_name_err = $holiday_date_err = $holiday_add_success = $holiday_add_fail = '';

            if(isset($_POST['submit'])){
                if(empty($_POST['holiday_name'])){
                    $holiday_name_err = '<p style="color: red;">Name is required</p>';
                }elseif(empty($_POST['holiday_date'])){
                    $holiday_date_err = '<p style="color: red;">Date is required</p>';
                }else{
                include('../../connection/db_config.php');
                $sql = "INSERT INTO rouhani_holidays(holiday_name, holiday_date)
                VALUE('{$_POST["holiday_name"]}', '{$_POST["holiday_date"]}')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    $holiday_add_success = '<p class="alert alert-success mt-3">Holiday added successfully</p>';
                }else{
                    $holiday_add_fail = '<p class="alert alert-danger mt-3">Something is worng!</p>';
                }}}
        ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="add-holiday-form" enctype="multipart/form-data">
            <label for="">Holiday Name</label>
            <input type="text" name="holiday_name" id="holiday_name" class="mb-3 w-100">
            <?php echo $holiday_name_err;?>
            <label for="">Holiday Date</label>
            <input type="date" name="holiday_date" id="holiday_date" class="mb-3 w-100">
            <?php echo $holiday_date_err;?>
            <button type="submit" name="submit" class="w-100 add-holiday-btn">Add</button>
        </form>
        <?php
            echo $holiday_add_success;
            echo $holiday_add_fail;
        ?>
    </div>
</div>