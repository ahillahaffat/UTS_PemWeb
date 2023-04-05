<!-- Ahilla Haffat Kammala/PemWeb C081 -->
<?php
    include('koneksi.php');
?>
<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1

// Number of records to show on each page

// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM trans_upn ORDER BY id_kondektur');

$stmt->execute();
// Fetch the records so we can display them in our template.
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_contacts = $pdo->query('SELECT COUNT(*) FROM trans_upn')->fetchColumn();
?>

<?=template_header('Home')?>

<div class="content read">
	<h2>Read Contacts</h2>
	<a href="create.php" class="create-contact">Create Contact</a>
	<table>
        <thead>
            <tr>
                <td>id_kondektur</td>
                <td>jumlah_km</td>
                <td>pendapatan</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): 

                    $id_kondektur = ($contact["id_kondektur"]);
                    $jumlah_km = ($contact["jumlah_km"]);
            ?>
            <tr
            >
                <td><?=$contact['id_kondektur']?></td>
                <td><?=$contact['jumlah_km']?></td>
                <td><?=$contact['jumlah_km']*1500?></td>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	
</div>




<?=template_footer()?>