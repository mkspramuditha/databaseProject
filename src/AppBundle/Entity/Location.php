<?php

namespace AppBundle\Entity;

use AppBundle\Orm\AbstractEntity;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class Location extends AbstractEntity
{
    private $_tableName = 'location';
    private $_repositoryName = 'LocationRepository';
    private $_fieldNames = ['Id', 'Locationcode', 'Locationname'];
    private $_columnNames = ['id', 'locationcode', 'locationname'];

    private $id;
    private $locationcode;
    private $locationname;
    //=================================================================

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
    public function getLocationcode()
    {
        return $this->locationcode;
    }

    /**
     * @param mixed $locationcode
     */
    public function setLocationcode($locationcode)
    {
        $this->locationcode = $locationcode;
    }

    /**
     * @return mixed
     */
    public function getLocationname()
    {
        return $this->locationname;
    }

    /**
     * @param mixed $locationname
     */
    public function setLocationname($locationname)
    {
        $this->locationname = $locationname;
    }


//=================================================================
    public function __construct()
    {
        $this->setTableName($this->_tableName);
        $this->setRepositoryName($this->_repositoryName);
        $this->setFieldNames($this->_fieldNames);

    }

    public function callGetMethod($name)
    {
        $object = $this;
        return function () use ($object, $name) {
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


}