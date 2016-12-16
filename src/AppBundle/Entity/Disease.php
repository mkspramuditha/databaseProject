<?php

namespace AppBundle\Entity;

use AppBundle\Orm\AbstractEntity;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class Disease extends AbstractEntity
{
    private $_tableName = 'disease';
    private $_repositoryName = 'DiseaseRepository';
    private $_fieldNames = ['Id','Userid','Diseaseid', 'Symptoms', 'Description', 'Victimcount','Locationid','Entryid'];
    private $_columnNames = ['id','userid','diseaseid', 'symptoms', 'description', 'victimcount','locationid','entryid'];

    private $id;
    private $userid;
    private $diseaseid;
    private $symptoms;
    private $description;
    private $victimcount;
    private $locationid;
    private $entryid;

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
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param mixed $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }

    /**
     * @return mixed
     */
    public function getDiseaseid()
    {
        return $this->diseaseid;
    }

    /**
     * @param mixed $diseaseid
     */
    public function setDiseaseid($diseaseid)
    {
        $this->diseaseid = $diseaseid;
    }

    /**
     * @return mixed
     */
    public function getSymptoms()
    {
        return $this->symptoms;
    }

    /**
     * @param mixed $symptoms
     */
    public function setSymptoms($symptoms)
    {
        $this->symptoms = $symptoms;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getVictimcount()
    {
        return $this->victimcount;
    }

    /**
     * @param mixed $victimcount
     */
    public function setVictimcount($victimcount)
    {
        $this->victimcount = $victimcount;
    }

    /**
     * @return mixed
     */
    public function getLocationid()
    {
        return $this->locationid;
    }

    /**
     * @param mixed $locationid
     */
    public function setLocationid($locationid)
    {
        $this->locationid = $locationid;
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