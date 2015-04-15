<?php

class DbConnection {

    public static function getConnection() {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "admin";
        $dbname = "dbecommerce";
        $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    }

}
