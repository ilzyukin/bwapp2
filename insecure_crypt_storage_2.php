<?php

/*

bWAPP, or a buggy web application, is a free and open source deliberately insecure web application.
It helps security enthusiasts, developers and students to discover and to prevent web vulnerabilities.
bWAPP covers all major known web vulnerabilities, including all risks from the OWASP Top 10 project!
It is for security-testing and educational purposes only.

Enjoy!

Malik Mesellem
Twitter: @MME_IT

bWAPP is licensed under a Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International License (http://creativecommons.org/licenses/by-nc-nd/4.0/). Copyright © 2014 MME BVBA. All rights reserved.

*/

include("security.php");
include("security_level_check.php");
include("functions_external.php");
include("selections.php");

$temp = setlocale(LC_ALL, "ru_RU.utf8");
$temp =bindtextdomain("messages", "./var/www/html/bWAPP/lang/ru_RU/LC_MESSAGES");

$temp3 = _("bWAPP - Sensitive Data Exposure"); // echo($temp3) BWAPP - Незащищенность критичных данных
$temp4 = _("an extremely buggy web app !");
$temp5 = _("New user");// echo($temp5) Новый пользователь
$temp6 = _("Information");// echo($temp6) Информация
$temp7 = _("Training");//  echo($temp7) Тренировочные задания
$temp8 = _("Blog");///  echo($temp8) Блог
$temp9 =  _("Enter your credentials");//echo($temp9) Введите ваши данные
$temp10 =  _("password");// echo($temp10)        Пароль
$temp11 = _("Check security_level");//echo($temp11)        Установите уровень безопасности:
$temp12 =  _("low");//echo($temp12)   низкий
$temp13 =  _("middle");//echo($temp12)   средний
$temp14 =  _("high");// echo($temp14)   высокий
$temp15 =  _("Bugs");// echo($temp15)   баги
$temp16 =  _("Change Password");// echo($temp16)   Изменить пароль
$temp17 =  _("Create User");// echo($temp17)   Создать пользователя
$temp18 =  _("Set Security Level");// echo($temp18)   Установить уровень безопасности
$temp19 =  _("Reset");// echo($temp19)   Сбросить
$temp20 =  _("Credits");// echo($temp20)   Контактные данные
$temp21 =  _("Logout");// echo($temp21)   Выйти из аккаунта
$temp22 =  _("Welcome");// echo($temp22)   Добро пожаловать
$temp23 =  _("Broken Auth. - Password Attacks");// echo($temp23)   атаки на пароль
$temp24 =  _("Login:");// echo($temp24)   Логин
$temp25 =  _("Password:");// echo($temp25)   Пароль
$temp26 =  _("Re-enter CAPTCHA:");// echo($temp26)   Повторно введите капчу
$temp27 =  _("Login");// echo($temp27)   Логин
$temp28 =  _("bWAPP is licensed under");// echo($temp28)   Лицензия БИВАП от
$temp29 =  _("2014 MME BVBA / Follow");// echo($temp29)   2014 MME BVBA / Подписывайтесь
$temp30 =  _("on Twitter and ask for our cheat sheet, containing all solutions! / Need an exclusive");// echo($temp30)   
$temp31 =  _("training");// echo($temp31)   Тренировка
$temp32 =  _("Set your security level:");// echo($temp32)   Введите Ваш уровень безопасности
$temp33 =  _("medium");// echo($temp33)   средний
$temp34 =  _("Set");// echo($temp34)   Установить
$temp35 =  _("Current:");// echo($temp35)   Текущий
$temp36 =  _("Enter your credentials.");// echo($temp36)   Введите Ваши данные
$temp37 =  _("Text Files (Accounts)");// echo($temp37)   Текстовые файлы (Учетные записи)
$temp38 =  _("Insert a new account into a text file:");// echo($temp38)   Вставьте новую учетную запись в текстовый файл:
$temp39 =  _("Username:"); //Имя пользователя:
$temp40 =  _("Password:"); //Пароль:
$temp41 =  _("Please enter both fields..."); //Пожалуйста заполните оба поля...
$temp42 =  _("Download"); //Скачать
$temp43 =  _("the file."); //файл.
$temp44 =  _("Delete"); //Удалить


$field_empty = false;
$record_added = false;

if(isset($_REQUEST["insert"]))
{

    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];

    if($username == "" or $password == "")
    {

        $field_empty = true;

    }

    else
    {

        switch($_COOKIE["security_level"])
        {

            case "0" :

                $line = "'" . $username . "', '" . $password . "'" . "\r\n";

                break;

            case "1" :

                $username = xss_check_3($username);
                $password = sha1($password, false);

                $line = "'" . $username . "', '" . $password . "'" . "\r\n";

                break;

            case "2" :

                $username = xss_check_3($username);
                $salt = md5(uniqid());
                // $password = sha1($salt . $password, false);
                //$password = hash("sha512", $salt . $password, false);
                $password = hash("sha256", $salt . $password, false);

                $line = "'" . $username . "', '" . $password . "', 'salt:" . $salt . "'" . "\r\n";

                break;

            default :

                $line = "'" . $username . "', '" . $password . "'" . "\r\n";

                break;

        }

        // Writes a new line to the file (append)
        $fp = fopen("passwords/accounts.txt", "a");
        fputs($fp, $line, 200);
        fclose($fp);

        $record_added = true;

    }

}

