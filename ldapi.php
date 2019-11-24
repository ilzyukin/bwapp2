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

$temp3 = _("bWAPP - Information Disclosure"); // echo($temp3) BWAPP - Раскрытие информации
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
$temp36 =  _("bWAPP - LDAP Injection"); // BWAPP - LDAP инъекция
$temp37 =  _("LDAP Injection (Search)");
$temp38 =  _("Search for a user account:");    
$temp39 =  _("LDAP Connection Setting");
$temp40 =  _("Search");

$temp = setlocale(LC_ALL, "ru_RU.utf8");
$temp =bindtextdomain("messages", "./var/www/html/bWAPP/lang/ru_RU/LC_MESSAGES");

function ldapi($data)
{

    switch($_COOKIE["security_level"])
    {

        case "0" :

            $data = no_check($data);
            break;

        case "1" :

            $data = ldapi_check_1($data);
            break;

        case "2" :

            $data = ldapi_check_1($data);
            break;

        default :

            $data = no_check($data);
            break;

    }

    return $data;

}

if(!(isset($_SESSION["ldap"]["login"]) && $_SESSION["ldap"]["login"]))
{

    header("Location: ldap_connect.php");

    exit;

}

$message = "";

// Retrieves the LDAP connection settings
$login = $_SESSION["ldap"]["login"];
$password = $_SESSION["ldap"]["password"];
$server = $_SESSION["ldap"]["server"];
$dn = $_SESSION["ldap"]["dn"];

// Connects and binds to the LDAP server
$ds = ldap_connect($server);
ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);// Sets the LDAP Protocol used by the AD service
ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
$r = ldap_bind($ds, $login, $password);

if($r)
{

    // Searches the LDAP attributes for the user who connected to the LDAP server
    // If the login name contains a '\' (= pre-windows 2000 domain name) then we need the SAMAccountName
    // The SAMAccountName is the part after the '\'
    if(strpos($login, "\\") !== false)
    {

        // Debugging
        // echo $login . " contains the character \\";

        // Breaks the login name in pieces (\). All pieces are put in an array
        $login_array = explode("\\", $login);

        // Puts the last part of the array (= the SAMAccountName) in a new variabele
        $samaccountname = $login_array[count($login_array) - 1];

        // Sets the fields for $filter
        $search_for = $samaccountname;// The string to find
        $search_field = "samaccountname";// The LDAP field to search for the string

    }

    else
    {

        // Sets the fields for $filter
        $search_for = $login;// The string to find
        $search_field = "userprincipalname";// The LDAP field to search for the string

    }

    // Filters the LDAP search
    $filter = "(&($search_field=$search_for)(objectClass=user))";// Searches a specific user

    // Searches the LDAP database with the configured filter
    $sr = ldap_search($ds, $dn, $filter);

    // Debugging
    // print_r($sr);

    $info = ldap_get_entries($ds, $sr);

    // Error handling
    error_reporting(E_ALL ^ E_NOTICE);

    // Debugging
    // print_r($info);

    $message =  "Welcome " . ucwords($samaccountname = $info[0]["samaccountname"][0]) . ",";

}

ldap_close($ds);

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

<title><?php echo($temp36) ?></title>

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

    <p><?php echo $message?></p>

    <table>

        <tr>

            <td width="450">

            <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

                <p>

                <label for="user"><?php echo($temp38) ?></label>

                <input type="user" id="user" name="user" size="25">

                <button type="submit" name="form" value="submit"><?php echo($temp40) ?></button>

                </p>

            </form>

            </td>

            <td><font size="1"><a href="ldap_connect.php">s<?php echo($temp39) ?></a></font></td>

        </tr>

    </table>

    <table id="table_yellow">

        <tr bgcolor="#ffb717" height="40">

            <td align="center" width="65"><b>SID</b></td>
            <td align="center" width="110"><b>SAM Name</b></td>
            <td align="center" width="170"><b>UPN</b></td>
            <td align="center" width="150"><b>Common Name</b></td>
            <td align="center" width="150"><b>Display Name</b></td>

        </tr>
