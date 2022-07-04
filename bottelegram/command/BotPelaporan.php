<?php 
require_once 'database/configDB.php';

function viewLaporanCovid($id_user){

    $queryViewCatatanUser = "SELECT nama, jurusan, nim, alamat, nomor_hp, tanggal_pelaporan FROM laporan_covid";
    $resultQueryView      = mysqli_query(connDB(), $queryViewCatatanUser);

    $message = "";

    if ($resultQueryView->num_rows > 0) {
        while ($viewDataCatatanUser = mysqli_fetch_assoc($resultQueryView)) {
            $resultCatatanUser = (object) $viewDataCatatanUser;
            
            $message .= "Nama     : " . $resultCatatanUser->nama . PHP_EOL;
            $message .= "Jurusan : " . $resultCatatanUser->jurusan . PHP_EOL;
            $message .= "NIM        : " . $resultCatatanUser->nim . PHP_EOL;
            $message .= "No HP    : " . $resultCatatanUser->nomor_hp . PHP_EOL;
            $message .= "Tanggal Pelaporan : " . $resultCatatanUser->tanggal_pelaporan . PHP_EOL;
            $message .= "Alamat   : \n" . $resultCatatanUser->alamat . PHP_EOL;
            $message .= "---------------------------------------\n";


        }
    }
    else{
        $message = "Data Masih Kosong 🙄";
    }

    return $message;
    
}

?>