<?php
include 'Variable_db.php';
class MySQLClass
{
    private $bind;
    private $link;
    private $sql;
    private $log_file;
    public $error;
    public function init($hostname, $username, $password, $databasename)
    {
        global $PathLogFile;
        $options = array(PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        try {
            $this->link = new PDO(sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', $hostname, $databasename), $username, $password, $options);
            return true;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            $this->error = $ex->getMessage();
            return false;
        }
    }
    public function connect2web()
    {
        return $this->init(WEB, WEBuser, WEBpass, WEBdb);
    }
    public function run($sql, $bind = "", $type = PDO::FETCH_OBJ)
    {
        $this->sql = trim($sql);
        $this->bind = $this->cleanup($bind);
        $this->error = "";
        try {
            $pdostmt = $this->link->prepare($this->sql);
            if ($pdostmt->execute($this->bind) !== false) {
                if (preg_match("/^(" . implode("|", array("select", "describe", "pragma", "call")) . ") /i", $this->sql)) {
                    return $pdostmt->fetchAll($type);
                } elseif (preg_match("/^(" . implode("|", array("delete", "insert", "update")) . ") /i", $this->sql)) {
                    return $pdostmt->rowCount();
                }

            }
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }
    public function getMessage()
    {
        return $this->error;
    }
    public function select($sql, $bind = '')
    {
        return $this->run($sql, $bind);
    }
    public function execute($sql, $bind = '')
    {
        return $this->run($sql, $bind);
    }
    public function closedb()
    {
        return 0;
    }
    public function delete($table, $where, $bind = "")
    {
        $sql = "DELETE FROM " . $table . " WHERE " . $where . ";";
        $this->run($sql, $bind);
    }
    public function insert($table, $info)
    {
        $fields = $this->filter($info);
        $sql = "INSERT INTO " . $table . " (" . implode($fields, ", ") . ") VALUES (:" . implode($fields, ", :") . ");";
        $bind = array();
        foreach ($fields as $field) {
            $bind[":$field"] = $info[$field];
        }

        return $this->run($sql, $bind);
    }
    public function get($table, $where = "", $order = "", $bind = "", $fields = "*")
    {
        $sql = "SELECT " . $fields . " FROM " . $table;
        if (!empty($where)) {
            $sql .= " WHERE " . $where;
        }

        $sql .= " " . $order;
        $sql .= ";";
        return $this->run($sql, $bind);
    }
    public function update($table, $info, $where, $bind = "")
    {
        $fields = $this->filter($info);
        $fieldSize = sizeof($fields);
        $sql = "UPDATE " . $table . " SET ";
        for ($f = 0; $f < $fieldSize; ++$f) {
            if ($f > 0) {
                $sql .= ", ";
            }

            $sql .= $fields[$f] . " = :update_" . $fields[$f];
        }
        $sql .= " WHERE " . $where . ";";
        $bind = $this->cleanup($bind);
        foreach ($fields as $field) {
            $bind[":update_$field"] = $info[$field];
        }

        return $this->run($sql, $bind);
    }
    private function filter($info)
    {
        if (is_array($info)) {
            $fields = array();
            foreach ($info as $key => $value) {
                $fields[] = $key;
            }
            return array_values(array_intersect($fields, array_keys($info)));
        }
        return array();
    }
    private function cleanup($bind)
    {
        if (!is_array($bind)) {
            if (!empty($bind)) {
                $bind = array($bind);
            } else {
                $bind = array();
            }

        }
        return $bind;
    }
}
