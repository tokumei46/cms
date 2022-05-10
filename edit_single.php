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
        $img = filter_input(INPUT_POST, "img");

        $dsn = "mysql:host=mysql;dbname=cms;charset=utf8";
        $user = "root";
        $password = "root";
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT name FROM k_menu WHERE1";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        while (true) {
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($rec["name"]) === true) {
                break;
            }
            $k_menu[] = $rec["name"];
        }
        $dbh = null;
    } catch (Exception $e) {
        echo "只今障害が発生しています<br>";
        echo "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
    }
    ?>
    <div id="edit">
        <div id="box2">
            <form action="setting/upload.php" method="post" enctype="multipart/form-data">
                <h3>イメージファイルアップロード<br></h3>
                <input type="file" name="image_data[]" multiple="multiple">
                <input type="submit" value="アップロード">
            </form>
            <br>
            <form action="single_check.php" method="post" enctype="multipart/form-data">
                <h3>カテゴリ<br></h3>
                <select name="cate">
                    <?php foreach ($k_menu as $key => $value) {; ?>
                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                    <? }; ?>
                </select>
                <br>
                <h3>タイトル</h3>
                <br>
                <textarea name="title" id="title1"><h1></h1></textarea>
                <br>
                <h3>サムネイル</h3>
                <input type="text" id="gazou" name="img">
                <input type="button" id="bt" value="ok">
                <br><br>

                <div class="tag">
                    <div id="h1">h1　</div>
                    <div id="p">p　</div>
                    <div id="br">br　</div>
                    <div id="h2">h2　</div>
                    <div id="img">img　</div>
                    <a href="setting/img.php" target="_blank">imgファイル名検索</a>
                </div>
                <textarea id="area" name="honbun"></textarea>
                <br>
                <input type="submit" value="ok">
                <input type="button" onclick="history.back()" value="戻る">
            </form>
        </div>
        <div id="write">
            <h3>タイトル</h3>
            <div id="title"></div>
            <h3>サムネイル</h3>
            <div id="sam"></div>
            <h3>本文</h3>
            <div id="box"></div>
        </div>
    </div>
    <script src="setting/main2.js"></script>
</body>

</html>