<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 11/24/15
 * Time: 6:05 PM
 */

namespace Notes\Persistence\Entity;

use Notes\Db\Adapter\PdoAdapter;
use Faker\Provider\Uuid;
use Notes\Domain\Entity\User;
use Notes\Domain\Entity\UserRepositoryInterface;

class MysqlUserRepository implements UserRepositoryInterface
{
    /** @var  \Notes\Db\Adapter\PdoAdapter */
    protected $adapter;

    /** @var  string */
    protected $dsn;
    /** @var  string */
    protected $username;

    /** @var  string */
    protected $password;

    ///** @var  string */
    //protected $link;

    public function __construct($dsn, $username, $password) {

        $this->dsn = $dsn;
        $this->password = $password;
        $this->username = $username;
        $this->adapter = new PdoAdapter($this->dsn, $this->username, $this->password);
    }

    public function __destruct() {

        /** @var resource */
        //$this->link->close();
        $this->adapter->close();
    }

    /**
     * @param \Notes\Domain\Entity\User $user
     * @return mixed
     */
    public function add(User $user)
    {
        // TODO: Implement add() method.
        $this->adapter->insert("users", [$user->getId(), $user->getUsername()]);
    }

    /**
     * @return int
     */
    public function count()
    {
        // TODO: Implement count() method.
        return count($this->adapter->select("users"));
    }

    /**
     * @param \Notes\Domain\ValueObject\Uuid $id
     * @return mixed
     */
    public function getById(Uuid $id)
    {
        // TODO: Implement getById() method.
        return $this->adapter->select("users", [$id->__toString()]);
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        // TODO: Implement getUsers() method.
        return $this->adapter->select("users");
    }

    /**
     * @param \Notes\Domain\ValueObject\Uuid $id
     * @param string $newUsername
     * @return bool
     */
    public function modifyById(Uuid $id, $newUsername)
    {
        // TODO: Implement modifyById() method.
        return $this->adapter->update("users", [$newUsername, $id->__toString()]);
    }

    /**
     * @param \Notes\Domain\ValueObject\Uuid $id
     * @return mixed
     */
    public function removeById(Uuid $id)
    {
        // TODO: Implement removeById() method.
        return $this->adapter->delete("users", [$id]);
    }
}