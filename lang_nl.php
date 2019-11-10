
<?php 

$temp = setlocale(LC_ALL, "ru_RU.utf8");
$temp =bindtextdomain("messages", "./var/www/html/bWAPP/lang/ru_RU/LC_MESSAGES");
$temp3 = _("Thanks for your interest in bWAPP!");
?>

<font color="green"><?php echo($temp3) ?></font>