<?php
    include_once('dbConnection.php');
    
    $flag = false;
    if(isset($_POST['submit2'])) {
        $flag = true;
        $idFilter = (int)$_POST['filter'];
        $filterName = trim($_POST['filterInput']);
        switch($idFilter){
            case 1:
                $query = "SELECT * FROM helicopter JOIN model ON helicopter.modelID = 
                model.ID JOIN country ON helicopter.countryID = country.ID JOIN 
                class ON helicopter.classID = class.ID 
                WHERE model.name = '$filterName'";
                break;
            case 2:
                $query = "SELECT * FROM helicopter JOIN model ON helicopter.modelID = 
                model.ID JOIN country ON helicopter.countryID = country.ID JOIN 
                class ON helicopter.classID = class.ID 
                WHERE mark = '$filterName'";
                break;
            case 3:
                $query = "SELECT * FROM helicopter JOIN model ON helicopter.modelID = 
                model.ID JOIN country ON helicopter.countryID = country.ID JOIN 
                class ON helicopter.classID = class.ID 
                WHERE country.countryname = '$filterName'";
                break;
            case 4:
                $query = "SELECT * FROM helicopter JOIN model ON helicopter.modelID = 
                model.ID JOIN country ON helicopter.countryID = country.ID JOIN 
                class ON helicopter.classID = class.ID 
                WHERE classname = '$filterName'";
                break;
        }
    }
    else if (isset($_POST['submit1'])){
        $flag = true;
        $idDigitFilter = (int)$_POST['digitFilter'];
        $digitFilterName = trim($_POST['digitFilterInput']);
        $digitFilterName_2 = trim($_POST['digitFilterInput_2']);
        switch($idDigitFilter){
            case 1:
                $query = "SELECT * FROM helicopter JOIN model ON helicopter.modelID = 
                model.ID JOIN country ON helicopter.countryID = country.ID JOIN 
                class ON helicopter.classID = class.ID 
                WHERE hYear BETWEEN $digitFilterName AND $digitFilterName_2";
                $digitalFilter = true;
                break;
            case 2:
                $query = "SELECT * FROM helicopter JOIN model ON helicopter.modelID = 
                model.ID JOIN country ON helicopter.countryID = country.ID JOIN 
                class ON helicopter.classID = class.ID 
                WHERE price BETWEEN $digitFilterName AND $digitFilterName_2";
                $digitalFilter = true;
                break;
        }
    }       
        $result = mysqli_query($dbh, $query);
        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
?>
<h2>Выберите фильтр:</h2>
<form method="post">
    Строковый фильтр:<br>
    <select class="filter" name="filter">
        <option>
            <option value="1">По марке</option>
            <option value="2">По модели</option>
            <option value="3">По стране</option>
            <option value="4">По классу</option>
        </option>
    </select>
    <input class="filter" type="text" name="filterInput">
    <button name=submit2>Найти</button>
    <br><br>
    Числовой фильтр:<br>
    <select class="filter" name="digitFilter">
        <option>
            <option value="1">По году</option>
            <option value="2">По цене</option>
        </option>
    </select>
    От:
    <input class="filter" type="text" name="digitFilterInput">
    До:
    <input class="filter" type="text" name="digitFilterInput_2">
    <button name=submit1>Найти</button>
 </form>
 <br>
 <? if($flag): ?>
 <table>
    <tr><th>Марка</th><th>Модель</th><th>Страна</th><th>Класс</th><th>Год</th><th>Цена</th></tr>
    <? foreach($data as $item): ?>
        <tr><th><?=$item['name']?></th><th><?=$item['mark']?></th><th><?=$item['countryname']?></th><th><?=$item['classname']?></th><th><?=$item['hYear']?></th><th><?=$item['price']?></th></tr>
    <? endforeach; ?>
</table>
<? endif; ?>
