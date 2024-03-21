<?php

namespace database;

use PDO;
use PDOException;

class Connection
{
    private $DB_HOST;
    private $DB_NAME;
    private $DB_USER;
    private $DB_PASSWORD;
    private $DB_OPTIONS = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];
    private $con;
    private $lastQuery;

    /**
     * method init
     * data from config file framework/configuration/config.json
     * @param string dbHost // localost
     * @param string database name
     * @param string database user
     * @param string database password
     */

    public function init(string $dbHost, string $dbName, string $dbUser, string $dbPass): void
    {
        $this->DB_HOST = $dbHost;
        $this->DB_NAME = $dbName;
        $this->DB_USER = $dbUser;
        $this->DB_PASSWORD = $dbPass;
        try {
            $this->con = new PDO('mysql:host=' . $this->DB_HOST . ';dbname=' . $this->DB_NAME, $this->DB_USER, $this->DB_PASSWORD, $this->DB_OPTIONS);
        } catch (PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * method select
     * @param string sql query $sql = 'SELECT * FROM table WHERE id=?'
     * @param array $param = [1]
     * @return bool true false
     */

    public function select(string $sql, array $params): bool
    {
        return $this->set($sql, $params);
    }

    /**
     * method insert
     * @param string table
     * @param array columns
     * (users, ['name' => Tom, 'age' => 20])
     * @return bool true false
     */

    public function insert(string $table, array $columns): bool
    {
        if (is_array($columns) && !empty($columns)) {
            $columnsName = [];
            $columnsValue = [];
            $sqlColumnsName = '';
            $sqlColumnsValues = '';
            foreach ($columns as $name => $val) {
                $columnsName[] = $name;
                $columnsValue[] = "?";
                $params[] = $val;
            }
            $sqlColumnsName = implode(',', $columnsName);
            $sqlColumnsValues = implode(',', $columnsValue);
            $sql = "INSERT INTO $table ($sqlColumnsName) VALUES ($sqlColumnsValues)";
            return $this->set($sql, $params);
        }
    }

    /**
     * method update
     * @param string table
     * @param array columns
     * @param array conditions
     * (users, ['age' => 20], ['id_user' => 1])
     * @return bool true false
     */

    public function update($table, $columns, $conditions): bool
    {
        if (is_array($columns) && !empty($columns) && is_array($conditions) && !empty($conditions)) {
            $columnsValues = [];
            $sqlColumnsValues = '';
            $SqlConditions = '';
            $params = [];
            foreach ($columns as $name => $value) {
                $columnsValues[] = $name . '=?';
                $params[] = $value;
            }
            $i = 0;
            foreach ($conditions as $nameC => $valueC) {
                if ($i === 0) {
                    $SqlConditions = " WHERE $nameC=?";
                } else {
                    $SqlConditions .= " AND $nameC=?";
                }
                $params[] = $valueC;
                $i++;
            }
            $sqlColumnsValues = implode(',', $columnsValues);
            $sql = "UPDATE $table SET $sqlColumnsValues" . $SqlConditions;
            return $this->set($sql, $params);
        }
    }

    /**
     * method delete
     * @param string table
     * @param array conditions
     * (users, ['id_user' => 1])
     * @return bool true false
     */

    public function delete($table, $conditions): bool
    {
        if (is_array($conditions) && !empty($conditions)) {
            $sqlCondition = '';
            $params = [];
            $i = 0;
            foreach ($conditions as $name => $value) {
                if ($i === 0) {
                    $sqlCondition = " WHERE $name=?";
                } else {
                    $sqlCondition .= " AND $name=?";
                }
                $params[] = $value;
                $i++;
            }
            $sql = "DELETE FROM $table" . $sqlCondition;
            return $this->set($sql, $params);
        }
    }

    /**
     * method truncate
     * clearing data from table
     * @param string table
     * @return bool true false
     */

    public function truncate($table): bool
    {
        $sql = "TRUNCATE TABLE $table";
        return $this->set($sql, []);
    }

    /**
     * method set
     * @param string sql
     * @param array params
     * @return bool true false
     */

    private function set(string $sql, array $params): bool
    {
        $result = false;
        try {
            $set = $this->con->prepare($sql);
            $set->execute($params);
            $this->lastQuery = $set;
            $result = true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    /**
     * method getRows
     * @return array from query
     */

    public function getRows(): array
    {
        return $this->lastQuery->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * method numRows
     * @return int from query
     */

    public function numRows(): int
    {
        return $this->lastQuery->rowCount();
    }

    /**
     * method lastId
     * @return int last id from table
     */

    public function lastId(): int
    {
        return $this->con->lastInsertId();
    }
}
