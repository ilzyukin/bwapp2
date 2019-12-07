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

$temp = setlocale(LC_ALL, "ru_RU.utf8");
$temp =bindtextdomain("messages", "./var/www/html/bWAPP/lang/ru_RU/LC_MESSAGES");



//___________________

$temp3 = _("bWAPP - SQL Injection"); 
$temp4 = _("an extremely buggy web app !");

$message = "";
$body = file_get_contents("php://input");

// If the security level is not MEDIUM or HIGH
if($_COOKIE["security_level"] != "1" && $_COOKIE["security_level"] != "2")
{

    ini_set("display_errors",1);

    $xml = simplexml_load_string($body);

    // Debugging
    // print_r($xml);

    $login = $xml->login;
    $secret = $xml->secret;

    if($login && $login != "" && $secret)
    {

        $sql = "UPDATE users SET secret = '" . $secret . "' WHERE login = '" . $login . "'";

        // Debugging
        // echo $sql;      

        $recordset = $link->query($sql);

        if(!$recordset)
        {

            die("Ошибка подключения: " . $link->error);

        }

        $message = $login . "секрет был сброшен!";

    }

    else
    {

        $message = "Произошла ошибка!";

    }

}

// If the security level is MEDIUM or HIGH
else
{

    // Disables XML external entities. Doesn't work with older PHP versions!
    // libxml_disable_entity_loader(true);
    $xml = simplexml_load_string($body);
    
    // Debugging
    // print_r($xml);

    $login = $_SESSION["login"];
    $secret = $xml->secret;

    if($secret)
    {

        $secret = mysqli_real_escape_string($link, $secret);

        $sql = "UPDATE users SET secret = '" . $secret . "' WHERE login = '" . $login . "'";

        // Debugging
        // echo $sql;      

        $recordset = $link->query($sql);

        if(!$recordset)
        {

            die("Ошибка подключения: " . $link->error);

        }

        $message = $login . "секрет был сброшен!";

    }

    else
    {

        $message = "Произошла ошибка!"; 

    }

}

echo $message;

$link->close();

?>