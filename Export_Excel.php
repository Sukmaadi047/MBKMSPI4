<?php
//Connect to database
require'connectDB.php';

$output = '';

if(isset($_POST["To_Excel"])){
  
    $searchQuery = " ";
    $Start_date = " ";
    $End_date = " ";
    $Start_time = " ";
    $End_time = " ";
    $card_sel = " ";

    //Start date filter
    if ($_POST['date_sel_start'] != 0) {
        $Start_date = $_POST['date_sel_start'];
        $_SESSION['searchQuery'] = "checkindate='".$Start_date."'";
    }
    if ($_POST['date_sel_start'] = " ") {
        $Start_date = " ";
        $_SESSION['searchQuery'] = "checkindate='".$Start_date."'";
    }
    //End date filter
    if ($_POST['date_sel_end'] != 0) {
        $End_date = $_POST['date_sel_end'];
        $_SESSION['searchQuery'] = "checkindate BETWEEN '".$Start_date."' AND '".$End_date."'";
    }
    //Time-In filter
    if ($_POST['time_sel'] == "Time_in") {
      //Start time filter
      if ($_POST['time_sel_start'] != 0 && $_POST['time_sel_end'] == 0) {
          $Start_time = $_POST['time_sel_start'];
          $_SESSION['searchQuery'] .= " AND timein='".$Start_time."'";
      }
      elseif ($_POST['time_sel_start'] != 0 && $_POST['time_sel_end'] != 0) {
          $Start_time = $_POST['time_sel_start'];
      }
      //End time filter
      if ($_POST['time_sel_end'] != 0) {
          $End_time = $_POST['time_sel_end'];
          $_SESSION['searchQuery'] .= " AND timein BETWEEN '".$Start_time."' AND '".$End_time."'";
      }
    }
    //Time-out filter
    if ($_POST['time_sel'] == "Time_out") {
      //Start time filter
      if ($_POST['time_sel_start'] != 0 && $_POST['time_sel_end'] == 0) {
          $Start_time = $_POST['time_sel_start'];
          $_SESSION['searchQuery'] .= " AND timeout='".$Start_time."'";
      }
      elseif ($_POST['time_sel_start'] != 0 && $_POST['time_sel_end'] != 0) {
          $Start_time = $_POST['time_sel_start'];
      }
      //End time filter
      if ($_POST['time_sel_end'] != 0) {
          $End_time = $_POST['time_sel_end'];
          $_SESSION['searchQuery'] .= " AND timeout BETWEEN '".$Start_time."' AND '".$End_time."'";
      }
    }
    //Card filter
    if ($_POST['room_sel'] != 0) {
        $room_sel = $_POST['room_sel'];
        $_SESSION['searchQuery'] .= " AND device_name='".$room_sel."'";
    }
    //Department filter
    if ($_POST['dev_sel'] != 0) {
        $dev_uid = $_POST['dev_sel'];
        $_SESSION['searchQuery'] .= " AND device_uid='".$dev_uid."'";
    }

    $sql = "SELECT * FROM users_logs WHERE ".$_SESSION['searchQuery']." ORDER BY id DESC";
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
    else{
      header( "location: UsersLog.php" );
      exit();
    }
}
?>