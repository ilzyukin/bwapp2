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

$temp = setlocale(LC_ALL, "ru_RU.utf8");
$temp =bindtextdomain("messages", "./var/www/html/bWAPP/lang/ru_RU/LC_MESSAGES");


//___________________

$temp3 = _("bWAPP - CAPTCHA box"); // echo($temp3) Поле ввода капчи

?>
<!DOCTYPE html>
<html>
    
<head>
        
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title><?php echo($temp3) ?></title>

</head>

<body>

<table>

    <tr>
        
        <td><img src="captcha.php"></iframe></td>        
        <td><input type="button" value="Обновить" onClick="window.location.reload()"></td>
        
    </tr>
    
</table>      
        
</body>

</html>