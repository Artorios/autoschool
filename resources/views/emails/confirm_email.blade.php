<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm email</title>
</head>
<body>
<div class="h2">You have new message from site autoschool</div>
<div class="separator-big"></div>
<div class="gallery-main order">
    <p><b>Username:</b> {{$data['name']}}</p>
    <p><b>Email:</b> {{$data['email']}}</p>
    <p><b>Ваш пароль для входа:</b> {{$data['password_for_send_user_email']}}</p>
    <a href="{{'185.69.152.26/confirm/student/' . $data['confirmation_code'] }}">Подтвердите почту перейдя по сылке</a>
</div>
</body>
</html>

<style>
    .h2{
        font-size: 40px;
        font-weight: 700;
        margin: 30px 0;
    }
    .separator-big{
        margin-bottom: 30px;
        background-color: #db383c;
        height: 4px;
        width: 85px;
    }
    .order p{
        font-size: 18px;
        line-height: 32px;
    }
    .order span{
        font-weight:bold;
    }
    .order table{
        margin: 20px 0 40px;
        font-size: 18px;
    }
    .order td{
        padding: 0 15px 5px 0;
    }
</style>