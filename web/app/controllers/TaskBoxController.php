

<?php



function getAll()
{
    
    $result = array();

    $pdo = new PDO('mysql:host=db;dbname=stage', "example", "secret2");
    
    $result = $pdo->query("SELECT * FROM tasksBoxes"); //WHERE name LIKE '%" . $value . "%'

    return json_encode($result->fetchAll());

    $pdo = null;
    $dbh = null;
}   

function get($id)
{
    
    $result = array();

    $pdo = new PDO('mysql:host=db;dbname=stage', "example", "secret2");
    
    $result = $pdo->query("SELECT * FROM tasksBoxes WHERE id = $id");

    return json_encode($result->fetchAll());

    $pdo = null;
    $dbh = null;
}   

if (isset($_GET['all'])) {
    echo getAll();

}elseif(isset($_GET['get'])){
    echo get(htmlspecialchars($_GET['get']));
}