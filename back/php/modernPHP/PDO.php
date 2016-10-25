<?php
/**
 * Created by PhpStorm.
 * User: mal@chuchujie.com
 * Date: 2015/10/16
 * Time: 11:14
 */

class Db
{
	static public $db = array();
	private $config;
	private $pdo;
	private $operate;
	private $sQuery;
	private $parameters;
	private $lastQuery;
	private $sqlSegments = array(
		'flags' => array(),
		'field' => array(),
		'join' => array(),
		'where' => array(),
		'table' => array(),
		'groupBy' => array(),
		'having' => array(),
		'orderBy' => array(),
		'limit' => array(),
		'forUpdate' => false,
		'params' => array(),
	);

	static public function getInstance($config = null) {
		if (!self::$db) {
			self::$db = new self($config);
		}
		return self::$db;
	}
	public function setMaster($config) {
		$this->config['master'] = $config;
	}
	public function setSlaves($config) {
		$hash = md5(serialize($config));
		$this->config['slaves'][$hash] = $config;
	}
	public function __construct($config = null) {
		if (!is_null($config)) {
			$this->config = $config;
		}

		$this->parameters = array();
	}
	private function connect($master = false) {
		if (
			$master == false
			&& $this->operate == 'slaves'
			&& isset($this->config['slaves'])
		) {
			$this->operate = 'slaves';
			$index = array_rand($this->config['slaves']);
			$config =$this->config['slaves'][$index];
		} else {
			$this->operate = 'master';
			$config = $this->config['master'];
		}
		try {
			if ( !(
				isset($config['host'])
				&& isset($config['dbname'])
				&& isset($config['username'])
				&& isset($config['password'])
			)) {
				throw new \PDOException('db config is error');
			}
			!isset($config['port']) && $config['port'] = 3306;
			$dsn = 'mysql:dbname='.$config['dbname'].';host='.$config['host'].';port='.$config['port'];
			if (!isset($this->pdo[$this->operate])) {
				$this->pdo[$this->operate] = new \PDO($dsn, $config['username'], $config['password'], array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
				$this->pdo[$this->operate]->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
				$this->pdo[$this->operate]->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
			}
		}
		catch (\PDOException $e) {
			$this->logException($e);
		}
	}
	public function closeConnection() {
		$this->pdo[$this->operate] = null;
	}
	private function Init($query,$parameters = '',$master = false) {
		$this->connect($master);
		try {
			$this->sQuery = $this->pdo[$this->operate]->prepare($query);
			$this->bindMore($parameters);
			if(!empty($this->parameters)) {
				//print_r($this->parameters);
				foreach($this->parameters as $param){
					$parameters = explode("\x7F",$param);
					$this->sQuery->bindParam($parameters[0],$parameters[1]);
				}
			}
			$this->succes  = $this->sQuery->execute();
		}
		catch(\PDOException $e){
			$this->logException($e, $query);
		}
		$this->parameters = array();
	}
	private function lastSql($query = '',$parameters = null){
		if (!is_null($parameters)){
			$indexed = $parameters == array_values($parameters);
			foreach($parameters as $k=>$v) {
				if(is_string($v)) $v="'$v'";
				if($indexed) $query=preg_replace('/\?/',$v,$query,1);
				else $query = str_replace(":$k",$v,$query);
			}
		}
		$this->lastQuery = $query;
		return $query;
	}
	public function getLastQuery() {
		return $this->lastQuery;
	}
	public function master($operate = true) {
		if ($operate == true) {
			$this->operate = 'master';
		} else {
			$this->operate = 'slaves';
		}
		return $this;
	}
	public function bind($para, $value) {
		if(is_string($para)) {
			$this->parameters[sizeof($this->parameters)] = ":" . $para . "\x7F" . $value;
		} else {
			$this->parameters[sizeof($this->parameters)] = $para . "\x7F" . $value;
		}
	}
	public function bindMore($parray) {
		if(empty($this->parameters) && is_array($parray)) {
			$columns = array_keys($parray);
			foreach($columns as $i => &$column)	{
				$this->bind($column, $parray[$column]);
			}
		}
	}
	public function query($query,$params = null,$fetchmode = \PDO::FETCH_ASSOC) {
		if (is_null($params)) {
			$params = $this->sqlSegments['params'];
			$this->initSqlSegment();
		}
		$query = trim($query);
		$rawStatement = explode(' ', $query);
		$statement = strtolower($rawStatement[0]);
		$this->lastSql($query,$params);
		if ($statement === 'select' || $statement === 'show') {
			$this->Init($query,$params,false);
			return isset($this->sQuery)?$this->sQuery->fetchAll($fetchmode):null;
		}
		elseif ( $statement === 'insert' ||  $statement === 'update' || $statement === 'delete' ) {
			$this->Init($query,$params,true);
			return isset($this->sQuery)?$this->sQuery->rowCount():null;
		}
		else {
			return NULL;
		}
	}
	public function lastInsertId() {
		return $this->pdo[$this->operate]->lastInsertId();
	}
	public function column($query,$params = null) {
		$this->Init($query,$params,false);
		$columns = $this->sQuery->fetchAll(\PDO::FETCH_NUM);

		$column = null;

		foreach($columns as $cells) {
			$column[] = $cells[0];
		}

		return $column;
	}
	public function row($query,$params = null,$fetchmode = \PDO::FETCH_ASSOC) {
		$this->Init($query,$params,false);
		return $this->sQuery->fetch($fetchmode);
	}
	public function single($query,$params = null) {
		$this->Init($query,$params,false);
		return $this->sQuery->fetchColumn();
	}
	public function beginTransaction() {
		$this->operate = 'master';
		$this->pdo[$this->operate]->beginTransaction();
	}
	public function commit() {
		$this->pdo[$this->operate]->commit();
	}
	public function rollBack() {
		//if ($this->pdo[$this->operate]->beginTransaction()) {
		$this->pdo[$this->operate]->rollBack();
		//}
	}
	private function logException($e, $sql = ""){
		$exception  = 'Unhandled Exception. '.PHP_EOL;
		$exception .= $e->getMessage();
		$exception .= PHP_EOL . "You can find the error back in the log.".PHP_EOL;
		if(!empty($sql)) {
			$message .= "\r\nRaw SQL : "  . $sql;
		}
		throw $e;
		//$this->log->write($message);
		//return $exception;
	}
	private function initSqlSegment() {
		$this->sqlSegments = array(
			'flags' => array(),
			'field' => array(),
			'join' => array(),
			'where' => array(),
			'table' => array(),
			'groupBy' => array(),
			'having' => array(),
			'orderBy' => array(),
			'limit' => array(),
			'forUpdate' => false,
			'params' => array(),
		);
	}
	public function table($name = '',$alias = null){
		$this->sqlSegments['table'][] = array('name'=>$name,'alias'=>$alias);
		return $this;
	}
	public function field($fields = '*') {
		if (is_string($fields)) {
			$fields = explode(',',$fields);
			$this->sqlSegments['field'] += $fields;
		} else {
			$this->sqlSegments['field'] += $fields;
		}
		return $this;
	}
	public function join($name,$conditionA = null,$logic = null,$conditionB = null){
		$this->addBuildJoin(null,$name,$conditionA,$logic,$conditionB);
		return $this;
	}
	public function leftJoin($name,$conditionA = null,$logic = null,$conditionB = null){
		$this->addBuildJoin('LEFT',$name,$conditionA,$logic,$conditionB);
		return $this;
	}
	public function rightJoin($name,$conditionA = null,$logic = null,$conditionB = null){
		$this->addBuildJoin('RIGHT',$name,$conditionA,$logic,$conditionB);
		return $this;
	}
	public function innerJoin($name,$conditionA = null,$logic = null,$conditionB = null){
		$this->addBuildJoin('INNER',$name,$conditionA,$logic,$conditionB);
		return $this;
	}
	public function crossJoin($name,$conditionA = null,$logic = null,$conditionB = null){
		$this->addBuildJoin('CROSS',$name,$conditionA,$logic,$conditionB);
		return $this;
	}
	public function where($key,$val = null){
		$this->addBuildClause('where',$key,$val,'AND');
		return $this;
	}
	public function orWhere($key,$val = null){
		$this->addBuildClause('where',$key,$val,'OR');
		return $this;
	}
	public function flag($flag){
		$this->sqlSegments['flags'][] = $flag;
	}
	public function groupBy($fields = '') {
		if (is_string($fields)) {
			$fields = explode(',',$fields);
			$this->sqlSegments['groupBy'] += $fields;
		} else {
			$this->sqlSegments['groupBy'] += $fields;
		}
		return $this;
	}
	public function orderBy($fields = '') {
		if (is_string($fields)) {
			$fields = explode(',',$fields);
			foreach($fields as &$val) {
				$seg = explode(' ',trim($val,' '));
				$sort = (isset($seg[1]))?(strtolower($seg[1]) == 'desc')?' DESC':' ASC':'';
				$val = $this->buildIdent($seg[0]) . $sort;
			}
			$this->sqlSegments['orderBy'] += $fields;
		} else {
			$this->sqlSegments['orderBy'] += $fields;
		}
		return $this;
	}
	public function having($key,$val = null,$op = 'AND'){
		$this->addBuildClause('having',$key,$val,$op);
		return $this;
	}
	public function limit($a,$b = null) {
		if($b == null) {
			$limit = explode(',',$a);
			if (count($limit) ==2) {
				$this->sqlSegments['limit']['limit'] = $limit[1];
				$this->sqlSegments['limit']['offset'] = $limit[0];
			} else {
				$this->sqlSegments['limit']['limit'] = $limit[0];
			}
		} else {
			$this->sqlSegments['limit']['limit'] = (int) $b;
			$this->sqlSegments['limit']['offset'] = (int) $a;
		}
		return $this;
	}
	public function offset($offset) {
		$this->sqlSegments['limit']['offset'] = (int) $offset;
		return $this;
	}
	public function lock() {
		$this->sqlSegments['forUpdate'] = true;
		return $this;
	}
	public function union($union){
		$this->sqlSegments['union'][] = $union;
		return $this;
	}
	public function get(){
		$query = $this->buildSelect();
		return $this->query($query);
	}
	public function insert($data) {
		$this->sqlSegments['field'] = $data;
		$query = $this->buildInsert();
		return $this->query($query);
	}
	public function update($data) {
		$this->sqlSegments['field'] = $data;
		$query = $this->buildUpdate();
		return $this->query($query);
	}
	public function delete() {
		$query = $this->buildDelete();
		return $this->query($query);
	}
	private function buildIdent($name ='') {
		return '`'. str_replace('.', '`.`', $name) .'`';
	}
	private function buildPlaceholder($data,$placeholder = '?',$separator =','){
		return implode($separator,array_fill(1,count($data),$placeholder));
	}
	private function buildPairKV($data,$placeholder = ' = ',$separator =',',$key = null,$val = null){
		$content = array();
		foreach($data as $k => $v) {
			array_push($content,$this->buildIdent(($key)?$key:$k) . $placeholder .(($val)?$val:$v));
		}
		return implode($separator,$content);
	}
	private function buildTable(){
		if (!is_array($this->sqlSegments['table']) || count($this->sqlSegments['table']) <1) {
			throw new \Exception('please set a table name use table() function!');
		}
		$tables = array();
		foreach($this->sqlSegments['table'] as $table) {
			if (is_callable($table['name'])) {
				$subQuery = clone($this);
				$subQuery->initSqlSegment();
				call_user_func_array($table['name'],array($subQuery));
				$tableName ='(' . $subQuery->buildSelect() . ')';
				$this->buildBindParams($subQuery->sqlSegments['params']);
			} else {
				$tableName = $this->buildIdent($table['name']);
			}
			if ($table['alias']) {
				$tableName .= ' AS '.$this->buildIdent($table['alias']);
			}
			array_push($tables,$tableName);
		}
		return ' '.implode(',',$tables);
	}
	private function buildFlags() {
		if (! $this->sqlSegments['flags']) {
			return '';
		}
		return ' ' . implode(' ',$this->sqlSegments['flags']);
	}
	private function buildField(){
		if (empty($this->sqlSegments['field'])) {
			return ' *';
		} else {
			return ' '.implode(',',$this->sqlSegments['field']);
		}
	}
	private function addBuildClause($type,$key,$val,$logic){
		if(is_callable($key)){
			$this->sqlSegments[$type][] = array('(', null, $logic);
			call_user_func_array($key,array($this));
			$this->sqlSegments[$type][] = array(')', null, $logic);
		} else {
			$this->sqlSegments[$type][] = array($key, $val, $logic);
		}
	}
	private function buildClause($type){
		$sql = '';
		foreach ($this->sqlSegments[$type] as $k =>$clause) {
			if ($clause[0] == '(' ) {
				$sql .= ' ' . strtolower($clause[2]) . ' ' . $clause[0];
			} else if($clause[0] == ')'){
				$sql .= ' ' . $clause[0];
			} else {
				if($k == 0 || substr($sql,-1) == '(') {
					$sql .= ' ' .$this->buildClauseAndBind($clause[0],$clause[1]);
				} else {
					$sql .= ' ' . strtolower($clause[2]) . ' ' .$this->buildClauseAndBind($clause[0],$clause[1]);
				}
			}
		}
		//echo $sql;
		return !empty($sql)?' WHERE'.$sql:'';
	}
	protected function buildClauseAndBind($key,$value){
		preg_match('/\[(\>|\<|\<\>|\!\=|\=|\~|\!\~|like|!like|in|!in|exists|!exists|#)\]?([a-zA-Z0-9_.\-\=\s\?\(\)]*)/',$key,$match);
		if (!$match) {
			$context = '`'. str_replace('.', '`.`', $key) .'` = ?';
			$this->buildBindParams($value);
		} else {
			switch ($match[1]) {
				case '~':
				case 'like':
					$context = '`'. str_replace('.', '`.`', $match[2]) .'` LIKE ?';
					$this->buildBindParams($value);
					break;
				case '!~':
				case '!like':
					$context = '`'. str_replace('.', '`.`', $match[2]) .'` NOT LIKE ?';
					$this->buildBindParams($value);
					break;
				case '>':
					$context = '`'. str_replace('.', '`.`', $match[2]) .'` > ?';
					$this->buildBindParams($value);
					break;
				case '<':
					$context = '`'. str_replace('.', '`.`', $match[2]) .'` < ?';
					$this->buildBindParams($value);
					break;
				case '<':
					$context = '`'. str_replace('.', '`.`', $match[2]) .'` < ?';
					$this->buildBindParams($value);
					break;
				case '<>':
				case '!=':
					$context = '`'. str_replace('.', '`.`', $match[2]) .'` != ?';
					$this->buildBindParams($value);
					break;
				case '=':
					$context = '`'. str_replace('.', '`.`', $match[2]) .'` = ?';
					$this->buildBindParams($value);
					break;
				case 'in':
					$context = '`'. str_replace('.', '`.`', $match[2]) .'` IN(' . $this->buildPlaceholder($value) . ')';
					$this->buildBindParams($value);
					break;
				case '!in':
					$context = '`'. str_replace('.', '`.`', $match[2]) .'` NOT IN(' . $this->buildPlaceholder($value) . ')';
					$this->buildBindParams($value);
					break;
				case 'exists':
					if (is_callable($value)) {
						$subQuery = clone($this);
						$subQuery->initSqlSegment();
						call_user_func_array($value,array($subQuery));
						$context ='EXISTS(' . $subQuery->buildSelect() . ')';
						$this->buildBindParams($subQuery->sqlSegments['params']);
					} else {
						$context ='EXISTS(' . $value . ')';
					}
					break;
				case '!exists':
					if (is_callable($value)) {
						$subQuery = clone($this);
						$subQuery->initSqlSegment();
						call_user_func_array($value,array($subQuery));
						$context ='NOT EXISTS(' . $subQuery->buildSelect() . ')';
						$this->buildBindParams($subQuery->sqlSegments['params']);
					} else {
						$context ='NOT EXISTS(' . $value . ')';
					}
					break;
				case '#':
					$context = $match[2];
					$this->buildBindParams($value);
					break;
			}
		}

		return $context;
	}
	private function buildBindParams($value){
		if (is_array($value)) {
			foreach ($value as $val) {
				$this->sqlSegments['params'][sizeof($this->sqlSegments['params'])+1] = $val;
			}
		} else {
			$this->sqlSegments['params'][sizeof($this->sqlSegments['params'])+1] = $value;
		}
	}
	private function buildGroupBy() {
		if (empty($this->sqlSegments['groupBy'])) {
			return '';
		} else{
			return ' GROUP BY '.implode(',',$this->sqlSegments['groupBy']);
		}
	}
	private function buildOrderBy() {
		if (empty($this->sqlSegments['groupBy'])) {
			return '';
		} else{
			return ' ORDER BY '.implode(',',$this->sqlSegments['orderBy']);
		}
	}
	private function buildLimit() {
		if (empty($this->sqlSegments['limit'])) {
			return '';
		} else{
			$sql = isset($this->sqlSegments['limit']['limit']) ? ' LIMIT ' . (int) $this->sqlSegments['limit']['limit']:'';
			$sql .= isset($this->sqlSegments['limit']['offset']) ? ' OFFSET ' . (int) $this->sqlSegments['limit']['offset']:'';
			return $sql;
		}
	}
	private function buildUnion() {
		if (empty($this->sqlSegments['union'])) {
			return '';
		} else {
			$context = '';
			foreach($this->sqlSegments['union'] as $union) {
				if (is_callable($union)) {
					$subQuery = clone($this);
					$subQuery->initSqlSegment();
					call_user_func_array($union,array($subQuery));
					$context .=' UNION(' . $subQuery->buildSelect() . ')';
					$this->buildBindParams($subQuery->sqlSegments['params']);
					unset($subQuery);
				} else {
					$context .=' UNION(' . $union . ')';
				}
			}
			return $context;
		}
	}
	private function buildForUpdate(){
		return ($this->sqlSegments['forUpdate'])?' FOR UPDATE':'';
	}
	private function buildSelect() {
		return 'SELECT'
		. $this->buildFlags()
		. $this->buildField()
		. ' FROM'
		. $this->buildTable()
		. $this->buildJoin()
		. $this->buildClause('where')
		. $this->buildGroupBy()
		. $this->buildClause('having')
		. $this->buildOrderBy()
		. $this->buildLimit()
		. $this->buildUnion()
		. $this->buildForUpdate();
	}
	private function buildValuesForInsert() {
		$sql = ' (';
		$data = $this->sqlSegments['field'];
		if (count($data) == count($data, 1)) {
			$sql .= '`' . implode('`,`',array_keys($data)) .'`' .') VAlUES';
			$sql .= ' (' . $this->buildPlaceholder($data) . ')';
			foreach($data as $v) {
				$this->buildBindParams($v);
			}
		} else {
			$structure = current($data);
			$sql .= '`' . implode('`,`',array_keys($structure)) .'`' .') VAlUES';
			$placeholder = ' (' . $this->buildPlaceholder($structure) . ')';
			$sql .= $this->buildPlaceholder($data,$placeholder,',');
			foreach($data as $v) {
				foreach ($v as $val){
					$this->buildBindParams($val);
				}
			}
		}
		return $sql;
	}
	private function buildReturning() {
		return empty($this->sqlSegments['returning']) ? '':' RETURNING' . $this->buildIdent($this->sqlSegments['returning']);
	}
	private function buildInsert(){
		return 'INSERT'
		. $this->buildFlags()
		. " INTO "
		. $this->buildTable()
		. $this->buildValuesForInsert()
		. $this->buildReturning();
	}
	private function buildValuesForUpdate() {
		$data = $this->sqlSegments['field'];
		if (empty($data)){
			return '';
		}
		$sql = ' SET '.$this->buildPairKV($data,' = ',',',null,'?');
		foreach($data as $v) {
			$this->buildBindParams($v);
		}
		return $sql;
	}
	private function buildUpdate(){
		return 'UPDATE'
		. $this->buildFlags()
		. $this->buildTable()
		. $this->buildValuesForUpdate()
		. $this->buildClause('where')
		. $this->buildOrderBy()
		. $this->buildLimit()
		. $this->buildReturning();
	}
	private function buildDelete() {
		return 'DELETE'
		. $this->buildFlags()
		. ' FROM'
		. $this->buildTable()
		. $this->buildClause('where')
		. $this->buildOrderBy()
		. $this->buildLimit()
		. $this->buildReturning();
	}
	private function addBuildJoin($type = null,$name,$conditionA = null,$logic = null,$conditionB = null){
		$index = sizeof($this->sqlSegments['join']);
		$this->sqlSegments['join'][$index]['type'] = strtoupper($type);
		$table = explode(' ',trim($name));
		$count = count($table);
		$this->sqlSegments['join'][$index]['table'] = $table[0];
		if ($count == 2) {
			$this->sqlSegments['join'][$index]['alias'] = $table[1];
		} else if ($count == 3){
			$this->sqlSegments['join'][$index]['alias'] = $table[2];
		}
		$this->sqlSegments['join'][$index]['logic'] = $logic;
		$this->sqlSegments['join'][$index]['conditionA'] = $conditionA;
		$this->sqlSegments['join'][$index]['conditionB'] = $conditionB;
	}
	private function buildJoin() {
		//left join `tab2` as `t1` ON `tab2`.`id` = `tab1`.`uid`
		if (empty($this->sqlSegments['join'])) {
			return '';
		}
		foreach ($this->sqlSegments['join'] as $join){
			$sql = isset($join['type'])?' ' . $join['type']:'';
			$sql .= ' JOIN';
			if (isset($join['alias'])) {
				$sql .= ' ' .$this->buildIdent($join['table']) . ' AS ' . $this->buildIdent($join['alias']);
			} else {
				$sql .= ' ' .$this->buildIdent($join['table']);
			}
			if (isset($join['conditionA']) && isset($join['conditionB'])) {
				$sql .= ' ON ' . $this->buildIdent($join['conditionA']) . $join['logic'] . $this->buildIdent($join['conditionB']);

			}
		}
		return $sql;
	}
}