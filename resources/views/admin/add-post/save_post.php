<?php
    include('../../connection/db_config.php');

    if(isset($_POST['addpost'])){

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
            move_uploaded_file($file_tmp,'../../uploads/'.$file_name);
        }}
    
    session_start();
    $author = mysqli_real_escape_string($conn, $_SESSION['user_name']);
    $title = mysqli_real_escape_string($conn, $_POST['post_title']);
    $description = mysqli_real_escape_string($conn, $_POST['post_desc']);
    $date = date('Y-m-d');

    $sql = "INSERT INTO rouhani_posts(post_author, post_title, post_desc, post_date, post_image)
            VALUE('{$author}', '{$title}', '{$description}', '{$date}', '{$file_name}')";

    if(mysqli_query($conn, $sql)){
        header('Location: news_post.php');
    }else{
        echo '<P>Query Failed</P>';
    }
}          
?>