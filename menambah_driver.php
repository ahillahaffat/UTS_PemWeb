<!-- Ahilla Haffat Kammala/PemWeb C081 -->

<?php 
    include ('koneksi.php');
    include ('style.css');

    $status = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_driver= $_POST['id_driver'];
        $nama = $_POST['nama'];
        $no_sim = $_POST['no_sim'];
        $id_alamat= $_POST['alamat'];
      
        //query SQL
        $query = "INSERT INTO driver (id_driver, nama, no_sim, alamat) 
        VALUES('$id_driver', '$nama', '$no_sim', '$alamat')"; 
  
        //eksekusi query
        $result = mysqli_query(connection(),$query);
        if ($result) {
          $status = 'ok';
        }
        else{
          $status = 'err';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Driver</title>
    <style>
 .container {
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  border-radius: 10px;
  padding: 20px;
}

.form-group {
  margin-bottom: 20px;
}

.form-control {
  border-radius: 5px;
  box-sizing: border-box;
  padding: 10px;
  border: none;
  box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
}

.btn-primary {
  background-color: #007bff;
  border: none;
  border-radius: 5px;
  box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
  color: #fff;
  padding: 10px 20px;
}

.btn-primary:hover {
  background-color: #0069d9;
}

</style>
</head>
<body>
<nav>
        <h2><b>Insert</b></h2>
        <div>
            <a href="bus.php"><b>Bus</b></a>
            <a href="kondektur.php"><b>Kondektur</b></a>
            <a href="driver.php"><b>Driver</b></a>
            <a href="trans_upn.php"><b>Trans UPN</b></a>
            <a href="menambah_driver.php"><b>Insert</b></a>
        </div>
    </nav>    
<div class = "container" >
                    <td colspan="3">
                      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                        <?php 
                          if ($status=='ok') {
                            echo '<br><br><div class="alert alert-success" role="alert">Data berhasil disimpan</div>';
                          }
                          elseif($status=='err'){
                            echo '<br><br><div class="alert alert-danger" role="alert">Data Customer gagal disimpan</div>';
                          }
                        ?>
                
                      <h2 style="margin: 30px 0 30px 0;">Form Driver</h2>
                      <form action="menambah_driver.php" method="POST">
                      <div class="form-group">
                        <label>id_driver</label>
                        <input type="text" class="form-control" placeholder="id_driver" name="id_driver" required="required">
                      </div>
                      <div class="form-group">
                        <label>nama</label>
                        <input type="text" class="form-control" placeholder="nama" name="nama" required="required">
                      </div>
                      <div class="form-group">
                        <label>no_sim</label>
                        <input type="text" class="form-control" placeholder="no_sim" name="no_sim" required="required">
                      </div>
                      <div class="form-group">
                        <label>alamat</label>
                        <input type="text" class="form-control" placeholder="alamat" name="alamat" required="required">
                      </div>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                  </main>
                    </td>
                </tr>
            </table>
    </div>
</body>
</html>