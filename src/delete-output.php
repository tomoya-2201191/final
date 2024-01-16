<?php
const SERVER = 'mysql220.phy.lolipop.lan';
const DBNAME = 'LAA1516825-final';
const USER = 'LAA1516825';
const PASS = 'Pass0325';

$connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';
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
            width: 100%;/*横幅*/
            height: 100%;
            right: 0;
            display: flex;/*要素の横並び*/
        }
        .main {
            padding: 10px;/*文字と枠の余白*/
            width: 100%;
        }
        .right-menu {
            width: 25%;/*横幅*/
            padding: 5px;/*文字と枠の余白*/
            margin: 0;
            background-color: lightgray;
            font-size: 25px;
            line-height: 55px;
        }
        .button {
            width: 110px;
            height: 70px;
            margin-left: 40px;
            padding: 10px;
            background-color: rgb(255, 192, 4);
            font-size: 25px;
            border-radius: 5px;
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
            <?php
                $carId = $_POST['carid'];
                $pdo = new PDO($connect, USER, PASS);
                $sql = $pdo->prepare('delete from car where car_id=?');
                $sql->execute([$carId]);
                echo '<h2>削除できました</h2>';
                $sql=$pdo->query('select * from car ORDER BY rank ASC');
                $i = 1;
                foreach($sql as $row){
                    echo '<tr><td><h2>',$i,'<h2></td>';
                    echo '<td><img src="../img/',$row['path'],'.jpg" width="650" height="400"></td>';
                    echo '<td><h1>',$row['name'],'</h1>';
                    echo '<h3>乗りたい度 : ☆',$row['star'],'</h3></td></tr>';
                    $i++;
                }
            ?>
        </div>
        <div class="right-menu">
            <?php
            $pdo = new PDO($connect, USER, PASS);
            $sql = $pdo->query('SELECT * FROM maker');
            echo '<ul>';
            foreach ($sql as $row) {
                echo '<h3><a href="category.php?id=', $row['maker_id'], '">', $row['name'], '</a></h3>';
            }
            echo '</ul>';
            ?>
        </div>
    </div>
</body>
</html>
