

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

function getLast()
{
    
    $result = array();

    $pdo = new PDO('mysql:host=db;dbname=stage', "example", "secret2");

    $stmt = $pdo->prepare('SELECT * FROM tasksBoxes WHERE id = (SELECT MAX(id) FROM tasksBoxes)');
    $stmt->execute();
    $result = $stmt->fetchAll();

    return json_encode($result);

    $pdo = null;
}   


function updateSort($id, $sortId)
{
    
    $result = array();

    $pdo = new PDO('mysql:host=db;dbname=stage', "example", "secret2");
    
    $stmt = $pdo->prepare('UPDATE tasksBoxes SET sortId = :sortId WHERE id = :taskId');
    $stmt->bindParam(':taskId', $id);
    $stmt->bindParam(':sortId', $sortId);

    $stmt->execute();
   
    $pdo = null;
}   


function create($data)
{
    //TODO delete get last task by make this betar
    //OUTPUT inserted.* SELECT 1
    $pdo = new PDO('mysql:host=db;dbname=stage', "example", "secret2");
    
    $stmt = $pdo->prepare('INSERT INTO tasksBoxes (title, sortId) VALUES ( :title, 0)');

    $stmt->bindParam(':title', $data->title);

    $stmt->execute();
    return json_encode("json");
    $pdo = null;

    
}   


function delete($id)
{
    

    $pdo = new PDO('mysql:host=db;dbname=stage', "example", "secret2");
    
    $stmt = $pdo->prepare('DELETE FROM tasksBoxes WHERE id = :boxid');
    $stmt->bindParam(':boxid', $id);
    $stmt->execute();
    
    
    $pdo = null;
}   


if (isset($_GET['all'])) {
    echo getAll();

}elseif(isset($_GET['get'])){
    echo get(htmlspecialchars($_GET['get']));

}elseif(isset($_GET['getLast'])){
    echo getLast();

}elseif(isset($_GET['updateSort'])){
    $data = file_get_contents('php://input');
    updateSort(htmlspecialchars($_GET['updateSort']), json_decode($data, false));

}elseif(isset($_GET['create'])){
    $data = file_get_contents('php://input');
    echo create(json_decode($data, false));

}elseif(isset($_GET['delete'])){
   delete(htmlspecialchars($_GET['delete']));

}