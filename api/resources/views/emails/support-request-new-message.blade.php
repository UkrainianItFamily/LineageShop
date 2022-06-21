<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>TEST</title>
</head>
<body>
<div>
    <h4>Получен ответ на обращение #{{ $supportId }}</h4>
</div>
<div>
    <h4>Логин отправителя</h4>
    {{ $login }}
</div>
<div>
    <h4>Текст ответа</h4>
    {{ $messageText }}
</div>
</body>
</html>
