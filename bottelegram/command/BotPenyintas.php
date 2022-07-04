<?php 
require_once 'database/configDB.php';

function viewDataPenyintas($id_user){

    $queryViewCatatanUser = "SELECT nama, no_hp, alamat, tanggal_sembuh FROM penyintas";
    $resultQueryView      = mysqli_query(connDB(), $queryViewCatatanUser);

    $message = "";

    if ($resultQueryView->num_rows > 0) {
        while ($viewDataCatatanUser = mysqli_fetch_assoc($resultQueryView)) {
            $resultCatatanUser = (object) $viewDataCatatanUser;
            
            $message .= "Nama   : " . $resultCatatanUser->nama . PHP_EOL;
            $message .= "No HP  : " . $resultCatatanUser->no_hp . PHP_EOL;
            $message .= "Alamat : \n" . $resultCatatanUser->alamat . PHP_EOL;
            $message .= "Tanggal Sembuh : " . $resultCatatanUser->tanggal_sembuh . PHP_EOL;
            $message .= "---------------------------------------\n";


        }
    }
    else{
        $message = "Data Masih Kosong 🙄";
    }

    return $message;
    
}

?>