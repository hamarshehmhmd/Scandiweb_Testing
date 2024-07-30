<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'scandiweb';
    private $username = 'root';
    private $password = 'root';
    private $conn;

    /**
     * Get the database connection.
     *
     * @return PDO|null The database connection or null if connection fails.
     */
    public function getConnection() {
        $this->conn = null;

        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name}";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $exception) {
            error_log("Connection error: " . $exception->getMessage(), 0);
        }

        return $this->conn;
    }
}

?>
