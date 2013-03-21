<?php
/**
 * querybuilder.class.php -- class for making SQL queries in simple manner
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
 * @package   querybuilder.class.php
 * @author    Nootan Ghimire <nootan.ghimire@gmail.com>
 * @copyright 2012 Nootan Ghimire
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      http://www.facebook.com/nootan.ghimire
 */
 
 /**
   * Description of the class
   * ========================
   *
   * This class eases the necessity of typing whole queries in any of your php-application.
   * It makes query building simple, and less error- prone
   * Currently it is limited to writing MySQL queries
   * In future, it may have features like writing queries for other SQLs
   *
 */

class querybuilder{	

	protected $build_type, $QType=">MySQL5", $lastQueryBuild;
	
	public function __construct($b_ty) {
		if(isset($b_ty)){
			$this->build_type=$b_ty;
		}
		else {
			$this->build_type="normal";
		}
	}
	/*
	Setting QueryType. After Extending, we can write syntax according to
	the DB we use such as MYSQL, SQL and other things.
	No current use
	*/
	protected function setQueryType($type) {
	$this->QType=$type;	
	}
	
	public function MakeInsertQuery($table, $values){
		if($this->build_type=="strict"){
			$hold_q="INSERT INTO `".$table."`".$values.";";
		}
		else{
			$hold_q="INSERT INTO ".$table." ".$values.";";
		}
		//values example: $values="VALUES(<NULL> or <value>, <other_var>, <other_var>, <other_var>...)";
		$this->lastQueryBuild=$hold_q;
		
	}
	public function MakeSelectQuery($table, $condition, $show_vars){
		if($this->build_type=="strict"){
			$hold_q="SELECT ".$show_vars." FROM `".$table."` WHERE ".$condition.";";
		}
		else {
			$hold_q="SELECT ".$show_vars." FROM ".$table." WHERE ".$condition.";";
		}
		$this->lastQueryBuild=$hold_q;
	}
	public function MakeBlindSelect($table, $show_vars, $extra){
		if($this->build_type=="strict"){
			$hold_q="SELECT ".$show_vars." FROM `".$table." ".$extra.";";
		}
		else {
			$hold_q="SELECT ".$show_vars." FROM ".$table." ".$extra.";";
		}
		$this->lastQueryBuild=$hold_q;
		
	}
	public function MakeUpdateQuery($table, $set, $condition){
		if($this->build_type=="strict"){
			$hold_q="UPDATE `".$table."` SET ".$set." WHERE ".$condition.";";
		}
		else {
			$hold_q="UPDATE ".$table." SET ".$set." WHERE ".$condition.";";
		}
		//Call as: MakeUpdateQuery("table","foo=bar","foo1=bar1");
		$this->lastQueryBuild=$hold_q;
	}
	
	public function getLastQuery(){
		return $this->lastQueryBuild;
	}
	
	public function setBuildType($new_type){
		$this->build_type=$new_type;				
	}
	
	public function ShowQueryType(){
		return $this->QType;
	}
	/*
	> Sets Default values and clears last build query
	*/
	public function SetDefault() {
		$this->QType=">MySQL5";		
		$this->build_type="normal";
		$this->lastQueryBuild="";
	}
}



?>
