
<?php

require_once __DIR__.'/pdo.php';

function getAll($boxid)
{
    
    $result = array();

    $stmt = pdo()->prepare('SELECT * FROM tasks WHERE taskBoxId = :taskBoxId');
    $stmt->bindParam(':taskBoxId', $boxid);
    $stmt->execute();
    $result = $stmt->fetchAll();
    
    return json_encode($result);
}   

function get($id)
{
    
    $result = array();

    
    $stmt = pdo()->prepare('SELECT * FROM tasks WHERE id = :taskId');
    $stmt->bindParam(':taskId', $id);
    $stmt->execute();
    $result = $stmt->fetchAll();

    return json_encode($result);
    
}   

function getLast()
{
    
    $result = array();


    $stmt = pdo()->prepare('SELECT * FROM tasks WHERE id = (SELECT MAX(id) FROM tasks)');
    $stmt->execute();
    $result = $stmt->fetchAll();

    return json_encode($result);
}   

function update($id, $data)
{
    
    $stmt = pdo()->prepare('UPDATE tasks SET text = :text, done = :done, current = :current, taskBoxId = :taskBoxId WHERE id = :taskId');
    $data->current = intval($data->current);
    $data->done = intval($data->done);
    $stmt->bindParam(':taskId', $id);
    $stmt->bindParam(':text', $data->text);
    $stmt->bindParam(':done', $data->done);
    $stmt->bindParam(':current', $data->current);
    $stmt->bindParam(':taskBoxId', $data->taskBoxId);

    $stmt->execute();

}   

function updateSort($id, $taskSort)
{
    
    $result = array();

    
    $stmt = pdo()->prepare('UPDATE tasks SET sortId = :sortId WHERE id = :taskId');
    $stmt->bindParam(':taskId', $id);
    $stmt->bindParam(':sortId', $taskSort);

    $stmt->execute();

}  
 
function create($data)
{
    //TODO delete get last task by make this betar
    //OUTPUT inserted.* SELECT 1
    
    $stmt = pdo()->prepare('INSERT INTO tasks (text, done, current, taskBoxId, sortId) VALUES ( :text, false, :curr , :boxid , 0)');

    $data->current = intval($data->current);
    
    $stmt->bindParam(':text', $data->text);
    $stmt->bindParam(':curr', $data->current);
    $stmt->bindParam(':boxid', $data->taskBoxId);

    $stmt->execute();
    return json_encode("json");

}   


function delete($id)
{
    

    
    $stmt = pdo()->prepare('DELETE FROM tasks WHERE id = :taskId');
    $stmt->bindParam(':taskId', $id);
    $stmt->execute();
    

}   

if (isset($_GET['all'])) {
    echo getAll(htmlspecialchars($_GET['all']));

}elseif(isset($_GET['get'])){
    echo get(htmlspecialchars($_GET['get']));

}elseif(isset($_GET['getLast'])){
    echo getLast();

}elseif(isset($_GET['update'])){
    $data = file_get_contents('php://input');
    update(htmlspecialchars($_GET['update']), json_decode($data, false));
     
}elseif(isset($_GET['updateSort'])){
    $data = file_get_contents('php://input');
    updateSort(htmlspecialchars($_GET['updateSort']), json_decode($data, false));

}elseif(isset($_GET['create'])){
    $data = file_get_contents('php://input');
    echo create(json_decode($data, false));

}elseif(isset($_GET['delete'])){
   delete(htmlspecialchars($_GET['delete']));

}