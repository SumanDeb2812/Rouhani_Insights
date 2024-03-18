<?php
    session_start();
    if(isset($_SESSION['last_active_time'])){
        if(time()-$_SESSION['last_active_time'] > 300){
            header("Location: ../../../logout.php");
            die();
        }
    }
    $_SESSION['last_active_time'] = time();
    if(!isset($_SESSION['user_name'])){
        header("Location: ../../../login.php");
        die();
    }

    include('../../../components/admin-pages-header-inside-1folder.php');
?>
    <div class="post-header">
        <h3>Here you can edit your post!</h3>
        <a href="../news_post.php"><i class="fa fa-arrow-left"></i></a>
    </div>
    <div class="container news-container">
        <h3>Edit Your News Details Below</h3>
        <?php
            include('../../../connection/db_config.php');
            $post_id = $_GET['id'];
            $sql = "SELECT * FROM rouhani_posts WHERE post_id = {$post_id}";
            $result = mysqli_query($conn, $sql) or die("Query Failed");
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
        ?>            
        <form class="news_form" action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
            <div class="news_form_div">
                <label>News Title</label>
                <input type="text" value="<?php echo $row['post_title'] ?>" name="post_title">
            </div>
            <div class="news_form_div">
                <label>News Description</label>
                <textarea name="post_desc" cols="50" rows="5">
                    <?php echo $row['post_desc'] ?>
                </textarea>
            </div>
            <div class="news_form_div">
                <label>File Attachments</label>
                <input type="file" name="post_file">
            </div>
            <input type="hidden" name="old_post_file" value="<?php echo $row['post_image'] ?>">
            <div class="post-img">
                <img src="../../../uploads/<?php echo $row['post_image'] ?>">
            </div>
            <button class="news-post-btn" type="submit" name="post-update">Update</button>
        </form>
        <?php
                };
            };
        if(isset($_POST['post-update'])){

            if(isset($_FILES['post_file'])){
                $error = [];
                $file_name = $_FILES['post_file']['name'];
                $file_size = $_FILES['post_file']['size'];
                $file_tmp = $_FILES['post_file']['tmp_name'];
                $file_type = $_FILES['post_file']['type'];
                $file_ext = end(explode('.',$file_name));
                $extension = ['jepg','jpg','png'];
                if(in_array($file_ext,$extension) === false){
                    $error[] = "Please choose a jpg or png image!";
                }
                if($file_size > 2097152){
                    $error[] = "File size should be 2mb or lower";
                }
                if(empty($error) == true){
                    move_uploaded_file($file_tmp,'../../../uploads/'.$file_name);
                }
            }
            
            if($file_name != ''){
                $updated_post_image = $file_name;
                unlink('../../../uploads/'.$_POST['old_post_file']);
            }else{
                $updated_post_image = $_POST['old_post_file'];
            }

            $sql1 = "UPDATE rouhani_posts SET post_title = '{$_POST["post_title"]}', post_desc = '{$_POST["post_desc"]}', post_image = '{$updated_post_image}' WHERE post_id = {$post_id}";

            mysqli_query($conn, $sql1) or die("Query Failed");
            header('Location: ../news_post.php');
            die();
        }
        ?>
        
    </div>
    

    <!-- Bootstrap js link below -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Main js file link below! -->
    <script src="js/script.js"></script>
</body>
</html>