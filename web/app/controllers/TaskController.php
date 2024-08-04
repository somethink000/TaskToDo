
<?php


function getAll($boxid)
{
    
    $result = array();

    $pdo = new PDO('mysql:host=db;dbname=stage', "example", "secret2");
    
    //$result = $pdo->query("SELECT * FROM tasks WHERE taskBoxId = $boxid");
    
    $stmt = $pdo->prepare('SELECT * FROM tasks WHERE taskBoxId = :taskBoxId');
    $stmt->bindParam(':taskBoxId', $taskBoxId);
    $taskBoxId = $boxid;
    $stmt->execute();
    $result = $stmt->fetchAll();
    
    return json_encode($result);

    $pdo = null;
}   

function get($id)
{
    
    $result = array();

    $pdo = new PDO('mysql:host=db;dbname=stage', "example", "secret2");
    
    $result = $pdo->query("SELECT * FROM tasks WHERE id = $id");

    return json_encode($result->fetchAll());

    $pdo = null;
    
}   

function update($id, $data)
{
    
    // $result = array();

    // $pdo = new PDO('mysql:host=db;dbname=stage', "example", "secret2");
    
    // $result = $pdo->query("UPDATE tasks SET text = $data.text, done = $data.done, current = $data.current, taskBoxId = $data.taskBoxId WHERE id = $id");

    // return json_encode($result->fetchAll());

    // $pdo = null;
    // $dbh = null;
}   



if (isset($_GET['all'])) {
    echo getAll(htmlspecialchars($_GET['all']));

}elseif(isset($_GET['get'])){
    echo get(htmlspecialchars($_GET['get']));

}elseif(isset($_GET['update'])){
    $data = file_get_contents('php://input');
    //echo update(htmlspecialchars($_GET['update']), $data);
    echo json_encode($out[] = htmlspecialchars($_GET['update']));
}