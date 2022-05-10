<?php require_once("header.php"); ?>
<wordwrap>
    <main>
        <?php require_once("pankuzu.php"); ?>
        <?php
        require_once("common/common.php");

        try {

            $name = filter_input(INPUT_POST, 'name');
            $com = filter_input(INPUT_POST, 'com');
            $code = filter_input(INPUT_POST, 'code');
            $title = filter_input(INPUT_POST, 'title');
            $com = str_replace(PHP_EOL, '', $com);

            if (empty($name) === true or empty($com) === true) {
                echo "<br>";
                echo "名前かコメントが空白です。";
                echo "<br><br>";
                echo "<form>";
                echo "<input type='button' onclick='history.back()' value='戻る'>";
                echo "</form>";
            } else {
                $title = strip_tags($title);

                $dsn = "mysql:host=mysql;dbname=cms;charset=utf8";
                $user = "root";
                $password = "root";
                $dsn = new PDO($dsn, $user, $password);
                $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "INSERT INTO karicm(name, title, honbun, id, time) VALUES(?,?,?,?,NOW())";
                $stmt = $dsn -> prepare($sql);
                $data[] = $name;
                $data[] = $title;
                $data[] = $com;
                $data[] = $code;
                $stmt -> execute($data);
                $data = array();
                    
                $dbh = null;
                        
                echo "<br><br>";
                echo "コメントを送信しました。<br>";
                echo "コメントは認証後に反映されます。<br><br>";
                echo "<a href='single.php?n=".$code."'>";
                echo "戻る";
                echo "</a>";
                        
                $bun = "";
                $bun .= $name."様よりコメント\n\n";
                $bun .= $title."　の記事\n\n";
                $bun .= $com."\n\n下記URLよりログインして認証可否して下さい。\n\n";
                $bun .= "http://localhost/cms/setting/set_login.php";
            }
        } catch (Exception $e) {
            echo ("サーバエラー" . $e->getMessage());
        }
        ?>
        <?php require_once("nav.php"); ?>
    </main>
    <?php require_once("side.php"); ?>
    <?php require_once("footer.php"); ?>