@extends('admin.layout.lavel-1-layout')

@section('main-content')
<div class="login-body">
    <div class="login-box">
        <div class="image-box">
            <h2>Rouhani Insights</h2>
            <div class="owl-carousel owl-login owl-theme">
                <div> <div class="image-item-1"></div> </div>
                <div> <div class="image-item-2"></div> </div>
                <div> <div class="image-item-3"></div> </div>
            </div>
            <img src="images/logo2.png" alt="">
        </div>
        <div class="login-area">
            <h2>Log In</h2>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <h6>Employee Id</h6>
                <input type="text" name="emp_id" id="input-user">
                <p class='error-login' id='login-error-user'></p>
                <h6>Password</h6>
                <span><input type="password" name="emp_password" id="input-password"><i class="fa fa-eye" id="password-eye"></i><i class="fa fa-eye-slash" id="password-eye-none"></i></span>
                <p class='error-login' id='login-error-password'></p>
                <a href="#">Forgot Password</a>
                <button type="submit" class="login-submit-btn" onclick="return validateLoginForm()">Login</button>
            </form>
            @error('loginerror')
                <p class='error-login'>{{ $message }}</p>
            @enderror
            <?php
            // if (isset($_POST['login'])) {
            //     include('connection/db_config.php');
            //     $emp_id = mysqli_real_escape_string($conn, $_POST['emp_id']);
            //     $password = md5($_POST['emp_password']);
            //     $sql = "SELECT emp_id, emp_fname FROM hrd_emp_deatils WHERE emp_id = '{$emp_id}' AND emp_password = '{$password}'";
            //     $result = mysqli_query($conn, $sql) or die("Query Failed");
            //     if (mysqli_num_rows($result) > 0) {
            //         while ($row = mysqli_fetch_assoc($result)) {
            //             session_start();
            //             $_SESSION["emp_fname"] = $row["emp_fname"];
            //             $_SESSION["emp_id"] = $row["emp_id"];
            //             //for web authorization purpose
            //             $result1 = mysqli_query($conn, "SELECT role_id FROM wb_emp_auth WHERE emp_id = '{$row["emp_id"]}' AND auth_status = 1");
            //             if (mysqli_num_rows($result1) > 0) {
            //                 while ($row1 = mysqli_fetch_assoc($result1)) {
            //                     $_SESSION['wb_role_id'] = $row1['role_id'];
            //                 }
            //             }
            //             //login with employee profile
            //             $sql3 = "UPDATE wb_emp_auth SET auth_status = CASE WHEN role_id = 3 THEN 1 WHEN role_id = 1 THEN 0 WHEN role_id = 2 THEN 0 END WHERE emp_id = '{$row["emp_id"]}';";
            //             mysqli_query($conn, $sql3);
            //         }
            //         header("Location: admin/rouhani-dashboard.php");
            //         die();
            //     } else {
            //         echo "<p class='error-login'>Username and Password not matched</p>";
            //     }
            // }
            // ?>
        </div>
    </div>
</div>

<script>
    //login page eye button hide and show
    let input_password = document.getElementById('input-password');
    document.getElementById('password-eye').addEventListener('click', () => {
        input_password.type = 'text';
        document.getElementById('password-eye').style.display = "none";
        document.getElementById('password-eye-none').style.display = "block";
    });
    document.getElementById('password-eye-none').addEventListener('click', () => {
        input_password.type = 'password';
        document.getElementById('password-eye-none').style.display = "none";
        document.getElementById('password-eye').style.display = "block";
    });
</script>
@endsection