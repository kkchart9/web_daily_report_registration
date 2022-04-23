<?php
require_once(dirname(__FILE__).'/config/config.php');
require_once(dirname(__FILE__).'/functions.php');

try {
    session_start();

    if(isset($_SESSION['USER'])) {
        // ログイン済みの場合はHOME画面へ
        header('Location:/web日報登録/index.php');
        exit;
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // POST処理時

        check_token();
    
        // 1.入力値を取得
        $user_no = $_POST['user_no'];
        $password = $_POST['password'];
    
        // 2.バリデーションチェック
        $err = array();
        if(!$user_no) {
            $err['user_no'] = '社員番号を入力してください。';
        } elseif (!preg_match('/^[0-9]+$/', $user_no)) {
            $err['user_no'] = '社員番号を入力してください。';
        } elseif (mb_strlen($user_no, 'utf-8') > 20) {
            $err['user_no'] = '社員番号が長すぎます。';
        }
    
        if(!$password) {
            $err['password'] = 'パスワードを入力してください。';
        }
    
        if(empty($err)) {
            // 3.データベース接続
            $pdo = connect_db();
    
            // ユーザーデーブルを取得
            $sql = "SELECT * FROM user WHERE user_no = :user_no LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':user_no', $user_no, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch();
    
            // ログインチェック
            if($user && password_verify($password, $user['password'])) {
                // 4.ログイン処理（セッションに保存）
                $_SESSION['USER'] = $user;
    
                // 5.HOME画面へ遷移
                header('Location:/web日報登録/index.php');
                exit;
            } else {
                $err['password'] = '認証に失敗しました。';
            }
            
        }
    
    } else {
        // 画面初回アクセス時
        $user_no = "";
        $password = "";

        set_token();
    }
} catch (Exception $e) {
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
        <link rel="stylesheet" href="css/style.css">
        <title>日報登録 | WoRKS</title>
    </head>
    <body class="text-center bg-light">
        <div>
            <img src="img/logo.svg" alt="" width="120" height="120" class="mb-4">
        </div>

        <form class="border rounded bg-white form-login" method="post">
            <h1 class="h3 my-3">Login</h1>
            <a href="/web日報登録/admin/login.php">管理者画面へ</a>
            <div class="form-group pt-3">
                <input type="text" class="form-control rounded-pill <?php if(isset($err['user_no'])) echo 'is-invalid';?>" 
                name="user_no" placeholder="社員番号" Required>
                <div class="invalid-feedback"><?=$err['user_no']?></div>
            </div>
            <div class="form-group">
                <input type="password" class="form-control rounded-pill <?php if(isset($err['password'])) echo 'is-invalid';?>" 
                name="password" value="<?=$user_no?>" placeholder="パスワード">
                <div class="invalid-feedback"><?=$err['password']?></div>
            </div>
            <button type="submit" class="btn btn-primary text-white rounded-pill px-5 mx-4">ログイン</button>
            <input type="hidden" name="CSRF_TOKEN" value="<?= $_SESSION['CSRF_TOKEN'] ?>">
        </form>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>