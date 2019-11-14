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
include("selections.php");
include("functions_external.php");
include("connect_i.php");

$temp = setlocale(LC_ALL, "ru_RU.utf8");
$temp =bindtextdomain("messages", "./var/www/html/bWAPP/lang/ru_RU/LC_MESSAGES");
//___________________

$temp3 = _("bWAPP - HTML Injection"); // echo($temp3) BWAPP - HTML инъекция
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
$temp37 =  _("HTML Injection - Stored (Blog)");// echo($temp37)  HTML инъекция - Сохраненный (Блог)
$temp38 =  _("Submit");// echo($temp38)  Подтвердить
$temp39 =  _("Add:");// echo($temp39)   Добавить:
$temp40 =  _("Show all:");// echo($temp40)   Показать все:
$temp41 =  _("Delete:");// echo($temp41)   Удалить:
$temp42 =  _("Owner");// echo($temp42)   Владелец
$temp43 =  _("Date");// echo($temp43)   Дата
$temp44 =  _("Entry");// echo($temp44)   Вход

$entry = "";
$owner = "";
$message = "";

function htmli($data)
{

    include("connect_i.php");

    switch($_COOKIE["security_level"])
    {

        case "0" :

            $data = sqli_check_3($link, $data);
            break;

        case "1" :

            $data = sqli_check_3($link, $data);
            // $data = xss_check_4($data);
            break;

        case "2" :

            $data = sqli_check_3($link, $data);
            // $data = xss_check_3($data);
            break;

        default :

            $data = sqli_check_3($link, $data);
            break;

    }

    return $data;

}

if(isset($_POST["entry_add"]))
{

    $entry = htmli($_POST["entry"]);
    $owner = $_SESSION["login"];

    if($entry == "")
    {

        $message =  "<font color=\"red\">Please enter some text...</font>";

    }

    else
    {

        $sql = "INSERT INTO blog (date, entry, owner) VALUES (now(),'" . $entry . "','" . $owner . "')";

        $recordset = $link->query($sql);

        if(!$recordset)
        {

            die("Error: " . $link->error . "<br /><br />");

        }

        // Debugging
        // echo $sql;

        $message = "<font color=\"green\">Your entry was added to our blog!</font>";

    }

}

else
{

    if(isset($_POST["entry_delete"]))
    {

        $sql = "DELETE from blog WHERE owner = '" . $_SESSION["login"] . "'";

        $recordset = $link->query($sql);

        if(!$recordset)
        {

            die("Error: " . $link->error . "<br /><br />");

        }

        // Debugging
        // echo $sql;

        $message = "<font color=\"green\">All your entries were deleted!</font>";

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

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

	<table>

            <tr>

                <td colspan="6"><p><textarea name="entry" id="entry" cols="80" rows="3"></textarea></p></td>

            </tr>

            <tr>

                <td width="79" align="left">

                    <button type="submit" name="blog" value="submit"><?php echo($temp38) ?></button>

                </td>

                <td width="85" align="center">

                    <label for="entry_add"><?php echo($temp39) ?></label>
                    <input type="checkbox" id="entry_add" name="entry_add" value="" checked="on">

                </td>

                <td width="100" align="center">

                    <label for="entry_all"><?php echo($temp40) ?></label>
                    <input type="checkbox" id="entry_all" name="entry_all" value="">

                </td>

                <td width="106" align="center">

                    <label for="entry_delete"><?php echo($temp41) ?></label>
                    <input type="checkbox" id="entry_delete" name="entry_delete" value="">

                </td>

                <td width="7"></td>

                <td align="left"><?php echo $message;?></td>

            </tr>

	</table>

    </form>

    <br />

    <table id="table_yellow">

        <tr height="30" bgcolor="#ffb717" align="center">

            <td width="20">#</td>
            <td width="100"><b><?php echo($temp42) ?></b></td>
            <td width="100"><b><?php echo($temp43) ?></b></td>
            <td width="445"><b><?php echo($temp44) ?></b></td>

        </tr>

<?php

// Selects all the records

$entry_all = isset($_POST["entry_all"]) ? 1 : 0;

if($entry_all == false)
{

	$sql = "SELECT * FROM blog WHERE owner = '" . $_SESSION["login"] . "'";

}

else
{

	$sql = "SELECT * FROM blog";

}

$recordset = $link->query($sql);

if(!$recordset)
{

    // die("Error: " . $link->connect_error . "<br /><br />");

?>
        <tr height="50">

            <td colspan="4" width="665"><?php die("Error: " . $link->error);?></td>
            <!--
            <td></td>
            <td></td>
            <td></td>
            -->

        </tr>

<?php

}

while($row = $recordset->fetch_object())
{

    if($_COOKIE["security_level"] == "1" or $_COOKIE["security_level"] == "2")
    {

?>
        <tr height="40">

            <td align="center"><?php echo $row->id; ?></td>
            <td><?php echo $row->owner; ?></td>
            <td><?php echo $row->date; ?></td>
            <td><?php echo xss_check_3($row->entry); ?></td>

        </tr>

<?php

    }

    else
    {

?>
        <tr height="40">

            <td align="center"><?php echo $row->id; ?></td>
            <td><?php echo $row->owner; ?></td>
            <td><?php echo $row->date; ?></td>
            <td><?php echo $row->entry; ?></td>

        </tr>

<?php

    }

}

$recordset->close();

$link->close();

?>
    </table>

</div>

<div id="side">

    <a href="http://twitter.com/MME_IT" target="blank_" class="button"><img src="./images/twitter.png"></a>
    <a href="http://be.linkedin.com/in/malikmesellem" target="blank_" class="button"><img src="./images/linkedin.png"></a>
    <a href="http://www.facebook.com/pages/MME-IT-Audits-Security/104153019664877" target="blank_" class="button"><img src="./images/facebook.png"></a>
    <a href="http://itsecgames.blogspot.com" target="blank_" class="button"><img src="./images/blogger.png"></a>

</div>

<div id="disclaimer">

    <p><?php echo($temp28) ?><a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank"><img style="vertical-align:middle" src="./images/cc.png"></a> &copy; <?php echo($temp29) ?> <a href="http://twitter.com/MME_IT" target="_blank">@MME_IT</a> <?php echo($temp30) ?> <a href="http://www.mmebvba.com" target="_blank"><?php echo($temp31) ?></a>?</p>

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