<?php

if(isset($_POST["user"]))
{

    // Connects and binds to the LDAP server
    $ds = ldap_connect($server);
    ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);// Sets the LDAP Protocol used by the AD service
    ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
    $r = ldap_bind($ds, $login, $password);

    if($r)
    {

        // Sets the fields for $filter
        $search_for = $_REQUEST["user"];// The string to find
        $search_for = ldapi($search_for);
        $search_field_1 = "givenname";// The LDAP field to search for the string
        $search_field_2 = "sn";// The LDAP field to search for the string
        $search_field_3 = "userprincipalname";// The LDAP field to search for the string
        // $search_field = "userprincipalname";// The LDAP field to search for the string

        // Filters the LDAP search
        // $filter = "CN=*";// Searches all the 'Common Names'
        // $filter = "($search_field=$search_for*)";// Wildcard is *. Remove it if you want an exact match
        // $filter = "($search_field=$search_for)";// Exact match
        // $filter = "(objectClass=user)";// Searches all the users
        // $filter = "(&($search_field=$search_for)(objectClass=user))";// Searches a specific user
        // $filter = "(&($search_field=$search_for)(objectClass=user)(objectCategory=person))";// Searches a specific user
        // $filter = "(|($search_field=$search_for))";// Injection!!!
        $filter = "(|($search_field_1=$search_for)($search_field_2=$search_for)($search_field_3=$search_for))";// Injection!!!

        // Common LDAP queries
        // http://www.google.com/support/enterprise/static/gapps/docs/admin/en/gads/admin/ldap.5.4.html

        // Retrieves only specific attributes
        $ldap_fields_to_find = array("objectsid", "samaccountname", "userprincipalname", "cn", "displayname");

        // Searches the LDAP database
        // $sr = ldap_search($ds, $dn, $filter);
        $sr = ldap_search($ds, $dn, $filter, $ldap_fields_to_find);

        // Debugging
        // print_r($sr);

        $info = ldap_get_entries($ds, $sr);

        // Error handling
        error_reporting(E_ALL ^ E_NOTICE);

        // Debugging
        // print_r($info);

        for($x=0; $x<$info["count"]; $x++)
        {

            $objectsid = bin_sid_to_text($info[$x]["objectsid"][0]);
            $samaccountname = $info[$x]["samaccountname"][0];
            $userprincipalname = $info[$x]["userprincipalname"][0];
            $cn = $info[$x]["cn"][0];
            $givenname = $info[$x]["displayname"][0];

?>

        <tr height="40">

            <td align="center"><?php echo $objectsid?></td>
            <td><?php echo $samaccountname?></td>
            <td><?php echo $userprincipalname?></td>
            <td><?php echo $cn?></td>
            <td><?php echo $givenname?></td>

        </tr>
<?php

        }

    }

    ldap_close($ds);

}

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

    <p><?php echo($temp28) ?><a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank"><img style="vertical-align:middle" src="./images/cc.png"></a> &copy; <?php echo($temp29) ?><a href="http://twitter.com/MME_IT" target="_blank">@MME_IT</a> <?php echo($temp30) ?> <a href="http://www.mmebvba.com" target="_blank"><?php echo($temp31) ?></a>?</p>

</div>

<div id="bee">

    <img src="./images/bee_1.png">

</div>

<div id="security_level">

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <label><?php echo($temp18) ?></label><br />

        <select name="security_level">

            <option value="0"><?php echo($temp12) ?></option>
            <option value="1"><?php echo($temp13) ?></option>
            <option value="2"><?php echo($temp14) ?></option>

        </select>

        <button type="submit" name="form_security_level" value="submit"><?php echo($temp34) ?></button>
        <font size="4"><?php echo($temp35) ?><b><?php echo $security_level?></b></font>

    </form>

</div>

<?php require_once('_select_inc.php'); ?>

</body>

</html>