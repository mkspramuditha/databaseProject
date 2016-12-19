<?php
/**
 * Created by PhpStorm.
 * User: shan
 * Date: 12/15/16
 * Time: 2:23 PM
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Roles;
use AppBundle\Entity\Users;
use AppBundle\Orm\AbstractRepository;
use AppBundle\Orm\DatabaseHandler;

class UsersRepository extends AbstractRepository
{
    protected $_tableName = "users";
    protected $_entityName = "Users";
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
<<<<<<< HEAD
        $query = 'SELECT * FROM ' . $table . '  JOIN roles ON users.role = roles.roleid JOIN userdetails ON users.userid = userdetails.userid WHERE (' . $tableField . ') = (' . $values . ') LIMIT 1';
=======
        $query = 'SELECT * FROM ' . $table . '  JOIN roles ON users.roleId = roles.roleId JOIN userdetails ON users.username = userdetails.userid WHERE (' . $tableField . ') = (' . $values . ') LIMIT 1';
>>>>>>> master
        $results = $DBInstance->query($query);
//        var_dump($results);
        $DBInstance->setResult($results);
        $row = $DBInstance->fetch();

        return $this->setObject($row);

    }

    public function findAll()
    {
        $table = $this->_tableName;
        $DBInstance = DatabaseHandler::getInstance();

        $query = 'SELECT * FROM ' . $table . ' JOIN roles ON users.role = roles.roleid JOIN userdetails ON users.userid = userdetails.userid';

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
<<<<<<< HEAD
        $query = 'SELECT * FROM ' . $table . ' JOIN roles ON users.roleid = roles.roleid JOIN userdetails ON users.username = userdetails.userid WHERE (' . $tableField . ') = (' . $values . ') ';
        print_r($query);
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

    public function findLike($username, $firstname, $email)
    {
        $table = $this->_tableName;
        $DBInstance = DatabaseHandler::getInstance();

        $query = 'SELECT * FROM ' . $table . ' JOIN roles ON users.roleid = roles.roleid JOIN userdetails ON users.username = userdetails.userid WHERE users.username LIKE "%' . $username . '%" AND userdetails.firstname LIKE "%' . $firstname . '%" AND users.email LIKE "%' . $email . '%"';
        print_r($query);
=======
        $query = 'SELECT * FROM ' . $table . ' JOIN roles ON users.roleId = roles.roleId JOIN userdetails ON users.username = userdetails.userid WHERE (' . $tableField . ') = (' . $values . ') ';
>>>>>>> master
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
            self::$instance = new UsersRepository();
        }
        return self::$instance;
    }

    public function setObject($row)
    {
        $userdetails = UserDetailsRepository::getInstance()->findBy(array('userid'), array($row['username']));


        $user = new Users();
        $user->setId($row['id']);
        $user->setUsername($row['username']);
        $user->setPassword($row['password']);
        $user->setEmail($row['email']);
        $user->setRoles(array($row['roleid']));
        $user->setStatus($row['statusId']);
        $user->setToken($row['token']);
        $user->setUserDetailsObj($userdetails);

        return $user;
    }
}