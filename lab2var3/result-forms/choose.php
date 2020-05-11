<?php
header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");
require '../connection.php';


$nurse = $_GET["nursechoose"];

$nursestart = "SELECT ward.Name FROM ward , nurse_ward , nurse where id_ward = fid_ward and fid_nurse = id_nurse and nurse.name = '". $nurse ."'";




echo '<?xml version="1.0" encoding="utf8" ?>';
echo "<root>";
foreach ($dbh->query($nursestart) as $row) {
    echo '<row>'.'<nurseName>'.$row['Name'].'</nurseName>'.'</row>';
}
echo "</root>";