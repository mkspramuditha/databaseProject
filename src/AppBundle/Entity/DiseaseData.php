<?php

namespace AppBundle\Entity;

use AppBundle\Orm\AbstractEntity;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class DiseaseData extends AbstractEntity
{
    private $_tableName = 'diseasedata';
    private $_repositoryName = 'DiseaseDataRepository';
    private $_fieldNames = ['Id', 'Userid', 'Diseasedataid', 'Symptoms', 'Description', 'Victimcount', 'Locationcode', 'Entryid'];
    private $_columnNames = ['id', 'userid', 'diseasedataid', 'symptoms', 'description', 'victimcount', 'locationcode', 'entryid'];

    private $id;
    private $userid;
    private $diseasedataid;
    private $symptoms;
    private $description;
    private $victimcount;
    private $locationcode;
    private $entryid;
    private $userObj;

    /**
     * @return mixed
     */
    public function getUserObj()
    {
        return $this->userObj;
    }

    /**
     * @param mixed $userObj
     */
    public function setUserObj($userObj)
    {
        $this->userObj = $userObj;
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
    public function getDiseasedataid()
    {
        return $this->diseasedataid;
    }

    /**
     * @param mixed $diseasedataid
     */
    public function setDiseasedataid($diseasedataid)
    {
        $this->diseasedataid = $diseasedataid;
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