<!DOCTYPE html>
<html lang="ja">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>cmsログイン</title>
      <link rel="stylesheet" href="../style.css">
   </head>
   <body>
      <h2>ログイン情報を入力してください<br></h2>
      <form action="login_check.php" method="post">
         <p>管理者名</p>
         <input type="text" name="name">
         <br>
         <p>パスワード</p>
         <input type="password" name="pass">
         <br>
         <p>パスワード再入力</p>
         <input type="password2" name="pass2">
         <br><br>
         <input type="submit" value="OK">
      </form>
   </body>
</html>
