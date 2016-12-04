<?php

class model
{
    public function connection()
    {
        $config = parse_ini_file('config.ini');
        $host = $config['host'];
        $user = $config['user'];
        $pass = $config['pass'];
        $base = $config['base'];
        $connection = @new mysqli($host, $user, $pass, $base);
        if (mysqli_connect_errno()) {
            die(mysqli_connect_error());
        }
        $connection->query('SET NAMES "UTF-8"');
        return $connection;
    }
}