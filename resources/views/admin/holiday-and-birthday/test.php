<?php 
    include('../../connection/db_config.php');
    date_default_timezone_set("Asia/Kolkata");
    $today = date('Y-m-d');

    // $sql = "SELECT * FROM rouhani_users WHERE DATE_FORMAT(user_dob, '%m-%d') = DATE_FORMAT('$today', '%m-%d')";
    // $result = mysqli_query($conn, $sql);
    // if(mysqli_num_rows($result) > 0){
    //     while($row= mysqli_fetch_assoc($result)){
    //         $birthday_boy = $row['user_name'];
    //         echo "Happy Birthday " . $birthday_boy . " !! <br><br>";
    //         $sql1 = "SELECT * FROM rouhani_users WHERE DATE_FORMAT(user_dob, '%m-%d') != DATE_FORMAT('$today', '%m-%d') AND user_name != 'Admin'";
    //         $result1 = mysqli_query($conn, $sql1);
    //         while($row1 = mysqli_fetch_assoc($result1)){
    //                 echo "Today is " . $birthday_boy . "'s birthday. <br>";
    //                 echo "Wish him happy birthday <br>"; 
    //                 echo "to: " . $row1['user_email'] . '<br><br>';
    //         }
    //     }
    // }else{
    //     echo "No result found";
    // }


    $sql1 = "SELECT * FROM rouhani_holidays WHERE DATE_FORMAT(holiday_date, '%m-%d') = DATE_FORMAT('$today', '%m-%d')";
    $result1 = mysqli_query($conn, $sql1);
    if(mysqli_num_rows($result1) > 0){
        while($row1 = mysqli_fetch_assoc($result1)){
            $holiday = $row1['holiday_name'];
            $sql3 = "SELECT * FROM rouhani_users WHERE user_name != 'Admin'";
            $result3 = mysqli_query($conn, $sql3);
            while($row3 = mysqli_fetch_assoc($result3)){
                echo $row3['user_name'] . " Wish you very happy " . $holiday . "<br>"; 
            }
        }
    }

?>    