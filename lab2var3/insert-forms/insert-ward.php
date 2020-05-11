<?php
header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");
require '../connection.php';

$data = $_GET;
echo '<?xml version="1.0" encoding="utf8" ?>';
echo "<root>";
try {
	$insertWard = "INSERT INTO ward (id_ward, name) VALUES (?,?)";
	$dbh_insert = $dbh->prepare($insertWard);
	if ($dbh_insert->execute([$data['ward_id'],$data['ward_name']])) {
		echo '<result>'."Палата успешно добавлена в базу данных".'</result>';
	} else {
		echo '<result>'."Ошибка!".'</result>';
	}
} catch (Exception $e) {
	echo $e;
}
echo "</root>";