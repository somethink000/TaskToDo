
<?php

        $env = parse_ini_file('.env');


        $conn = new mysqli('127.0.0.1:3300', $env["DB_USER"], $env["DB_PASSWORD"], $env["DB_NAME"]);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);


        $sql = [];

        $sql[] = "CREATE TABLE tasksBoxes (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            title TEXT NOT NULL,
            sortId INT NOT NULL
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
       

        // $sql[] = "INSERT INTO tasksBoxes (title, sortId) VALUES ('TaskToDo', 0)";
        // $sql[] = "INSERT INTO tasks (text, done, current, taskBoxId, sortId) VALUES ('Setup my tusks', 0, 1, 1, 0)";
        // $sql[] = "INSERT INTO tasks (text, done, current, taskBoxId, sortId) VALUES ('Proud of yourself', 0, 0, 1, 1)";
        // $sql[] = "INSERT INTO tasks (text, done, current, taskBoxId, sortId) VALUES ('Install TuskToDo', 1, 0, 1, 2)";


        foreach($sql as $item)
        {
            if ($conn->query($item) === TRUE) 
            {
                echo "New table created ...".PHP_EOL;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        
?>