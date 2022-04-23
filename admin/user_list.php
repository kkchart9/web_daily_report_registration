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

    // ユーザーデータを取得
    $sql = "SELECT * FROM user";
    $stmt = $pdo->query($sql);
    $user_list = $stmt->fetchAll();
    
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
        <link rel="stylesheet" href="../css/style.css">
        <title>社員一覧 | WoRKS</title>
    </head>
    <body class="text-center bg-info">
        <div>
            <img src="../img/logo.svg" alt="" width="120" height="120" class="mb-4">
        </div>

        <form class="border rounded bg-white form-user-list" action="index.php">
            <h1 class="h3 my-3">社員一覧</h1>
            <a href="/web日報登録/admin/register.php"><button type="button" class="btn btn-secondary rounded-pill px-5" style="margin-bottom: 24px;">社員を追加する</button></a>

            <table class="table table-bordered">
                <thead>
                    <tr class="bg-light">
                        <th scope="col">社員番号</th>
                        <th scope="col">社員名</th>
                        <th scope="col">権限</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($user_list as $user): ?>
                        <tr>
                            <td scope="row"><?= $user['user_no'] ?></td>
                            <td><a href="/web日報登録/admin/user_result.php?id=<?= $user['id'] ?>"><?= $user['name'] ?></a></td>
                            <td><?php if ($user['auth_type'] == 1) echo '管理者' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="/web日報登録/logout.php"><button type="button" class="btn btn-primary text-white rounded-pill px-5 mx-4">ログアウト</button></a>
        </form>
        



        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>