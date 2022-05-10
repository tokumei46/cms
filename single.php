<?php require_once("header.php");   ?>
<warapper>
    <main>
        <?php require_once("pankuzu.php"); ?>
        <?php
        try {

            $code = filter_input(INPUT_GET, "n");

            $dsn = "mysql:host=mysql;dbname=cms;charset=utf8";
            $user = "root";
            $password = "root";
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT title, img, category, time, honbun  FROM blog WHERE1";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);

            $title = $rec["title"];
            echo $rec["title"];
            echo "<br>";
            echo "<div class='catetime'>";
            echo $rec["category"];
            echo "<br>";
            echo $rec["time"];
            echo "</div>";
            echo "<br>";
            echo "<img class='bunimg' src='setting/img/" . $rec['img'] . "'>";
            echo "<br>";
            echo $rec["honbun"];

            if (empty($get["cate"]) === true) {
                $sql = "SELECT code, title FROM blog WHERE1";
                $stmt = $dbh->prepare($sql);
                $stmt->execute();
            } else {
                $sql = "SELECT code, title FROM blog WHERE category=?";
                $stmt = $dbh->prepare($sql);
                $data[] = $get["cate"];
                $stmt->execute($data);
            }
            $data = array();
            $title = array();

            while (true) {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if (empty($rec["code"]) === true) {
                    break;
                }
                $box[] = $rec["code"];
                $title[] = $rec["title"];
            }
            $maxim = count($box);
            $max = $maxim - 1;
            $point = array_search($code, $box);
            $mae = $point - 1;
            $ato = $point + 1;

            echo "<div class='pag2'>";
            if($mae < 0) {
                echo "<div class='posi2'></div>";
            } else {
                echo "<div class='posi2'>前の記事:";
                if(empty($get["cate"]) === true) { 
                echo "<a href='single.php?n=".$box[$mae]."'>".strip_tags($title[$mae])."</a></div>";
                } else {
                echo "<a href='single.php?n=".$box[$mae]."&cate=".$get['cate']."'>".strip_tags($title[$mae])."</a></div>";
            }
        }
            echo "</div>";

            echo "<h3>コメントを残す</h3>";
            echo "<div class='comment'>";
            echo  "<form action='comment.php' method='post'>";
            echo  "お名前<br>";
            echo  "<input type='text' name='name'><br>";
            echo  "コメント<br>";
            echo  "<textarea name='com'></textarea><br>";
            echo  "<input type='hidden' name='code' value='".$code."'>";
            echo  "<input type='submit' value='送信'>";
            echo  "</form>";
            echo  "</div>";
            echo  "<br><br>";

            echo  "<h3>コメント一覧</h3>";

            $sql = "SELECT name, honbun, time FROM honcm WHERE id=? ORDER BY code DESC";
            $stmt = $dbh -> prepare($sql);
            $data[] = $code;
            $stmt -> execute($data);
            $data = array();

            $dbh = null;

            $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
            if(empty($rec["name"]) === true) {
                echo "コメントがありません<br>";
            } else {
                echo "<div class='comment2'>";
                echo $rec["name"]. "<br>";
                echo $rec["time"]. "<br>";
                echo $rec["honbun"]. "<br>";
                echo "</div>";
                while(true) {
                    $rec = $stmt-> fetch(PDO::FETCH_ASSOC);
                    if(empty($rec["name"]) === true) {
                        break;
                    } 
                    echo "div class='comment2'>";
                    echo $rec["name"]. "<br>";
                    echo $rec["time"]. "<br>";
                    echo $rec["honbun"]. "<br>";
                    echo "</div>";
                }
            }

        } catch (Exception $e) {
            echo ("エラー発生<br>" . $e->getMessage());
            echo "<a href='set_top.php'>cmsトップへ</a>";

        }
        ?>

        <?php require_once("nav.php"); ?>

    </main>
    <?php require_once("side.php"); ?>
    <?php require_once("footer.php"); ?>