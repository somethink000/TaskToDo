


<?php

require_once __DIR__.'/pdo.php';



//Register
// $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `username` = :username");
// $stmt->execute(['username' => $_POST['username']]);
// if ($stmt->rowCount() > 0) {
//     flash('Это имя пользователя уже занято.');
//     header('Location: /'); // Возврат на форму регистрации
//     die; // Остановка выполнения скрипта
// }

// // Добавим пользователя в базу
// $stmt = pdo()->prepare("INSERT INTO `users` (`username`, `password`) VALUES (:username, :password)");
// $stmt->execute([
//     'username' => $_POST['username'],
//     'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
// ]);

// header('Location: login.php');




//Login
// require_once __DIR__.'/boot.php';

// // проверяем наличие пользователя с указанным юзернеймом
// $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `username` = :username");
// $stmt->execute(['username' => $_POST['username']]);
// if (!$stmt->rowCount()) {
//     flash('Пользователь с такими данными не зарегистрирован');
//     header('Location: login.php');
//     die;
// }
// $user = $stmt->fetch(PDO::FETCH_ASSOC);

// // проверяем пароль
// if (password_verify($_POST['password'], $user['password'])) {
//     // Проверяем, не нужно ли использовать более новый алгоритм
//     // или другую алгоритмическую стоимость
//     // Например, если вы поменяете опции хеширования
//     if (password_needs_rehash($user['password'], PASSWORD_DEFAULT)) {
//         $newHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
//         $stmt = pdo()->prepare('UPDATE `users` SET `password` = :password WHERE `username` = :username');
//         $stmt->execute([
//             'username' => $_POST['username'],
//             'password' => $newHash,
//         ]);
//     }
//     $_SESSION['user_id'] = $user['id'];
//     header('Location: /');
//     die;
// }

// flash('Пароль неверен');
// header('Location: login.php');





//IsAuth
// function check_auth(): bool
// {
//     return !!($_SESSION['user_id'] ?? false);
// }

// $user = null;

// if (check_auth()) {
//     $stmt = pdo()->prepare("SELECT * FROM `users` WHERE `id` = :id");
//     $stmt->execute(['id' => $_SESSION['user_id']]);
//     $user = $stmt->fetch(PDO::FETCH_ASSOC);
// }
// 
// if ($user) {

//     <h1>Welcome back, <?=htmlspecialchars($user['username'])!</h1>

//     <form class="mt-5" method="post" action="do_logout.php">
//         <button type="submit" class="btn btn-primary">Logout</button>
//     </form>

// <?php } else { 

//     <h1 class="mb-5">Registration</h1>

//     <?php flash(); 

//     <form method="post" action="do_register.php">

//     </form>

// <?php } 




//Logout
//$_SESSION['user_id'] = null;
//header('Location: /');