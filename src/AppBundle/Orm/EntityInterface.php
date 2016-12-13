<?php

namespace AppBundle\Orm;

interface EntityInterface{

    public function setTableName($table);

    public function setRepositoryName($repository);

}

