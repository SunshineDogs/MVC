<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<h2 align="center">Авторизация</h2>
<div style="text-align: center;">
    <h1>Вход</h1>
    <form action="/admin" method="post" enctype="multipart/form-data">
        <label>Login <input type="text" name="login" required></label>
        <br><br>
        <label>Пароль <input type="password" name="password" required></label>
        <br><br>
        <input type="submit" class="btn btn-primary d-block mx-auto" value="Войти">
    </form>
</div>
