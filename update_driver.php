<!-- Ahilla Haffat Kammala/PemWeb C081 -->

<?php
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('koneksi.php');
  include ('style.css'); 

  $status = '';
  $result = '';
  //melakukan pengecekan apakah ada variable GET yang dikirim
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (isset($_GET['id_driver'])) {
          //query SQL
          $id_driver_upd = $_GET['id_driver'];
          $query = "SELECT * FROM driver WHERE id_driver = '$id_driver_upd'";
         
          //eksekusi query
          $result = mysqli_query(connection(),$query);
      }
  }

  //melakukan pengecekan apakah ada form yang dipost
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_driver= $_POST['id_driver'];
        $nama = $_POST['nama'];
        $no_sim = $_POST['no_sim'];
        $alamat = $_POST['alamat'];
    //query SQL
    $sql = "UPDATE driver SET  nama='$nama', no_sim='$no_sim', alamat='$alamat' WHERE id_driver='$id_driver'";

    //eksekusi query
    $result = mysqli_query(connection(),$sql);
    if ($result) {
      $status = 'ok';

        }
    else{
      $status = 'err';
    }

    //redirect ke halaman lain
    header('Location: driver.php?status='.$status);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Driver</title>
  <style>
    .container {
  box-sizing: border-box;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  padding: 20px;
  margin-top: 30px;
}

.form-group label {
  font-weight: bold;
}

.form-group input,
.form-group select {
  width: 100%;
  padding: 10px;
  border: 2px solid #ddd;
  border-radius: 5px;
  margin-bottom: 10px;
}

.btn-primary {
  background-color: #007bff;
  border: none;
  border-radius: 5px;
  color: #fff;
  padding: 10px 20px;
  cursor: pointer;
}

.btn-primary:hover {
  background-color: #0069d9;
}
</style>
</head>
<body>
<nav>
        <h2><b>Update Driver</b></h2>
        <div>
            <a href="bus.php"><b>Bus</b></a>
            <a href="kondektur.php"><b>Kondektur</b></a>
            <a href="driver.php"><b>Driver</b></a>
            <a href="trans_upn.php"><b>Trans UPN</b></a>
            <a href="menambah_driver.php"><b>Insert</b></a>
        </div>
    </nav>
    <div class="content"">
    <div class="container">      
                <tr class="akhir">
                    <td colspan="3">
                    
                        <h2 style="margin: 30px 0 30px 0;">Update Data driver</h2>
                        <?php if ($status == 'ok'): ?>
                            <div class="alert success">
                                <span class="closebtn">&times;</span>  
                                <strong>Success!</strong> Data Berhasil Diperbarui.
                            </div>
                        <?php endif; ?>
                        <form action="update_driver.php" method="POST">
                        <?php while($data = mysqli_fetch_array($result)): ?>
                          <div class="form-group">
                            <label>id_driver</label>
                            <input type="text" class="form-control" placeholder="id_driver" name="id_driver" value="<?php echo $data['id_driver'];  ?>" required="required" readonly>
                          </div>
                          <div class="form-group">
                            <label>nama</label>
                            <input type="text" class="form-control" placeholder="nama" name="nama" value="<?php echo $data['nama'];  ?>" required="required">
                          </div>
                          <div class="form-group">
                            <label>no_sim</label>
                            <input type="text" class="form-control" placeholder="no_sim" name="no_sim" value="<?php echo $data['no_sim'];  ?>" required="required" >
                          </div>
                          <div class="form-group">
                            <label>alamat</label>
                            <input type="text" class="form-control" placeholder="alamat" name="alamat" value="<?php echo $data['alamat'];  ?>" required="required">
                          </div>
                          <button type="submit" class="btn btn-primary">Update</button>
                          <?php endwhile; ?>
                        </form>
                    </div>
                  </div>
                    </td>
                </tr>
            </table>
    </div>
</body>
</html>