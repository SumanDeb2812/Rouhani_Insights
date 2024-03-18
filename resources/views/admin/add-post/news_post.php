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
        <h3>Blogs Section</h3>
        <div>
            <?php if ($_SESSION['user_name'] != 'Admin'){ ?>
                <a href="add_news.php"><button>Add Post</button></a>
                <a href="old-post/old_news.php"><button>Old Blogs</button></a>
            <?php } ?>    
            <a href="../rouhani-dashboard.php"><i class="fa fa-arrow-left"></i></a>
        </div>
    </div>
    <div class="container post-container">
        <h3>New Blogs Lists</h3>
        <div class="news-main-box">
            <div class="news-box">
                <div class="blog-content news-id" style="font-weight:600; font-size:18px;">Post No.</div>
                <div class="blog-content news-id" style="font-weight:600; font-size:18px;">Author</div>
                <div class="blog-content news-title" style="font-weight:600; font-size:18px">Title</div>
                <div class="blog-content news-date" style="font-weight:600; font-size:18px">Posting Date</div>
                <div class="blog-content news-img-name" style="font-weight:600; font-size:18px">Image</div>
                <div class="blog-content news-edit" style="font-weight:600; font-size:18px">Edit Post</div>
                <div class="blog-content news-delete" style="font-weight:600; font-size:18px">Delete Post</div>
            </div>
            <?php
                include('../../connection/db_config.php');
                if($_SESSION['user_name'] == 'Admin'){
                    $sql = "SELECT * FROM rouhani_posts ORDER BY post_date DESC";
                }else{
                    $sql = "SELECT * FROM rouhani_posts WHERE post_author = '{$_SESSION["user_name"]}' ORDER BY post_date DESC";
                }
                $result = mysqli_query($conn, $sql) or die("Query Failed");
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
            ?>    
                <div class="news-box">   
                    <div class="blog-content news-id"><?php echo $row['post_id'] ?></div>
                    <div class="blog-content news-id"><?php echo $row['post_author'] ?></div>
                    <div class="blog-content news-title"><?php echo $row['post_title'] ?></div>
                    <div class="blog-content news-date"><?php echo $row['post_date'] ?></div>
                    <?php if(!empty($row['post_image'])){
                        echo '<div class="blog-content news-img-name">' . $row['post_image'] . '</div>';
                    }else{
                        echo '<div class="blog-content news-img-name text-danger">Image not avaliable</div>';
                    } ?>
                    <a href="edit-post/news_edit.php?id=<?php echo $row['post_id'] ?>" class="blog-content news-edit"><i class="fa fa-pencil"></i></a>
                    <a href="delete-post/delete_post.php?id=<?php echo $row['post_id'] ?>" class="blog-content news-delete"><i class="fa fa-trash"></i></a>
                </div>
            <?php
                    };
                }else{
                    echo "<p style='margin-top:100px'>No result found</p>";
                }
            ?>    
        </div>
    </div>

    <!-- Bootstrap js link below -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Main js file link below! -->
    <script src="js/script.js"></script>
</body>
</html>