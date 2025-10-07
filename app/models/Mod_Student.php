<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Mod_Student extends Model
{
    protected $table = "autable";

    public function __construct()
    {
        parent::__construct();
        $this->call->database();
    }

    // ✅ Get full user profile with role
    public function profile($email, $passw)
    {
        $sql = "SELECT id, fname, lname, email, age, address, passw, role 
                FROM {$this->table} 
                WHERE email = ? AND passw = ?";
        $result = $this->db->raw($sql, [$email, $passw]);

        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data ? $data : [];
    }

    // ✅ Check if login credentials exist
    public function logi($email, $passw)
    {
        $sql = "SELECT COUNT(id) as total FROM {$this->table} WHERE email = ? AND passw = ?";
        $result = $this->db->raw($sql, [$email, $passw]);
        $row = $result->fetch(PDO::FETCH_ASSOC);

        return $row && $row['total'] > 0;
    }

    // ✅ Insert a new user (with role)
    public function insert($users)
    {
        $sql = "INSERT INTO {$this->table} (fname, lname, email, passw, role) 
                VALUES (?, ?, ?, ?, ?)";
        return $this->db->raw($sql, [
            $users['fname'],
            $users['lname'],
            $users['email'],
            $users['passw'],
            $users['role'] ?? 'user'
        ]);
    }

    // ✅ Count records (for pagination)
    public function count_records($keyword = '')
    {
        if (!empty($keyword)) {
            $sql = "SELECT COUNT(id) as total FROM {$this->table} WHERE fname LIKE ?";
            $result = $this->db->raw($sql, ["%{$keyword}%"]);
        } else {
            $sql = "SELECT COUNT(id) as total FROM {$this->table}";
            $result = $this->db->raw($sql);
        }
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Get records (for listing)
    public function get_records($limit_clause, $keyword = '')
    {
        if (!empty($keyword)) {
            $sql = "SELECT * FROM {$this->table} WHERE fname LIKE ?";
            $result = $this->db->raw($sql, ["%{$keyword}%"]);
        } else {
            $sql = "SELECT id, fname, lname, email, role 
                    FROM {$this->table} 
                    ORDER BY id DESC {$limit_clause}";
            $result = $this->db->raw($sql);
        }
        return $result ? $result->fetchAll(PDO::FETCH_ASSOC) : [];
    }
}
