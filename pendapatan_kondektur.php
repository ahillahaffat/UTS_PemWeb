<!-- Ahilla Haffat Kammala/PemWeb C081 -->
<?php
include "koneksi.php";
include ('style.css');

if(isset($_POST['submit'])){
    $bulan = $_POST['bulan'];
    $conn = mysqli_connect("localhost","root","","transupn");

    if(!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }

    $sql = "SELECT trans_upn.id_trans_upn, trans_upn.id_kondektur, trans_upn.jumlah_km, kondektur.nama, COUNT(trans_upn.id_trans_upn) AS total_perjalanan, SUM(trans_upn.jumlah_km) AS total_km 
    FROM trans_upn 
    INNER JOIN kondektur ON trans_upn.id_kondektur = kondektur.id_kondektur 
    WHERE MONTH(tanggal) = '$bulan' 
    GROUP BY trans_upn.id_kondektur";
    $result = mysqli_query($conn,$sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Trans UPN</title>
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
        <h2><b>Pendapatan Kondektur</b></h2>
        <div>
            <a href="bus.php"><b>Bus</b></a>
            <a href="kondektur.php"><b>Kondektur</b></a>
            <a href="driver.php"><b>Driver</b></a>
            <a href="trans_upn.php"><b>Trans UPN</b></a>
            <a href="menambah_bus.php"><b>Insert</b></a>
            <a href="pendapatan_kondektur.php"><b>Data</b></a>
        </div>
    </nav>
<div class="container">
    <form method="POST">
        <label for="bulan">Bulan:</label>
        <select name="bulan" id="bulan">
        <?php
    $bulan_array = array(
        1 => "Januari",
        2 => "Februari",
        3 => "Maret",
        4 => "April",
        5 => "Mei",
        6 => "Juni",
        7 => "Juli",
        8 => "Agustus",
        9 => "September",
        10 => "Oktober",
        11 => "November",
        12 => "Desember"
    );
    for($i = 1; $i <= 12; $i++){
        if($i >= 4 && $i <= 10) {
            $nama_bulan = $bulan_array[$i];
            echo "<option value='$i' ";
            if(isset($bulan) && $bulan == $i) echo "selected";
            echo ">$i ($nama_bulan)</option>";
        }
    }
?>
        </select>
        <button type="submit" name="submit">Tampilkan</button>
    </form>
            <?php
if(isset($result) && mysqli_num_rows($result) > 0): ?>
    <table class="rwd-table">
        <thead>
            <tr>
                <th>ID Kondektur</th>
                <th>Nama Kondektur</th>
                <th>Total Perjalanan</th>
                <th>Total KM</th>
                <th>Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_pendapatan = 0;
            while($row = mysqli_fetch_assoc($result)){
                $id_kondektur = $row['id_kondektur'];
                $nama = $row['nama'];
                $total_perjalanan = $row['total_perjalanan'];
                $total_km = $row['total_km'];
                $total_pendapatan_per_kondektur = $total_km * 1500;
                $total_pendapatan += $total_pendapatan_per_kondektur;?>
                <tr>
                <td data-th="ID Kondektur"><?php echo $row['id_kondektur']; ?></td>
                <td data-th="Nama Kondektur"><?php echo $nama; ?></td>
                <td data-th="Total Perjalanan"><?php echo $total_perjalanan; ?></td>
                <td data-th="Total KM"><?php echo $total_km; ?></td>
                <td data-th="Total Pendapatan">Rp. <?php echo number_format($total_pendapatan_per_kondektur, 0, ',', '.'); ?></td>
                </tr>
            <?php } ?>
            <tr>
            <td colspan="4" style="text-align: right; font-weight: bold;">Total Pendapatan</td>
            <td>Rp. <?php echo number_format($total_pendapatan, 0, ',', '.'); ?></td>
            </tr>
        </tbody>
    </table>
<?php elseif(isset($result)): ?>
    <p>Tidak ada data untuk bulan ini</p>
<?php endif; ?>
</div>
</body>
</html>