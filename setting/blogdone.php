<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION["login"]) === false) {
    echo "ログインしていません<br>";
    echo "<a href='setting/set_login.php'>ログイン画面へ</a>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>cms</title>
    <link rel="stylesheet" href="setting/style2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    try {
        $cate = filter_input(INPUT_POST,"cate");
        $title = filter_input(INPUT_POST, "title");
        $honbun = filter_input(INPUT_POST, "honbun");
        $img = filter_input(INPUT_POST, "img");

        $dsn = "mysql:host=mysql;dbname=cms;charset=utf8";
        $user = "root";
        $password = "root";
        $dbh = new PDO($dsn, $user, $password);
        $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO blog(category, title, honbun, img, time) VALUES(?,?,?,?,NOW())";
        $stmt = $dbh -> prepare($sql);
        $data[] = $cate;
        $data[] = $title;
        $data[] = $honbun;
        $data[] = $img;
        $stmt -> execute($data);
    }
    catch (Exception $e) {
        echo "只今障害が発生しています<br>";
        echo "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
    }
    ?>
    <h3>登録しました<br></h3>
    <a href="../edit_single.php"></a>
    <a href="set_top.php">トップメニューへ</a>
</body>
</html>