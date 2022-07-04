<?php  
//Connect to database
require 'connectDB.php';
date_default_timezone_set('Asia/Jakarta');
$d = date("Y-m-d");
$t = date("H:i:sa");

if (isset($_GET['card_uid']) && isset($_GET['device_token'])) {
    $start = microtime(true);
    $card_uid = $_GET['card_uid'];
    $kode_ruangan = $_GET['device_token'];
    $sql = "SELECT * FROM devices WHERE device_uid=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select_device";
        exit();
    }
    else{
        mysqli_stmt_bind_param($result, "s", $kode_ruangan);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)){
            $device_mode = $row['device_mode'];
            $device_name = $row['device_name'];
            $device_dep = $row['device_dep'];
            if ($device_mode == 1) {
                $sql = "SELECT * FROM users WHERE card_uid=?";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select_card";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($result, "s", $card_uid);
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    if ($row = mysqli_fetch_assoc($resultl)){
                        //*****************************************************
                        //An existed Card has been detected for Login or Logout
                        if ($row['add_card'] == 1){
                        if ($row['device_uid'] == $kode_ruangan || $row['device_uid'] == 0){
                                $Uname = $row['username'];
                                $Number = $row['nim'];
                                $sql = "SELECT * FROM users_logs WHERE card_uid=? AND checkindate=? AND card_out=0";
                                $result = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($result, $sql)) {
                                    echo "SQL_Error_Select_logs";
                                    exit();
                                }
                                else{
                                    mysqli_stmt_bind_param($result, "ss", $card_uid, $d);
                                    mysqli_stmt_execute($result);
                                    $resultl = mysqli_stmt_get_result($result);
                                    //*****************************************************
                                    //Login
                                    if (!$row = mysqli_fetch_assoc($resultl)){

                                        $sql = "INSERT INTO users_logs (username, nim, card_uid, device_name, device_dep, checkindate, timein, timeout) VALUES (? ,?, ?, ?, ?, ?, ?, ?)";
                                        $result = mysqli_stmt_init($conn);
                                        if (!mysqli_stmt_prepare($result, $sql)) {
                                            echo "SQL_Error_Absen_Masuk";
                                            exit();
                                        }
                                        else{
                                            $timeout = "00:00:00";
                                            mysqli_stmt_bind_param($result, "ssssssss", $Uname, $Number, $card_uid, $device_name, $device_dep, $d, $t, $timeout);
                                            mysqli_stmt_execute($result);
                                            $end = microtime(true);
                                            $waktu = $end - $start;
                                            $sql = "UPDATE users_logs SET respon_rfid_masuk=? WHERE card_uid=? AND checkindate=? AND card_out=0";
                                            $result = mysqli_stmt_init($conn);
                                                if (!mysqli_stmt_prepare($result, $sql)) {
                                                    echo "SQL_Error_Respon_Masuk";
                                                    exit();
                                                }
                                                else{
                                                    mysqli_stmt_bind_param($result, "dss", $waktu, $card_uid, $d);
                                                    mysqli_stmt_execute($result);
                                                }
                                            $waktu_in = date("H:i");
                                            echo "Absen Masuk ".$waktu_in." ".$Uname;
                                            $sql_2 = "UPDATE devices SET card_uid=? WHERE device_uid=?";
                                            $result_2 = mysqli_stmt_init($conn);
                                            if (!mysqli_stmt_prepare($result_2, $sql_2)) {
                                                echo "SQL_Error_Status_Perekaman_Kartu";
                                                exit();
                                            }
                                            else{                                        
                                                mysqli_stmt_bind_param($result_2, "ss", $card_uid, $kode_ruangan);
                                                mysqli_stmt_execute($result_2);
    
                                                echo " Absen masuk terakhir".$Uname;
                                                exit();
                                            }                                            
                                        }
                                    }
                                    //*****************************************************
                                    
                                    //Logout
                                    else{
                                        $sql="UPDATE users_logs SET timeout=?, card_out=1 WHERE card_uid=? AND checkindate=? AND card_out=0";
                                        $result = mysqli_stmt_init($conn);
                                        if (!mysqli_stmt_prepare($result, $sql)) {
                                            echo "SQL_Error_Absen_Keluar";
                                            exit();
                                        }
                                        else{
                                            mysqli_stmt_bind_param($result, "sss", $t, $card_uid, $d);
                                            mysqli_stmt_execute($result);
                                            $end = microtime(true);
                                            $waktu = $end - $start;
                                            $sql = "UPDATE users_logs SET respon_rfid_keluar =? WHERE card_uid=? AND checkindate=? AND card_out=1";
                                            $result = mysqli_stmt_init($conn);
                                                if (!mysqli_stmt_prepare($result, $sql)) {
                                                    echo "SQL_Error_Respon_Masuk";
                                                    exit();
                                                }
                                                else{
                                                    mysqli_stmt_bind_param($result, "dss", $waktu, $card_uid, $d);
                                                    mysqli_stmt_execute($result);
                                                }
                                            $waktu_out = date("H:i");
                                            echo "Absen Keluar ".$waktu_out." ".$Uname;
                                            exit();
                                        }
                                    }
                                }
                            }
                            else {
                                echo "Not Allowed!";
                                exit();
                            }
                        }
                        else if ($row['add_card'] == 0){
                            echo "Not registerd!";
                            exit();
                        }
                    }
                    else{
                        echo "Not found!";
                        exit();
                    }
                }
            }
            else if ($device_mode == 0) {
                //New Card has been added
                $sql = "SELECT * FROM users WHERE card_uid=?";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select_card";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($result, "s", $card_uid);
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    //The Card is available
                    if ($row = mysqli_fetch_assoc($resultl)){
                        $sql = "SELECT card_select FROM users WHERE card_select=1";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_Select";
                            exit();
                        }
                        else{
                            mysqli_stmt_execute($result);
                            $resultl = mysqli_stmt_get_result($result);
                            
                            if ($row = mysqli_fetch_assoc($resultl)) {
                                $sql="UPDATE users SET card_select=0";
                                $result = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($result, $sql)) {
                                    echo "SQL_Error_insert";
                                    exit();
                                }
                                else{
                                    mysqli_stmt_execute($result);

                                    $sql="UPDATE users SET card_select=1 WHERE card_uid=?";
                                    $result = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($result, $sql)) {
                                        echo "SQL_Error_insert_An_available_card";
                                        exit();
                                    }
                                    else{
                                        mysqli_stmt_bind_param($result, "s", $card_uid);
                                        mysqli_stmt_execute($result);

                                        echo "available";
                                        exit();
                                    }
                                }
                            }
                            else{
                                $sql="UPDATE users SET card_select=1 WHERE card_uid=?";
                                $result = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($result, $sql)) {
                                    echo "SQL_Error_insert_An_available_card";
                                    exit();
                                }
                                else{
                                    mysqli_stmt_bind_param($result, "s", $card_uid);
                                    mysqli_stmt_execute($result);

                                    echo "available";
                                    exit();
                                }
                            }
                        }
                    }
                    //The Card is new
                    else{
                        $sql="UPDATE users SET card_select=0";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_insert";
                            exit();
                        }
                        else{
                            mysqli_stmt_execute($result);
                            $sql = "INSERT INTO users (card_uid, card_select, device_uid, device_dep, user_date) VALUES (?, 1, ?, ?, CURDATE())";
                            $result = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result, $sql)) {
                                echo "SQL_Error_Select_add";
                                exit();
                            }
                            else{
                                mysqli_stmt_bind_param($result, "sss", $card_uid, $kode_ruangan, $device_dep );
                                mysqli_stmt_execute($result);
                                $end = microtime(true);
                                $waktu = $end - $start;
                                $sql = "UPDATE users SET respon_rfid =? WHERE card_uid=?";
                                $result = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($result, $sql)) {
                                        echo "SQL_Error_Respon_Masuk";
                                        exit();
                                    }
                                    else{
                                        mysqli_stmt_bind_param($result, "ds", $waktu, $card_uid);
                                        mysqli_stmt_execute($result);
                                    }
                                echo "succesful";
                                exit();
                            }
                        }
                    }
                }    
            }
        else{
            echo "Invalid Device!";
            exit();
        }
        }          
    }
}

?>