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
    $img = $_FILES["image_data"];
    $max = count($img["name"]);

    foreach ($img["tmp_name"] as $key => $value) {
        $tmp_name[] = $value;
    }
    foreach ($img["name"] as $key => $value) {
        $name[] = $value;
    }
    for ($i = 0; $i < $max; $i++) {
        move_uploaded_file($tmp_name[$i], "./img/" . $name[$i]);
    }
    $dsn = "mysql:host=mysql;dbname=cms;charset=utf8";
    $user = "root";
    $password = "root";
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    for ($i = 0; $i < $max; $i++) {
        $sql = "INSERT INTO img(name) VAlUES(?)";
        $stmt = $dbh->prepare($sql);
        $data[] = $name[$i];
        $stmt->execute($data);
        $data = array();
    }
    echo "<br><br>完了しました";
    ?>
    <form>
        <input type='button' onclick='history.back()' value='戻る'>
    </form>
</body>

</html>