if(isset($_REQUEST["delete"]))
{

    if(file_exists("passwords/accounts.txt"))
    {

        // Deletes the file
        $file = "passwords/accounts.txt";

        unlink($file);

    }

}

?>
<!DOCTYPE html>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<!--<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Architects+Daughter">-->
<link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css" media="screen" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />

<!--<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>-->
<script src="js/html5.js"></script>

<title><?php echo($temp3) ?></title>

</head>

<body>

<header>

<h1>bWAPP</h1>

<h2><?php echo($temp4) ?></h2>

</header>

<div id="menu">

    <table>

        <tr>

            <td><a href="portal.php"><?php echo($temp15) ?></a></td>
            <td><a href="password_change.php"><?php echo($temp16) ?></a></td>
            <td><a href="user_extra.php"><?php echo($temp17) ?></a></td>
            <td><a href="security_level_set.php"><?php echo($temp18) ?></a></td>
            <td><a href="reset.php" onclick="return confirm('All settings will be cleared. Are you sure?');"><?php echo($temp19) ?></a></td>
            <td><a href="credits.php"><?php echo($temp20) ?></a></td>
            <td><a href="http://itsecgames.blogspot.com" target="_blank"><?php echo($temp8) ?></a></td>
            <td><a href="logout.php" onclick="return confirm('Are you sure you want to leave?');"><?php echo($temp21) ?></a></td>
            <td><font color="red"><?php echo($temp22) ?> <?php if(isset($_SESSION["login"])){echo ucwords($_SESSION["login"]);}?></font></td>

        </tr>

    </table>

</div>

<div id="main">

    <h1><?php echo($temp37) ?></h1>

    <p><?php echo($temp38) ?></p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

    <p><label for="username"><?php echo($temp39) ?></label><br />
    <input type="text" id="username" name="username"></p>

    <p><label for="password"><?php echo($temp40) ?></label><br />
    <input type="password" id="password" name="password"></p>

    <input type="submit" name="insert" value="Insert"/>

    </form>

    <br />
    <?php

    if($record_added == true)
    {

        // echo "The account was added: " . $line . "<br /><br />";
        echo "<font color=\"green\">The account was added!</font><br /><br />";

    }

    else

        if($field_empty == true)   
        {

    ?>
    <font color="red"><?php echo($temp41) ?></font><br /><br />
    <?php

    }

    else
    {

        echo "<br /><br />";

    }

    if(file_exists("passwords/accounts.txt"))
    {

    ?>

    <a href="passwords/accounts.txt" target="_blank"><?php echo($temp42) ?></a> <?php echo($temp43) ?><br />

    <a href="<?php echo($_SERVER["SCRIPT_NAME"]);?>?delete"><?php echo($temp44) ?></a> <?php echo($temp43) ?>

    <?php

    }

    else
    {

        echo "<br />";

    }

    ?>


</div>

<div id="side">

    <a href="http://twitter.com/MME_IT" target="blank_" class="button"><img src="./images/twitter.png"></a>
    <a href="http://be.linkedin.com/in/malikmesellem" target="blank_" class="button"><img src="./images/linkedin.png"></a>
    <a href="http://www.facebook.com/pages/MME-IT-Audits-Security/104153019664877" target="blank_" class="button"><img src="./images/facebook.png"></a>
    <a href="http://itsecgames.blogspot.com" target="blank_" class="button"><img src="./images/blogger.png"></a>

</div>

<div id="disclaimer">

    <p><?php echo($temp28) ?> <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank"><img style="vertical-align:middle" src="./images/cc.png"></a> &copy; <?php echo($temp29) ?> <a href="http://twitter.com/MME_IT" target="_blank">@MME_IT</a> <?php echo($temp30) ?> <a href="http://www.mmebvba.com" target="_blank"><?php echo($temp31) ?></a>?</p>

</div>

<div id="bee">

    <img src="./images/bee_1.png">

</div>

<div id="security_level">

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <label><?php echo($temp32) ?></label><br />

        <select name="security_level">

            <option value="0"><?php echo($temp12) ?></option>
            <option value="1"><?php echo($temp33) ?></option>
            <option value="2"><?php echo($temp14) ?></option>

        </select>

        <button type="submit" name="form_security_level" value="submit"><?php echo($temp34) ?></button>
        <font size="4"><?php echo($temp35) ?> <b><?php echo $security_level?></b></font>

    </form>

</div>

<?php require_once('_select_inc.php'); ?>

</body>

</html>