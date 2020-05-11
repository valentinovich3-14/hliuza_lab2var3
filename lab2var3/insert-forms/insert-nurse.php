<?php

require '../connection.php';

$data = $_GET;

try {
	$insertNurse = "INSERT INTO nurse (id_nurse, name, date, department, shift) VALUES (?,?,?,?,?)";
	$dbh_insert = $dbh->prepare($insertNurse);
	if ($dbh_insert->execute([$data['nurse_id'],$data['nurse_name'], $data['nurse_date'], $data['nurse_depart'], $data['nurse_shift']])) {
		echo "Медсестра успешно добавлена в базу данных";
	} else {
		echo "Ошибка! Возможно данная медсестра уже имеется в базе";
	}
} catch (Exception $e) {
	echo $e;
}
