<?php
/**
 * @copyright   Copyright (C) 2005 - 2017 Enikeishik <enikeishik@gmail.com>. All rights reserved.
 * @author      Enikeishik <enikeishik@gmail.com>
 */

namespace CITest\Frontend;

/**
 * Db wrap
 */
class Db extends \mysqli
{
    /**
     * @param Debug &$debug = null
     * @throws \Exception
     */
    public function __construct()
    {
        //подавляем вывод ошибок, т.к. иначе (даже при try-catch) выдается Warning
        @parent::__construct(C_DB_SERVER, C_DB_USER, C_DB_PASSWD, C_DB_NAME);
        if (0 != $this->connect_errno) {
            throw new \Exception(preg_replace('/[^a-z0-1\s\.\-;:,_~]+/i', '', $this->connect_error));
        }
        if ('' != C_DB_CHARSET) {
            $this->query('SET NAMES ' . C_DB_CHARSET);
        }
    }
    
    public function getItem(string $sql)
    {
        $result = $this->query($sql);
        if (!$result) {
            return null;
        }
        if ($row = $result->fetch_assoc()) {
            $result->free();
            return $row;
        } else {
            $result->free();
            return null;
        }
    }
    
    public function getValue(string $sql, string $field)
    {
        $item = $this->getItem($sql);
        if (is_array($item) && array_key_exists($field, $item)) {
            return $item[$field];
        } else {
            return null;
        }
    }
    
    public function getValues(string $sql, string $field, string $indexField = null)
    {
        $result = $this->query($sql);
        if (!$result) {
            return null;
        }
        $items = array();
        if (is_null($indexField)) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row[$field];
            }
        } else {
            while ($row = $result->fetch_assoc()) {
                $items[$indexField . $row[$indexField]] = $row[$field];
            }
        }
        $result->free();
        return $items;
    }
    
    public function getItems(string $sql, string $indexField = null)
    {
        $result = $this->query($sql);
        if (!$result) {
            return null;
        }
        $items = array();
        if (is_null($indexField)) {
            //$items = $result->fetch_all(MYSQLI_ASSOC); - use more memory (?)
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        } else {
            while ($row = $result->fetch_assoc()) {
                $items[$indexField . $row[$indexField]] = $row;
            }
        }
        $result->free();
        return $items;
    }
    
    public function getLastInsertedId()
    {
        return $this->insert_id;
    }
    
    public function addEscape(string $str)
    {
        return $this->real_escape_string($str);
    }
    
    public function getError()
    {
        return $this->error;
    }
}
