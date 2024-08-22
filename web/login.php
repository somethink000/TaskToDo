


<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="./css/style.css">

        <title>TaskToDo</title>

        <script src="./js/auth.js" defer></script>
    </head>


    <header>
        <div class="content bl-box">
            <div class="title" onclick="window.location = 'index.php';">TaskToDo</div>
            <div >
                
            </div>
        </div>
    </header>


    <body id="body" >
    

            <div class="auth_form">
                <form onsubmit="tryLogin(event)">

                    <div class="main-border bl-box">
                        <input type="text" class="task_input" id="username" name="username" placeholder="Username">
                    </div>
                    <!-- required  -->
                    <div class="main-border bl-box">
                        <input type="password" class="task_input" id="password" name="password" placeholder="Password"> 
                    </div>

                    <button class="main-border bl-box add_button" type="submit" class="">Login</button>

                </form>

            </div>
    </body>

</html>
