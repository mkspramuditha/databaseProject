<?php
/**
 * Created by PhpStorm.
 * User: shan
 * Date: 12/14/16
 * Time: 7:40 PM
 */

namespace AppBundle\Orm;


use SensioLabs\Security\Exception\RuntimeException;

class DatabaseHandler
{
    private  $_host = "localhost";
    private  $_databaseName = "databaseProject";
    private  $_databaseUser = "root";
    private  $_databasePassword = null;

    private $_connection;
    private static $_dbConnect;
    private $_result;

    public function connect()
        {
            if ($this->_connection === null) {

                if (!$this->_connection = mysqli_connect($this->getHost(), $this->getDatabaseUser(), $this->getDatabasePassword(), $this->getDatabaseName())) {
                    throw new RuntimeException('Error connecting to the server : ' . mysqli_connect_error());
            }
                unset($host, $user, $password, $database);
            }
            return $this->_connection;
        }

    public function insert($entity){
        $table = $entity->getTableName();

        $tableColumnNames = implode(',',$entity->getColumnNames());
        $values = $this->getValuesFromEntity($entity);
        $query = 'INSERT INTO ' . $table . ' (' . $tableColumnNames . ') ' . ' VALUES (' . $values . ')';
        $this->query($query);
    }

    public function update($entity){
        $this->delete($entity);
        $this->insert($entity);
    }

    public function delete($entity){

        $table = $entity->getTableName();

        $query = 'DELETE FROM ' . $table . ' WHERE id ='. $entity->getId() .' ';
        var_dump($query);
        $this->query($query);
    }

    public static function getInstance(){
        if(self::$_dbConnect ==null){
            self::$_dbConnect = new DatabaseHandler();
        }
        return self::$_dbConnect;
    }

    public function getValuesFromEntity($entity)
    {
        $fieldNames = $entity->getFieldNames();

        $values = [];
        foreach ($fieldNames as $field){
            $method = $entity->callGetMethod('get'.$field);
            $values [] = $method();
        }
//        $entity->get_method('echo_this');
        $values = implode(',', array_map(array(self::getInstance(), 'quoteValue'), array_values($values)));

        return $values;
    }


    public function quoteValue($value)
    {
        $this->connect();
        if ($value === null) {
            $value = 'NULL';
        }
        else if (!is_numeric($value)) {
            $value = "'" . mysqli_real_escape_string($this->_connection, $value) . "'";
        }
        return $value;
    }

    public function query($query){
//        print_r($query);
//        echo "<br>";
        $connection = $this->connect();
        $results = mysqli_query($connection,$query);
//        print_r($connection->error);

        return $results;
    }

    public function fetch(){
        if ($this->_result !== null) {
                if (($row = mysqli_fetch_array($this->_result, MYSQLI_ASSOC)) === false) {
                    $this->freeResult();
                }
                return $row;
            }
            return false;
    }

    public function fetchArray(){

        if ($this->_result !== null) {
            $resultArr = [];
            while($row = mysqli_fetch_assoc($this->_result)){
                $resultArr[] = $row;
            }
            return $resultArr;
        }
        return false;
    }


    public function freeResult()
    {
        if ($this->_result === null) {
            return false;
        }
        mysqli_free_result($this->_result);
        return true;
    }


    /**
     * @return string
     */
    public function getHost()
    {
        return $this->_host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->_host = $host;
    }

    /**
     * @return string
     */
    public function getDatabaseName()
    {
        return $this->_databaseName;
    }

    /**
     * @param string $databaseName
     */
    public function setDatabaseName($databaseName)
    {
        $this->_databaseName = $databaseName;
    }

    /**
     * @return string
     */
    public function getDatabaseUser()
    {
        return $this->_databaseUser;
    }

    /**
     * @param string $databaseUser
     */
    public function setDatabaseUser($databaseUser)
    {
        $this->_databaseUser = $databaseUser;
    }

    /**
     * @return null
     */
    public function getDatabasePassword()
    {
        return $this->_databasePassword;
    }

    /**
     * @param null $databasePassword
     */
    public function setDatabasePassword($databasePassword)
    {
        $this->_databasePassword = $databasePassword;
    }

    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->_connection;
    }

    /**
     * @param mixed $connection
     */
    public function setConnection($connection)
    {
        $this->_connection = $connection;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->_result;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->_result = $result;
    }





}