<?php
/**
 * File name: UserFactory.php
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

use Notes\Domain\FactoryInterface;
use Notes\Domain\ValueObject\Uuid;

/**
 * Class UserFactory
 * @category  PHP
 * @package   Notes\Domain\Entity
 * @author    donbstringham <donbstringham@gmail.com>
 * @link      http://donbstringham.us
 */
class UserFactory implements FactoryInterface
{
    /**
     * @return \Notes\Domain\Entity\User
     */
    public function create()
    {
        return new User(new Uuid());
    }
}
