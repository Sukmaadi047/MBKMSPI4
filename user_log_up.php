<?php  
session_start();
?>
<div class="table-responsive" style="max-height: 500px;"> 
  <table class="table">
    <thead class="table-primary">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Nomer Induk</th>
        <th>Tanggal</th>
        <th>Ruangan</th>
        <th>Gedung</th>
        <th>Jam Masuk</th>
        <th>Jam keluar</th>
        <th>Suhu</th>
      </tr>
    </thead>
    <tbody class="table-secondary">
      <?php

        //Connect to database
        require'connectDB.php';
        $searchQuery = " ";
        $Start_date = " ";
        $End_date = " ";
        $Start_time = " ";
        $End_time = " ";
        $Card_sel = " ";

        if (isset($_POST['log_date'])) {
          //Start date filter
          if ($_POST['date_sel_start'] != 0) {
              $Start_date = $_POST['date_sel_start'];
              $_SESSION['searchQuery'] = "checkindate='".$Start_date."'";
          }
          else{
              $Start_date = date("Y-m-d");
              $_SESSION['searchQuery'] = "checkindate='".date("Y-m-d")."'";
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
          if ($_POST['card_sel'] != 0) {
              $Card_sel = $_POST['card_sel'];
              $_SESSION['searchQuery'] .= " AND card_uid='".$Card_sel."'";
          }
          //Department filter
          if ($_POST['dev_uid'] != 0) {
              $dev_uid = $_POST['dev_uid'];
              $_SESSION['searchQuery'] .= " AND device_uid='".$dev_uid."'";
          }
        }
        
        if ($_POST['select_date'] == 1) {
            $Start_date = "";
            $_SESSION['searchQuery'] = "checkindate!='".$Start_date."'";
        }

        // $sql = "SELECT * FROM users_logs WHERE checkindate=? BETWEEN ? AND ? ORDER BY id ASC";
        $sql = "SELECT * FROM users_logs WHERE ".$_SESSION['searchQuery']." ORDER BY id DESC";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo '<p class="error">SQL Error</p>';
        }
        else{
            mysqli_stmt_execute($result);
            $resultl = mysqli_stmt_get_result($result);
            if (mysqli_num_rows($resultl) > 0){
                $No = "1";
                while ($row = mysqli_fetch_assoc($resultl)){
        ?>
                  <TR>
                  <TD><?php echo $No;?></TD>
                  <TD><?php echo $row['username'];?></TD>
                  <TD><?php echo $row['nim'];?></TD>
                  <TD><?php echo $row['checkindate'];?></TD>
                  <TD><?php echo $row['device_name'];?></TD>
                  <TD><?php echo $row['device_dep'];?></TD>
                  <TD><?php echo $row['timein'];?></TD>
                  <TD><?php echo $row['timeout'];?></TD>
                  <TD><?php echo $row['suhu_tubuh'];?></TD>
                  </TR>
                  <?php $No++; ?>
      <?php
                }
            }
        }
        // echo $sql;
      ?>
    </tbody>
  </table>
</div>