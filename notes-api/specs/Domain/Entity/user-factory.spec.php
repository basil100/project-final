<?php
/**
 * File name: user-factory.spec.php
 * Project: project-final_deliverable-1
 * PHP version 5
 * @category  PHP
 * @author    donbstringham <donbstringham@gmail.com>
 * @copyright 2015 © donbstringham
 * @license   http://opensource.org/licenses/MIT MIT
 * @version   GIT: <git_id>
 * @link      http://donbstringham.us
 * $LastChangedDate$
 * $LastChangedBy$
 */

use Notes\Domain\Entity\UserFactory;

describe('Notes\Domain\Entity\UserFactory', function () {
    describe('->__construct()', function () {
        it('should create a new UserFactory object', function () {
            $actual = new UserFactory();

            expect($actual)->to->be->instanceof('Notes\Domain\Entity\UserFactory');
        });
    });
    describe('->create()', function () {
        it('should create a new User object', function () {
            $factory = new UserFactory();
            $actual = $factory->create();

            expect($actual)->to->be->instanceof('Notes\Domain\Entity\User');
        });
    });
});
