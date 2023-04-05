<!-- Ahilla Haffat Kammala/PemWeb C081 -->

<?php
   include "koneksi.php";
   
   $status = "";
   $result = "";
   
   if ($_SERVER["REQUEST_METHOD"] === "GET") {
       if (isset($_GET["id_kondektur"])) {
           //query SQL
           $id_kondektur_upd = $_GET["id_kondektur"];
           $query = "SELECT * FROM kondektur WHERE id_kondektur = '$id_kondektur_upd'";
   
           //eksekusi query
           $result = mysqli_query(connection(), $query);
       }
   }
   
   if ($_SERVER["REQUEST_METHOD"] === "POST") {
       $id_kondektur = $_POST["id_kondektur"];
       $nama = $_POST["nama"];
       
       //query SQL
       $sql = "UPDATE kondektur SET id_kondektur='$id_kondektur', nama='$nama' WHERE id_kondektur='$id_kondektur'";
   
       //eksekusi query
       $result = mysqli_query(connection(), $sql);
       
       if ($result) {
           $status = "ok";
       } else {
           $status = "err";
       }
   
       //redirect ke halaman lain
       header("Location: kondektur.php");
   }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Update Konduktor</title>
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
        <h2><b>Update Kondektur</b></h2>
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
      <h2 style="margin: 30px 0 30px 0;">Update Data Kondektur</h2>
                        <form action="update_kondektur.php" method="POST">
                        <?php while($data = mysqli_fetch_array($result)): ?>
                            <label>id_kondektur</label>
                            <input type="text" class="form-control" placeholder="id_kondektur" name="id_kondektur" value="<?php echo $data['id_kondektur'];  ?>" required="required" readonly >
                            
                            <label>nama</label>
                            <input type="text" class="form-control" placeholder="nama" name="nama" value="<?php echo $data['nama'];  ?>" required="required">

                          <button type="submit" class="btn btn-primary">Update</button>
                          <?php endwhile; ?>
                        </form>
</div>
            </body>
            </html>