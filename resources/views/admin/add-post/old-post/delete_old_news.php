<?php
    include('../../../connection/db_config.php');
    $post_id = $_GET['id'];
    $sql = "DELETE FROM rouhani_old_posts WHERE post_id = {$post_id}";
    mysqli_query($conn, $sql) or die('Query Failed');
    header('Location: ../old-post/old_news.php');
    die();
?>