<?php

require '../connection.php';

$nurse = $_GET["nurse"];

$nursestart = "SELECT nurse.name FROM nurse, nurse_ward, ward WHERE nurse.id_nurse = nurse_ward.fid_nurse and nurse_ward.fid_ward = ward.id_ward and ward.name = '". $nurse ."'";

foreach ($dbh->query($nursestart) as $row) {
	echo '<li>'. $row['name'] .'</li>';
}
