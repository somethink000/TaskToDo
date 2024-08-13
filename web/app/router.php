
<?php


function home()
{
    
    return header('../login.php');
}   


if (isset($_GET['home'])) {
    echo home();

}