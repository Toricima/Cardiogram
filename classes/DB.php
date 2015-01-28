<?php

/**
 * db short summary.
 *
 * db description.
 *
 * @version 1.5
 * @author Toricima
 */
 
 require_once 'classes/Logger.php';
 
abstract class DB
{
    private $_PDO,
            $_query,
            $_errorlist = array(),
            $_results,
            $_count,
            $_UPDATEvalues = array(),
            $_UPDATEcollumns = array(),
            $_isInsert = false; 
    
    public function __construct()
    {
        $user = "root";
        $pass = "password";
        
        try
        {
            $this->_PDO = new PDO('mysql:host=localhost;dbname=hartslag', $user, $pass);
            $this->_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            Logger::logError("Couldn't connect to the server",$e->getMessage());
        }
    }
    
    public function Select($table = array(), $where = array())
    {
        $this->Action("SELECT *",$table, $where);
    }
    
    protected function Delete($table, $where)
    {
        $this->Action("DELETE",$table,$where);
    }
    
    protected function Insert($table, $collumns = array(), $values = array())
    {
        if(count($collumns) != count($values))
            return false;

        $c_collumns = count($collumns);
        
        $sql = "INSERT INTO {$table} ( ";
        $sql = $this->Looper($collumns,$sql);
        $sql .= ") VALUES ( ";
        
        $x = 0;
        foreach($values as $value)
        {
            $x++;
            
            if($x < $c_collumns)
                $sql .= " ? ,";
            else
                $sql.= "?";
        }
        $sql .= ")";
       $this->_isInsert = true;
       $this->Query($sql, $values);
        
    }
    
    protected function Update($table,$collumns = array(), $values = array(),$where = array())
    {
        if(count($collumns) != count($values))
            echo "Collumns and values do not match";
   
        $this->_UPDATEcollumns = $collumns;
        $this->_UPDATEvalues = $values;
        $this->Action("UPDATE",$table,$where);
    }
    
    protected function Join($join, $table = array(), $on, $where = array())
    {    
        $indexes = array();
        $tables = array();
    
        $sql = "SELECT";
    
        for($i = 0; $i < count($table); $i++)
        {
            $t = $table[$i][0];
            array_push($tables,$t);
        
            for($j = 1; $j < count($table[$i]); $j++)
            {
                $index = "{$table[$i][0]}.{$table[$i][$j]}";
                array_push($indexes, $index);
            }
        }

        $sql = $this->Looper($indexes,$sql);
        $sql .= " FROM  {$tables[1]}";
        $sql .= " {$join} {$tables[0]}";
        $sql .= " ON {$where[0]} {$where[1]} {$where[2]}";
        
        $array = array();
        $this->Query($sql,$array);
    }
    
    private function Action($action, $table, $where = array())
    {      
        $allowed_operators = array("=","<",">","=>","<=","AND","OR");
        
        $c_where = count($where);
        $values = array();
        
        if($action == "UPDATE")
        { 
            $coll = $this->_UPDATEcollumns;
            $v = $this->_UPDATEvalues;
            $c = count($coll);
            
            $sql = "{$action} {$table} SET ";
           
            for($i = 0; $i < $c; $i++)
            {
                array_push($values,$v[$i]);
                
                if($i < $c)
                    $sql .= "{$coll[$i]} = ? ";
                else
                    $sql .= "{$coll[$i]} = ?";
            }
            
            $sql .= " WHERE ";
        }
        else
            $sql = $action." FROM ". $table[0]." WHERE ";
        
        $c_operator = 1;
        $c_value = 2;
        
        for($j = 0; $j < $c_where; $j++)
        {
            if($j == $c_operator)
            {
                $c_operator += 2;
                if(in_array($where[$j],$allowed_operators))
                    $sql .= " {$where[$j]} ";
            }
            else if($j == $c_value)
            {
                $c_value += 4;
                $sql .= " ? ";
                array_push($values, $where[$j]);
            }
            else
                $sql .= " {$where[$j]} ";
        }
      $this->Query($sql,$values);
    }
    
    private function Query($sql, $params = array())
    {
        $c_params = count($params);
        $param_type = PDO::PARAM_STR;
        $x = 1;
      
        try
        {
            $this->_query = $this->_PDO->prepare($sql);
            $this->_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOExeption $e)
        {
            Logger::logError("Couldn't prepare PDO",$e->getMessage());
            die();
        }
    
            foreach($params as $param)
            {
                if(is_numeric($param))
                    $param_type = PDO::PARAM_INT;
                 
                $this->_query->bindValue($x, $param, $param_type);
                $x++;
            }
           
            if($this->_query->execute())
            {
                if(!$this->_isInsert)
                    $this->_results = $this->_query->fetchAll();
                else
                    $this->_isInsert = false;
            }
    }
    
    private function Looper($indexes, $sql)
    {
        $x = 0;
        foreach($indexes as $index)
        {
            if($x == count($indexes) -1)
                $sql .= " {$index}";
            else
                $sql.= " {$index} ,";   
            $x++;
        }   
        return $sql;
    }
    
    public function results() { return $this->_results; }
    public function ResultCount() { return count($this->_results);}
}
?>