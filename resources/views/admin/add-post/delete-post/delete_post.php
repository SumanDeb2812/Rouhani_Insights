<?php
    include('../../../connection/db_config.php');
    $post_id = $_GET['id'];
    $sql = "INSERT INTO rouhani_old_posts SELECT * FROM rouhani_posts WHERE post_id = {$post_id};";
    $sql .= "DELETE FROM rouhani_posts WHERE post_id = {$post_id}";
    mysqli_multi_query($conn, $sql) or die('Query Failed');
    header('Location: ../news_post.php');
    die();
?>