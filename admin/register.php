<?php
require_once(dirname(__FILE__).'/../config/config.php');
require_once(dirname(__FILE__).'/../functions.php');

try {
    session_start();

    if(!isset($_SESSION['USER']) || $_SESSION['USER']['auth_type'] != 1) {
        // ログインされていない場合はログイン画面へ
        header('Location:/web日報登録/admin/login.php');
        exit;
    }

    $pdo = connect_db();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // POST処理時

        // 1.入力値を取得
        $user_no = $_POST['user_no'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $auth_type = $_POST['auth_type'];
        if ($auth_type == 'admin_no') {
            $auth_type = 0;
        } elseif ($auth_type == 'admin_yes') {
            $auth_type = 1;
        }
        // var_dump($auth_type);
        // exit;

        // 2.バリデーションチェック
        $err = array();
        if(!$user_no) {
            $err['user_no'] = '社員番号を入力してください。';
        }

        if(!$name) {
            $err['name'] = '名前を入力してください。';
        }

        if(!$password) {
            $err['password'] = 'パスワードを入力してください。';
        }

        // 対象のデータがあるかどうかチェック
        $sql = "SELECT user_no FROM user WHERE user_no = :user_no AND password = :password LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':user_no', (int)$user_no, PDO::PARAM_INT);
        $stmt->bindValue('password', $password, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch();

        if($user) {
            // 対象日のデータがあればUPDATE
            $sql = "UPDATE user SET user_no = :user_no, name = :name, password = :password, auth_type = :auth_type WHERE user_no = :user_no";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':user_no', (int)$user['user_no'], PDO::PARAM_INT);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':password', $password, PDO::PARAM_STR);
            $stmt->bindValue(':auth_type', $auth_type, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            // 対象日のデータが無ければINSERT
            $sql = "INSERT INTO user (user_no, name, password, auth_type) VALUES (:user_no, :name, :password, :auth_type)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':user_no', (int)$user_no, PDO::PARAM_INT);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':password', $password, PDO::PARAM_STR);
            $stmt->bindValue(':auth_type', $auth_type, PDO::PARAM_STR);
            $stmt->execute();
        }
    } 

}catch (Exception $e) {
    // エラー時の処理
    header('Location:/web日報登録/error.php');
    exit;
}



?>
<!doctype html>
<html lang="ja">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Original css -->
        <link rel="stylesheet" href="../css/style.css">
        <title>社員一覧 | WoRKS</title>
    </head>
    <body class="text-center bg-info">
        <div>
            <img src="../img/logo.svg" alt="" width="120" height="120" class="mb-4">
        </div>

        <form class="border rounded bg-white form-user-list register" method="POST">
            <h1 class="h3 my-3">社員追加</h1>
            <a href="/web日報登録/admin/user_list.php"><button type="button" class="btn btn-secondary rounded-pill px-5">社員一覧に戻る</button></a>

            <input type="text" class="form-control" name="user_no" placeholder="社員番号" required>
            <input type="text" class="form-control" name="name" placeholder="名前" maxlength="50" required>
            <input type="password" class="form-control" name="password" placeholder="パスワード" mixlength="4" maxlength="128" required>
            <div class="form-check">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="auth_type" value="admin_no" checked>
                <label class="form-check-label" for="exampleRadios1">
                    管理者権限を付与しない
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="auth_type" value="admin_yes">
                <label class="form-check-label" for="exampleRadios2">
                    管理者権限を付与する
                </label>
            </div>
            </div>
            <button type="submit" class="btn btn-primary">登録する</button>
            
        </form>
        



        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>