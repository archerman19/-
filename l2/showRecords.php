<?php
    include_once('dbConnection.php');

    $query = "SELECT * FROM helicopter JOIN model ON helicopter.modelID = 
    model.ID JOIN country ON helicopter.countryID = country.ID JOIN 
    class ON helicopter.classID = class.ID";
    $resultCountry = mysqli_query($dbh, $query);
    for ($data = []; $row = mysqli_fetch_assoc($resultCountry); $data[] = $row);
    if(isset($_POST['del'])){
        $dID = $_POST['hID'];
        echo $dID;
    }

?>
<form action='delete.php' method='POST'>
    <table>
        <tr><th>Марка</th><th>Модель</th><th>Страна</th><th>Класс</th><th>Год</th><th>Цена</th><th>Удалить</th></tr>
        <? foreach($data as $item): ?>
            <tr><th><?=$item['name']?></th><th><?=$item['mark']?></th><th><?=$item['countryname']?></th><th><?=$item['classname']?></th>
            <th><?=$item['hYear']?></th><th><?=$item['price']?></th><th><input type='checkbox' name='delete_row[]' value="<?=$item['hID']?>"></th></tr>
        <? endforeach; ?>
    </table>
<br><input type='submit' value='Удалить выделенные записи'></form>
