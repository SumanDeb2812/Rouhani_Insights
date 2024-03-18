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
    <h3>Rouhani Old Blogs History Section</h3>
    <a href="../news_post.php"><i class="fa fa-arrow-left"></i></a>
</div>

<div class="container post-container">
    <h3>Old Blogs History</h3>
    <div class="news-main-box">
        <div class="news-box">
            <div class="blog-content news-id" style="font-weight:600; font-size:18px;">Post Id</div>
            <div class="blog-content news-title" style="font-weight:600; font-size:18px">Post Title</div>
            <div class="blog-content news-date" style="font-weight:600; font-size:18px">Post Date</div>
            <div class="blog-content news-img-name" style="font-weight:600; font-size:18px">Post Image</div>
            <div class="blog-content news-delete" style="font-weight:600; font-size:18px">Delete Post</div>
        </div>
        <?php
            include('../../../connection/db_config.php');
            $sql = "SELECT * FROM rouhani_old_posts ORDER BY post_date DESC";
            $result = mysqli_query($conn, $sql) or die("Query Failed");
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
        ?>    
            <div class="news-box">   
                <div class="blog-content news-id"><?php echo $row['post_id'] ?></div>
                <div class="blog-content news-title"><?php echo $row['post_title'] ?></div>
                <div class="blog-content news-date"><?php echo $row['post_date'] ?></div>
                <div class="blog-content news-img-name"><?php echo $row['post_image'] ?></div>
                <a href="delete_old_news.php?id=<?php echo $row['post_id'] ?>" class="blog-content news-delete"><i class="fa fa-trash"></i></a>
            </div>
        <?php
                };
            }else{
                echo "<p style='margin-top:100px'>No result found</p>";
            }
        ?>    
    </div>
</div>
</html>