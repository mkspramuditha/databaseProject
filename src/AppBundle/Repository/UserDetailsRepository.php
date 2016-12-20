<?php
/**
 * Created by PhpStorm.
 * User: shan
 * Date: 12/15/16
 * Time: 2:23 PM
 */

namespace AppBundle\Repository;



use AppBundle\Entity\UserDetails;
use AppBundle\Orm\AbstractRepository;
use AppBundle\Orm\DatabaseHandler;

class UserDetailsRepository extends AbstractRepository
{
    protected $_tableName = "userdetails";
    protected $_entityName = "UserDetails";
    public static $instance;

    public function setTableName($table)
    {
        $this->_tableName = $table;
    }

    public function setEntityName($entity)
    {
        $this->_entityName = $entity;
    }

    public function callSetMethod($name)
    {
        return parent::callSetMethod($name);
    }

    public function findOneBy($field, $values)
    {
        $table = $this->_tableName;
        $DBInstance = DatabaseHandler::getInstance();
        $tableField = implode(',', $field);
        $values = implode(',', array_map(array($DBInstance, 'quoteValue'), array_values($values)));
        $query = 'SELECT * FROM ' . $table . '  WHERE (' . $tableField . ') = (' . $values . ') LIMIT 1';
        $results = $DBInstance->query($query);
        $DBInstance->setResult($results);
        $row = $DBInstance->fetch();

        return $this->setObject($row);

    }

    public function findAll()
    {
        $table = $this->_tableName;
        $DBInstance = DatabaseHandler::getInstance();
        $query = 'SELECT * FROM ' . $table;
        $results = $DBInstance->query($query);
        $DBInstance->setResult($results);
        $row = $DBInstance->fetchArray();
        $resultArray = [];
        foreach ($row as $item) {
            $resultArray[] = $this->setObject($item);
        }

        return $resultArray;

    }

    public function findBy($field, $values)
    {
        $table = $this->_tableName;
        $DBInstance = DatabaseHandler::getInstance();
        $tableField = implode(',', $field);
        $values = implode(',', array_map(array($DBInstance, 'quoteValue'), array_values($values)));
        $query = 'SELECT * FROM ' . $table . '  WHERE (' . $tableField . ') = (' . $values . ') ';
        $results = $DBInstance->query($query);
        $DBInstance->setResult($results);
//        var_dump($DBInstance->getResult());
        $row = $DBInstance->fetchArray();
//        var_dump($row);
        $resultArray = [];
        foreach ($row as $item) {
            $resultArray[] = $this->setObject($item);
        }

        return $resultArray;

    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new UserDetailsRepository();
        }
        return self::$instance;
    }

    public function setObject($row)
    {


        $userdetails = new UserDetails();
        $userdetails->setId($row['id']);
        $userdetails->setUserid($row['userid']);
        $userdetails->setFirstname($row['firstname']);
        $userdetails->setMiddlename($row['middlename']);
        $userdetails->setLastname($row['lastname']);
        $userdetails->setPhone($row['phone']);
//        $userdetails->setEmail($row['email']);


        return $userdetails;
    }
}