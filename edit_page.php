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
    <div id="edit">
        <div id="box2">
            <form action="setting_upload.php" method="post" enctype="multipart/form-data">
                <h3>イメージファイルアップロード</h3>
                <input type="file" name="image_data[]" multiple="multiple">
                <input type="submit" value="アップロード">
            </form>
            <form action="page_check.php" method="post" enctype="multipart/form-data">
                <br>
                <h3>タイトル</h3>
                <br>
                <textarea name="title" id="title1"><h1></h1></textarea>
                <br>
                <h3>サムネイル</h3>
                <input type="text" id="gazou" name="img">
                <input type="button" id="bt" value="OK">
                <br>
                <input type="radio" name="com" value="nasi">お問い合わせフォーム欄なし
                <input type="radio" name="com" value="ari">お問い合わせフォーム欄あり
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
                <input type="submit" value="OK">
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