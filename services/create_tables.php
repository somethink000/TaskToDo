
<?php

    require('services/connect.php');


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
            done BIT NOT NULL,
            current BIT NOT NULL,
            taskBoxId INT NOT NULL,
            sortId INT NOT NULL
        )";


        // $sql[] = "INSERT INTO tasksBoxes (title, sortId) VALUES ('TaskToDo', 0)";
        // $sql[] = "INSERT INTO tasks (text, done, current, taskBoxId, sortId) VALUES ('Setup my tusks', false, true, 1, 0)";
        // $sql[] = "INSERT INTO tasks (text, done, current, taskBoxId, sortId) VALUES ('Proud of yourself', false, false, 1, 1)";
        // $sql[] = "INSERT INTO tasks (text, done, current, taskBoxId, sortId) VALUES ('Install TuskToDo', true, false, 1, 2)";


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