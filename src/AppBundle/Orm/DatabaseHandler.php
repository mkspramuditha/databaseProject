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

    public static function insert($entity){

//        $entity->get_method('echo_this');

    }

    public static function update($entity){

    }

    public static function delete($entity){

    }

    public static function getInstance(){
        if(self::$_dbConnect ==null){
            self::$_dbConnect = new DatabaseHandler();
        }
        return self::$_dbConnect;
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





}