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
$temp = setlocale(LC_ALL, "ru_RU.utf8");
$temp =bindtextdomain("messages", "./var/www/html/bWAPP/lang/ru_RU/LC_MESSAGES");
echo($temp);
$reuslt3 = textdomain("messages");

//___________________

$temp3 = _("bWAPP - Talks & Training"); // Очень крутое веб-приложение!
$temp4 = _("an extremely buggy web app !");// echo($temp4) Логин
$temp6 = _("New user");// echo($temp5) Новый пользователь
$temp5 = _("Login");// echo($temp6) Информация
$temp7 = _("Info");//  echo($temp7) Тренировочные задания
$temp8 = _("Talks & Training");///  echo($temp8) Блог
$temp9 =  _("Blog");//echo($temp9) Введите ваши данные
$temp10 =  _("Create a new user.");// echo($temp10)        Пароль
$temp11= _("E-mail:");//echo($temp11)      
$temp12=  _("password");//echo($temp12)   низкий
$temp13 =  _("Re-type password:");//echo($temp12)   средний
$temp14 =  _("Secret");// echo($temp14)   высокий
$temp15=  _("E-mail activation:");//echo($temp12)   низкий
$temp16 =  _("Create");//echo($temp12)   средний
$temp17 =  _("Secret");// echo($temp14)   высокий
$temp18=  _("bWAPP is licensed under");//echo($temp12)   низкий
$temp19 =  _("2014 MME BVBA / Follow");//echo($temp12)   средний
$temp20 =  _("on Twitter and ask for our cheat sheet, containing all solutions! / Need an exclusive ");// echo($temp14)   высокий
$temp21 =  _("training");//echo($temp12)   средний
$temp22= _("Registration");//echo($temp22) 

$temp23=  _("We are happy to give bWAPP talks and workshops at your security convention or seminar!");
$temp24 =  _("This year we were at");
$temp25 =  _("B-Sides Orlando");
$temp26 =  _("Infosecurity Belgium");
$temp27= _("and the");

$temp28 =  _("TDI Symposium");
$temp29 =  _("Interested in hands-on skills training? We offer the following exclusive courses and workshops:");
$temp30 =  _("Attacking & Defending Web Apps with bWAPP : 2-day Web Application Security course");
$temp31= _("Plant the Flags with bWAPP : 4-hour offensive Web Application Hacking workshop");

$temp32 =  _("Ethical Hacking Basics : 1-day Ethical Hacking course");
$temp33 =  _("Ethical Hacking Advanced : 1-day comprehensive Ethical Hacking course");
$temp34 =  _("Windows Server 2012 Security : 2-day Windows Security course");
$temp35= _("All our courses and workshops can be scheduled on demand, at your location."); 

$temp36 =  _("Don't hesitate to contact us for price information.");
$temp37= _("Hope to see you soon!");

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

            <td><a href="login.php"><?php echo($temp5) ?></a></td>
            <td><a href="user_new.php"><?php echo($temp6) ?></a></td>
            <td><a href="info.php"><?php echo($temp7) ?></a></td>
            <td><font color="#ffb717"><?php echo($temp8) ?></font></td>
            <td><a href="http://itsecgames.blogspot.com" target="_blank"><?php echo($temp9) ?></a></td>

        </tr>

    </table>

</div>

<div id="main">

    <h1><?php echo($temp8) ?></h1>

    <p><?php echo($temp23) ?><br />
    <?php echo($temp24) ?> 
    <a href="http://bsidesorlando.org/2014/malik-mesellem-what-is-bwapp-web-application-penetration-testing-with-bwapp" target="_blank"><?php echo($temp25) ?></a>, 
    <a href="http://www.infosecurity.be" target="_blank"><?php echo($temp26) ?></a>, 
    <a href="http://www.sans.org/event/sans-2014/bonus-sessions/4407" target="_blank">SANS 2014</a>, <?php echo($temp27) ?> 
    <a href="http://trusteddigitalidentity.com/" target="_blank"><?php echo($temp28) ?></a>.</p>

    <p><?php echo($temp29) ?>

    <ul>

        <li><?php echo($temp30) ?> (<a href="http://goo.gl/ASuPa1" target="_blank">pdf</a>)</li>
        <li><?php echo($temp31) ?> (<a href="http://goo.gl/fAwCex" target="_blank">pdf</a>)</li>
        <li><?php echo($temp32) ?> (<a href="http://goo.gl/09ccSf" target="_blank">pdf</a>)</li>
        <li><?php echo($temp33) ?> (<a href="http://goo.gl/PHLnQF" target="_blank">pdf</a>)</li>
        <li><?php echo($temp34) ?> (<a href="http://goo.gl/4C0JfW" target="_blank">pdf</a>)</li>

    </ul>

    </p>

    <p><?php echo($temp35) ?><br />
    <?php echo($temp36) ?></p>

    <p><?php echo($temp37) ?></p>

</div>

<div id="side">

    <a href="http://twitter.com/MME_IT" target="blank_" class="button"><img src="./images/twitter.png"></a>
    <a href="http://be.linkedin.com/in/malikmesellem" target="blank_" class="button"><img src="./images/linkedin.png"></a>
    <a href="http://www.facebook.com/pages/MME-IT-Audits-Security/104153019664877" target="blank_" class="button"><img src="./images/facebook.png"></a>
    <a href="http://itsecgames.blogspot.com" target="blank_" class="button"><img src="./images/blogger.png"></a>

</div>

<div id="disclaimer">

    <p><?php echo($temp18) ?> <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank"><img style="vertical-align:middle" src="./images/cc.png"></a> &copy; <?php echo($temp19) ?><a href="http://twitter.com/MME_IT" target="_blank">@MME_IT</a> <?php echo($temp20) ?> <a href="http://www.mmebvba.com" target="_blank"><?php echo($temp21) ?></a>?</p>

</div>

<div id="bee">

    <img src="./images/bee_1.png">

</div>

</body>

</html>