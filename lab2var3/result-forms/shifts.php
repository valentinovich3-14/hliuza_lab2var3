<?php
header('Content-Type: application/json');
require '../connection.php';


$shift = $_GET["shift_choose"];

$shiftstart = "SELECT name, date, department FROM nurse WHERE shift = '". $shift ."'";

$result = array();
if (!empty($shiftstart)) {
	foreach ($dbh->query($shiftstart) as $row) {
		$result[] = array(
			'name'			=>	$row['name'],
			'date'			=>	$row['date'],
			'department'	=>	$row['department']
		);
	}
}

echo(json_encode($result));