<?php

namespace AppBundle\Orm;

Abstract class AbstractRepository implements RepositoryInterface {

    protected $_tableName;
    protected $_entityName;


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
        $object = $this;
        return function() use($object, $name){
            $args = func_get_args();
            return call_user_func_array(array($object, $name), $args);
        };
    }

    public abstract function findOneBy($field , $values);
    public abstract function findAll();
    public abstract function findBy($field , $values);


}
