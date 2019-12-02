<?php
$temp = setlocale(LC_ALL, "ru_RU.utf8");
$temp =bindtextdomain("messages", "./var/www/html/bWAPP/lang/ru_RU/LC_MESSAGES");
$reuslt3 = textdomain("messages");

//___________________
$temp3 = _("bWAPP - XSS");

$temp4 = _("an extremely buggy web app !");// echo($temp4) Логин
$temp6 = _("Bugs");// echo($temp5) Новый пользователь
$temp5 = _("Change Password");// echo($temp6) Информация
$temp7 = _("Create User");//  echo($temp7) Тренировочные задания
$temp8 = _("Set Security Level");///  echo($temp8) Блог
$temp9 =  _("Credits");//echo($temp9) Введите ваши данные
$temp10 =  _("Blog");// echo($temp10)        Пароль
$temp11 = _("Logout");//echo($temp11)        Установите уровень безопасности:
$temp12 =  _("Broken Auth. - Insecure Login Forms");//echo($temp12)   низкий
$temp13 =  _("REnter the correct passphrase to unlock the secret.");//echo($temp12)   средний
$temp14 =  _("Reset");// echo($temp14)   высокий
$temp15 =  _("brucebanner");//echo($temp12)   низкий
$temp16 =  _("Passphrase");//echo($temp12)   средний
$temp17 =  _("bWAPP is licensed under");// echo($temp14)   высокий
$temp18 =  _("2014 MME BVBA / Follow");//echo($temp12)   средний
$temp19 =  _("@MME_IT");//echo($temp12)   средний
$temp20=  _("on Twitter and ask for our cheat sheet, containing all solutions! / Need an exclusive");// echo($temp14)   высокий
$temp21 =  _("training");//echo($temp12)   средний
$temp22 =  _("Set your security level:");//echo($temp12)   средний
$temp23 =  _("low");//echo($temp12)   средний
$temp24 =  _("medium");//echo($temp12)   средний
$temp25 =  _("high");//echo($temp12)   средний
$temp26 =  _("Set");//echo($temp12)   средний
$temp27 =  _("Current:");//echo($temp12)   средний


$temp28 =  _("bWAPP - Portal");//echo($temp12)   средний
$temp29 =  _("bWAPP");//echo($temp12)   средний
$temp30 =  _("XSS - Stored (User-Agent)");//echo($temp12)   средний
$temp31 =  _("Your IP address and User-Agent string have been logged into the database!");//echo($temp12)   средний
$temp32 =  _("download");//echo($temp12)   средний
$temp33 =  _("log file)");//echo($temp12)   средний
$temp34 =  _("An overview of our latest visitors:");//echo($temp12)   средний
$temp35 =  _("Date");//echo($temp12)   средний
$temp36 =  _("IP Address");//echo($temp12)   средний
$temp37 =  _("User-Agent");//echo($temp12)   средний
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

function xss($data)
{

    switch($_COOKIE["security_level"])
    {

        case "0" :

            $data = no_check($data);
            break;

        case "1" :

            $data = xss_check_4($data);
            break;

        case "2" :

            $data = xss_check_3($data);
            break;

        default :

            $data = no_check($data);
            break;

    }

    return $data;

}

$ip_address = $_SERVER["REMOTE_ADDR"];
$user_agent = $_SERVER["HTTP_USER_AGENT"];

// Writes the entry into the database
$sql = "INSERT INTO visitors (date, user_agent, ip_address) VALUES (now(), '" . xss(sqli_check_3($link, $user_agent)) . "', '" . $ip_address . "')";

$recordset = $link->query($sql);

if(!$recordset)
{

    die("Error: " . $link->error);

}

// Writes the entry into a text file
$line = "'" . date("y/m/d G.i:s", time()) . "', '" . $ip_address . "', '" . xss($user_agent) . "'" . "\r\n";

$fp = fopen("logs/visitors.txt", "a");
fputs($fp, $line, 200);
fclose($fp);

// Selects all the records
$sql = "SELECT * FROM visitors ORDER by id DESC LIMIT 3";

$recordset = $link->query($sql);

if(!$recordset)
{

    die("Ошибка: " . $link->error);

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

<h1><?php echo($temp29) ?></h1>

<h2><?php echo($temp4) ?></h2>

</header>


<div id="menu">

     <table>

        <tr>

            <td><a href="portal.php"><?php echo("Portal"); ?></a></td>
            <td><a href="password_change.php"><?php echo($temp5) ?></a></td>
            <td><a href="user_extra.php"><?php echo($temp7) ?></a></td>
            <td><a href="security_level_set.php"><?php echo($temp8) ?></a></td>
            <td><a href="reset.php" onclick="return confirm('All settings will be cleared. Are you sure?');"><?php echo($temp14) ?></a></td>
            <td><a href="credits.php"><?php echo($temp9) ?></a></td>
            <td><a href="http://itsecgames.blogspot.com" target="_blank"><?php echo($temp10); ?></a></td>
            <td><a href="logout.php" onclick="return confirm('Are you sure you want to leave?');"><?php echo($temp11); ?></a></td>
            <td><font color="red"><?php echo($temp12); ?> <?php if(isset($_SESSION["login"])){echo ucwords($_SESSION["login"]);}?></font></td>

        </tr>

    </table>

</div>

<div id="main">

    <h1><?php echo($temp30) ?></h1>

    <p><?php echo($temp31) ?><font size="2">(<a href="logs/visitors.txt" target="_blank"><?php echo($temp32) ?></a> <?php echo($temp33) ?></font></p>

    <p><?php echo($temp34) ?></p>

    <table id="table_yellow">

        <tr height="30" bgcolor="#ffb717" align="center">

            <td width="100"><b><?php echo($temp35) ?></b></td>
            <td width="100"><b><?php echo($temp36) ?></b></td>
            <td width="465"><b><?php echo($temp37) ?></b></td>

        </tr>

<?php

while($row = $recordset->fetch_object())
{

?>
        <tr height="40">

            <td align="center"><?php echo $row->date; ?></td>
            <td align="center"><?php echo $row->ip_address; ?></td>
            <td><?php echo $row->user_agent; ?></td>

        </tr>

<?php

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

    <p><?php echo($temp18) ?> <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank"><img style="vertical-align:middle" src="./images/cc.png"></a> &copy; <?php echo($temp19) ?> <a href="http://twitter.com/MME_IT" target="_blank"><?php echo($temp20) ?></a> <?php echo($temp20) ?><a href="http://www.mmebvba.com" target="_blank"><?php echo($temp21) ?></a>?</p>

</div>

<div id="bee">

    <img src="./images/bee_1.png">

</div>

<div id="security_level">

   <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <label><?php echo($temp22) ?></label><br />

        <select name="security_level">

            <option value="0"><?php echo($temp23) ?></option>
            <option value="1"><?php echo($temp24) ?></option>
            <option value="2"><?php echo($temp25) ?></option>

        </select>

        <button type="submit" name="form_security_level" value="submit"><?php echo($temp26) ?></button>
        <font size="4"><?php echo($temp27) ?>: <b><?php echo $security_level?></b></font>

    </form>

</div>

<?php require_once('_select_inc.php'); ?>

</body>

</html>