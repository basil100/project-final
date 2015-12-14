<?php
/**
 * File name: UserRespositoryInterface.php
 * Project: project-final_deliverable-1
 * PHP version 5
 * @category  PHP
 * @package   Notes\Domain\Entity
 * @author    donbstringham <donbstringham@gmail.com>
 * @copyright 2015 © donbstringham
 * @license   http://opensource.org/licenses/MIT MIT
 * @version   GIT: <git_id>
 * @link      http://donbstringham.us
 * $LastChangedDate$
 * $LastChangedBy$
 */

namespace Notes\Domain\Entity;

use Faker\Provider\Uuid;

interface UserRepositoryInterface
{
    /**
     * @param \Notes\Domain\Entity\User $user
     * @return mixed
     */
    public function add(User $user);

    /**
     * @return int
     */
    public function count();

    /**
     * @param \Notes\Domain\ValueObject\Uuid $id
     * @return mixed
     */
    public function getById(Uuid $id);

    /**
     * @return mixed
     */
    public function getUsers();

    /**
     * @param
     * @return bool
     */
    public function modifyById(Uuid $id, $newUsername);


    /**
     * @param \Notes\Domain\ValueObject\Uuid $id
     * @return mixed
     */
    public function removeById(Uuid $id);
}
