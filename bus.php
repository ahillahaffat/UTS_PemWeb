<!-- Ahilla Haffat Kammala/PemWeb C081 -->
<?php
    include('koneksi.php');
    include('style.css');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Trans UPN</title>

  <script>
    function filterData() {
      var status = document.getElementById("status").value;
      var url = "bus.php?status=" + status;
      window.location.href = url;
    }
  </script>
<style> 

table {
  border-collapse: collapse;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* memberikan shadow pada tabel */
  border-radius: 10px; /* memberikan border radius pada tabel */
}

th, td {
  padding: 10px; /* memberikan jarak padding pada setiap kolom */
}
</style>
</head>
<body> 

    <nav>
        <h2><b>Bus</b></h2>
        <div>
            <a href="bus.php"><b>Bus</b></a>
            <a href="kondektur.php"><b>Kondektur</b></a>
            <a href="driver.php"><b>Driver</b></a>
            <a href="trans_upn.php"><b>Trans UPN</b></a>
            <a href="menambah_bus.php"><b>Insert</b></a>
        </div>
    </nav>
    <div class="container">
  <!-- konten -->
  <form method="get">
    <select name="status" onchange="filterData()">
      <option value="all">Semua</option>
      <option value="1">Aktif</option>
      <option value="2">Tidak Aktif</option>
      <option value="0">Sedang Perawatan</option>
    </select>

    <?php
      if (isset($_GET['status']) && $_GET['status'] != 'all') {
        $status = $_GET['status'];
        $query = "SELECT * FROM bus WHERE status='$status'";
      } else {
        $query = "SELECT * FROM bus";
      }
    ?>

    <button type="submit">Filter</button>
  </form>

  <table border="1" align="center">
    <thead>
      <tr bgcolor="tan">
        <th>ID Bus</th>
        <th>Plat</th>
        <th>Status</th>
        <th>Total KM</th>
        <th>Opsi</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $result = mysqli_query(connection(), $query);
        while($data = mysqli_fetch_array($result)): 
      ?>
      <tr>
        <td>
          <?php echo $data['id_bus']; ?>
        </td>
        <td>
          <?php echo $data['plat']; ?>
        </td>
        <td>
          <?php 
            if ($data["status"] == 1) {
              $warna = "green";
            } elseif ($data["status"] == 2) {
              $warna = "yellow";
            } elseif ($data["status"] == 0) {
              $warna = "red";
            }
            $status=$data["status"];
            echo "<button style ='background-color:$warna;'>$status</button>"
          ?>
        </td>
        <td>
          <?php
            $query_km = "SELECT SUM(jumlah_km) as total_km FROM trans_upn WHERE id_bus=".$data['id_bus'];
            $result_km = mysqli_query(connection(), $query_km);
            $data_km = mysqli_fetch_array($result_km);
            echo $data_km['total_km'];
          ?>
        </td>
        <td>
                                            <a href="<?php echo "update_bus.php?id_bus=" .
                                                $data[
                                                    "id_bus"
                                                ]; ?>" class="update-button">Update</a>
                                            <a href="<?php echo "hapus_bus.php?id_bus=" .
                                                $data[
                                                    "id_bus"
                                                ]; ?>" class="delete-button">Delete</a>
                                            </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

    </td>
</tr>
</table>
</body>
</html> 