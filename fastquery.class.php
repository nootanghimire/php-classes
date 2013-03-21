<?php
/**
 * fastquery.class.php -- class for fast query processing
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category  Core_Classes
 * @package   Feed.class.php
 * @author    Nootan Ghimire <nootan.ghimire@gmail.com>
 * @copyright 2012 Nootan Ghimire
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      http://www.facebook.com/nootan.ghimire
 */

class FastQuery{
    protected $lastQuery, $QueryStatus, $rowID, $lastError, $affectedRows, $db_res, $db_data;

    function executeQuery($query){
        $config=$_SERVER['DOCUMENT_ROOT']."/core/configs/db_config.php";
        include_once $config;
        $db_handle=new MySQLi();
		$db_handle->connect(DB_HOST, DB_USER,DB_PASS,DB_NAME);
		
		if($result = $db_handle->query($query)) {
		
			$this->QueryStatus=true;
			$this->rowID=$db_handle->insert_id;
			$this->affectedRows=$db_handle->affected_rows;
			
			if(is_object($result)) { 
			$this->db_data= $result->fetch_array();
			}
			
		} else {
			$this->QueryStatus=false;
			$this->lastError=$db_handle->error;
		
		}
		
    }
	function getLastQueryResource(){
		return $this->lastQuery;	
	}
	function getRowID(){
		return $this->rowID;
	}
	function getQueryStat(){
		return $this->QueryStatus;
	}
	function getLastError(){
	    return $this->lastError;
	}
	function getAffectedRows(){
		return $this->affectedRows;	
	}
	function getField($FieldName){
		$data = $this->db_data[$FieldName];
		return $data;
	}

}
?>
