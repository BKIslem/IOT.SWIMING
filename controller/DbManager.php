<?php


class DBManager
{
    private $db;
    private static $instance = null;
    private static  $settings;
    private $sQuery;
    private $parameters;

    /**
     * DBManager constructor
     */
    private function __construct() {
        try{
            $param = parse_ini_file(__DIR__."/../config/db.ini");
            $this->db = new PDO("mysql:host=".$param['host'].";port=".$param['port'].";dbname=".$param['dbname'],
                $param['user'],
                $param['password']);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->exec("set names utf8");
        } catch (PDOException $e) { return $e->getMessage(); }
    }

    /**
     * Get instance
     * @return DBManager|null
     */
    public static function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new DBManager();
        }

        return self::$instance;
    }

    /**
     * Get connection
     * @return PDO
     */
    public function getConnection()
    {
        return $this->db;
    }

    /**
     *  Magic method clone is empty to prevent duplication of connection
     */
    public function __clone(){
        throw new Exception("Can't clone a singleton");
    }

    /**
     *
     * @return DbConn
     */
    public function initConnection(){
        self::$settings = parse_ini_file(ROOT . "/config/db.ini");
        $dsn = 'mysql:dbname=' .   self::$settings["dbname"] . ';host=' .   self::$settings["host"] . '';
        try {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            # Read settings from INI file, set UTF8

            $this->db = new PDO($dsn,  self::$settings["user"],   self::$settings["password"], array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));

            # We can now log any exceptions on Fatal error.
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            # Disable emulation of prepared statements, use REAL prepared statements instead.
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            return    $this->db;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }


    /**
     *    Every method which needs to execute a SQL query uses this method.
     *
     *    1. If not connected, connect to the Database.
     *    2. Prepare Query.
     *    3. Parameterize Query.
     *    4. Execute Query.
     *    5. On exception : Write Exception into the log + SQL query.
     *    6. Reset the Parameters.
     */
    private function Init($query, $parameters = ""){
        if ( (empty($this->db))) {
            $this->db = self::initConnection();
        }
        # Connect to Database

        try {
            # Prepare query
            $this->sQuery = $this->db->prepare($query);

            # Add parameters to the parameter array
            $this->bindMore($parameters);

            # Bind parameters
            if (!empty($this->parameters)) {
                foreach ($this->parameters as $param => $value) {
                    if (is_int($value[1])) {
                        $type = PDO::PARAM_INT;
                    } else if (is_bool($value[1])) {
                        $type = PDO::PARAM_BOOL;
                    } else if (is_null($value[1])) {
                        $type = PDO::PARAM_NULL;
                    } else {
                        $type = PDO::PARAM_STR;
                    }
                    // Add type when binding the values to the column
                    $this->sQuery->bindValue($value[0], $value[1], $type);
                }
            }

            # Execute SQL
            $this->sQuery->execute();
        } catch (PDOException $e) {
            # Write into log and display Exception
            echo $this->ExceptionLog($e->getMessage(), $query);
            die();
        }

        # Reset the parameters
        $this->parameters = array();
    }

    /**
     * @void
     * Add the parameter to the parameter array
     * @param string $para
     * @param string $value
     */
    public function bind($para, $value){
        $this->parameters[sizeof($this->parameters)] = [":" . $para, $value];
    }

    /**
     * @void
     * Add more parameters to the parameter array
     * @param array $parray
     */
    public function bindMore($parray){
        if (empty($this->parameters) && is_array($parray)) {
            $columns = array_keys($parray);
            foreach ($columns as $i => &$column) {
                $this->bind($column, $parray[$column]);
            }
        }
    }

    /**
     *  If the SQL query  contains a SELECT or SHOW statement it returns an array containing all of the result set row
     *  If the SQL statement is a DELETE, INSERT, or UPDATE statement it returns the number of affected rows
     * @param  string $query
     * @param  array $params
     * @param  int $fetchmode
     * @return mixed
     */
    public function query($query, $params = null, $fetchmode = PDO::FETCH_ASSOC){

        try {
            if (empty($this->db)) {
                $this->db = self::initConnection();
            }
            $query = trim(str_replace("\r", " ", $query));

            $this->Init($query, $params);

            $rawStatement = explode(" ", preg_replace("/\s+|\t+|\n+/", " ", $query));

            # Which SQL statement is used
            $statement = strtolower($rawStatement[0]);

            if ($statement === 'select' || $statement === 'show') {
                return $this->sQuery->fetchAll($fetchmode);
            } elseif ($statement === 'insert' || $statement === 'update' || $statement === 'delete') {
                return $this->sQuery->rowCount();
            } else {
                return NULL;
            }
        } catch (PDOException $e) {
            # Write into log and display Exception
            echo $this->ExceptionLog($e->getMessage(), $query);
            die();
        }
    }


    /**
     * @param $query
     * @param null $params
     * @param int $fetchmode
     * @return null
     */
    public function rowCount($query, $params = null, $fetchmode = PDO::FETCH_ASSOC){
        $query = trim(str_replace("\r", " ", $query));

        $this->Init($query, $params);

        $rawStatement = explode(" ", preg_replace("/\s+|\t+|\n+/", " ", $query));

        # Which SQL statement is used
        $statement = strtolower($rawStatement[0]);

        if ($statement === 'select' || $statement === 'show') {
            return $this->sQuery->rowCount();
        } elseif ($statement === 'insert' || $statement === 'update' || $statement === 'delete') {
            return $this->sQuery->rowCount();
        } else {
            return NULL;
        }
    }

    /**
     *  Returns the last inserted id.
     * @return string
     */
    public function lastInsertId(){
        return $this->db->lastInsertId();
    }

    /**
     * Starts the transaction
     * @return boolean, true on success or false on failure
     */
    public function beginTransaction(){
        return $this->db->beginTransaction();
    }

    /**
     *  Execute Transaction
     * @return boolean, true on success or false on failure
     */
    public function executeTransaction(){
        return $this->db->commit();
    }

    /**
     *  Rollback of Transaction
     * @return boolean, true on success or false on failure
     */
    public function rollBack(){
        return $this->db->rollBack();
    }

    /**
     *  Returns an array which represents a column from the result set
     * @param  string $query
     * @param  array $params
     * @return array
     */
    public function column($query, $params = null){
        $this->Init($query, $params);
        $Columns = $this->sQuery->fetchAll(PDO::FETCH_NUM);

        $column = null;

        foreach ($Columns as $cells) {
            $column[] = $cells[0];
        }

        return $column;

    }

    /**
     * Returns an array which represents a row from the result set
     * @param  string $query
     * @param  array $params
     * @param  int $fetchmode
     * @return array
     */
    public function row($query, $params = null, $fetchmode = PDO::FETCH_ASSOC){
        $this->Init($query, $params);
        $result = $this->sQuery->fetch($fetchmode);
        $this->sQuery->closeCursor(); // Frees up the connection to the server so that other SQL statements may be issued,
        return $result;
    }

    /**
     *  Returns the value of one single field/column
     * @param  string $query
     * @param  array $params
     * @return string
     */
    public function single($query, $params = null){

        $this->Init($query, $params);
        $result = $this->sQuery->fetchColumn();
        $this->sQuery->closeCursor(); // Frees up the connection to the server so that other SQL statements may be issued
        return $result;
    }

    /**
     * Writes the log and returns the exception
     * @param  string $message
     * @param  string $sql
     * @return string
     */
    private function ExceptionLog($message, $sql = ""){
        $exception = 'Unhandled Exception. <br />';
        $exception .= $message;
        $exception .= "<br /> You can find the error back in the log.";

        if (!empty($sql)) {
            # Add the Raw SQL to the Log
            $message .= "\r\nRaw SQL : " . $sql;
        }
        # Write into log
        $this->log->write($message);

        return $exception;
    }

    /**
     * Select data from database
     * @param $sql
     * @param array $array
     * @param int $fetchMode
     * @return mixed
     */
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC){

        try {
            if ( (empty($this->db))) {
                $this->db = self::initConnection();
            }
            $sth = $this->db->prepare($sql);
            foreach ($array as $key => $value) {
                $sth->bindValue("$key", $value);
            }
            if (!$sth->execute()) {
                $this->handleError();
            } else {
                return $sth->fetchAll($fetchMode);
            }
        } catch (PDOException $e) {
            # Write into log
            echo $this->ExceptionLog($e->getMessage());
            die();
        }
    }

    /**
     * @param $sql
     * @param array $array
     * @param int $fetchMode
     * @return mixed
     */
    public function selectById($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC){
        try {
            if ( (empty($this->db))) {
                $this->db = self::initConnection();
            }
            $sth = $this->db->prepare($sql);
            $sth->execute();
            return $sth->fetch();
        } catch (PDOException $e) {
            # Write into log
            echo $this->ExceptionLog($e->getMessage());
            die();
        }
    }

    /**
     * insert to database
     * @param $table
     * @param $data
     * @return bool
     */
    public function insert($table, $data){
        try {
            if ( (empty($this->db))) {
                $this->db =self::initConnection();
            }

            ksort($data);
            $fieldNames = implode('`, `', array_keys($data));
            $fieldValues = ':' . implode(', :', array_keys($data));

            $sth = $this->db->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");

            foreach ($data as $key => $value) {
                $sth->bindValue(":$key", $value);
            }

            if (!$sth->execute()) {
                $this->handleError();
            }
            return true;
        } catch (PDOException $e) {
            # Write into log
            echo $this->ExceptionLog($e->getMessage());
            die();
        }
    }

    /**
     * update in database
     * @param $table
     * @param $data
     * @param $where
     * @return bool
     */
    public function update($table, $data, $where){
        try {

            if ( (empty($this->db))) {
                $this->db = self::initConnection();
            }
            ksort($data);

            $fieldDetails = NULL;

            foreach ($data as $key => $value) {
                $fieldDetails .= "`$key`=:$key,";
            }
            $fieldDetails = rtrim($fieldDetails, ',');

            $sth = $this->db->prepare("UPDATE $table SET $fieldDetails WHERE $where");

            foreach ($data as $key => $value) {
                $sth->bindValue(":$key", $value);
            }
            if ($sth->execute()) {
                return true;
            }else return false;
        } catch (PDOException $e) {
            # Write into log
            echo $this->ExceptionLog($e->getMessage());
            die();
        }
    }

    /**
     * delete
     * @param $table
     * @param $where
     * @param int $limit
     * @return mixed
     */
    public function delete($table, $where, $limit = 1){
        try {
            if ( (empty($this->db))) {
                $this->db = self::initConnection();
            }
            return $this->db->exec("DELETE FROM $table WHERE $where LIMIT $limit");
        } catch (PDOException $e) {
            # Write into log
            echo $this->ExceptionLog($e->getMessage());
            die();
        }
    }

    /**
     * count rows
     * @param $table
     * @return mixed
     */
    public function rowsCount($table){
        try {
            if ( (empty($this->db))) {
                $this->db = self::initConnection();
            }
            $sth = $this->db->prepare("SELECT * FROM " . $table);
            $sth->execute();
            return $sth->rowCount();
        } catch (PDOException $e) {
            # Write into log
            echo $this->ExceptionLog($e->getMessage());
            die();
        }
    }

    /**
     * error check
     */
    private function handleError(){
        if ($this->errorCode() != '00000') {
            if ($this->_errorLog == true)
                echo json_encode($this->errorInfo());
            throw new Exception("Error: " . implode(',', $this->errorInfo()));
        }
    }


    /**
     * Insert in database and return last insert Id
     * @param $table
     * @param $data
     * @return mixed - last Id
     */
    public function seting($table, $data){
        try {
            if ( (empty($this->db))) {
                $this->db = self::initConnection();
            }
            ksort($data);
            $fieldNames = implode('`, `', array_keys($data));
            $fieldValues = ':' . implode(', :', array_keys($data));


            $sth = $this->db->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");

            foreach ($data as $key => $value) {
                $sth->bindValue(":$key", $value);
            }

            try {
                $sth->execute();
                $this->db->lastInsertId();
            } catch (PDOExecption $e) {
                print "Error!: " . $e->getMessage() . "</br>";
            }

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            # Write into log
            echo $this->ExceptionLog($e->getMessage());
            die();
        }
    }

    /**
     * Insert unique
     * @param $table
     * @param $vars
     * @return bool
     */
    public function insert_unique($table, $vars){
        if (count($vars)) {
            if ( (empty($this->db))) {
                $this->db =self::initConnection();
            }

            $req = "INSERT INTO `$table` (`" . join('`, `', array_keys($vars)) . "`) ";
            $req .= "SELECT '" . join("', '", $vars) . "' FROM DUAL ";
            $req .= "WHERE NOT EXISTS (SELECT 1 FROM `$table` WHERE ";

            foreach ($vars AS $col => $val)
                $req .= "`$col`='$val' AND ";

            $req = substr($req, 0, -5) . ") LIMIT 1";
            $sth = $this->db->prepare($req);
            $sth->execute() OR die();
            return $this->db->lastInsertId();
        }

        return False;
    }

    /**
     * Insert unique with specific conditions
     * @param $table
     * @param $vars
     * @return bool
     */
    public function insert_unique2($table, $vars, $where){
        if (count($vars)) {
            if ( (empty($this->db))) {
                $this->db =self::initConnection();
            }
            $req = "INSERT INTO `$table` (`" . join('`, `', array_keys($vars)) . "`) ";
            $req .= "SELECT '" . join("', '", $vars) . "' FROM DUAL ";
            $req .= "WHERE NOT EXISTS (SELECT 1 FROM `$table` WHERE ";

            foreach ($where AS $col => $val)
                $req .= "`$col`='$val' AND ";

            $req = substr($req, 0, -5) . ") LIMIT 1";

            $sth = $this->db->prepare($req);
            if($sth->execute()){
                return true;
            }
        }

        return False;
    }


}