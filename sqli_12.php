<?php

/*

bWAPP, or a buggy web application, is a free and open source deliberately insecure web application.
It helps security enthusiasts, developers and students to discover and to prevent web vulnerabilities.
bWAPP covers all major known web vulnerabilities, including all risks from the OWASP Top 10 project!
It is for security-testing and educational purposes only.

Enjoy!

Malik Mesellem
Twitter: @MME_IT

David Bloom
Twitter: @philophobia78

bWAPP is licensed under a Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International License (http://creativecommons.org/licenses/by-nc-nd/4.0/). Copyright © 2014 MME BVBA. All rights reserved.

*/

include("security.php");
include("security_level_check.php");
include("selections.php");
include("functions_external.php");

$temp = setlocale(LC_ALL, "ru_RU.utf8");
$temp =bindtextdomain("messages", "./var/www/html/bWAPP/lang/ru_RU/LC_MESSAGES");



//___________________

$temp3 = _("bWAPP - SQL Injection"); // echo($temp3) bWAPP - SQL инъекция
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
$temp30 =  _("on Twitter and ask for our cheat sheet, containing all solutions! / Need an exclusive ");// echo($temp30)   
$temp31 =  _("training");// echo($temp31)   Тренировка
$temp32 =  _("Set your security level:");// echo($temp32)   Введите Ваш уровень безопасности
$temp33 =  _("medium");// echo($temp33)   средний
$temp34 =  _("Set");// echo($temp34)   Установить
$temp35 =  _("Current:");// echo($temp35)   Текущий
$temp36 =  _("Enter your credentials.");// echo($temp36)   Введите Ваши данные
$temp37 =  _("SQL Injection - Stored (SQLite)");//   
$temp38 =  _("Add an entry to our blog:");//    
$temp39 =  _("Add Entry");//    
$temp40 =  _("Delete Entries");//
$temp41 =  _("Owner");//    
$temp42 =  _("Date");//  
$temp43 =  _("Entry");//
$temp44 =  _("No movies were found!");// 
$temp45 =  _("Link");//
$temp46 =  _("Done!");//
$temp47 =  _("(requires the PHP SQLite module)");//

$entry = "";
$owner = "";
$message = $temp47;

function sqli($data)
{

    switch($_COOKIE["security_level"])
    {

        case "0" :

            $data = no_check($data);
            break;

        case "1" :

            // Not working with PDO
            // $data = sqlite_escape_string($data);
            // Use a prepared statement instead!
            $data = sqli_check_4($data);
            break;

        case "2" :

            // Not working with PDO
            // $data = sqlite_escape_string($data);
            // Use a prepared statement instead!
            $data = sqli_check_4($data);
            break;

        default :

            $data = no_check($data);
            break;

    }

    return $data;

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
            <td><a href="reset.php" onclick="return confirm('Все настройки будут сброшены. Вы уверены?');"><?php echo($temp19) ?></a></td>
            <td><a href="credits.php"><?php echo($temp20) ?></a></td>
            <td><a href="http://itsecgames.blogspot.com" target="_blank"><?php echo($temp8) ?></a></td>
            <td><a href="logout.php" onclick="return confirm('Вы уверены, что хотите выйти?');"><?php echo($temp21) ?></a></td>
            <td><font color="red"><?php echo($temp22) ?> <?php if(isset($_SESSION["login"])){echo ucwords($_SESSION["login"]);}?></font></td>

        </tr>

    </table>

</div>

<div id="main">

    <h1><?php echo($temp37) ?></h1>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <p><label for="entry"><?php echo($temp38) ?></label><br />
        <textarea name="entry" id="entry" cols="80" rows="3"></textarea></p>

        <button type="submit" name="entry_add" value="add"><?php echo($temp39) ?></button>
        <button type="submit" name="entry_delete" value="delete"><?php echo($temp40) ?></button>

        <?php

        if(isset($_POST["entry_add"]))
        {

            $entry = sqli($_POST["entry"]);
            $owner = $_SESSION["login"];

            if($entry == "")
            {

                $message =  "<font color=\"red\">Пожалуйста, введите текст...</font>";

            }

            else
            {

                $db = new PDO("sqlite:".$db_sqlite);

                $sql = "SELECT max(id) as id FROM blog;";

                $recordset = $db->query($sql);

		$row = $recordset->fetch();

		$id = $row["id"];

                $sql = "INSERT INTO blog (id, date, entry, owner) VALUES (" . ++$id . ",'" . date('Y-m-d', time()) . "','" . $entry . "','" . $owner . "');";

		$db->exec($sql);

                $message = "<font color=\"green\">Запись была добавлена в наш блог!</font>";

            }

        }

	elseif(isset($_POST["entry_delete"]))
	{

		$db = new PDO("sqlite:".$db_sqlite);

                $sql = "DELETE FROM blog;";

                $db->exec($sql);

		$message = "<font color=\"green\">Ваши записи были удалены!</font>";
   
	}

        echo "&nbsp;&nbsp;" . $message;

        ?>

    </form>

    <br />

    <table id="table_yellow">

        <tr height="30" bgcolor="#ffb717" align="center">

            <td width="20">#</td>
            <td width="100"><b><?php echo($temp41) ?></b></td>
            <td width="100"><b><?php echo($temp42) ?></b></td>
            <td width="445"><b><?php echo($temp43) ?></b></td>

        </tr>

<?php

if(!isset($db))
{

    $db = new PDO("sqlite:".$db_sqlite);
 
}

// Selects all the records
$sql = "SELECT * FROM blog";

$recordset = $db->query($sql);

if(!$recordset)
{

    // die("Error: " . $link->connect_error . "<br /><br />");

?>
        <tr height="50">

            <td colspan="4" width="665"><?php die("Ошибка: " . $db->errorCode()); ?></td>

        </tr>

<?php

}

foreach($recordset as $row)
{

    if($_COOKIE["security_level"] == "2")
    {

?>
        <tr height="40">

            <td align="center"><?php echo $row["id"]; ?></td>
            <td><?php echo $row["owner"]; ?></td>
            <td><?php echo $row["date"]; ?></td>
            <td><?php echo xss_check_3($row["entry"]); ?></td>

        </tr>

<?php

    }

    else

        if($_COOKIE["security_level"] == "1")
        {

?>
        <tr height="40">

            <td align="center"><?php echo $row["id"]; ?></td>
            <td><?php echo $row["owner"]; ?></td>
            <td><?php echo $row["date"]; ?></td>
            <td><?php echo xss_check_4($row["entry"]); ?></td>

        </tr>

<?php

        }

        else
        {

?>
        <tr height="40">

            <td align="center"><?php echo $row["id"]; ?></td>
            <td><?php echo $row["owner"]; ?></td>
            <td><?php echo $row["date"]; ?></td>
            <td><?php echo $row["entry"]; ?></td>

        </tr>

<?php

        }

}

$db = null;

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