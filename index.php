<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Aquarius</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="container">
<div class="span12 col-md-offset-0 maincontainer">
    <div class="container block">
        <div class="row-fluid">
            <div class="span4 offset7 login-form-container">
                <form class="form-inline login-form" name="logform" method="POST" action="login.php">
                <?php
                if (@session_start()) {
                if (!isset($_SESSION['autorised'])) {
                echo '

                    <div class="controls-row">
                        <input type="text" name="loginp" class="input-small" placeholder="Логин">
                        <input type="password" name="passinp" class="input-small" placeholder="Пароль">


                        <input type="submit" class="btn btn-primary logbtn" tabindex="8" name="logbtn" value="Вход">
                    </div>
                    <div class="helpreg"><a href="registration.php">Регистрация</a>
                    </div>';
                } else {
                    echo '<div class="login_nick">' . $_SESSION['user_name'] . ' ('.$_SESSION['user_full_name'].')</div> <input type="submit" value="Выход" class="logbtn">';
                    $_SESSION['action'] = 'logout';
                    }
                 }
                else {
                    echo 'Error with start sessions';
                }

                    ?>
                </form>
            </div>
        </div>

        <div class="row img-container">
            <div class="span6 offset3">
                <a href="/"><img src="img/logo.gif" id="logo"></a>
            </div>
        </div>
    </div>
    <div class="container block">
        <div class="navbar navbar-static-top nav-container">
            <div class="navbar-inner">
                <a class="brand" href="#">Меню</a>
                <ul class="nav">

                    <li class="active"><a href="/">Главная</a></li>
                    <li><a href="/tasks.php">Задачи</a></li>
                    <li><a href="/users.php">Пользователи</a></li>
                    <li><a href="/settings.php">Настройки</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container block">
        <div class="row-fluid">
            <div class="span8 offset2 body-container welcome">
                Добро пожаловать в систему управления задачами Aquarius! Пожалуйста, авторизуйтесь или пройдите регистрацию,
                чтобы приступить к управлению задачами!
            </div>
        </div>
    </div>
    <div class="container block">
        <div class="row-fluid footer-container">
            <small>Bars93 &#0169 All rights reserved!</small>
        </div>
    </div>
</div>
</body>
</html>