<?php

$temp = setlocale(LC_ALL, "ru_RU.utf8");
$temp =bindtextdomain("messages", "./var/www/html/bWAPP/lang/ru_RU/LC_MESSAGES");
$reuslt3 = textdomain("messages");

//___________________
$temp3 = _("bWAPP - XSS");

$temp4 = _("an extremely buggy web app !");// echo($temp4) Логин
$temp6 = _("Bugs");// echo($temp5) Новый пользователь
$temp5 = _("Change Password");// echo($temp6) Информация
$temp7 = _("Create User");//  echo($temp7) Тренировочные задания
$temp8 = _("Set Security Level");///  echo($temp8) Блог
$temp9 =  _("Credits");//echo($temp9) Введите ваши данные
$temp10 =  _("Blog");// echo($temp10)        Пароль
$temp11 = _("Logout");//echo($temp11)        Установите уровень безопасности:
$temp12 =  _("Broken Auth. - Insecure Login Forms");//echo($temp12)   низкий
$temp13 =  _("REnter the correct passphrase to unlock the secret.");//echo($temp12)   средний
$temp14 =  _("Reset");// echo($temp14)   высокий
$temp15 =  _("brucebanner");//echo($temp12)   низкий
$temp16 =  _("Passphrase");//echo($temp12)   средний
$temp17 =  _("bWAPP is licensed under");// echo($temp14)   высокий
$temp18 =  _("2014 MME BVBA / Follow");//echo($temp12)   средний
$temp19 =  _("@MME_IT");//echo($temp12)   средний
$temp20=  _("on Twitter and ask for our cheat sheet, containing all solutions! / Need an exclusive");// echo($temp14)   высокий
$temp21 =  _("training");//echo($temp12)   средний
$temp22 =  _("Set your security level:");//echo($temp12)   средний
$temp23 =  _("low");//echo($temp12)   средний
$temp24 =  _("medium");//echo($temp12)   средний
$temp25 =  _("high");//echo($temp12)   средний
$temp26 =  _("Set");//echo($temp12)   средний
$temp27 =  _("Current:");//echo($temp12)   средний


$temp28 =  _("bWAPP - Portal");//echo($temp12)   средний
$temp29 =  _("bWAPP");//echo($temp12)   средний
$temp30 =  _("XSS - Reflected (Eval)");//echo($temp12)   средний
$temp31 =  _("The current date on your computer is:");//echo($temp12)   средний
$temp32 =  _("First name:");//echo($temp12)   средний
$temp33 =  _("Last name:");//echo($temp12)   средний
$temp34 =  _("Go");//echo($temp12)   средний
$temp35 =  _("bWAPP");//echo($temp12)   средний
$temp36 =  _("Hack");//echo($temp12)   средний
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

if(isset($_GET["title"]))
{

    // Creates the movie table
    $movies = array("CAPTAIN AMERICA", "IRON MAN", "SPIDER-MAN", "THE INCREDIBLE HULK", "THE WOLVERINE", "THOR", "X-MEN");

    // Retrieves the movie title
    $title = $_GET["title"];

    if($_COOKIE["security_level"] == "2")
    {
        
        // Generates the JSON output
        header("Content-Type: text/json; charset=utf-8");
        
       // Generates the output depending on the movie title received from the client
        if(in_array(strtoupper($title), $movies))
        {
       
            // Creates the response array
            $movies = array(
                "movies" => array(
                    array(
                        "response" => "Yes! We have that movie..."
                    )
                )
            );

        }

        else if(trim($title) == "")       
        {

            // Creates the response array
            $movies = array(
                "movies" => array(
                    array(
                        "response" => "HINT: our master really loves Marvel movies :)"
                    )
                )
            );

        }

        else        
        {

            // Creates the response array
            $movies = array(
                "movies" => array(
                    array(
                        "response" => xss_check_3($title) . "??? Sorry, we don't have that movie :("
                    )
                )
            );

        }

        // Returns the JSON representation
        // This function is safe
        echo json_encode($movies); 

    }

    else      
    {

        if($_COOKIE["security_level"] == "1")
        {

            // Generates the JSON output
            header("Content-Type: text/json; charset=utf-8");

        }

        // Generates the output depending on the movie title received from the client
        if(in_array(strtoupper($title), $movies))
            echo '{"movies":[{"response":"Yes! We have that movie..."}]}';
        else if(trim($title) == "")
            echo '{"movies":[{"response":"HINT: our master really loves Marvel movies :)"}]}';
         else
            echo '{"movies":[{"response":"' . $title . '??? Sorry, we don\'t have that movie :("}]}';

    }

}

else 
{
    
    echo "<font color=\"red\">Try harder :p</font>";
    
}

// Multiple entries
/*
$movies = array(
    "movies" => array(
        array(
            "title" => "Iron Man"
        ),
        array(
            "title" => "Captain America"
        )
    )
);
*/



?>