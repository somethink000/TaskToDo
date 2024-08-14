<?php

    const SESSION_TTL = 2592000;

    function pdo(): PDO
    {
        // static $pdo;
        
        // if (!$pdo) {

            //$env = parse_ini_file('.env');
            //$pdo = new PDO('mysql:host=db;dbname=stage', "example", "secret2");
            // $dsn = 'mysql:host='.$env['DB_HOST'].';dbname='.$env['DB_NAME'];
            // $pdo = new PDO($dsn, $env["DB_USER"], $env['DB_PASSWORD']);
            // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo = new PDO('mysql:host=db;dbname=stage', "example", "secret2");
        //}

        return $pdo;
    }