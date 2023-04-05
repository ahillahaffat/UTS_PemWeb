<!-- Ahilla Haffat Kammala/PemWeb C081 -->
<?php
    include('koneksi.php');
    include('style.css');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Trans UPN</title>
    <style>
        .container td a {
  display: inline-block;
  transform: scale(1);
  transition: all 0.3s ease;
}

.container td a:hover {
  transform: scale(1.2);
}

        table {
            border-collapse: collapse;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 100%;  
            min-width: 900px;
            margin: 30px auto;

        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        thead tr {
            background-color: tan;
            color: white;
        }
    </style>
</head>
<body>
    <nav>
        <h2><b>Trans UPN</b></h2>
        <div>
            <a href="bus.php"><b>Bus</b></a>
            <a href="kondektur.php"><b>Kondektur</b></a>
            <a href="driver.php"><b>Driver</b></a>
            <a href="trans_upn.php"><b>Trans UPN</b></a>
            <a href="menambah_trans_upn.php"><b>Insert</b></a>
        </div>
    </nav>
    <div class="container">    
        <table border="1" align="center">
            <thead>
                <tr bgcolor="tan">
                    <th>id_trans_upn</th>
                    <th>id_kondektur</th>
                    <th>id_bus</th>
                    <th>id_driver</th>
                    <th>jumlah_km</th>
                    <th>tanggal</th>
                    <th>opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $query = "SELECT * FROM trans_upn";
                $result = mysqli_query(connection(),$query);
                ?>

                <?php while($data = mysqli_fetch_array($result)): ?>
                    <tr>
                        <td>
                            <?php echo $data['id_trans_upn']; ?>
                        </td>
                        <td>
                            <?php echo $data['id_kondektur']; ?>
                        </td>
                        <td>
                            <?php echo $data['id_bus']; ?>
                        </td>
                        <td>
                            <?php echo $data['id_driver']; ?>
                        </td>
                        <td>
                            <?php echo $data['jumlah_km']; ?>
                        </td>
                        <td>
                            <?php echo $data['tanggal']; ?>
                        </td>
                        <td>
                            <a href="<?php echo "update_trans_upn.php?id_trans_upn=".$data['id_trans_upn']; ?>">Update</a>
                            &nbsp;&nbsp;
                            <a href="<?php echo "hapus_trans_upn.php?id_trans_upn=".$data['id_trans_upn']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</body>
</html>
