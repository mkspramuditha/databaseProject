<?php

namespace AppBundle\Entity;

use AppBundle\Orm\AbstractEntity;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class EntryDetails extends AbstractEntity
{
    private $_tableName = 'entrydetails';
    private $_repositoryName = 'EntryDetails';
    private $_fieldNames = ['Id','Entryid', 'Datetime'];
    private $_columnNames = ['id', 'entryid', 'datetime'];

    private $id;
    private $entryid;
    private $datetime;

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
    public function getEntryid()
    {
        return $this->entryid;
    }

    /**
     * @param mixed $entryid
     */
    public function setEntryid($entryid)
    {
        $this->entryid = $entryid;
    }


    /**
     * @return mixed
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @param mixed $datetime
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
    }
    //=================================================================


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