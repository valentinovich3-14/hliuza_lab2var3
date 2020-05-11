<?php require 'connection.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>2 лабораторная - 3 вариант</title>
    <script src="ajax.js"></script>
</head>
<body>



<!-- HTML Формат -->
<?php require 'select-forms/nurse.php'; ?>
<form>
    <p><b>Медсестры выбранного отделения</b></p>
        <select name="nurse" id="select1">
            <?php
                foreach ($dbh->query($nursestart) as $row) {
                    echo '<option>'.$row['name'].'</option>';
                }
            ?>
        </select>
    <p><input type="button" value="Выбрать" onclick="get1();"></p>
</form>
<ol id="result1"></ol>



<!-- XML Формат -->
<?php require 'select-forms/choose.php'; ?>
<form>
    <p><b>перечень палат, в которых дежурит выбранная медсестра</b></p>
    <select name="nursechoose" id="select2">
        <?php
            foreach ($dbh->query($choosestart) as $row) {
                echo '<option>'.$row['name'].'</option>';
            }
        ?>
    </select>
    <p><input type="button" value="Выбрать" onclick="get2();"></p>
</form>
<ol id="result2"></ol>



<!-- JSON Формат -->
<?php require 'select-forms/shifts.php'; ?>
<form>
    <p><b>дежурства (в любых палатах) в указанную смену.</b></p>
    <select name="shift_choose" id="select3">
        <?php
            foreach ($dbh->query($shiftsstart) as $row) {
                echo '<option>'.$row['shift'].'</option>';
            }
        ?>
    </select>
    <p><input type="button" value="Выбрать" onclick="get3();"></p>
</form>
<ol id="result3"></ol>

<!-- HTML Формат -->
<form>
    <p><b>Добавление медсестры в бд</b></p>
    <table>
        <tr>
            <th>ID</th>
            <th>Имя медсестры</th>
            <th>Дата дежурства</th>
            <th>Отдел</th>
            <th>Смена</th>
        </tr>
        <tr>
            <td><input type="text" name="nurse_id" required="required"></td>
            <td><input type="text" name="nurse_name" required="required"></td>
            <td><input type="date" name="nurse_date" required="required"></td>
            <td><input type="number" name="nurse_depart" required="required"></td>
            <td><input type="text" name="nurse_shift" required="required"></td>
        </tr>
    </table>
    <p><input type="button" value="Добавить" onclick="get4();"></p>
</form>
<ul id="result4"></ul>

<!-- XML Формат -->
<form action="insert-forms/insert-ward.php">
    <p><b>Добавление палаты в бд</b></p>
    <table>
        <tr>
            <th>ID</th>
            <th>Название палаты</th>
        </tr>
        <tr>
            <td><input type="text" name="ward_id" required="required"></td>
            <td><input type="text" name="ward_name" required="required"></td>
        </tr>
    </table>
    <p><input type="button" value="Добавить" onclick="get5();"></p>
</form>
<ul id="result5"></ul>


<!-- JSON Формат -->
<form>
    <p><b>Установка связи между палатой и медсестрой</b></p>
    <table>
        <tr>
            <th>Медсестра</th>
            <th>Палата</th>
        </tr>
        <tr>
            <td>
                <select name="connection_nurse_name">
                    <?php
                        foreach ($dbh->query($choosestart) as $row) {
                            echo '<option>'.$row['name'].'</option>';
                        }
                    ?>
                </select>
            </td>
            <td>
                <select name="connection_ward_name">
                    <?php
                        foreach ($dbh->query($nursestart) as $row) {
                            echo '<option>'.$row['name'].'</option>';
                        }
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <p><input type="button" value="Добавить" onclick="get6();"></p>
</form>
<ul id="result6"></ul>

</body>
</html>