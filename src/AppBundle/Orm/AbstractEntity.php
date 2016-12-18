<?php
/**
 * Created by PhpStorm.
 * User: shan
 * Date: 12/13/16
 * Time: 11:54 AM
 */

namespace AppBundle\Orm;


Abstract class AbstractEntity implements EntityInterface
{
    private $_tableName;
    private $_repositoryName;
    private $_fieldNames;

    /**
     * @param mixed $tableName
     */
    public function setTableName($tableName)
    {
        $this->_tableName = $tableName;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->_tableName;
    }

    /**
     * @param mixed $repositoryName
     */
    public function setRepositoryName($repositoryName)
    {
        $this->_repositoryName = $repositoryName;
    }

    /**
     * @return string
     */
    public function getRepositoryName()
    {
        return $this->_repositoryName;
    }

    /**
     * @return mixed
     */
    public function getFieldNames()
    {
        return $this->_fieldNames;
    }

    /**
     * @param mixed $fieldNames
     */
    public function setFieldNames($fieldNames)
    {
        $this->_fieldNames = $fieldNames;
    }

    public abstract function callGetMethod($name);


}