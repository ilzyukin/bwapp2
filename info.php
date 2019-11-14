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
//___________________

$temp3 = _("bWAPP - Info"); // echo($temp3) BWAPP - Информация
$temp4 = _("an extremely buggy web app !");
$temp5 = _("New User");// echo($temp5) Новый пользователь
$temp6 = _("Info");// echo($temp6) Информация
$temp7 = _("Talks & Training");//  echo($temp7) Разговоры & Обучение
$temp8 = _("Blog");///  echo($temp8) Блог
$temp9 = _("bWAPP, or a");//echo($temp9) 
$temp10 =  _("buggy web application");// echo($temp10)        
$temp11 =  _(", is a free and open source deliberately insecure web application.");//echo($temp11)        
$temp12 =  _("It helps security enthusiasts, developers and students to discover and to prevent web vulnerabilities.");//echo($temp12)   
$temp13 =  _("bWAPP prepares one to conduct successful penetration testing and ethical hacking projects.");//echo($temp12)   
$temp14 =  _("What makes bWAPP so unique? Well, it has over 100 web vulnerabilities!");// echo($temp14)   
$temp15 =  _("It covers all major known web bugs, including all risks from the ");// echo($temp15)   
$temp16 =  _("OWASP");// echo($temp16)  
$temp17 =  _("Top 10 project.");// echo($temp17)   
$temp18 =  _("bWAPP is a PHP application that uses a MySQL database. It can be hosted on Linux, Windows and Mac with Apache/IIS and MySQL. It can also be installed with WAMP or XAMPP.");// echo($temp18)   
$temp19 =  _("Another possibility is to download the");// echo($temp19)   
$temp20 =  _(", a custom Linux VM pre-installed with bWAPP.");// echo($temp20) 
$temp21 =  _("Download our");// echo($temp21)  
$temp22 =  _("What is bWAPP?");// echo($temp22)  
$temp23 =  _("introduction tutorial, including free exercises...");// echo($temp23)   
$temp24 =  _("bWAPP is for educational purposes. Education, the most powerful weapon which we can use to change the world. Have fun with this free and open source project!");// echo($temp24)   
$temp25 =  _("Cheers, Malik Mesellem");// echo($temp25)  
$temp26 =  _("Re-enter CAPTCHA:");// echo($temp26)   Повторно введите капчу
$temp27 =  _("Login");// echo($temp27)   Логин
$temp28 =  _("bWAPP is licensed under");// echo($temp28)   Лицензия БИВАП от
$temp29 =  _("2014 MME BVBA / Follow");// echo($temp29)   2014 MME BVBA / Подписывайтесь
$temp30 =  _("on Twitter and ask for our cheat sheet, containing all solutions! / Need an exclusive");// echo($temp30)   
$temp31 =  _("training");// echo($temp31)   Тренировка


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

            <td><a href="login.php"><?php echo($temp27) ?></a></td>
            <td><a href="user_new.php"><?php echo($temp5) ?></a></td>
            <td><font color="#ffb717"><?php echo($temp6) ?></font></td>
            <td><a href="training.php"><?php echo($temp7) ?></a></td>
            <td><a href="http://itsecgames.blogspot.com" target="_blank"><?php echo($temp8) ?></a></td>

        </tr>

    </table>

</div>

<div id="main">

    <h1><?php echo($temp6) ?></h1>

    <p><?php echo($temp9) ?> <i><?php echo($temp10) ?></i><?php echo($temp11) ?><br />
    <?php echo($temp12) ?><br />
    <?php echo($temp13) ?></p>

    <p><?php echo($temp14) ?><br />
    <?php echo($temp15) ?> <a href="http://www.owasp.org" target="blank"><?php echo($temp16) ?></a> <?php echo($temp17) ?></p>

    <p><?php echo($temp18) ?><br />
    <?php echo($temp19) ?> <i>bee-box</i><?php echo($temp20) ?></p>

    <p><?php echo($temp21) ?> <a href="http://goo.gl/uVBGnq" target="_blank"><?php echo($temp22) ?></a> <?php echo($temp23) ?></p>

    <p><?php echo($temp24) ?></p>

    <p><?php echo($temp25) ?></p>

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

</body>

</html>