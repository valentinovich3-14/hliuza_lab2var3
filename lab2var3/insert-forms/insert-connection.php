<?php
header('Content-Type: application/json');
require '../connection.php';

$nurseName = $_GET['nurse_name'];
$wardName = $_GET['ward_name'];
$result = '';
// Проверяем на наличие связи в бд
$testQuery = "SELECT COUNT(*) from nurse, nurse_ward, ward WHERE nurse_ward.fid_nurse = nurse.id_nurse and nurse_ward.fid_ward = ward.id_ward and nurse.name = '". $nurseName ."' and ward.name = '". $wardName ."'";

foreach ($dbh->query($testQuery) as $row) {
    if ($row['COUNT(*)'] > 0) {
    	$result = "Такая связь уже существует в базе!";
    } else {
    	// Получаем id медсестры и палаты
    	$queryIds = "SELECT nurse.id_nurse, ward.id_ward from nurse, ward WHERE nurse.name = '". $nurseName ."' and ward.name = '". $wardName ."'";
    	foreach ($dbh->query($queryIds) as $id) {
    		$nurseId = $id['id_nurse'];
    		$wardId = $id['id_ward'];

    		// Добавление в бд идентификаторов
    		$insertNurseWard = "INSERT INTO nurse_ward (fid_nurse, fid_ward) VALUES (?,?)";

    		$dbh_insert = $dbh->prepare($insertNurseWard);
    		if ($dbh_insert->execute([$nurseId,$wardId])) {
                $result = "Связь успешно добавлена";
			} else {
                $result = "Ошибка добавления связи!";
			}
    	}
    }
}
echo(json_encode($result));