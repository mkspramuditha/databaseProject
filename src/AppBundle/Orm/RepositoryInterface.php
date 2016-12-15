<?php

namespace AppBundle\Orm;

Interface RepositoryInterface{

    public function setTableName($table);

    public function setEntityName($entity);

    public function callSetMethod($name);

}