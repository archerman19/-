<?php
    include_once("dbConnection.php");
    $isSend = false;
    $err = '';
    if(isset($_POST['submit3'])) {
        $mark = trim($_POST['mark']);
        $year = trim($_POST['year']);
        $price = trim($_POST['price']);
        if($mark === '' || $year === '' || $price === ''){
            $err = 'Заполните все поля!';
        }
        else if(mb_strlen($year, 'UTF8') < 4){
            $err = 'Значение года слишком короткое';
        }
        else{     
            $id = $_POST['model_id'];
            $id1 = $_POST['country_id'];
            $id2 = $_POST['class_id'];
            $query = "INSERT INTO 
            helicopter 
            (modelID, mark, countryID, classID, hYear, price) 
            values
            ($id, '$mark', $id1, $id2, $year, $price)";
            $result = mysqli_query($dbh, $query);
            $isSend = true;
        }
        
    }
    else{
        $mark = '';
        $year = '';
        $price = '';
    }
    echo $_SERVER['REQUEST_METHOD'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <header class="head">
        <button><a href="guide.php">Справочник</a></button>
    </header>
    <form class="selector" method="post">
        <table>
            <tr><th>Марка</th><th>Модель</th><th>Страна</th><th>Класс</th><th>Год</th><th>Цена</th></tr>
            <tr>
                <th>
                    <div>
                        <select name="model_id" type="text">
                            <option>
                                <?php
                                    $sql = "SELECT ID, name FROM model";
                                    $result_select = mysqli_query($dbh, $sql);
                                    /*Выпадающий список*/
                                    
                                    while($row = mysqli_fetch_array($result_select)) {
                            
                                    echo '<option value = "' .$row['ID'] . '">' . $row['name'] . '</option>';
                                    }
                                ?>
                            </option>
                        </select>
                    </div>
                </th>
                <th>
                    <div>
                        <input type="text" name="mark" value="<?=$mark?>">
                    </div>
                </th>
                <th>
                    <div>
                        <select name="country_id" type="text">
                            <option>
                                <?php
                                    $sql = "SELECT ID, countryname FROM country";
                                    $result_select = mysqli_query($dbh, $sql);
                                    /*Выпадающий список*/
                                    
                                    while($row = mysqli_fetch_array($result_select)) {
                            
                                    echo '<option value = "' .$row['ID'] . '">' . $row['countryname'] . '</option>';
                                    }
                                ?>
                            </option>
                        </select>
                    </div>
                </th>
                <th>
                    <div>
                        <select name="class_id" type="text">
                            <option>
                                <?php
                                    $sql = "SELECT ID, classname FROM class";
                                    $result_select = mysqli_query($dbh, $sql);
                                    /*Выпадающий список*/
                                    
                                    while($row = mysqli_fetch_array($result_select)) {
                            
                                    echo '<option value = "' .$row['ID'] . '">' . $row['classname'] . '</option>';
                                    }
                                ?>
                            </option>
                        </select>
                    </div>
                </th>
                <th>
                    <div>
                        <input name="year" value="<?=$year?>">
                    </div>
                </th>
                <th>
                    <div>
                        <input name="price" value="<?=$price?>">
                    </div>
                </th>
            </tr>
        </table>
        <button name="submit3">Добавить запись</button>
    </form>
    <? if($isSend): ?>
    <p>Записано в базу данных</p>
    <? else: ?>
    <p><?=$err?></p>
    <? endif; ?>
    <div class="section">
        <div class="item">
            <h1>Все записи</h1>
            <?php include 'showRecords.php';?>
        </div>
        <div class="item">
            <?php include 'filter.php'; ?>
        </div>
    </div>
</body>
</html>