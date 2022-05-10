<aside>
    <div class="box2">
        <h2>カテゴリー</h2>
        <?php
        try {
            $dsn = "mysql:host=mysql;dbname=cms;charset=utf8";
            $user = "root";
            $password = "root";
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT name, code FROM o_menu WHERE1";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            while (true) {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if (empty($rec["name"]) === true) {
                    break;
                }
                $o_name[] = $rec["name"];
                $o_code[] = $rec["code"];
            }
            if (isset($o_name) === true) {
                $max = count($o_name);
                echo "<div class='box3'>";
                for ($i = 0; $i < $max; $i++) {
                    $n = $i + 1;
                    echo "<div id='menu$n'>" . $o_name[$i] . "</div>";
                    $code = $o_code[$i];

                    $sql = "SELECT name FROM k_menu WHERE o_code=?";
                    $stmt = $dbh->prepare($sql);
                    $data[] = $code;
                    $stmt->execute($data);

                    echo "<ul class='side_ul'>";

                    while (true) {
                        $rec2 = $stmt->fetch(PDO::FETCH_ASSOC);
                        if (empty($rec2["name"]) === false) {
                            echo "<a href='category.php?cate=" . $rec2['name'] . "'>";
                            echo "<li>" . $rec2['name'] . "</li>";
                            echo "</a>";
                        } else {
                            echo "</ul>";
                            $data = array();
                            break 1;
                        }
                    }
                }
            }
            echo "</div>";
            echo "</div>";

            echo "<div class='box2'>";
            echo "<h2>メニュー</h2>";

            $sql = "SELECT title, code FROM page WHERE1";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            while (true) {
                $rec3 = $stmt->fetch(PDO::FETCH_ASSOC);
                if (empty($rec["title"]) === true) {
                    break;
                }
                $code2[] = $rec3["code"];
                $title2[] = $rec3["title"];
            }

            if (isset($code2) === true) {
                $max2 = count($code2);
                echo "<div class='box3'>";
                for ($i = 0; $i < $max2; $i++) {
                    echo "<a href='page.php?p=" . $code2[$i] . "'>";
                    echo strip_tags($title2[$i]);
                    echo "</a>";
                    echo "<br>";
                }
                echo "</div>";
            }
            echo "</div>";

            $sql = "SELECT * FROM pro WHERE1";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "<h2>管理人</h2>";
            if (isset($rec["name"]) === true) {
                echo "<div class='box'>";
                echo "<h3>" . $rec['name'] . "</h3>";
                echo "<div class='img'>";
                echo "<img src='setting/img/" . $rec['img'] . "'>";
                echo "</div>";
                echo $rec["honbun"];
                echo "</div>";
            }
            echo "<h2>最近の投稿</h2>";

            $sql = "SELECT title, img, category, time, code FROM blog ORDER BY code DESC LIMIT 0, 3";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            while (true) {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if (empty($rec["title"]) === true) {
                    break;
                }
                echo "<div id='blog_card'>";
                echo "<a class='card' href='single.php?n=" . $rec['code'] . "'>";
                echo "<div id='main_img'>";
                echo "<img src='setting/img/" . $rec['img'] . "'>";
                echo "</div>";
                echo "<div id='main_text'>";
                echo "カテゴリ　" . $rec["category"] . "<br>";
                echo "更新日時　" . $rec["time"] . "<br>";
                echo strip_tags($rec["title"]) . "<br>";
                echo "</div>";
                echo "</a>";
                echo "</div>";
            }
            $sql = "SELECT * FROM sp WHERE1";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            echo "<h2>スポンサー</h2>";

            while(true) {
                $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
                if(empty($rec["name"]) === true) {
                    break;
                }
                echo "<div class='box'>";
                echo "<h3>".$rec["name"]."</h3>";
                echo "<div class='img'>";
                echo "<a href='".$rec['url']."'>";
                echo "<img src='setting/img/".$rec['img']."'>";
                echo "</a>";
                echo "</div>";
                echo "</div>";
            }
        } catch (Exception $e) {
            echo ("サーバエラー" . $e->getMessage());
        }
        ?>
    </div>
</aside>
</warapper>