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
include("connect_i.php");
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
$temp23 =  _("Broken Auth. - Forgotten Function");// echo($temp23)   Уязвимая аутентификация - забытая функция
$temp24 =  _("Apparently you forgot your secret...");// echo($temp24)   Очевидно, Вы забыли свой секрет...
$temp25 =  _("E-mail:");// echo($temp25)   Почта
$temp26 =  _("Forgot");// echo($temp26)   Забыл свои данные
$temp27 =  _("bWAPP is licensed under");// echo($temp27)   Лицензия БИВАП от
$temp28 =  _("2014 MME BVBA / Follow");// echo($temp28)   2014 MME BVBA / Подписывайтесь
$temp29 =  _("on Twitter and ask for our cheat sheet, containing all solutions! / Need an exclusive");// echo($temp29)   
$temp30 =  _("training");// echo($temp30)   Тренировка
$temp31 =  _("Set your security level:");// echo($temp31)   Введите Ваш уровень безопасности
$temp32 =  _("medium");// echo($temp32)   средний
$temp33 =  _("Set");// echo($temp33)   Установить
$temp34 =  _("Current:");// echo($temp34)   Текущий


$message = "";

if(isset($_POST["action"]))
{

    $email = $_POST["email"];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {

    $message = "<font color=\"red\">Please enter a valid e-mail address!</font>";

    }

    else
    {

        $email = mysqli_real_escape_string($link, $email);

        $sql = "SELECT * FROM users WHERE email = '" . $email . "'";

        // Debugging
        // echo $sql;    

        $recordset = $link->query($sql);

        if(!$recordset)
        {

            die("Error: " . $link->error);

        }

        // Debugging
        // echo "<br />Affected rows: ";
        // printf($link->affected_rows);

        $row = $recordset->fetch_object();

        // If the user is present
        if($row)
        {

            // Debugging
            // echo "<br />Row: ";
            // print_r($row);

            $login = $row->login;

            // Security level LOW
            // Prints the secret
            if($_COOKIE["security_level"] != "1" && $_COOKIE["security_level"] != "2")
            {

                $secret = $row->secret;

                $message = "Hello " . ucwords($login) . "! Your secret: <b>" . $secret . "</b>";

            }

            // Security level MEDIUM
            // Mails the secret
            if($_COOKIE["security_level"] == "1")
            {

                if($smtp_server != "")
                {

                    ini_set( "SMTP", $smtp_server);

                // Debugging
                // $debug = "true";

                }

                $secret = $row->secret;

                // Sends a mail to the user
                $subject = "bWAPP - Your Secret";

                $sender = $smtp_sender;

                $content = "Hello " . ucwords($login) . ",\n\n";
                $content.= "Your secret: " . $secret . "\n\n";
                $content.= "Greets from bWAPP!";

                $status = @mail($email, $subject, $content, "From: $sender");

                if($status != true)
                {

                    $message = "<font color=\"red\">An e-mail could not be sent...</font>";

                    // Debugging
                    // die("Error: mail was NOT send");
                    // echo "Mail was NOT send";

                }

                else
                {

                    $message = "<font color=\"green\">An e-mail with your secret has been sent.</font>";

                 }

            }

            // Security level HIGH
            // Mails a reset code
            if($_COOKIE["security_level"] == "2")
            {

                if($smtp_server != "")
                {

                    ini_set( "SMTP", $smtp_server);

                    // Debugging
                    // $debug = "true";

                }

                // 'Reset code' generation
                $reset_code = random_string();
                $reset_code = hash("sha1", $reset_code, false);

                // Debugging
                // echo $reset_code;

                // Sends a reset mail to the user
                $subject = "bWAPP - Change Your Secret";
                $server = $_SERVER["HTTP_HOST"];
                $sender = $smtp_sender;

                $email_enc = urlencode($email);

                $content = "Hello " . ucwords($login) . ",\n\n";
                $content.= "Click the link to reset and change your secret: http://" . $server . "/bWAPP/secret_change.php?email=" . $email_enc . "&reset_code=" . $reset_code . "\n\n";
                $content.= "Greets from bWAPP!";                 

                $status = @mail($email, $subject, $content, "From: $sender");

                if($status != true)
                {

                    $message = "<font color=\"red\">An e-mail could not be sent...</font>";

                    // Debugging
                    // die("Error: mail was NOT send");
                    // echo "Mail was NOT send";

                }

                else
                {

                    $sql = "UPDATE users SET reset_code = '" . $reset_code . "' WHERE email = '" . $email . "'";

                    // Debugging
                    // echo $sql;

                    $recordset = $link->query($sql);

                    if(!$recordset)
                    {

                        die("Error: " . $link->error);

                    }

                    // Debugging
                    // echo "<br />Affected rows: ";
                    // printf($link->affected_rows);

                    $message = "<font color=\"green\">An e-mail with a reset code has been sent.</font>";

                 }

            }

        }

        else
        {

            if($_COOKIE["security_level"] != "1" && $_COOKIE["security_level"] != "2")
            {

                $message = "<font color=\"red\">Invalid user!</font>";

            }

            else
            {

                $message = "<font color=\"green\">An e-mail with a reset code has been sent. Yeah right :)</font>";

            }

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

            <td><a href="portal.php"><?php echo $temp15 ?></a></td>
            <td><a href="password_change.php"><?php echo $temp16 ?></a></td>
            <td><a href="user_extra.php"><?php echo $temp17 ?></a></td>
            <td><a href="security_level_set.php"><?php echo $temp18 ?></a></td>
            <td><a href="reset.php" onclick="return confirm('All settings will be cleared. Are you sure?');"><?php echo $temp19 ?></a></td>
            <td><a href="credits.php"><?php echo $temp20 ?></a></td>
            <td><a href="http://itsecgames.blogspot.com" target="_blank"><?php echo $temp8 ?></a></td>
            <td><a href="logout.php" onclick="return confirm('Are you sure you want to leave?');"><?php echo $temp21 ?></a></td>
            <td><font color="red"><?php echo $temp22 ?> <?php if(isset($_SESSION["login"])){echo ucwords($_SESSION["login"]);}?></font></td>

        </tr>

    </table>

</div>

<div id="main">

    <h1><?php echo $temp23 ?></h1>

    <p><?php echo $temp24 ?></p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <p><label for="email"><?php echo $temp25 ?></label><br />
        <input type="text" id="email" name="email"></p>

        <button type="submit" name="action" value="forgot"><?php echo $temp26 ?></button>

    </form>

    </br >
    <?php

    echo $message;

    $link->close();

    ?>

</div>

<div id="side">

    <a href="http://twitter.com/MME_IT" target="blank_" class="button"><img src="./images/twitter.png"></a>
    <a href="http://be.linkedin.com/in/malikmesellem" target="blank_" class="button"><img src="./images/linkedin.png"></a>
    <a href="http://www.facebook.com/pages/MME-IT-Audits-Security/104153019664877" target="blank_" class="button"><img src="./images/facebook.png"></a>
    <a href="http://itsecgames.blogspot.com" target="blank_" class="button"><img src="./images/blogger.png"></a>

</div>

<div id="disclaimer">

    <p><?php echo $temp27 ?> <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank"><img style="vertical-align:middle" src="./images/cc.png"></a> &copy; <?php echo $temp28 ?> <a href="http://twitter.com/MME_IT" target="_blank">@MME_IT</a> <?php echo $temp29 ?><a href="http://www.mmebvba.com" target="_blank"><?php echo $temp30 ?></a>?</p>

</div>

<div id="bee">

    <img src="./images/bee_1.png">

</div>

<div id="security_level">

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <label><?php echo $temp31 ?></label><br />

        <select name="security_level">

            <option value="0"><?php echo $temp12 ?></option>
            <option value="1"><?php echo $temp32 ?></option>
            <option value="2"><?php echo $temp14 ?></option>

        </select>

        <button type="submit" name="form_security_level" value="submit"><?php echo $temp33 ?></button>
        <font size="4"><?php echo $temp34 ?> <b><?php echo $security_level?></b></font>

    </form>

</div>

<?php require_once('_select_inc.php'); ?>

</body>

</html>