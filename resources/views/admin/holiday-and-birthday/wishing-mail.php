<?php 
    include('../../connection/db_config.php');
    date_default_timezone_set("Asia/Kolkata");
    $today = date('Y-m-d');

    //Birthday wish to birthday boy

    $sql_birthday = "SELECT * FROM rouhani_users WHERE DATE_FORMAT(user_dob, '%m-%d') = DATE_FORMAT('$today', '%m-%d')";
    $result_birthday = mysqli_query($conn, $sql_birthday) or die('query failed');
    if(mysqli_num_rows($result_birthday) > 0){
        while($row_birthday = mysqli_fetch_assoc($result_birthday)){
            $birthday_boy = $row_birthday['user_name'];
            $to = $row_birthday['user_email'];
            $subject = "Happy Birthday " . ucfirst($row_birthday['user_name']) . "!!";
            $message = "<html>
                            <head>
                                <style>
                                    .birthday-box{
                                        width: 600px;
                                        height: 100vh;
                                        background-image: url(https://rouhaniinsights.com/wishes/birthday-wish2.jpg);
                                        background-position: center;
                                        background-size: cover;
                                        text-align: center;
                                        background-repeat: no-repeat;
                                        padding-top: 100px;
                                    }
                                    .birthday-message{
                                        text-align: center;
                                        color: rgb(168, 8, 35);
                                        width: 600px;
                                    }
                                    .birthday-box h1{
                                        color: rgb(4, 156, 156);
                                        font-size: 40px;
                                        letter-spacing: 5px;
                                        margin-bottom: 10px;
                                    }
                                    .birthday-box h2{
                                        color: #f7cf57;
                                        font-size: 50px;
                                        letter-spacing: 5px;
                                    }
                                    .birthday-message p{
                                        letter-spacing: 3px;
                                        line-height: 30px;
                                    }
                                    .birthday-message-2{
                                        font-weight: bold;
                                        font-size: 20px;
                                        margin-top: 50px;
                                    }
                                    .birthday-message-1{
                                        font-size: 16px;
                                    }
                                </style>
                            </head>
                            <body>
                                <div class='birthday-box'>
                                    <h1>!! Happy Birthday !!</h1>
                                    <h2>" . ucfirst($row_birthday['user_name']) . "</h2>
                                    <div class='birthday-message'>
                                        <p class='birthday-message-1'>May your birthday be filled with sunshine and happiness,<br> just like you brighten up the office every day</p>
                                        <p class='birthday-message-2'>Rouhani wishes you a very Happy Birthday</p>
                                    </div>   
                                </div>
                            </body>
                        </html>";
            $from = "info@rouhaniinsights.com";
            $headers = "From: $from \r\n";
            $headers .= "MIME-Version: 1.0 \r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8 \r\n";
            $mail_sent = mail($to, $subject, $message, $headers);
            if($mail_sent){
                mysqli_query($conn, "UPDATE rouhani_users SET wish_sent = '1' WHERE user_name = '{$row_birthday["user_name"]}'") or die('query failed');
            }
            $sql_birthday1 = "SELECT * FROM rouhani_users WHERE DATE_FORMAT(user_dob, '%m-%d') != DATE_FORMAT('$today', '%m-%d') AND user_name != 'Admin'";
            $result_birthday1 = mysqli_query($conn, $sql_birthday1);
            while($row_birthday1 = mysqli_fetch_assoc($result_birthday1)){
                $to = $row_birthday1['user_email'];
                $subject = "Today is " . ucfirst($birthday_boy) . "'s birthday !!";
                $message = "Its your friend's Birthday Today. Do not forget to wish " .  ucfirst($birthday_boy) . " and make him feel special .";
                $from = "info@rouhaniinsights.com";
                $headers = "From: $from \r\n";
                $headers .= "MIME-Version: 1.0 \r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8 \r\n";
                mail($to, $subject, $message, $headers);
            }
        }
    }


    //Wish everyone holiday

    $sql_holiday = "SELECT * FROM rouhani_holidays WHERE DATE_FORMAT(holiday_date, '%m-%d') = DATE_FORMAT('$today', '%m-%d')";
    $result_holiday = mysqli_query($conn, $sql_holiday) or die('query failed');
    if(mysqli_num_rows($result_holiday) > 0){
        while($row_holiday = mysqli_fetch_assoc($result_holiday)){
            $holiday = $row_holiday['holiday_name'];
            $sql_holiday1 = "SELECT * FROM rouhani_users WHERE user_name != 'Admin'";
            $result_holiday1 = mysqli_query($conn, $sql_holiday1) or die('query failed');
            while($row_holiday1 = mysqli_fetch_assoc($result_holiday1)){
                $to = $row_holiday1['user_email'];
                $subject = ucfirst($row_holiday1['user_name']) . " wish you very happy " . $holiday;
                $message = "<html>
                                <head>
                                    // <style>
                                    //     .holiday-box{
                                    //         width: 600px;
                                    //         height: 100vh;
                                    //         background-image: ;
                                    //         background-position: center;
                                    //         background-size: cover;
                                    //         text-align: center;
                                    //         background-repeat: no-repeat;
                                    //         padding-top: 100px;
                                    //     }
                                    // </style>
                                </head>
                                <body>
                                    // <div class='holiday-box'></div>
                                    <h1> Happy " . $holiday . "</h1>
                                </body>
                            </html>";
                $from = "info@rouhaniinsights.com";
                $headers = "From: $from \r\n";
                $headers .= "MIME-Version: 1.0 \r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8 \r\n";
                $mail_sent = mail($to, $subject, $message, $headers);
            }
            if($mail_sent){
                mysqli_query($conn, "UPDATE rouhani_holidays SET wish_sent = '1' WHERE holiday_name = '{$row_holiday["holiday_name"]}'") or die('query failed');
            }
        }
    }
?>    