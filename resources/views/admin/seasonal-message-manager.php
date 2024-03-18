<?php
session_start();
//loguot automatically after 5 mins if has no activity
if (isset($_SESSION['last_active_time'])) {
    if (time() - $_SESSION['last_active_time'] > 300) {
        header("Location: ../logout.php");
        die();
    }
}
$_SESSION['last_active_time'] = time();
//if not login then redirect to login page
if (!isset($_SESSION["emp_id"])) {
    header("Location: ../login.php");
    die();
}
// authorization msg
// if(isset($_SESSION['error_msg'])){
//     echo '<script>
//             alert("This is an unauthorize request!!");
//         </script>';
//     unset($_SESSION['error_msg']);
// }
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
include('components/outside-folder-admin-page-header.php');
?>

    <!-- navbar -->
    <div class="admin-header">
        <img src="../images/logo2.png" alt="">
        <div>
            <a href="rouhani-dashboard.php"><i class="fa fa-arrow-left"></i></a>
        </div>
    </div>

    <div class="post-container">
        <div class="seasonal-message-upload">
            <form action="" method="post" class="shadow-lg" enctype="multipart/form-data">
                <div class="SMU-input">
                    <label for="">Upload image here</label>
                    <input type="file" name="file">
                    <p>*Image size should be lower 2 MB</p>
                </div>
                <input type="submit" name="submit" value="Submit" class="SMU-submit">
            </form>
            <?php
                if(isset($_POST['submit'])){
                    $file_name =  $_FILES["file"]["name"];
                    $temp_name =  $_FILES["file"]["tmp_name"];
                    if($temp_name == true){
                        move_uploaded_file($temp_name, "../images/seasonal-message/" . $file_name);
                    }else{
                        echo "No file choosen!";
                    }
                }
            ?>
        </div>

        <div class="seasonal-message-delete">
            <form action="" method="post">
                <input type="submit" value="Delete" class="sea-del-btn" name="delete-sea-msg">
            </form>
            <?php
                $dir_name = "../images/seasonal-message/";
                $images = glob($dir_name . "*.jpg"); 

                //message delete function
                if(isset($_POST['delete-sea-msg'])){
                    foreach($images as $image) {
                        unlink($image);
                    }
                }

                if($images != []){
                    foreach($images as $image) {
                        echo '<img width="200px" src="'.$image.'" />';
                    }
                }else{
                    echo "No image found!";
                }
            ?>
        </div>
    </div>


    <script>
        let logo_div_service = document.getElementById('logo-div-service');
        let nav_home_btn = document.getElementById('nav-home-btn');

        function openNavSer(){
            setTimeout(() => {
                logo_div_service.style.left = "0";
                nav_home_btn.style.opacity = "1";
            }, 500);
        }

        window.addEventListener('load', () => {
            openNavSer();
        });

        window.addEventListener('scroll', () => {
            if(window.pageYOffset > 100){
                logo_div_service.style.left = "-300px";
            }else{
                logo_div_service.style.left = "0";
            }
        });
    </script>
</body>