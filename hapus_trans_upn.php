<!-- Ahilla Haffat Kammala/PemWeb C081 -->
<?php 

  include ('koneksi.php'); 

  $status = '';
  $result = '';
  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['id_trans_upn'])) {
          //query SQL
          $id_trans_upn = $_GET['id_trans_upn'];
          $query = "DELETE FROM trans_upn WHERE id_trans_upn = '$id_trans_upn'"; 

          //eksekusi query
          $result = mysqli_query(connection(),$query);

          if ($result) {
            $status = 'ok';
          }
          else{
            $status = 'err';
          }

          //redirect ke halaman lain
          header('Location: trans_upn.php?status='.$status);
      }  
  }