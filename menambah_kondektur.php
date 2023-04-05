<!-- Ahilla Haffat Kammala/PemWeb C081 -->

<?php 
    include ('koneksi.php');
    include ('style.css');

    $status = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_kondektur= $_POST['id_kondektur'];
        $nama = $_POST['nama'];
        //query SQL
        $query = "INSERT INTO kondektur (id_kondektur, nama) 
        VALUES('$id_kondektur', '$nama')"; 
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
    <title>Insert Kondektur</title>
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
        <h2><b>Insert Kondektur</b></h2>
        <div>
            <a href="bus.php"><b>Bus</b></a>
            <a href="kondektur.php"><b>Kondektur</b></a>
            <a href="driver.php"><b>Driver</b></a>
            <a href="trans_upn.php"><b>Trans UPN</b></a>
            <a href="menambah_kondektur.php"><b>Insert</b></a>
        </div>
    </nav>
    <div class="container">          
                <tr class="akhir">
                    <td colspan="3">
                      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                        <?php 
                          if ($status=='ok') {
                            echo '<br><br><div class="alert alert-success" role="alert">Data Customer berhasil disimpan</div>';
                          }
                          elseif($status=='err'){
                            echo '<br><br><div class="alert alert-danger" role="alert">Data Customer gagal disimpan</div>';
                          }
                        ?>
                
                      <h2 style="margin: 30px 0 30px 0;">Form Kondektur</h2>
                      <form action="menambah_kondektur.php" method="POST">
                      <div class="form-group">
                        <label>id_kondektur</label>
                        <input type="text" class="form-control" placeholder="id_kondektur" name="id_kondektur" required="required">
                      </div>
                      <div class="form-group">
                        <label>nama</label>
                        <input type="text" class="form-control" placeholder="nama" name="nama" required="required">
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