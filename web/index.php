<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="./css/style.css">

        <script src="./js/taskSort.js" defer></script>
        <script src="./js/taskBoxSort.js" defer></script>
        <script src="./js/todoLoad.js" defer></script>

        

        <script src="./js/taskActions.js" defer></script>
        <script src="./js/taskBoxActions.js" defer></script>

        <script src="./js/pageInput.js" defer></script>
        <script src="./js/sparksAnimation.js" defer></script>

        <title>TaskToDo</title>
        
    </head>

    <body id="body" class="blur">


        <div id="particles_container" class="particles_container"></div>


        <div class="main-block">

        <div class="current-tasks">

            <div class="boxes_place_ctrls">

            <button class="add_button bl-box main-border" onclick="createTaskBoxWindow(event)">
                <img class="head_image" src="./assets/plus.png" width="32" />
                <p class="txt">Create box</p>
            </button>

            <button class="add_button bl-box main-border">
                <img class="head_image" src="./assets/settings.png" width="32" />
            </button>

            </div>

            <div id="taskbox0" class="current-task-block ts_block bl-box main-border">

            <div class="task-block-name">
                <p class="title">Today</p>

                <div id="0" class="task_form main-border">
                <input class="task_input" type="text" placeholder="New task" onkeypress="forseCreateTask(event)">
                </div>
            </div>

            <div class="baseline">
                <div class="baseline_line"></div>
            </div>

            <ul class="task_block_list" ondragover="dragOverTasklist(event)" ondragenter="dragEnterTasklist(event)">

            </ul>

            </div>

        </div>


        <div class="boxes_main">
            
            <ul id="tasks_place" class="boxes_container" ondragover="dragOverTaskBoxContainer(event)" ondragenter="dragEnterTaskBoxContainer(event)"> 

            </ul>

        </div>
        </div>
    </body>

</html>
