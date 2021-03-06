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
include("admin/settings.php");

$temp = setlocale(LC_ALL, "ru_RU.utf8");
$temp = bindtextdomain("messages", "./var/www/html/bWAPP/lang/ru_RU/LC_MESSAGES");

$temp3 = _("bWAPP - LDAP Connection Settings"); // echo($temp3) BWAPP - Настройки подключения LDAP
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
$temp37 =  _("LDAP Connection Settings");// echo($temp37)   
$temp38 =  _("Configure your LDAP connection settings (requires the PHP LDAP extension)."); //Настройте параметры подключения LDAP (требуется расширение PHP LDAP).
$temp39 =  _("Login:");
$temp40 =  _("Password:"); //
$temp41 =  _("Server:"); //Сервер:
$temp42 =  _("The credentials will be sent in clear text!");
$temp43 =  _("Base DN:");

$bugs = file("bugs.txt");

if(isset($_POST["form_bug"]) && isset($_POST["bug"]))
{

            $key = $_POST["bug"];
            $bug = explode(",", trim($bugs[$key]));

            // Debugging
            // print_r($bug);

            header("Location: " . $bug[1]);

            exit;

}

if(isset($_POST["form_security_level"]) && isset($_POST["security_level"]))
{

    $security_level_cookie = $_POST["security_level"];

    switch($security_level_cookie)
    {

        case "0" :

            $security_level_cookie = "0";
            break;

        case "1" :

            $security_level_cookie = "1";
            break;

        case "2" :

            $security_level_cookie = "2";
            break;

        default :

            $security_level_cookie = "0";
            break;

    }

    if($evil_bee == 1)
    {

        setcookie("security_level", "666", time()+60*60*24*365, "/", "", false, false);

    }

    else
    {

        setcookie("security_level", $security_level_cookie, time()+60*60*24*365, "/", "", false, false);

    }

    header("Location: ldap_connect.php");

    exit;

}

if(isset($_COOKIE["security_level"]))
{

    switch($_COOKIE["security_level"])
    {

        case "0" :

            $security_level = "low";
            break;

        case "1" :

            $security_level = "medium";
            break;

        case "2" :

            $security_level = "high";
            break;

        case "666" :

            $security_level = "666";
            break;

        default :

            $security_level = "low";
            break;

    }

}

else
{

    $security_level = "not set";

}

$message = "";
$login = "bee@bwapp.local";
$password = "";
$server = "";
$dn = "DC=bwapp,DC=local";

if(isset($_REQUEST["clear"]))
{

    // Clears the LDAP settings
    $_SESSION["ldap"] = array();

    $message = "<font color=\"green\">Settings cleared successfully!</font>";

}

if(isset($_REQUEST["set"]) && isset($_REQUEST["login"]) && isset($_REQUEST["password"]) && isset($_REQUEST["server"]) && isset($_REQUEST["dn"]))
{

    // LDAP connection settings
    $login = $_REQUEST["login"];
    $password = $_REQUEST["password"];
    $server = $_REQUEST["server"];
    $dn = $_REQUEST["dn"];

    if($login == "" || $password == "" || $server == "" || $dn == "")
    {

        $message = "<font color=\"red\">Please enter all fields!</font>";

    }

    else
    {

        // Connects and binds to the LDAP server
        $ds = ldap_connect($server);
        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);// Sets the LDAP protocol used by the AD service
        ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
        $r = @ldap_bind($ds, $login, $password);
        // $r = @ldap_bind($ds, $domain . "\\" . $login, $password);// Pre-Windows 2000 username
        // $r = @ldap_bind($ds);// Anonymous login. Needs some adjustments in AD!

        // Debugging
        // Prints TRUE if the credentials are valid
        // print_r($r);

        if(!$r)
        {

            $message = "<font color=\"red\">Invalid credentials or invalid server!</font>";

        }

        else
        {

            $filter = "(cn=*)";

            // Checks if the base DN has a valid syntax
            if(!($search=@ldap_search($ds, $dn, $filter)))
            {

               $message = "<font color=\"red\">Base DN invalid syntax!</font>";

            }

            else
            {

                // Checks if the base DN is valid
                $number_returned = ldap_count_entries($ds,$search);

                if($number_returned == 0)
                {

                    $message = "<font color=\"red\">Base DN invalid!</font>";

                }

                // If the connection settings are valid
                else
                {

                    $_SESSION["ldap"]["login"] = $login;
                    $_SESSION["ldap"]["password"] = $password;
                    $_SESSION["ldap"]["server"] = $server;
                    $_SESSION["ldap"]["dn"] = $dn;

                    // $message = "<font color=\"green\">Valid connection settings!</font>";

                    header("Location: ldapi.php");

                    exit;

                }

            }

        }

        ldap_close($ds);

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

<script language="javascript">

function clear()
{

    location.href="<?php echo($_SERVER["SCRIPT_NAME"]); ?>?clear=yes";

}

</script>

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

    <p>

    <?php echo($temp38) ?><br />
    <?php echo($temp42) ?>

    </p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <p><label for="login"><?php echo($temp39) ?></label><br />
        <input type="text" id="login" name="login" value="<?php echo isset($_SESSION["ldap"]["login"])?$_SESSION["ldap"]["login"]:$login;?>" size="20" autocomplete="off"></p>

        <p><label for="password"><?php echo($temp40) ?></label><br />
        <input type="password" id="password" name="password" value="<?php echo isset($_SESSION["ldap"]["password"])?"":$password;?>" size="20" autocomplete="off"></p>

        <p><label for="server"><?php echo($temp41) ?></label><br />
        <input type="text" id="server" name="server" value="<?php echo isset($_SESSION["ldap"]["server"])?$_SESSION["ldap"]["server"]:$server;?>" size="20"></p>

        <p><label for="dn"><?php echo($temp43) ?></label><br />
        <input type="text" id="dn" name="dn" value="<?php echo isset($_SESSION["ldap"]["dn"])?$_SESSION["ldap"]["dn"]:$dn;?>" size="20"></p>

        <button type="submit" name="set" value="submit" style="height:30px;width:60px"><?php echo($temp34) ?></button>

        <input type="reset" value="Reset" onclick="javascript:clear()" style="height:30px;width:60px">&nbsp;&nbsp;<?php echo $message;?>

    </form>

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
            <option value="2"><?php echo($temp13) ?></option>

        </select>

        <button type="submit" name="form_security_level" value="submit"><?php echo($temp34) ?></button>
        <font size="4"><?php echo($temp35) ?> <b><?php echo $security_level?></b></font>

    </form>

</div>

<?php require_once('_select_inc.php'); ?>

</body>

</html>