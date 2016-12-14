<?php

namespace AppBundle\Entity;

use AppBundle\Orm\AbstractEntity;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class Users extends AbstractEntity implements UserInterface, \Serializable ,EquatableInterface
{
    private $_tableName = 'users';
    private $_repositoryName = 'UsersRepository';
    private $_fieldNames = ['Username','Password','Email'];
    private $_columnNames = ['username','password','email'];

    private $id;
    private $username;
    private $password;
    private $email;
    private $roles;


    public function __construct()
    {
        $this->setTableName($this->_tableName);
        $this->setRepositoryName($this->_repositoryName);
        $this->setFieldNames($this->_fieldNames);

    }

    public function callGetMethod($name)
    {
        $object = $this;
        return function() use($object, $name){
            $args = func_get_args();
            return call_user_func_array(array($object, $name), $args);
        };
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->_tableName;
    }

    /**
     * @param string $tableName
     */
    public function setTableName($tableName)
    {
        $this->_tableName = $tableName;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getRepositoryName()
    {
        return $this->_repositoryName;
    }

    /**
     * @param string $repositoryName
     */
    public function setRepositoryName($repositoryName)
    {
        $this->_repositoryName = $repositoryName;
    }

    /**
     * @return array
     */
    public function getColumnNames()
    {
        return $this->_columnNames;
    }

    /**
     * @param array $columnNames
     */
    public function setColumnNames($columnNames)
    {
        $this->_columnNames = $columnNames;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return array
     */
    public function getFieldNames()
    {
        return $this->_fieldNames;
    }

    /**
     * @param array $fieldNames
     */
    public function setFieldNames($fieldNames)
    {
        $this->_fieldNames = $fieldNames;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof Users) {
            return false;
        }

        if ($this->password !== $user->getPassword()) {
            return false;
        }

        if ($this->getSalt() !== $user->getSalt()) {
            return false;
        }

        if ($this->username !== $user->getUsername()) {
            return false;
        }

        return true;
    }


}