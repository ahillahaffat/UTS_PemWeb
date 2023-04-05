<!-- Ahilla Haffat Kammala/PemWeb C081 -->

<?php
  //memanggil file conn.php yang berisi koneski ke database
  //dengan include, semua kode dalam file conn.php dapat digunakan pada file index.php
  include ('koneksi.php');
  include ('style.css');


  $status = "";
   $result = "";
   if ($_SERVER["REQUEST_METHOD"] === "GET") {
       if (isset($_GET["id_bus"])) {
           //query SQL
           $id_bus_upd = $_GET["id_bus"];
           $query = "SELECT * FROM bus WHERE id_bus = '$id_bus_upd'";
   
           //eksekusi query
           $result = mysqli_query(connection(), $query);
       }
   }
   
   if ($_SERVER["REQUEST_METHOD"] === "POST") {
       $id_bus = $_POST["id_bus"];
       $plat = $_POST["plat"];
       $status = $_POST["status"];
       //query SQL
       $sql = "UPDATE bus SET  plat='$plat', status='$status' WHERE id_bus='$id_bus'";
   
       //eksekusi query
       $result = mysqli_query(connection(), $sql);
       if ($result) {
           $status = "ok";
       } else {
           $status = "err";
       }
   
       //redirect ke halaman lain
       header("Location: bus.php");
   }
   ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Bus</title>
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
        <h2><b>Update Bus</b></h2>
        <div>
            <a href="bus.php"><b>Bus</b></a>
            <a href="kondektur.php"><b>Kondektur</b></a>
            <a href="driver.php"><b>Driver</b></a>
            <a href="trans_upn.php"><b>Trans UPN</b></a>
            <a href="menambah_bus.php"><b>Insert</b></a>
        </div>
    </nav>
    <tr class="akhir">
  <td colspan="3">
  <div class="container">      
  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                        <?php 
                          if ($status=='ok') {
                            echo '<br><br><div class="alert alert-success" role="alert">Data berhasil diperbarui</div>';
                          }
                          elseif($status=='err'){
                            echo '<br><br><div class="alert alert-danger" role="alert">Data Customer gagal disimpan</div>';
                          }
                        ?>
      <h2 style="margin: 30px 0 30px 0;">Update Data Bus</h2>
      <form action="update_bus.php" method="POST">
        <?php while($data = mysqli_fetch_array($result)): ?>
          <div class="form-group">
            <label for="id_bus">id_bus</label>
            <input type="text" class="form-control" id="id_bus" name="id_bus" value="<?php echo $data['id_bus'];  ?>" required readonly>
          </div>
          <div class="form-group">
            <label for="plat">plat</label>
            <input type="text" class="form-control" id="plat" name="plat" value="<?php echo $data['plat'];  ?>" required>
          </div>
          <div class="form-group">
            <label for="status">status</label>
            <select class="form-control" id="status" name="status" required>
              <option value="">-- Pilih Status --</option>
              <option value="1" <?php if ($data['status'] == 1) echo "selected"; ?>>Aktif</option>
              <option value="2" <?php if ($data['status'] == 2) echo "selected"; ?>>Tidak Aktif</option>
              <option value="0" <?php if ($data['status'] == 0) echo "selected"; ?>>Sedang Perawatan</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        <?php endwhile; ?>
      </form>
    </div>
  </td>
</tr>

            </table>
    </div>
</body>
</html>