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
include("connect_i.php");
include("selections.php");

$message = "";
$temp = setlocale(LC_ALL, "ru_RU.utf8");
$temp =bindtextdomain("messages", "./var/www/html/bWAPP/lang/ru_RU/LC_MESSAGES");
$reuslt3 = textdomain("messages");
//________________________

$temp1 = _("bWAPP - Change Password");
$temp2 = _("bWAPP");
$temp3 = _("an extremely buggy web app !");
$temp4 = _("Bugs");
$temp5 = _("Change Password");
$temp6 = _("Create User");
$temp7 = _("Set Security Level");
$temp8 = _("Reset");
$temp9 = _("Credits");
$temp10 = _("Blog");
$temp11 = _("Logout");
$temp12= _("Welcome");

$temp13 = _("Change Password");
$temp14 = _("Please change your password");
$temp15 = _("Current password");
$temp16 = _("New password:");
$temp17 = _("Re-type new password:");
$temp18 = _("bWAPP is licensed under");
$temp19 = _("2014 MME BVBA / Follow");
$temp20= _("on Twitter and ask for our cheat sheet, containing all solutions! / Need an exclusive ");
$temp21 = _("training");

$temp22 = _("Set your security level:");
$temp23 = _("low");
$temp24 = _("medium");
$temp25 = _("high");
$temp26 = _("Set");
$temp27 = _("Change");

//_________________________







if(isset($_REQUEST["action"]))
{

    $password_new = $_REQUEST["password_new"];
    $password_conf = $_REQUEST["password_conf"];

    if($password_new == "")
    {

        $message = "<font color=\"red\">Please enter a new password...</font>";

    }

    else
    {

        if($password_new != $password_conf)
        {

            $message = "<font color=\"red\">The passwords don't match!</font>";

        }

        else
        {

            $login = $_SESSION["login"];

            $password_new = mysqli_real_escape_string($link, $password_new);
            $password_new = hash("sha1", $password_new, false);

            $password_curr = $_REQUEST["password_curr"];
            $password_curr = mysqli_real_escape_string($link, $password_curr);
            $password_curr = hash("sha1", $password_curr, false);

            $sql = "SELECT password FROM users WHERE login = '" . $login . "' AND password = '" . $password_curr . "'";

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

            if($row)
            {

                // Debugging
                // echo "<br />Row: ";
                // print_r($row);

                $sql = "UPDATE users SET password = '" . $password_new . "' WHERE login = '" . $login . "'";

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

                $message = "<font color=\"green\">The password has been changed!</font>";

            }

            else
            {

                $message = "<font color=\"red\">The current password is not valid!</font>";

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

<title> <?php echo($temp1) ?></title>

</head>

<body>

<header>

<h1 <?php echo($temp2) ?></h1>

<h2> <?php echo($temp3) ?></h2>

</header>

<div id="menu">

    <table>

        <tr>

            <td><a href="portal.php"> <?php echo($temp4) ?></a></td>
            <td><font color="#ffb717"> <?php echo($temp5) ?></font></td>
            <td><a href="user_extra.php"> <?php echo($temp6) ?></a></td>
            <td><a href="security_level_set.php"> <?php echo($temp7) ?></a></td>
            <td><a href="reset.php" onclick="return confirm('All settings will be cleared. Are you sure?');"> <?php echo($temp8) ?></a></td>
            <td><a href="credits.php"> <?php echo($temp9) ?></a></td>
            <td><a href="http://itsecgames.blogspot.com" target="_blank"> <?php echo($temp10) ?></a></td>
            <td><a href="logout.php" onclick="return confirm('Are you sure you want to leave?');"> <?php echo($temp11) ?></a></td>
            <td><font color="red"> <?php echo($temp12) ?> <?php if(isset($_SESSION["login"])){echo ucwords($_SESSION["login"]);}?></font></td>

        </tr>

    </table>

</div>

<div id="main">

    <h1> <?php echo($temp13) ?> </h1>

    <p> <?php echo($temp14) ?>  <b><?php if(isset($_SESSION["login"])){echo ucwords($_SESSION["login"]);} ?></b>.</p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <p><label for="password_curr"> <?php echo($temp15) ?></label><br />
        <input type="password" id="password_curr" name="password_curr"></p>

        <p><label for="password_new"> <?php echo($temp16) ?></label><br />
        <input type="password" id="password_new" name="password_new"></p>

        <p><label for="password_conf"> <?php echo($temp17) ?></label><br />
        <input type="password" id="password_conf" name="password_conf"></p>

        <button type="submit" name="action" value="change"><?php echo($temp27) ?></button>

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

    <p><?php echo($temp18) ?><a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank"><img style="vertical-align:middle" src="./images/cc.png"></a> &copy;<?php  echo($temp19) <a href="http://twitter.com/MME_IT" target="_blank">@MME_IT</a> <?php  echo($temp20) ?><a href="http://www.mmebvba.com" target="_blank"><?php echo($temp21) ?></a>?</p>

</div>

<div id="bee">

    <img src="./images/bee_1.png">

</div>

<div id="security_level">

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]);?>" method="POST">

        <label> <?php echo($temp22) ?></label><br />

        <select name="security_level">

            <option value="0"> <?php echo($temp23) ?></option>
            <option value="1"> <?php echo($temp24) ?></option>
            <option value="2"> <?phpecho($temp25) ?></option>

        </select>

        <button type="submit" name="form_security_level" value="submit"> <?php echo($temp26) ?></button>
        <font size="4"> <?php echo ($temp27) ?><b><?php echo $security_level?></b></font>

    </form>

</div>

<?php require_once('_select_inc.php'); ?>

</body>

</html>