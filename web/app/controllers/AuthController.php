


<?php

require_once __DIR__.'/pdo.php';



function login($data){

    $stmt = pdo()->prepare('SELECT * FROM users WHERE name = :name');
    $stmt->bindParam(':name', $data->username);
    $stmt->execute();
    
    $user = $stmt->fetch();
   
    if (!$user) {
       // return json_encode("idinah");
    }

    if (password_verify($data->password, $user['password'])) {
    
        if (password_needs_rehash($user['password'], PASSWORD_DEFAULT)) {
            $newHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
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

      
        return json_encode($sessionId);
    }

    //return json_encode("idinah");
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
           // return json_encode("idinah");
        }
      
        $upstmt = pdo()->prepare("UPDATE sessions SET last_activity=NOW() WHERE id=:id");
        $upstmt->bindParam(':id', $sid);
        $upstmt->execute();

        
        $out[0] = time() + SESSION_TTL;
        $out[1] = $userData;

        return json_encode($out);

    } else {
       // return json_encode("idinah");
    }
}


if (isset($_GET['login'])) {
    $data = file_get_contents('php://input');
    echo login(json_decode($data, false));

}elseif(isset($_GET['logout'])){
    //echo get(htmlspecialchars($_GET['get']));

}elseif(isset($_GET['checklogin'])){
    echo checkLogin(htmlspecialchars($_GET['checklogin']));

}