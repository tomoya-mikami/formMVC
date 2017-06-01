<?php
    session_start();
    header('X-FRAME-OPTIONS: SAMEORIGIN');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>処理の確認</title>
</head>
<body>
    <h1>お客様お問い合わせフォーム</h1>
    <div>
        <?= $_SESSION["result"] ?></br>
    </div>
    <dvi>
        <a href="index.php">topに戻る</a>
    </dvi>
</body>
</html>