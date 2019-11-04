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
include("admin/settings.php");

$temp = setlocale(LC_ALL, "ru_RU.utf8");
$temp =bindtextdomain("messages", "./var/www/html/bWAPP/lang/ru_RU/LC_MESSAGES");





//___________________

$temp3 = _("bWAPP - Broken Authentication"); // Очень крутое веб-приложение!
$temp4 = _("an extremely buggy web app !");// echo($temp4) Логин
$temp5 = _("New user");// echo($temp5) Новый пользователь
$temp6 = _("Information");// echo($temp6) Информация
$temp7 = _("Training");//  echo($temp7) Тренировочные задания
$temp8 = _("Blog");///  echo($temp8) Блог
$temp9 =  _("Enter your credentials");//echo($temp9) Введите ваши данные
$temp10 =  _("password");// echo($temp10)        Пароль
$temp11= _("Check security_level");//echo($temp11)        Установите уровень безопасности:
$temp12=  _("low");//echo($temp12)   низкий
$temp13 =  _("middle");//echo($temp12)   средний
$temp14 =  _("high");// echo($temp14)   высокий

//___________________

$message = "";

if(isset($_POST["form"]))
{

    if($_COOKIE["security_level"] == "1" or $_COOKIE["security_level"] == "2")
    {

        if(isset($_SESSION["captcha"]) && ($_POST["captcha_user"] == $_SESSION["captcha"]))
        {

            if($_POST["login"] == $login && $_POST["password"] == $password)
            {

                $message = "<font color=\"green\">Successful login!</font>";

            }

            else
            {

                $message = "<font color=\"red\">Invalid credentials! Did you forgot your password?</font>";

            }

        }

        else   
        {

            $message = "<font color=\"red\">Incorrect CAPTCHA!</font>";

        }

    }

    else
    {

        if($_POST["captcha_user"] == $_SESSION["captcha"])
        {

            if($_POST["login"] == $login && $_POST["password"] == $password)
            {

                $message = "<font color=\"green\">Successful login!</font>";

            }

            else
            {

                $message = "<font color=\"red\">Invalid credentials! Did you forgot your password?</font>";

            }

        }

        else
        {

            $message = "<font color=\"red\">Incorrect CAPTCHA!</font>";

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

<title> <?php echo $temp3 ?> </title>

</head>

<body>
 
<header>

<h1>bWAPP</h1>

<h2> <?php echo $temp4 ?> </h2>

</header>

<div id="menu">

    <table>

        <tr>

            <td><a href="portal.php">Bugs</a></td>
            <td><a href="password_change.php">Change Password</a></td>
            <td><a href="user_extra.php">Create User</a></td>
            <td><a href="security_level_set.php">Set Security Level</a></td>
            <td><a href="reset.php" onclick="return confirm('All settings will be cleared. Are you sure?');">Reset</a></td>
            <td><a href="credits.php">Credits</a></td>
            <td><a href="http://itsecgames.blogspot.com" target="_blank">Blog</a></td>
            <td><a href="logout.php" onclick="return confirm('Are you sure you want to leave?');">Logout</a></td>
            <td><font color="red">Welcome <?php if(isset($_SESSION["login"])){echo ucwords($_SESSION["login"]);}?></font></td>

        </tr>

    </table>

</div>

<div id="main">

    <h1>Broken Auth. - CAPTCHA Bypassing</h1>

    <p>Enter your credentials <i>(bee/bug)</i>.</p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <p><label for="login">Login:</label><br />
        <input type="text" id="login" name="login" size="20" autocomplete="off" /></p>

        <p><label for="password">Password:</label><br />
        <input type="password" id="password" name="password" size="20" autocomplete="off" /></p>

        <p><iframe src="captcha_box.php" scrolling="no" frameborder="0" height="70" width="350"></iframe></p>

        <p><label for="captcha_user">Re-enter CAPTCHA:</label><br />
        <input type="text" id="captcha_user" name="captcha_user" value="" autocomplete="off" /></p>

        <button type="submit" name="form" value="submit">Login</button>
        
        &nbsp;&nbsp;&nbsp;<?php echo $message . "\n";?>

    </form>

</div>

<div id="side">

    <a href="http://twitter.com/MME_IT" target="blank_" class="button"><img src="./images/twitter.png"></a>
    <a href="http://be.linkedin.com/in/malikmesellem" target="blank_" class="button"><img src="./images/linkedin.png"></a>
    <a href="http://www.facebook.com/pages/MME-IT-Audits-Security/104153019664877" target="blank_" class="button"><img src="./images/facebook.png"></a>
    <a href="http://itsecgames.blogspot.com" target="blank_" class="button"><img src="./images/blogger.png"></a>

</div>     

<div id="disclaimer">

    <p>bWAPP is licensed under <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank"><img style="vertical-align:middle" src="./images/cc.png"></a> &copy; 2014 MME BVBA / Follow <a href="http://twitter.com/MME_IT" target="_blank">@MME_IT</a> on Twitter and ask for our cheat sheet, containing all solutions! / Need an exclusive <a href="http://www.mmebvba.com" target="_blank">training</a>?</p>

</div>

<div id="bee">

    <img src="./images/bee_1.png">

</div>

<div id="security_level">

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <label>Set your security level:</label><br />

        <select name="security_level">

            <option value="0">low</option>
            <option value="1">medium</option>
            <option value="2">high</option>

        </select>

        <button type="submit" name="form_security_level" value="submit">Set</button>
        <font size="4">Current: <b><?php echo $security_level?></b></font>

    </form>

</div>

<?php require_once('_select_inc.php'); ?>

</body>

</html>