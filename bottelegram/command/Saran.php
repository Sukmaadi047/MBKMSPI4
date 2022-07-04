<?php 
require_once 'database/configDB.php';

function viewCatatanUser($id_user){

    $queryViewCatatanUser = "SELECT first_name, last_name, email, subjek, pesan FROM saran";
    $resultQueryView      = mysqli_query(connDB(), $queryViewCatatanUser);

    $message = "";

    if ($resultQueryView->num_rows > 0) {
        while ($viewDataCatatanUser = mysqli_fetch_assoc($resultQueryView)) {
            $resultCatatanUser = (object) $viewDataCatatanUser;
            
            $message .= "Nama Depan      : " . $resultCatatanUser->first_name . PHP_EOL;
            $message .= "Nama Belakang : " . $resultCatatanUser->last_name . PHP_EOL;
            $message .= "Email    : " . $resultCatatanUser->email . PHP_EOL;
            $message .= "Subjek  : " . $resultCatatanUser->subjek . PHP_EOL;
            $message .= "Pesan   : " . $resultCatatanUser->pesan . PHP_EOL;
            $message .= "-----------------------------------------------\n";

        }
    }
    else{
        $message = "Data Masih Kosong 🙄";
    }

    return $message;
    
}

?>