


<?php

require_once __DIR__.'/pdo.php';

function getUser(){

    $sid = htmlspecialchars($_COOKIE["session_id"]);

    if ($sid != '') {
       
        $stmt = pdo()->prepare(
            'SELECT u.id, u.name
             FROM sessions AS s LEFT JOIN users AS u ON (s.user_id=u.id)
             WHERE s.id=:id AND last_activity>=DATE_SUB(NOW(), INTERVAL :lastsec SECOND)'
        );
        $tim = intval(SESSION_TTL);
        $stmt->bindParam(':id', $sid);
        $stmt->bindParam(':lastsec', $tim); 
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        if (!$userData) {
           return http_response_code(404); 
        }
      
        //$out[2] = $userData;

        return $userData->id;

    } else {
        return http_response_code(404);
    }
}

function login($data){

    $stmt = pdo()->prepare('SELECT * FROM users WHERE name = :name');
    $stmt->bindParam(':name', $data->username);
    $stmt->execute();
    
    $user = $stmt->fetch();
   
    if (!$user) {
        return http_response_code(404);
    }

    if (password_verify($data->password, $user['password'])) {
    
        if (password_needs_rehash($user['password'], PASSWORD_DEFAULT)) {
            $newHash = password_hash($data->password, PASSWORD_DEFAULT);
            $stmt = pdo()->prepare('UPDATE users SET password = :password WHERE username = :username');
            $stmt->execute([
                'username' => $data->username,
                'password' => $newHash,
            ]);
        }
        
        $userId = $user['id'];
        $result = pdo()->query('SELECT UUID() AS session_id');
        $s = $result->fetch(PDO::FETCH_ASSOC);
        $result->closeCursor();
        $sessionId = $s['session_id'];
        pdo()->query(
            "INSERT INTO sessions (id, user_id)
                    VALUES ('$sessionId', '$userId')"
        );

        
        $out[0] = $sessionId;
        $out[1] = time() + SESSION_TTL;
        return json_encode($out);
    }

    return http_response_code(404);
}


function register($data){


    
    $stmt = pdo()->prepare('SELECT * FROM users WHERE name = :name');
    $stmt->bindParam(':name', $data->username);
    $stmt->execute();
    

    $user = $stmt->fetch();
    
    if ($user) {

        return http_response_code(404);
        
    }
        
        $stmt = pdo()->prepare("INSERT INTO users (name, password) VALUES ( :name, :password)");
        $pass = password_hash($data->password, PASSWORD_DEFAULT);
        $stmt->bindParam(':name', $data->username);
        $stmt->bindParam(':password', $pass);
        $stmt->execute();

        
        $stmt = pdo()->prepare('SELECT * FROM users WHERE name = :name');
        $stmt->bindParam(':name', $data->username);
        $stmt->execute();
        
        $user = $stmt->fetch();
        

        $userId = $user['id'];
        $result = pdo()->query('SELECT UUID() AS session_id');
        $s = $result->fetch(PDO::FETCH_ASSOC);
        $result->closeCursor();
        $sessionId = $s['session_id'];
        pdo()->query(
            "INSERT INTO sessions (id, user_id)
                    VALUES ('$sessionId', '$userId')"
        );

        
        $out[0] = $sessionId;
        $out[1] = time() + SESSION_TTL;
        return json_encode($out);
    
}
  
function checkLogin($sid){
   
    if ($sid != '') {
       
        $stmt = pdo()->prepare(
            'SELECT u.id, u.name
             FROM sessions AS s LEFT JOIN users AS u ON (s.user_id=u.id)
             WHERE s.id=:id AND last_activity>=DATE_SUB(NOW(), INTERVAL :lastsec SECOND)'
        );
        $tim = intval(SESSION_TTL);
        $stmt->bindParam(':id', $sid);
        $stmt->bindParam(':lastsec', $tim); 
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        if (!$userData) {
           return http_response_code(404); 
        }
      
        $upstmt = pdo()->prepare("UPDATE sessions SET last_activity=NOW() WHERE id=:id");
        $upstmt->bindParam(':id', $sid);
        $upstmt->execute();

        $out[0] = $sid;
        $out[1] = time() + SESSION_TTL;
        $out[2] = $userData;

        return json_encode($out);

    } else {
        return http_response_code(404);
    }
}


if (isset($_GET['login'])) {
    $data = file_get_contents('php://input');
    echo login(json_decode($data, false));

}elseif(isset($_GET['register'])){
    $data = file_get_contents('php://input');
    echo register(json_decode($data, false));

}elseif(isset($_GET['logout'])){
    //echo get(htmlspecialchars($_GET['get']));


}elseif(isset($_GET['checklogin'])){
    echo checkLogin(htmlspecialchars($_GET['checklogin']));

}