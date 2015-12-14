<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 11/24/15
 * Time: 1:34 PM
 */

namespace Notes\Domain\Entity\Role;

use Notes\Domain\Entity\User;

class OwnerRole implements RoleInterface
{
    /** @var array */
    protected $ownerRoles;
    /** @var \Notes\Domain\ValueObject\Uuid */
    protected $id;
    /** @var \Notes\Domain\ValueObject\StringLiteral */
    protected $name;


    /**
     * @param \Notes\Domain\Entity\User $user
     * @return mixed
     */
    public function addUserInRole(User $user)
    {
        // TODO: Implement addUserInRole() method.
        if (!$user instanceof User) {
            throw new InvalidArgumentException(
                __METHOD__ . '(): $user has to be a User object'
            );
        }

        $this->id = $user->getId();
        $this->name = $user->getUsername();
        $this->ownerRoles[] = $user;
    }

    /**
     * @return string
     */
    public function getRoleName()
    {
        // TODO: Implement getRoleName() method.
        return $this->name;
    }

    /**
     * @return array
     */
    public function getRoleUsers()
    {
        // TODO: Implement getRoleUsers() method.
        return $this->ownerRoles;
    }

    public function removeRoleUser()
    {
        // TODO: Implement removeRoleUser() method.
        unset($this->OwnerRoles[$this->id]);
    }
}