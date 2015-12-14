<?php
/**
 * File name: user-group-admin.spec.php
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

use Notes\Domain\Entity\UserGroup\Admins;
use Notes\Domain\Entity\User;
use Notes\Domain\ValueObject\StringLiteral;
use Notes\Domain\ValueObject\Uuid;

describe('Notes\Domain\Entity\UserGroup\Admins', function () {
    describe('->__construct()', function () {
        it('should return an Admin object', function () {
            $actual = new Admins();
            expect($actual)->to->be->instanceof('\Notes\Domain\Entity\UserGroup\Admins');
        });
    });

    describe('->addUser($userName)', function () {
        it('should add a user to the admin', function () {
            $actual = new Admins();
            $user = new User(new Uuid());
            $user->setUsername(new StringLiteral('Joe'));
            $before = $actual->getUsers();
            $actual->addUser($user);
            $after = $actual->getUsers();

            expect(!in_array($user, $before));
            expect(in_array($user, $after));
        });
    });

    describe('->getUsers()', function () {
        it('should return the admin\'s list of users he administrates to', function () {
            $faker = \Faker\Factory::create();
            $user = new User(new Uuid());
            $user->setUsername(new StringLiteral($faker->userName));
            $users = array($user);
            $admin = new Admins();
            $admin->addUser($user);

            expect($admin->getUsers())->equal($users);
        }) ;
    });

    describe('->getName', function () {
        it('should get the correct the admin\'s username', function () {

            $user = new User(new Uuid());
            $user->setUsername(new StringLiteral('Joe'));
            $admin = new Admins();
            $admin->addUser($user);
            $actual = $admin->getName();

            expect($actual->__toString())->equal('Joe');

        });
    });

    describe('->RemoveUser()', function () {
        it('should delete a user that the admin is responsible for', function () {

            $actual = new Admins();
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
