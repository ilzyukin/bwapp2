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

include("functions_external.php");
include("connect_i.php");
include("admin/settings.php");

$message = "";

//set on locale from $locale = /bWapp/lang/ru_RU/ or standart /usr/share/locale/
$temp = setlocale(LC_ALL, "ru_RU.utf8");
$temp =bindtextdomain("messages", "./var/www/html/bWAPP/lang/ru_RU/LC_MESSAGES");
echo($temp);
$reuslt3 = textdomain("messages");

//___________________

$temp3 = _("bWAPP - New User"); // Очень крутое веб-приложение!
$temp4 = _("an extremely buggy web app !");// echo($temp4) Логин
$temp6 = _("New user");// echo($temp5) Новый пользователь
$temp5 = _("Login");// echo($temp6) Информация
$temp7 = _("Info");//  echo($temp7) Тренировочные задания
$temp8 = _("Talks & Training");///  echo($temp8) Блог
$temp9 =  _("Blog");//echo($temp9) Введите ваши данные
$temp10 =  _("Create a new user.");// echo($temp10)        Пароль
$temp11= _("E-mail:");//echo($temp11)        Установите уровень безопасности:
$temp12=  _("Password");//echo($temp12)   низкий
$temp13 =  _("Re-type password:");//echo($temp12)   средний
$temp14 =  _("Secret");// echo($temp14)   высокий
$temp15=  _("E-mail activation:");//echo($temp12)   низкий
$temp16 =  _("Create");//echo($temp12)   средний
$temp17 =  _("Secret");// echo($temp14)   высокий

$temp18=  _("bWAPP is licensed under");//echo($temp12)   низкий
$temp19 =  _("2014 MME BVBA / Follow");//echo($temp12)   средний
$temp20 =  _("n Twitter and ask for our cheat sheet, containing all solutions! / Need an exclusive");// echo($temp14)   высокий
$temp21 =  _("training");//echo($temp12)   средний



//___________________

