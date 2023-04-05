<!-- Ahilla Haffat Kammala/PemWeb C081 -->
<?php
    include('koneksi.php');
    include('style.css');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>transupn</title>
</head>
<body> 
<nav>
        <h2><b>Driver</b></h2>
        <div>
            <a href="bus.php"><b>Bus</b></a>
            <a href="kondektur.php"><b>Kondektur</b></a>
            <a href="driver.php"><b>Driver</b></a>
            <a href="trans_upn.php"><b>Trans UPN</b></a>
            <a href="menambah_driver.php"><b>Insert</b></a>
            <a href="pendapatan_driver.php"><b>Data</b></a>
        </div>
    </nav>
    <div class="container">    
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
 
                <tr class="akhir">
                    <td colspan="6">
                        <table border="1" align="center" >
                            <thead>
                                <tr bgcolor="tan" >
                                    <th>id_driver</th>
                                    <th>nama</th>
                                    <th>no_sim</th>
                                    <th>alamat</th>
                                    <th>opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $query = "SELECT * FROM driver";
                                $result = mysqli_query(connection(),$query);
                                ?>

                                <?php 
                                    while($data = mysqli_fetch_array($result)): 
                                ?>
                                    <tr>
                                            <td>
                                                <?php 
                                                    echo $data['id_driver'];  
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    echo $data['nama'];  
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    echo $data['no_sim'];  
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    echo $data['alamat'];  
                                                ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo "update_driver.php?id_driver=".$data['id_driver']; ?>" > Update</a>
                                                &nbsp;&nbsp;
                                               <a href="<?php echo "hapus_driver.php?id_driver=".$data['id_driver']; ?>"> Delete</a>
                                            </td>
                                    </tr>
                                    
                                <?php endwhile ?>
                            </tbody>
                            
                        </td>

                </tr>
            </table>
</body>
</html> 