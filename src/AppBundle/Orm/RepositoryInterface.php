<?php

namespace AppBundle\Orm;

Interface RepositoryInterface{

    public function setTableName($table);

    public function setEntityName($repository);

    public function callSetMethod($name);

}