if(isset($_REQUEST["action"]))
{

    $login = $_REQUEST["login"];
    $password = $_REQUEST["password"];
    $password_conf = $_REQUEST["password_conf"];
    $email = $_REQUEST["email"];
    $secret = $_REQUEST["secret"];
    $mail_activation = isset($_POST["mail_activation"]) ? 1 : 0;

    if($login == "" or $email == "" or $password == "" or $secret == "")
    {

        $message = "<font color=\"red\">Please enter all the fields!</font>";

    }

    else
    {

        /*

        /^[a-z\d_]{2,20}$/i
        ||||  | |||     |||
        ||||  | |||     ||i : case insensitive
        ||||  | |||     |/ : end of regex
        ||||  | |||     $ : end of text
        ||||  | ||{2,20} : repeated 2 to 20 times
        ||||  | |] : end character group
        ||||  | _ : underscore
        ||||  \d : any digit
        |||a-z: 'a' through 'z'
        ||[ : start character group
        |^ : beginning of text
        / : regex start

         */

        if(preg_match("/^[a-z\d_]{2,20}$/i", $login) == false)
        {

            $message = "<font color=\"red\">Please choose a valid login name!</font>";

        }

        else
        {

            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {

                $message = "<font color=\"red\">Please enter a valid e-mail address!</font>";

            }

            else
            {

                if($password != $password_conf)
                {

                    $message = "<font color=\"red\">The passwords don't match!</font>";

                }

                else
                {

                    // Input validations
                    $login = mysqli_real_escape_string($link, $login);
                    $login = htmlspecialchars($login, ENT_QUOTES, "UTF-8");

                    $password = mysqli_real_escape_string($link, $password);
                    $password = hash("sha1", $password, false);

                    $email = mysqli_real_escape_string($link, $email);
                    $email = htmlspecialchars($email, ENT_QUOTES, "UTF-8");

                    $secret = mysqli_real_escape_string($link, $secret);
                    $secret = htmlspecialchars($secret, ENT_QUOTES, "UTF-8");

                    $sql = "SELECT * FROM users WHERE login = '" . $login . "' OR email = '" . $email . "'";

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

                    // If the user is not present
                    if(!$row)
                    {

                        // Debugging
                        // echo "<br />Row: ";
                        // print_r($row);

                        if($mail_activation == false)
                        {

                            $sql = "INSERT INTO users (login, password, email, secret, activated) VALUES ('" . $login . "','" . $password . "','" . $email .  "','" . $secret . "',1)"; 

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

                            $message = "<font color=\"green\">User successfully created!</font>";
                        
                        }
                        
                        else
                        {

                            // 'Activation code' generation
                            $activation_code = random_string();         
                            $activation_code = hash("sha1", $activation_code, false);

                            // Debugging
                            // echo $activation_code;

                            if($smtp_server != "")
                            {

                                ini_set( "SMTP", $smtp_server);

                            //Debugging
                            // $debug = "true";     

                            }

                            // Sends an activation mail to the user                    
                            $subject = "bWAPP - New User";
                            $server = $_SERVER["HTTP_HOST"];
                            $sender = $smtp_sender;

                            $content = "Welcome " . ucwords($login) . ",\n\n";
                            $content.= "Click the link to activate your new user:\n\nhttp://" . $server . "/bWAPP/user_activation.php?user=" . $login . "&activation_code=" . $activation_code . "\n\n";
                            $content.= "Greets from bWAPP!";

                            $status = @mail($email, $subject, $content, "From: $sender");

                            if($status != true)
                            {

                                $message = "<font color=\"red\">User not successfully created! An e-mail could not be sent...</font>";

                                // Debugging
                                // die("Error: mail was NOT send");
                                // echo "Mail was NOT send";

                            }

                            else
                            {

                                $sql = "INSERT INTO users (login, password, email, secret, activation_code) VALUES ('" . $login . "','" . $password . "','" . $email .  "','" . $secret . "','" . $activation_code . "')"; 

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

                                // Debugging
                                // echo "Mail was send";

                                $message = "<font color=\"green\">User successfully created! An e-mail with an activation code has been sent.</font>";

                            }

                        }

                    }

                    else
                    {

                        $message = "<font color=\"red\">The login or e-mail already exists!</font>";

                    }

                }

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

            <td><a href="login.php"><?php echo($temp5) ?></font></a></td>
            <td><font color="#ffb717"><?php echo($temp6) ?></font></td>
            <td><a href="info.php"><?php echo($temp7) ?></a></td>
            <td><a href="training.php"><?php echo($temp8) ?></a></td>
            <td><a href="http://itsecgames.blogspot.com" target="_blank"><?php echo($temp9) ?></a></td>

        </tr>

    </table>

</div> 

<div id="main">

    <h1><?php echo($temp10) ?></h1>

    <p><?php echo($temp11) ?></p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <table>

        <tr><td>
  
        <p><label for="login"><?php echo($temp5) ?></label><br />
        <input type="text" id="login" name="login"></p>

        </td>

        <td width="5"></td>

        <td>

        <p><label for="email"><?php echo($temp11) ?></label><br />
        <input type="text" id="email" name="email" size="30"></p>

        </td></tr>

        <tr><td>

        <p><label for="password"><?php echo($temp12) ?></label><br />
        <input type="password" id="password" name="password"></p>

        </td>

        <td width="25"></td>

        <td>

        <p><label for="password_conf"><?php echo($temp13) ?></label><br />
        <input type="password" id="password_conf" name="password_conf"></p>

        </td></tr>

        <tr><td colspan="3">

        <p><label for="secret"><?php echo($temp14) ?></label><br />
        <input type="text" id="secret" name="secret" size="40"></p>

        </td></tr>

        <tr><td>

        <p><label for="mail_activation"><?php echo($temp15) ?></label>
        <input type="checkbox" id="mail_activation" name="mail_activation" value="">

        </td></tr>

        </table>

        <button type="submit" name="action" value="create"><?php echo($temp16) ?></button>

    </form>

    <br />
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

    <p><?php echo($temp18) ?><a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank"><img style="vertical-align:middle" src="./images/cc.png"></a> &copy; <?php echo($temp19) ?> <a href="http://twitter.com/MME_IT" target="_blank">@MME_IT</a> <?php echo($temp20) ?><a href="http://www.mmebvba.com" target="_blank"><?php echo($temp21) ?></a>?</p>

</div>

<div id="bee">

    <img src="./images/bee_1.png">

</div>

</body>

</html>