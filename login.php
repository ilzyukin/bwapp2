<?php
//
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

include("connect_i.php");
include("admin/settings.php");

session_start();

$message = "";

//set on locale from $locale = /bWapp/lang/ru_RU/ or standart /usr/share/locale/
$temp = setlocale(LC_ALL, "ru_RU.utf8");

$temp =bindtextdomain("messages", "./var/www/html/bWAPP/lang/ru_RU/LC_MESSAGES");

echo($temp);
$reuslt3 = textdomain("messages");

echo("result3 = $result3");
$temp = _("char");
echo _('char');
echo _("char");
if(isset($_POST["form"]))
{

    $login = $_POST["login"];
    $login = mysqli_real_escape_string($link, $login);

    $password = $_POST["password"];
    $password = mysqli_real_escape_string($link, $password);
    $password = hash("sha1", $password, false);

    $sql = "SELECT * FROM users WHERE login = '" . $login;
    $sql.= "' AND BINARY password = '" . $password . "'";
    // Checks if the user is activated
    $sql.= " AND activated = 1";

    // Debugging
    // echo $sql;

    $recordset = $link->query($sql);

    if(!$recordset)
    {

        die("Error: " . $link->error);

    }

    else
    {

        $row = $recordset->fetch_object();

        // Debugging
        // print_r($row);

        if($row)
        {

            session_regenerate_id(true);

            $token = sha1(uniqid(mt_rand(0,100000)));

            $_SESSION["login"] = $row->login;
            $_SESSION["admin"] = $row->admin;
            $_SESSION["token"] = $token;
            $_SESSION["amount"] = 1000;

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

            header("Location: portal.php");

            exit;

        }

        else
        {

        $message = "<font color=\"red\">Invalid credentials or user not activated!</font>";

        }

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

<title><?php echo $temp; ?></title>

</head>

<body>

<header>

<h1>bWAPP</h1>

<h2>Очень крутое веб-приложение !</h2>

</header>

<div id="menu">

    <table>

        <tr>

            <td><font color="#ffb717">Логин</font></td>
            <td><a href="user_new.php">Новый пользователь</a></td>
            <td><a href="info.php">Информация</a></td>
            <td><a href="training.php">Тренировочные задания</a></td>
            <td><a href="http://itsecgames.blogspot.com" target="_blank">Блог</a></td>

        </tr>

    </table>

</div>

<div id="main">

    <h1>Логин</h1>

    <p>Введите ваши данные <i>(bee/bug)</i>.</p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <p><label for="login">Логин:</label><br />
        <input type="text" id="login" name="login" size="20" autocomplete="off"></p> 

        <p><label for="password">Пароль:</label><br />
        <input type="password" id="password" name="password" size="20" autocomplete="off"></p>

        <p><label for="security_level">Установите уровень безопасности:</label><br />

        <select name="security_level">

            <option value="0">низкий</option>
            <option value="1">средний</option>
            <option value="2">высокий</option>

        </select>

        </p>

        <button type="submit" name="form" value="submit">Логин</button>

    </form>

    <br />
    <?php

    echo $message;

    $link->close();

    ?>

</div>

<div id="sponsor_2">

    <table>

        <tr>

            <td width="103" align="center"><a href="https://www.owasp.org" target="_blank"><img src="./images/owasp.png"></a></td>
            <td width="102" align="center"><a href="https://www.owasp.org/index.php/OWASP_Zed_Attack_Proxy_Project" target="_blank"><img src="./images/zap.png"></a></td>
            <td width="110" align="center"><a href="https://www.netsparker.com/?utm_source=bwappapp&utm_medium=banner&utm_campaign=bwapp" target="_blank"><img src="./images/netsparker.png"></a></td>
            <td width="152" align="center"><a href="http://www.missingkids.com" target="_blank"><img src="./images/mk.png"></a></td>

        </tr>

    </table>

    <br />

    <table>

        <tr>

            <td width="288" align="right"><a href="http://www.mmebvba.com" target="_blank"><img src="./images/mme.png"></a></td>
            <td width="190" align="right"><a href="https://www.netsparker.com/?utm_source=bwappapp&utm_medium=banner&utm_campaign=bwapp" target="_blank"><img src="./images/netsparker.gif"></a></td>

        </tr>

    </table>

</div>

<div id="side">

    <a href="http://twitter.com/MME_IT" target="blank_" class="button"><img src="./images/twitter.png"></a>
    <a href="http://be.linkedin.com/in/malikmesellem" target="blank_" class="button"><img src="./images/linkedin.png"></a>
    <a href="http://www.facebook.com/pages/MME-IT-Audits-Security/104153019664877" target="blank_" class="button"><img src="./images/facebook.png"></a>
    <a href="http://itsecgames.blogspot.com" target="blank_" class="button"><img src="./images/blogger.png"></a>

</div>

<div id="disclaimer">

    <p>bWAPP лицнзия <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank"><img style="vertical-align:middle" src="./images/cc.png"></a> &copy; 2014 MME BVBA / Follow <a href="http://twitter.com/MME_IT" target="_blank">@MME_IT</a> on Twitter and ask for our cheat sheet, containing all solutions! / Need an exclusive <a href="http://www.mmebvba.com" target="_blank">training</a>?</p>

</div>

<div id="bee">

    <img src="./images/bee_1.png">

</div>

</body>

</html>

