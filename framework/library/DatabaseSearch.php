<?php

namespace library;

use database\Connection;

class DatabaseSearch
{

    private $tableSql;
    private $columnsSql;
    private $sql = '';
    private $searchSql = '';
    private $whereSql = '';
    private $orderBySql = '';
    private $paginationSql = '';
    private $param = [];
    private $pagination = [];
    private $returnData = [];



    private $db;

    public function __construct(Connection $connection)
    {
        $this->db = $connection;
    }

    /**
     * method table
     * @return array data from table ['dataTable'=>[data], 'dataPagination'=>data]
     */

    public function getData()
    {
        if (!empty($this->pagination)) {
            $numPages = $this->numPages();
            $page = $this->pagination['page'] > $numPages ? 1 : $this->pagination['page'];
            $this->returnData['pagination'] = ['page' => $page, 'numPages' => $numPages];
            $this->param([($page - 1) * $this->pagination['perPage'], $this->pagination['perPage']]);
        }
        $this->sql = "SELECT $this->columnsSql FROM $this->tableSql $this->searchSql $this->whereSql $this->orderBySql $this->paginationSql";
        $this->db->select($this->sql, $this->param);
        $this->returnData['data'] = $this->db->getRows();
        return $this->returnData;
    }

    /**
     * method table
     * @param string name table
     */

    public function table($table)
    {
        $this->tableSql = $table;
    }

    /**
     * method columns
     * @param array columnsName from table
     */

    public function columns(array $columns)
    {
        $this->columnsSql = implode(',', $columns);
    }

    /**
     * method search
     * @param array table columns name
     * @param string search text
     */

    public function search(array $searchColumns, string $searchText)
    {
        if (!empty($searchColumns) && $searchText !== '') {
            foreach ($searchColumns as $column) {
                if ($this->searchSql === '') {
                    $this->searchSql = " WHERE ($column LIKE ?";
                    $this->param(["%$searchText%"]);
                } else {
                    $this->searchSql .= " OR $column LIKE ?";
                    $this->param(["%$searchText%"]);
                }
            }
            $this->searchSql .= ")";
        }
    }

    /**
     * method where
     * @param array ['age'=>['>',20]]
     */

    public function where(array $conditions)
    {
        if (!empty($conditions)) {
            $this->whereSql = $this->searchSql === "" ? " WHERE" : " AND";
            foreach ($conditions as $column => $condition) {
                $this->whereSql .= " $column {$condition[0]} ? AND ";
                $this->param([$condition[1]]);
            }
            $this->whereSql = rtrim($this->whereSql, 'AND ');
        }
    }

    /**
     * method order
     * @param array ['columnName'=> 'DESC]
     */

    public function order(array $orderBy)
    {
        if (!empty($orderBy)) {
            $this->orderBySql = " ORDER BY";
            foreach ($orderBy as $column => $direction) {
                $this->orderBySql .= " $column $direction,";
            }
            $this->orderBySql = rtrim($this->orderBySql, ',');
        }
    }

    /**
     * method pagination
     * @param array ['numPage'=> 1, 'numPerPage'=>100]
     */

    public function pagination(array $pagination)
    {
        if (!empty($pagination)) {
            $this->pagination = $pagination;
            $this->paginationSql = "LIMIT ?, ?";
        }
    }

    /**
     * method param
     * @param array parameters for PDO
     */

    private function param(array $param)
    {
        $this->param = array_merge($this->param, $param);
    }

    /**
     * method numRecird for pagination
     */

    private function numPages()
    {
        $sql = "SELECT $this->columnsSql FROM $this->tableSql $this->searchSql $this->whereSql $this->orderBySql";
        $this->db->select($sql, $this->param);
        $numRecors = $this->db->numRows();
        return ceil($numRecors / $this->pagination['perPage']);
    }
}
