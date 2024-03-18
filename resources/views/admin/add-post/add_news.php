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

    include('../../components/admin-pages-header.php')
?>
    <div class="post-header">
        <h3>Here you can post your news & blogs!</h3>
        <a href="news_post.php"><i class="fa fa-arrow-left"></i></a>
    </div>
    <div class="container news-container">
        <h3>Add News Details Below</h3>
        <form class="news_form" action="save_post.php" method="post" enctype="multipart/form-data">
            <div class="news_form_div">
                <label>News Title</label>
                <input type="text" name="post_title">
            </div>
            <div class="news_form_div">
                <label>News Description</label>
                <textarea name="post_desc" cols="50" rows="5"></textarea>
            </div>
            <div class="news_form_div">
                <label>Upload Imgage</label>
                <input type="file" name="post_file">
            </div>
            <p style="color:red; margin-left:25px;">*(Image size should be lower than 2mb)</p>
            <input class="news-post-btn" type="submit" value="Post" name="addpost">
            </div>
        </form>
    </div>
    

    <!-- Bootstrap js link below -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Main js file link below! -->
    <script src="js/script.js"></script>
</body>
</html>