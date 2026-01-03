<?php
namespace App\Repositories;

use PDO;
use App\Config\Database;

abstract class BaseRepository
{
    protected PDO $db;

    public function __construct() {
        $this->db = Database::conn();
    }

    protected function q(string $sql, array $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
