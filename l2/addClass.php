<?php
    include_once('dbConnection.php');

    $isSend = false;
    $err = '';
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name']);
        if($name === ''){
            $err = 'Заполните все поля!';
        }
        else{
            $query = "INSERT INTO class SET classname='$name'";
            $result = mysqli_query($dbh, $query);
            $isSend = true;
        }  
    }
    else{
        $name = '';
    }
    $query = "SELECT classname FROM class";
    $resultCountry = mysqli_query($dbh, $query);
    for ($data = []; $row = mysqli_fetch_assoc($resultCountry); $data[] = $row);
    
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
    <a href="guide.php">Назад</a>
    <main>
        <div class="form">
            <form method="post">
                <p>Добавить класс: </p> 
                <input type="text" name="name" value="<?=$name?>">
                <button>Добавить</button>            
            </form>
            <? if($isSend): ?>
            <p>Класс добавлен</p> 
            <? else: ?>
            <p><?=$err?></p>
            <? endif; ?>
            <ul>
                <p class="caption">Список классов в справочнике</p>
                <? foreach($data as $countryName): ?>
                <li><?=$countryName['classname']?></li>
                <? endforeach; ?>
            </ul>
        </div>
    </main>
</body>
</html>