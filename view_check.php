<!-- view -->
<?php
    session_start();
    header('X-FRAME-OPTIONS: SAMEORIGIN');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>入力内容の確認</title>
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/return.js"></script>
</head>
<body>
    <h1>お客様お問い合わせフォーム</h1>
    <!-- $_SESSION["name"]で値を受け取る -->
    <div>
        要件 : <?=$_SESSION["subject"];?>
    </div>
    <div>
        名前 : <?=$_SESSION["name"];?>
    </div>
    <div>
        メールアドレス : <?=$_SESSION["adress"];?>
    </div>
    <div>
        電話番号 : <?=$_SESSION["tel"];?>
    </div>
    <div>
        お問い合わせ内容<br>
        <textarea name="content" cols="40" rows="5" readonly><?= $_SESSION["content"]; ?></textarea>
    </div>
    <div>
        以上でよろしいでしょうか？
    </div>
    <!--隠しform-->
    <form id='form' action="index.php?action=send" method="POST">
        <input type="hidden" name="token" value=<?= $_SESSION['token'] ?> readonly>
        <input type="hidden" name="subject" value= <?= $_SESSION["subject"]; ?> readonly>
        <input type="hidden" name="name" value= <?= $_SESSION["name"]; ?> readonly>
        <input type="hidden" name="adress" value= <?= $_SESSION["adress"]; ?> readonly>
        <input type="hidden" name="tel" value= <?= $_SESSION["tel"]; ?> readonly>
        <input type="hidden" name="content" value= <?= $_SESSION["content"] ?> readonly>
        <div>
            <input type="button" value="送信" id="send">
            <input type="button" value="入力に戻る" id="return" >
        </div>
    </form>
</body>
</html>