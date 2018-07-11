<?
    include_once('app.php');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>short link</title>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css"/>
</head>
<body>
    <form class="form" action="/" method="POST">
        <div class="logo-text">
            <h1>Short Link Service</h1>
        </div>
        <span class="form__title">Введите адрес</span>
        <input class="form__item url" type="text" name="url" placeholder="Enter url">
        <input class="form__item button" type="submit" name="submit" value="get short URL">
        <div class="answer">
        </div>
    </form>
    <script src="ajax.js"></script>
</body>
</html>