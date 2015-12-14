<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 11/24/15
 * Time: 1:34 PM
 */

namespace Notes\Domain\Entity\Role;
use Notes\Domain\Entity\User;


interface RoleInterface
{
    /**
     * @param \Notes\Domain\Entity\User $user
     * @return mixed
     */
    public function addUserInRole(User $user);

    /**
     * @return string
     */
    public function getRoleName();

    /**
     * @return array
     */
    public function getRoleUsers();

    public function removeRoleUser();

}