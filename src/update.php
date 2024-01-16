<?php
const SERVER = 'mysql220.phy.lolipop.lan';
const DBNAME = 'LAA1516825-final';
const USER = 'LAA1516825';
const PASS = 'Pass0325';

$connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>更新</title>
    <style>
        .header {
            width: 100%;
            height: 80px;
            background-color: lightgray;
            padding: 20px 50px;
            box-sizing: border-box;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            font-size: 20px;
        }
        body {
            margin-top: 90px; /* ヘッダーの高さ分だけコンテンツを下げる */
        }
        .container {
            width: 100%; /*横幅*/
            height: 100%;
            right: 0;
            display: flex; /*要素の横並び*/
            /*position: relative;*/
        }
        .main {
            padding: 10px; /*文字と枠の余白*/
            /*background-color: lightgray;*/
            width: 100%;
        }
        .right-menu {
            width: 25%; /*横幅*/
            padding: 5px; /*文字と枠の余白*/
            margin: 0;
            background-color: lightgray;
            font-size: 25px;
            line-height: 55px;
        }
        .button {
            width: 70px;
            height: 30px;
            margin-left: 90px;
            background-color: rgb(255, 192, 4);
            border-radius: 5px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <header class="header">
        <h3>将来乗りたい車</h3>
    </header>
    <div class="container">
        <div class="main">
            <h2>
                <a href="home.php">一覧</a>
                <a href="insert.php">登録</a>
                <a href="update.php">更新</a>
                <a href="delete.php">削除</a>
                <a href="maker.php">メーカー登録</a>
            </h2>
            <table>
            <?php
                $i = 1;
                $pdo = new PDO($connect, USER, PASS);
                $cars = $pdo->query('select * from car ORDER BY rank ASC');
                
                foreach ($cars as $car) {
                    echo '<form action="update-output.php" method="post">';
                    echo '<tr>';
                    echo '<td><h2>', $i, '</h2></td>';
                    echo '<td><img src="../img/', $car['path'], '.jpg" width="650" height="400"></td>';
                    echo '<td>車両名 : <input type="text" name="name_', $car['car_id'], '" value="', $car['name'], '"><br>';
                    echo '乗りたい度 : ☆<input type="number" min="1" max="5" name="star_', $car['car_id'], '" value="', $car['star'], '"><br>';
                    echo '順位 : <input type="number" min="1" name="rank_', $car['car_id'], '" value="', $car['rank'], '"><br>';
                    echo '画像パス : <input type="text" name="path_', $car['car_id'], '" value="', $car['path'], '"><br>';
                    echo '<input type="hidden" name="carid" value="', $car['car_id'], '">';
                    echo 'メーカー：<select name= "maker_', $car['car_id'], '">';
                    $makers = $pdo->query('select * from maker');
                    $a = 1;
                    foreach ($makers as $maker) {
                        echo '<option value="' . $a . '">', $maker['name'], '</option>';
                        $a++;
                    }
                    echo '</select>';
                    echo '<br>';
                    echo '<input type="submit" name="update" value="更新" class="button"></td></tr>';
                    $i++;
                    echo '</form>';
                }
                
            ?>
            </table>
        </div>
        <div class="right-menu">
            <?php
                $makers = $pdo->query('select * from maker');
                echo '<ul>';
                foreach ($makers as $maker) {
                    echo '<h3><a href="category.php?id=', $maker['maker_id'], '">', $maker['name'], '</a></h3>';
                }
                echo '</ul>';
            ?>
        </div>
    </body>
</html>
