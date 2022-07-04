<?php 
require_once 'database/configDB.php';

function viewCatatanUser($id_user){

    $queryViewCatatanUser = "SELECT first_name, last_name, email FROM laporan_covid";
    $resultQueryView      = mysqli_query(connDB(), $queryViewCatatanUser);

    $message = "";

    if ($resultQueryView->num_rows > 0) {
        while ($viewDataCatatanUser = mysqli_fetch_assoc($resultQueryView)) {
            $resultCatatanUser = (object) $viewDataCatatanUser;
            
            $message .= "Nama   : " . $resultCatatanUser->first_name . PHP_EOL;
            $message .= "Nomor HP   : " . $resultCatatanUser->last_name . PHP_EOL;
            $message .= "Tanggal Pelaporan   : " . $resultCatatanUser->email . PHP_EOL;
            $message .= "\n";

        }
    }
    else{
        $message = "Data Masih Kosong 🙄";
    }

    return $message;
    
}

?>