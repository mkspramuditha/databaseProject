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

    /**
     * @param mixed $tableName
     */
    public function setTableName($tableName)
    {
        $this->_tableName = $tableName;
    }

    /**
     * @param mixed $repositoryName
     */
    public function setRepositoryName($repositoryName)
    {
        $this->_repositoryName = $repositoryName;
    }


}