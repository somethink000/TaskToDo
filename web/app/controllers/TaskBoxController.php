

<?php


require_once __DIR__.'/pdo.php';
require_once __DIR__.'/AuthController.php';

function getAll()
{   


    $userid = getUser();
    return json_encode($userid);
    $result = array();

    
    $stmt = pdo()->prepare('SELECT * FROM tasksBoxes WHERE userId = :userId');
    $stmt->bindParam(':userId',$userid);
    $stmt->execute();
    $result = $stmt->fetchAll();

    return json_encode($result);

}   


function get($id)
{
    
    $result = array();

    $stmt = pdo()->prepare('SELECT * FROM tasksBoxes WHERE id = :boxId');
    $stmt->bindParam(':boxId', $boxId);
    $boxId = $id;
    $stmt->execute();
    $result = $stmt->fetchAll();

    return json_encode($result);

}   

function getLast()
{
    
    $result = array();

    $stmt = pdo()->prepare('SELECT * FROM tasksBoxes WHERE id = (SELECT MAX(id) FROM tasksBoxes)');
    $stmt->execute();
    $result = $stmt->fetchAll();

    return json_encode($result);

}   


function updateSort($id, $sortId)
{
    
    $result = array();

    $stmt = pdo()->prepare('UPDATE tasksBoxes SET sortId = :sortId WHERE id = :taskId');
    $stmt->bindParam(':taskId', $id);
    $stmt->bindParam(':sortId', $sortId);

    $stmt->execute();
}   


function create($data)
{
    //TODO delete get last task by make this betar
    //OUTPUT inserted.* SELECT 1
 
    $stmt = pdo()->prepare('INSERT INTO tasksBoxes (title, sortId) VALUES ( :title, 0)');

    $stmt->bindParam(':title', $data->title);

    $stmt->execute();
    return json_encode("json");
    
}   


function delete($id)
{
    
    $stmt = pdo()->prepare('DELETE FROM tasksBoxes WHERE id = :boxid');
    $stmt->bindParam(':boxid', $id);
    $stmt->execute();
    
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