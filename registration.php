<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Aquarius</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    <script type="text/javascript" src="js/jquery.nickvalid.js"></script>
    <script type="text/javascript" src="js/jquery.emailvalid.js"></script>
    <script type="text/javascript" src="js/jquery.passwordvalid.js"></script>
    <script type="text/javascript" src="js/jquery.typing-0.2.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" type="text/css" href="css/common.css">
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
                            echo '<div class="controls-row">
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
            <div class="span8 offset2 body-container pagination-centered">
                <div class="span8 pagination-centered offset2">
                    <h3>Регистрация пользователя</h3>
            <?php
            if (!(@session_start()))
                echo 'Error with session working';
            if (!@isset($_SESSION['autorised'])) {
                echo '<form class="regform form-horizontal" id="regform" method="POST" action="reguser.php">
            <div class="control-group">
			<label for="login_name" class="control-label">Имя пользователя: </label>
			<div class="controls">
			<input type="text" accesskey="1" lang="ru" name="login_name" id="login_name" class="login_name" tabindex="1" onkeyup="valid()">
			</div>
			</div>
			<div id="uname_err" class="error">Ник не должен быть длиннее 25 символов</div><br>
			<div class="control-group">
			<label for="login_email" class="control-label">E-mail:</label>
			<div class="controls">
			<input type="text" lang="ru" name="login_email" id="login_email" class="login_email" tabindex="2">
			</div>
			</div>
			<div id="uemail_err" class="error">Введите e-mail правильно, например \'asm@mail.ru\'</div>
			<br>
			<div class="control-group">
			<label for="login_pw" class="control-label">Пароль: </label>
			<div class="controls">
			<input type="password" lang="ru" name="login_pw" id="login_pw" class="login_pw" tabindex="3">
			</div>
			</div>
			<div id="upw_err" class="error">Пароль должен содержать не менее 6 символов. В том числе хотя бы одну букву и цифры (или наоборот)</div>
			<div class="control-group">
			<label for="login_cpw" class="control-label">Подтверждение пароля:</label>
			<div class="controls">
			<input type="password" lang="ru" name="login_cpw" id="login_cpw" class="login_cpw" tabindex="4">
			</div>
			</div>
			<div id="cpw_err" class="error">Пароль и его подтверждение не совпадают</div>
			<br>
			<input type="submit" tabindex="5" value="Регистрация" name="reg_btn" id="reg_btn" class="reg_btn">
		</form>

		<script type="text/javascript">
		<!--
	    $(document).ready(function() {
	        nickok = false;
            $(this).validate();
	    });
	    //-->
		</script>';
            } else {
                echo '<div class="postreg">Вы уже зарегистрированны и авторизованны!</div>';
            }
            ?>
                </div>
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