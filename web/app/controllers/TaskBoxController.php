

<?php



function getAll()
{
    
    $result = array();

    $pdo = new PDO('mysql:host=db;dbname=stage', "example", "secret2");
    
    $stmt = $pdo->prepare('SELECT * FROM tasksBoxes');
    $stmt->execute();
    $result = $stmt->fetchAll();

    return json_encode($result);

    $pdo = null;
}   

function get($id)
{
    
    $result = array();

    $pdo = new PDO('mysql:host=db;dbname=stage', "example", "secret2");
    
    $stmt = $pdo->prepare('SELECT * FROM tasksBoxes WHERE id = :boxId');
    $stmt->bindParam(':boxId', $boxId);
    $boxId = $id;
    $stmt->execute();
    $result = $stmt->fetchAll();

    return json_encode($result);

    $pdo = null;
    
}   

if (isset($_GET['all'])) {
    echo getAll();

}elseif(isset($_GET['get'])){
    echo get(htmlspecialchars($_GET['get']));
}