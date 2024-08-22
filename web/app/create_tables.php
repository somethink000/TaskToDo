
<?php

        function createTables( $conn ){
            $sql = [];

            $sql[] = "CREATE TABLE tasksBoxes (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                title TEXT NOT NULL,
                sortId INT NOT NULL,
                userId INT NOT NULL
            )";
    
            
            $sql[] = "CREATE TABLE tasks (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                text TEXT NOT NULL,
                done TINYINT NOT NULL,
                current TINYINT NOT NULL,
                taskBoxId INT NOT NULL,
                sortId INT NOT NULL
            )";
    
            $sql[] = "CREATE TABLE users (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL
            )";
    
            $sql[] = "CREATE TABLE sessions (
                id varchar(255) PRIMARY KEY NOT NULL,
                user_id int(11) UNSIGNED NOT NULL,
                created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                last_activity timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
            )";

            foreach($sql as $item)
            {
                if ($conn->query($item) === TRUE) 
                {
                    echo "New table created ...".PHP_EOL;
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }

        function fillTables( $conn ){
            // $sql = [];

            // $sql[] = "INSERT INTO tasksBoxes (title, sortId) VALUES ('TaskToDo', 0)";
            // $sql[] = "INSERT INTO tasks (text, done, current, taskBoxId, sortId) VALUES ('Setup my tusks', 0, 1, 1, 0)";
            // $sql[] = "INSERT INTO tasks (text, done, current, taskBoxId, sortId) VALUES ('Proud of yourself', 0, 0, 1, 1)";
            // $sql[] = "INSERT INTO tasks (text, done, current, taskBoxId, sortId) VALUES ('Install TuskToDo', 1, 0, 1, 2)";

            // $stmt = $conn->prepare("INSERT INTO users (name, password) VALUES ( ?, ?)");
            // $pass = password_hash("5139", PASSWORD_DEFAULT);
            // $name = "some";
            // $stmt->bind_param("ss", $name, $pass);
            // $stmt->execute();

            // foreach($sql as $item)
            // {
            //     if ($conn->query($item) === TRUE) 
            //     {
            //         echo "Table filled ...".PHP_EOL;
            //     } else {
            //         echo "Error: " . $sql . "<br>" . $conn->error;
            //     }
            // }

            // $user = mysqli_fetch_array($conn->query("SELECT * FROM users"));
            // foreach ($user as $i){
            //     echo($i);
            // }
        }



        $env = parse_ini_file('.env');

        $conn = new mysqli('127.0.0.1:3300', $env["DB_USER"], $env["DB_PASSWORD"], $env["DB_NAME"]);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);


        createTables( $conn );
        fillTables( $conn );

?>