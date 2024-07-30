<?php

class QueryBuilder {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function select($table, $columns = '*', $where = '', $orderBy = '') {
        $query = "SELECT $columns FROM $table";
        if ($where) {
            $query .= " WHERE $where";
        }
        if ($orderBy) {
            $query .= " ORDER BY $orderBy";
        }
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($table, $data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(array_values($data));
    }

    public function delete($table, $where) {
        if (!is_array($where)) {
            $where = [$where];
        }
        $placeholders = implode(', ', array_fill(0, count($where), '?'));
        $query = "DELETE FROM $table WHERE sku IN ($placeholders)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($where);
    }

    public function getConnection() {
        return $this->conn;
    }
}
