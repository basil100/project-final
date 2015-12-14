<?php
/**
 * File name: FactoryInterface.php
 * Project: project-final_deliverable-1
 * PHP version 5
 * @category  PHP
 * @package   Notes\Domain
 * @author    donbstringham <donbstringham@gmail.com>
 * @copyright 2015 © donbstringham
 * @license   http://opensource.org/licenses/MIT MIT
 * @version   GIT: <git_id>
 * @link      http://donbstringham.us
 * $LastChangedDate$
 * $LastChangedBy$
 */

namespace Notes\Domain;

/**
 * Interface FactoryInterface
 * @category  PHP
 * @package   Notes\Domain
 * @author    donbstringham <donbstringham@gmail.com>
 * @link      http://donbstringham.us
 */
interface FactoryInterface
{
    /**
     * @return mixed
     */
    public function create();
}
