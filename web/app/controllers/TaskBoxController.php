

<?php



function getAll()
{
    
    $result = array();

    $pdo = new PDO('mysql:host=db;dbname=stage', "example", "secret2");

    $result = $pdo->query("SELECT * FROM Comments"); //WHERE name LIKE '%" . $value . "%'
        
    return json_encode($result);

    $pdo = null;
    $dbh = null;
}   

if (isset($_GET['all'])) {
   
    echo getAll();

}