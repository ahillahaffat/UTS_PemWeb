<!-- Ahilla Haffat Kammala/PemWeb C081 -->

<?php
include ('koneksi.php');
include ('style.css');

$status = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_trans_upn = $_POST['id_trans_upn'];
    $id_kondektur = $_POST['id_kondektur'];
    $id_bus = $_POST['id_bus'];
    $id_driver = $_POST['id_driver'];
    $jumlah_km = $_POST['jumlah_km'];
    $tanggal = $_POST['tanggal'];

    // Check if the foreign key values exist in their respective tables
    $konduktor_result = mysqli_query(connection(), "SELECT * FROM kondektur WHERE id_kondektur='$id_kondektur'");
    $bus_result = mysqli_query(connection(), "SELECT * FROM bus WHERE id_bus='$id_bus'");
    $driver_result = mysqli_query(connection(), "SELECT * FROM driver WHERE id_driver='$id_driver'");

    if (mysqli_num_rows($konduktor_result) > 0 && mysqli_num_rows($bus_result) > 0 && mysqli_num_rows($driver_result) > 0) {
        $query = "INSERT INTO trans_upn (id_trans_upn, id_kondektur, id_bus, id_driver, jumlah_km, tanggal)
                  VALUES ('$id_trans_upn', '$id_kondektur', '$id_bus', '$id_driver', '$jumlah_km', '$tanggal')";
        $result = mysqli_query(connection(), $query);
        if ($result) {
            $status = 'ok';
        } else {
            $status = 'err';
        }
    } else {
        $status = 'fk_err';
    }
    header('Location: trans_upn.php?status=' . $status);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Add New Product</title>
    <style>
    /* Salin CSS Form di sini */

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


    
label {
  display: block;
  margin-top: 10px;
  font-weight: bold;
}

input[type="text"], select {
  width: 100%;
  padding: 10px;
  margin-top: 5px;
  margin-bottom: 15px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

input[type="submit"] {
  background-color: #4c9baf;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #387ec9;
}

  </style>
</head>
<body>
<nav>
        <h2><b>Insert Trans UPN</b></h2>
        <div>
            <a href="bus.php"><b>Bus</b></a>
            <a href="kondektur.php"><b>Kondektur</b></a>
            <a href="driver.php"><b>Driver</b></a>
            <a href="trans_upn.php"><b>Trans UPN</b></a>
            <a href="menambah_trans_upn.php"><b>Insert</b></a>
        </div>
    </nav>
    <div class="container">      
    <tr class="akhir">
  <td colspan="3"><main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <?php 
                          if ($status=='ok') {
                            echo '<br><br><div class="alert alert-success" role="alert">Data berhasil diperbarui</div>';
                          }
                          elseif($status=='err'){
                            echo '<br><br><div class="alert alert-danger" role="alert">Data Customer gagal disimpan</div>';
                          }
                        ?>
    <div class="content">
    <form action="menambah_trans_upn.php" method="POST">

        <label>Id Trans UPN:</label>
        <input type="text" placeholder="id_trans_upn" name="id_trans_upn" required="required">

        <label>Id Kondektur:</label>
        <select name="id_kondektur">
            <?php
                 $query_kondektur = "SELECT * FROM kondektur";
                 $result_kondektur = mysqli_query(connection(), $query_kondektur);
                 while($data_kondektur = mysqli_fetch_array($result_kondektur)) {
                     echo "<option value='".$data_kondektur['id_kondektur']."'>".$data_kondektur['nama']."</option>";
                 }
             ?>
        </select>

        <label>Id Bus:</label>
        <select name="id_bus">
            <?php
                 $query_bus = "SELECT * FROM bus";
                 $result_bus = mysqli_query(connection(), $query_bus);
                 while($data_bus = mysqli_fetch_array($result_bus)) {
                     echo "<option value='".$data_bus['id_bus']."'>".$data_bus['plat']."</option>";
                 }
             ?>
        </select>

        <label>Id driver:</label>
        <select name="id_driver">
            <?php
                 $query_driver = "SELECT * FROM driver";
                 $result_driver = mysqli_query(connection(), $query_driver);
                 while($data_driver = mysqli_fetch_array($result_driver)) {
                     echo "<option value='".$data_driver['id_driver']."'>".$data_driver['nama']."</option>";
                 }
             ?>
        </select>

        <label>Jumlah Km:</label>
        <input type="text" placeholder="jumlah_km" name="jumlah_km" required="required">

        <label>Tanggal:</label>
        <input type="text" placeholder="tanggal" name="tanggal" required="required">

        <input type="submit" name="submit" value="Simpan">
    </form>
</div>
            </body>
            </html>