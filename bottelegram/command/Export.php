<?php
//Connect to database
require'connectDB.php';

$output = '';

    $sql = "SELECT * FROM users_logs ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){
        $no=1;
      $output .= '
                  <table class="table" bordered="1">  
                    <TR>
                      <TH>No</TH>
                      <TH>Name</TH>
                      <TH>Nomer Induk</TH>
                      <TH>Nama Ruangan</TH>
                      <TH>Nama Gedung</TH>
                      <TH>Tanggal</TH>
                      <TH>Jam Masuk</TH>
                      <TH>Jam Keluar</TH>
                      <TH>Suhu</TH>
                    </TR>';
        while($row=$result->fetch_assoc()) {
            $output .= '
                        <TR> 
                            <TD> '.$no++.'</TD>
                            <TD> '.$row['username'].'</TD>
                            <TD> '.$row['nim'].'</TD>
                            <TD> '.$row['device_name'].'</TD>
                            <TD> '.$row['device_dep'].'</TD>
                            <TD> '.$row['checkindate'].'</TD>
                            <TD> '.$row['timein'].'</TD>
                            <TD> '.$row['timeout'].'</TD>
                            <TD> '.$row['suhu'].'</TD>
                        </TR>';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=User_Log'.$Start_date.'.xls');
        echo $output;
        exit();
    }
?>