<?php
    header('X-FRAME-OPTIONS: SAMEORIGIN');
    session_start();
?>
<!-- view -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>お問い合わせフォーム</title>
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/init.js"></script>
</head>

<body>
    <h1>お客様お問い合わせフォーム</h1>
    <form action="index.php?action=check" method="POST">
    <input type="hidden" name="token" value=<?= $_SESSION['token'] ?> readonly>

        <!-- 要件 -->
        <p> <?php if(isset($_SESSION['error_subject']))echo $_SESSION['error_subject'] ?> </p>
        <p id="subject">
            件名:<select name="subject" required>
                <option label="ご意見" value="opinion"></option>
                <option label="ご感想" value="impression"></option>
                <option label="その他" value="other"></option>
            </select>
        </p>

        <!-- 名前 -->
        <p> <?php if(isset($_SESSION['error_name']))echo $_SESSION['error_name'] ?> </p>
        <p id="name" data-name=<?=empty($_SESSION['name'])?0:$_SESSION['name'];?>>
            名前:<input type="text" name="name" required>
        </p>

        <!-- アドレス -->
        <p> <?php if(isset($_SESSION['error_adress']))echo $_SESSION['error_adress'] ?> </p>
        <p id="adress" data-adress=<?=empty($_SESSION['adress'])?0:$_SESSION['adress']; ?>>
            メールアドレス:<input type="text" name="adress" placeholder="info@example.com" required>
        </p>

        <!-- 電話番号 -->
        <p> <?php if(isset($_SESSION['error_tel']))echo $_SESSION['error_tel'] ?> </p>
        <p id="tel" data-tel=<?=empty($_SESSION['tel'])?0:$_SESSION['tel']; ?>>
            電話番号:<input type="text" name="tel" placeholder="00-00-00" required>
        </p>

        <!-- お問い合わせ内容 -->
        <p> <?php if(isset($_SESSION['error_content']))echo $_SESSION['error_content'] ?> </p>
        <p id="content" data-content=<?=empty($_SESSION['content'])?0:$_SESSION['content']; ?>>
            お問い合わせ内容<br>
            <textarea  name="content" cols="40" rows="5" placeholder="200字以内" required></textarea>
        </p>
        
        <p>
            <input type="submit" value="確認">
        </p>
    </form>
</body>

</html>