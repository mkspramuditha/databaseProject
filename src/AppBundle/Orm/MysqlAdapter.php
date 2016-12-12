<?php
namespace AppBundle\Orm;

use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
use SensioLabs\Security\Exception\RuntimeException;

class MysqlAdapter implements DatabaseAdapter{

    protected $_config = array();
    protected $_link;
    protected $_result;

    /**
     * MysqlAdapter constructor.
     * @param array $_config
     */
    public function __construct(array $_config)
    {
        if(count($_config)!=4){
            throw new InvalidArgumentException('Invalid number Of connection parameters');
        }
        $this->_config = $_config;
    }

    /**
     * connect to mysql
     */

    function connect()
    {
        if($this->_link === null){
            list($host,$user,$password,$database) = $this->_config;
            if(!$this->_link = mysqli_connect($host,$user,$password,$database)){
                throw new RuntimeException('Error connecting to the database'. mysqli_connect_error());
            }
            unset($host,$user,$password,$database);

        }
        return $this->_link;
    }

    function disconnect()
    {
        // TODO: Implement disconnect() method.
    }

    function query($query)
    {
        if(!is_string($query) || $query=""){
            throw new InvalidArgumentException("The specified query is not valid");
        }
        $this->connect();
        if(!$this->_result = mysqli_query($this->_link,$query)){
            throw new RuntimeException("Error executing the specified query : ".$query.mysqli_error($this->_link));
        }
        return $this->_result;

    }

    function fetch()
    {
        // TODO: Implement fetch() method.
    }

    function select($table, $where="" , $conditions = "", $fields = '*', $order = "", $limit = null, $offset = null)
    {
            $query = 'SELECT ' . $fields . ' FROM ' . $table
                . (($where) ? ' WHERE ' . $where : "")
               . (($limit) ? ' LIMIT ' . $limit : "")
               . (($offset && $limit) ? ' OFFSET ' . $offset : "")
               . (($order) ? ' ORDER BY ' . $order : "");
            $this->query($query);
            return $this->countRows();
    }

    function insert($table, array $data)
    {
        $fields = implode(',',array_keys($data));
        $values = implode(',', array_map(array($this, 'quoteValue'), array_values($data)));
        $query = "INSERT INTO".$table."(".$fields.")"."VALUES(".$values.")";
        $this->query($query);
        return $this->getInsertId();
    }

    function update($table, array $data, $conditions="")
    {
        $set = array();
        foreach ($data as $field=>$value){
            $set[] = $field." = ".$this->quoteValue($value);
        }
        $set = implode(',',$set);
        $query = 'UPDATE'.$table.'SET'.$set.(($conditions)?'WHERE'.$conditions:'');
        $this->query($query);
        return $this->getAffectedRows();
    }

    function delete($table, $conditions)
    {
        // TODO: Implement delete() method.
    }

    function getInsertId()
    {
        return $this->_link !== null ? mysqli_insert_id($this->_link) : null;
    }

    function countRows()
    {
        return $this->_result !== null ? mysqli_num_rows($this->_result) : 0;
    }

    function getAffectedRows()
    {
        return $this->_link !== null ? mysqli_affected_rows($this->_link) : 0;
    }

    public function quoteValue($value)
    {
        $this->connect();
        if ($value === null) {
            $value = 'NULL';
        }
        else if (!is_numeric($value)) {
            $value = "'" . mysqli_real_escape_string($this->_link, $value) . "'";
        }
        return $value;
    }

}