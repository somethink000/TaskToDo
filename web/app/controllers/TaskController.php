
<?php


function getAll($boxid)
{
    
    $result = array();

    $pdo = new PDO('mysql:host=db;dbname=stage', "example", "secret2");
    
    $stmt = $pdo->prepare('SELECT * FROM tasks WHERE taskBoxId = :taskBoxId');
    $stmt->bindParam(':taskBoxId', $boxid);
    $stmt->execute();
    $result = $stmt->fetchAll();
    
    return json_encode($result);

    $pdo = null;
}   

function get($id)
{
    
    $result = array();

    $pdo = new PDO('mysql:host=db;dbname=stage', "example", "secret2");
    
    $stmt = $pdo->prepare('SELECT * FROM tasks WHERE id = :taskId');
    $stmt->bindParam(':taskId', $id);
    $stmt->execute();
    $result = $stmt->fetchAll();

    return json_encode($result);

    $pdo = null;
    
}   

function update($id, $data)
{
    
    $result = array();

    $pdo = new PDO('mysql:host=db;dbname=stage', "example", "secret2");

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $txt = "ee";
    $vxt = 0;
    $stmt = $pdo->prepare('UPDATE tasks SET text = :text, current = :current, taskBoxId = :taskBoxId WHERE id = :taskId');
    $stmt->bindParam(':taskId', $id);
    $stmt->bindParam(':text', $txt);
    //$stmt->bindParam(':done', $data->done);
    $stmt->bindParam(':current', $data->current);
    $stmt->bindParam(':taskBoxId', $data->taskBoxId);
    
    return json_encode($out[] = $data->current);
    
    $stmt->execute();
   

    
    

    $pdo = null;
}   

function updateSort($id, $taskSort)
{
    
    $result = array();

    $pdo = new PDO('mysql:host=db;dbname=stage', "example", "secret2");
    
    $stmt = $pdo->prepare('UPDATE tasks SET sortId = :sortId WHERE id = :taskId');
    $stmt->bindParam(':taskId', $taskId);
    $stmt->bindParam(':sortId', $sortId);
    
    $taskId = $id;
    $sortId = $taskSort;
    
    $stmt->execute();
   
    //$result = $stmt->fetchAll();
    //return json_encode($result->fetchAll());

    $pdo = null;
}   

if (isset($_GET['all'])) {
    echo getAll(htmlspecialchars($_GET['all']));

}elseif(isset($_GET['get'])){
    echo get(htmlspecialchars($_GET['get']));

}elseif(isset($_GET['update'])){
    $data = file_get_contents('php://input');
    echo update(htmlspecialchars($_GET['update']), json_decode($data, false));
     
}elseif(isset($_GET['updateSort'])){
    $data = file_get_contents('php://input');
    updateSort(htmlspecialchars($_GET['updateSort']), json_decode($data, false));

}