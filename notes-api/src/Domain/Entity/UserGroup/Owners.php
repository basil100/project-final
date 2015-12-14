<?php
/**
 * File name: Owners.php
 * Project: project-final_deliverable-1
 * PHP version 5
 * @category  PHP
 * @package   Notes\Domain\Entity\UserGroup
 * @author    donbstringham <donbstringham@gmail.com>
 * @copyright 2015 © donbstringham
 * @license   http://opensource.org/licenses/MIT MIT
 * @version   GIT: <git_id>
 * @link      http://donbstringham.us
 * $LastChangedDate$
 * $LastChangedBy$
 */

namespace Notes\Domain\Entity\UserGroup;

use Notes\Domain\Entity\Role\OwnerRole;
use Notes\Domain\Entity\User;

/**
 * Class Owners
 * @category  PHP
 * @package   Notes\Domain\Entity\UserGroup
 * @author    donbstringham <donbstringham@gmail.com>
 * @link      http://donbstringham.us
 */
class Owners implements UserGroupInterface
{

    /** @var array */
    protected $owners;
    /** @var \Notes\Domain\ValueObject\Uuid */
    protected $id;
    /** @var \Notes\Domain\ValueObject\StringLiteral */
    protected $name;
    /** @var  \Notes\Domain\Entity\Role\OwnerRole */
    protected $role;

    /**
     * @param \Notes\Domain\Entity\User $user
     * @return mixed
     */
    public function addUser(User $user)
    {
        // TODO: Implement addUser() method
        if (!$user instanceof User) {
            throw new InvalidArgumentException(
                __METHOD__ . '(): $user has to be a User object'
            );
        }

        $this->role = new OwnerRole();

        $this->id = $user->getId();
        $this->name = $user->getUsername();
        $this->role->addUserInRole($user);
        $this->owners[] = $user;
    }

    /**
     * @return string
     */
    public function getName()
    {
        // TODO: Implement getName() method
        return $this->name;
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        // TODO: Implement getUsers() method
        return $this->owners;
    }

    public function removeUser()
    {
        // TODO: Implement removeUser() method
        unset($this->admins[$this->id]);
    }
}
