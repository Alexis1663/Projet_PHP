<?php

class Connection extends PDO
{

    private $stmt;

    /**
    * generate a new connection
    *
    * @param $dns : data source name
    * @param $username : name of the database’s admin
    * @param $password : admin’s password of the database
    *
    * @return void
    **/

    public function __construct(string $dns, string $username, string $password)
    {
        parent::__construct($dns, $username, $password);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
    * execute a query to get values
    *
    * @return bool : success or not from the request
    **/
    public function executeQuery(string $query, array $parameters = []): bool
    {
        $this->stmt = parent::prepare($query);
        foreach ($parameters as $name => $value) {
            $this->stmt->bindValue($name, $value[0], $value[1]);
        }
        return $this->stmt->execute();
    }

    /**
    * get the results of an execute query
    *
    * @return array : list of results
    **/
    public function getResults(): array
    {
        return $this->stmt->fetchall();
    }
}
