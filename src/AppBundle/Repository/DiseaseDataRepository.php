<?php
/**
 * Created by PhpStorm.
 * User: shan
 * Date: 12/15/16
 * Time: 2:23 PM
 */

namespace AppBundle\Repository;


use AppBundle\Entity\DiseaseData;
use AppBundle\Orm\AbstractRepository;
use AppBundle\Orm\DatabaseHandler;

class DiseaseDataRepository extends AbstractRepository
{
    protected $_tableName = "diseasedata";
    protected $_entityName = "DiseaseData";
    public static $instance;

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
        return parent::callSetMethod($name);
    }

    public function findOneBy($field, $values)
    {
        $table = $this->_tableName;
        $DBInstance = DatabaseHandler::getInstance();
        $tableField = implode(',', $field);
        $values = implode(',', array_map(array($DBInstance, 'quoteValue'), array_values($values)));
        $query = 'SELECT * FROM ' . $table . ' JOIN location ON diseasedata.locationid = location.locationcode  JOIN entrydetails ON diseasedata.entryid= entrydetails.entryid JOIN users ON diseasedata.userid = users.username WHERE (' . $tableField . ') = (' . $values . ') LIMIT 1';
        $results = $DBInstance->query($query);
        $DBInstance->setResult($results);
        $row = $DBInstance->fetch();

        return $this->setObject($row);

    }

    public function findAll()
    {
        $table = $this->_tableName;
        $DBInstance = DatabaseHandler::getInstance();
        $query = 'SELECT * FROM ' . $table . ' JOIN location ON diseasedata.locationid = location.locationcode  JOIN entrydetails ON diseasedata.entryid= entrydetails.entryid JOIN users ON diseasedata.userid = users.username';
        $results = $DBInstance->query($query);
        $DBInstance->setResult($results);
        $row = $DBInstance->fetchArray();
        $resultArray = [];
        foreach ($row as $item) {
            $resultArray[] = $this->setObject($item);
        }

        return $resultArray;

    }

    public function findBy($field, $values)
    {
        $table = $this->_tableName;
        $DBInstance = DatabaseHandler::getInstance();
        $tableField = implode(',', $field);
        $values = implode(',', array_map(array($DBInstance, 'quoteValue'), array_values($values)));
        $query = 'SELECT * FROM ' . $table . ' JOIN location ON diseasedata.locationid = location.locationcode  JOIN entrydetails ON diseasedata.entryid= entrydetails.entryid JOIN users ON diseasedata.userid = users.username WHERE (' . $tableField . ') = (' . $values . ') ';
        $results = $DBInstance->query($query);
        $DBInstance->setResult($results);
//        var_dump($DBInstance->getResult());
        $row = $DBInstance->fetchArray();
//        var_dump($row);
        $resultArray = [];
        foreach ($row as $item) {
            $resultArray[] = $this->setObject($item);
        }

        return $resultArray;

    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DiseaseDataRepository();
        }
        return self::$instance;
    }

    public function setObject($row)
    {

        $disease = new DiseaseData();
        $disease->setUserid($row['userid']);
        $disease->setDiseasedataid($row['diseasedataid']);
        $disease->setSymptoms($row['symptoms']);
        $disease->setDescription($row['description']);
        $disease->setVictimcount($row['victimcount']);
        $disease->setLocationcode($row['locationcode']);
        $disease->setEntryid($row['entryid']);

        return $disease;
    }
}