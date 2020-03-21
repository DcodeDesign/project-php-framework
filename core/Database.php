<?php

// DBConnect::getInstance()->getDatabase()

class Database
{
    private $db = NULL;
    private static $instance = NULL;

    public function __construct()
    {
        $this->host = HOST;
        $this->user = USER;
        $this->password = PASSWORD;
        $this->database = DATABASE;
        $this->connect();
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new DataBaseStatic(HOST, USER, PASSWORD, DATABASE);
        }
        return self::$instance;
    }


    protected function connect()
    {
        $this->db = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
        return $this->db;
    }

    /**
     * @return mysqli
     */
    public function getDatabase()
    {
        return $this->db;
    }

    public function ErrorConnection()
    {
        if (!$this->db) {
            echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
            echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
            echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
    }
}

