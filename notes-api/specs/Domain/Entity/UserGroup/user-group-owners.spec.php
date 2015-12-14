<?php
/**
 * File name: user-group-owner.spec.php
 * Project: notes-api
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

use Notes\Domain\Entity\UserGroup\Owners;

use Notes\Domain\Entity\User;
use Notes\Domain\ValueObject\StringLiteral;
use Notes\Domain\ValueObject\Uuid;

describe('Notes\Domain\Entity\UserGroup\Owners', function () {
    describe('->__construct()', function () {
        it('should return an Owner object', function () {
            $actual = new Owners();
            expect($actual)->to->be->instanceof('\Notes\Domain\Entity\UserGroup\Owners');
        });
    });

    describe('->addUser($userName)', function () {
        it('should add a user to the Owners', function () {
            $actual = new Owners();
            $user = new User(new Uuid());
            $user->setUsername(new StringLiteral('Owner1'));
            $before = $actual->getUsers();
            $actual->addUser($user);
            $after = $actual->getUsers();

            expect(!in_array($user, $before));
            expect(in_array($user, $after));
        });
    });

    describe('->getUsers()', function () {
        it('should return the Owner\'s list of users', function () {
            $faker = \Faker\Factory::create();
            $user = new User(new Uuid());
            $user->setUsername(new StringLiteral($faker->userName));
            $users = array($user);
            $admin = new Owners();
            $admin->addUser($user);

            expect($admin->getUsers())->equal($users);
        }) ;
    });

    describe('->getName', function () {
        it('should get the correct the Owner\'s username', function () {
            $user = new User(new Uuid());
            $user->setUsername(new StringLiteral('Owner1'));
            $admin = new Owners();
            $admin->addUser($user);
            $actual = $admin->getName();

            expect($actual->__toString())->equal('Owner1');
        });
    });

    describe('->RemoveUser()', function () {
        it('should delete a user that the Owner is responsible for', function () {
            $actual = new Owners();
            $user = new User(new Uuid());
            $user->setUsername(new StringLiteral('Joe'));
            $before = $actual->getUsers();
            $actual->removeUser();
            $after = $actual->getUsers();

            expect(!in_array($user, $before));
            expect(in_array($user, $after));
        });
    });

});

