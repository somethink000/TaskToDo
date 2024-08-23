<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="./css/style.css">

        <title>TaskToDo</title>
        
        <script src="./js/auth.js"></script>
        <script src="./js/sparksAnimation.js"></script>
        
        <script>checkLogin()</script>
    </head>

    

    <body id="body" class="blur">


        <div id="particles_container" class="particles_container"></div>


        <div class="about">

            <div class="box bl-box">

                <div class="title">TaskToDo {WIP}</div>
                
                <div class="baseline">
                    <div class="baseline_line"></div>
                </div>

                <div class="text">
                    <div class="txt">Simple todo app currently work in progress </div>
                </div>

                <div class="baseline">
                    <div class="baseline_line"></div>
                </div>

                <div class="auth">
                    <div >
                        <a class="btns" onclick="window.location = 'login.php';">Login</a>
                        <a class="btns" onclick="window.location = 'register.php';">Register</a>
                    </div>
                </div>

            </div>
        </div>
        
    </body>

</html>
