<?php  
//Connect to database
require 'connectDB.php';
date_default_timezone_set('Asia/Damascus');
$d = date("Y-m-d");

if (isset($_GET['suhu']) && isset($_GET['device_token'])) {
    
    $start = microtime(true);
    $suhu = $_GET['suhu'];
    $device_uid = $_GET['device_token'];

    $sql = "SELECT * FROM devices WHERE device_uid=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select_Device";
        exit();
    }
    else{
        mysqli_stmt_bind_param($result, "s", $device_uid);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)){
            $card_uid = $row['card_uid'];
            $device_dep = $row['device_dep'];
            if ($card_uid != '0') {
                $sql = "SELECT * FROM users WHERE card_uid=?";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select_card";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($result, "s", $card_uid);
                    mysqli_stmt_execute($result);
                    $result1 = mysqli_stmt_get_result($result);
                    if ($row = mysqli_fetch_assoc($result1)){
                        $Uname = $row['username'];
                        $Number = $row['nim'];
                        $sql = "UPDATE users_logs SET suhu_tubuh=? WHERE username=? AND nim=? AND card_uid=? AND checkindate=? AND timein!='' AND timeout=? AND card_out=0";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_Update_suhu";
                            exit();
                        }
                        else{
                            $timeout = "00:00:00";
                            mysqli_stmt_bind_param($result, "ssssss", $suhu, $Uname, $Number, $card_uid, $d, $timeout);
                            mysqli_stmt_execute($result);
                            $end = microtime(true);
                            $waktu = $end - $start;
                            $sql = "UPDATE users_logs SET respon_suhu =? WHERE username=? AND nim=? AND card_uid=? AND checkindate=? AND timein!='' AND timeout=? AND card_out=0";
                            $result = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($result, $sql)) {
                                    echo "SQL_Error_Respon_Masuk";
                                    exit();
                                }
                                else{
                                    $timeout = "00:00:00";
                                    mysqli_stmt_bind_param($result, "dsssss", $waktu, $Uname, $Number, $card_uid, $d, $timeout);
                                    mysqli_stmt_execute($result);
                                }
                            echo $Uname;
                            $sql_2 = "UPDATE devices SET card_uid='0' WHERE device_uid=?";
                            $result_2 = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result_2, $sql_2)) {
                                echo "SQL_Error_Delete_Perekaman_Kartu";
                                exit();
                            }
                            else{                 
                                mysqli_stmt_bind_param($result_2, "s", $device_uid);
                                mysqli_stmt_execute($result_2);
                                        
                            }                                        
                        }
                    }
                }
            }
        }
    }
}