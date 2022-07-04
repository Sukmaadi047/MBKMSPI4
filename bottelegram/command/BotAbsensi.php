<?php 
require_once 'database/configDB.php';

function viewAbsensi($id_user){
    date_default_timezone_set('Asia/Jakarta');
    $d = date("Y-m-d");
    $queryViewCatatanUser = "SELECT username, nim, suhu_tubuh, checkindate, timein, timeout FROM users_logs";
    $resultQueryView      = mysqli_query(connDB(), $queryViewCatatanUser);

    $message = "";

    if ($resultQueryView->num_rows > 0) {
        while ($viewDataCatatanUser = mysqli_fetch_assoc($resultQueryView)) {
            $resultCatatanUser = (object) $viewDataCatatanUser;
            
            $message .= "Nama   : " . $resultCatatanUser->username . PHP_EOL;
            $message .= "NIM   : " . $resultCatatanUser->nim . PHP_EOL;
            $message .= "Suhu Tubuh   : " . $resultCatatanUser->suhu_tubuh . PHP_EOL;
            $message .= "Tanggal   : " . $resultCatatanUser->checkindate . PHP_EOL;
            $message .= "Jam Masuk   : " . $resultCatatanUser->timein . PHP_EOL;
            $message .= "Jam Keluar   : " . $resultCatatanUser->timeout . PHP_EOL;
            $message .= "---------------------------------------\n";

        }
    }
    else{
        $message = "Data Masih Kosong 🙄";
    }

    return $message;
    
}

?>