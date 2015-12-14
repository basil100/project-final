<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 11/24/15
 * Time: 6:14 PM
 */

namespace Notes\Db\Adapter;


class PdoAdapter implements RdbmsAdapterInterface
{
    /** @var  string */
    protected $dsn;
    /** @var  string */
    protected $password;
    /** @var  \PDO */
    protected $pdo;
    /** @var  string */
    protected $username;

    public function __construct($dsn, $username, $password) {
        $this->dsn = $dsn;
        $this->password = $password;
        $this->username = $username;
    }


    public function connect()
    {
        // TODO: Implement connect() method.
        try {
            $this->pdo = new \PDO($this->dsn, $this->username, $this->password );
            return true;
        }
        catch(\PDOException $e) {
            throw new \Exception($e->getMessage());
        }


    }

    public function close()
    {
        // TODO: Implement close() method.
        $this->pdo = null;
        return $this->pdo;
    }

    public function delete($table, $criteria = [])
    {
        // TODO: Implement delete() method.
        try {
            $this->connect();
            $statement = $this->pdo->prepare("DELETE FROM users WHERE userId = ?");
            // for cascading things
            $statement2 = $this->pdo->prepare("DELETE FROM notes WHERE userId = ?");

            if($table == 'notes') {
                $statement = $this->pdo->prepare("DELETE FROM notes WHERE noteId = ?");
                $statement->execute($criteria);
                return true;
            }

            $statement->execute($criteria);
            $statement2->execute($criteria);
            $this->close();
            return true;

        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function insert($table, $data = [])
    {
        // TODO: Implement insert() method.
        try {
            $this->connect();

            $statement = $this->pdo->prepare("INSERT INTO users(userId, username) VALUE(?, ?)");

            if($table == 'notes') {
                $statement = $this->pdo->prepare("INSERT INTO notes(noteId, noteTitle, noteBody, userId) VALUE(?, ?, ?, ?)");
            }
            $statement->execute($data);
            $this->close();

            return true;

        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }

    }

    public function select($table, $criteria = [])
    {
        // TODO: Implement select() method.
        try {
            $this->connect();
            if($table == 'notes') {
                $statement = $this->pdo->prepare("SELECT * FROM notes WHERE noteId = ?");
                if(count($criteria) == 0) {
                    $statement = $this->pdo->prepare("SELECT * FROM notes");
                }

                $statement->execute($criteria);
                return $statement->fetchAll(\PDO::FETCH_ASSOC);
            }

            $statement = $this->pdo->prepare("SELECT * FROM users WHERE userId = ?");
            if(count($criteria) == 0) {
                $statement = $this->pdo->prepare("SELECT * FROM users");
            }

            $statement->execute($criteria);
            $this->close();
            return $statement->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function sql($sql, $data = [])
    {
        // TODO: Implement sql() method.
        try {
            $this->connect();
            $statement = $this->pdo->prepare($sql);
            $statement->execute($data);
            $this->close();
            return true;

        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function update($table, $data = [])
    {
        // TODO: Implement update() method.
        try {
            $this->connect();
            $statement = $this->pdo->prepare("UPDATE users SET username =? WHERE userId =?");
            if($table == 'notes') {
                $statement = $this->pdo->prepare("UPDATE notes SET noteTitle =?, noteBody =? WHERE noteId =?");
            }

            $statement->execute($data);
            $this->close();
            return true;

        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
