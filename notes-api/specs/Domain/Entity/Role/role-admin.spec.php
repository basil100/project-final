<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 11/24/15
 * Time: 4:16 PM
 */

use Notes\Domain\Entity\Role\AdminRole;
use Notes\Domain\Entity\User;
use Notes\Domain\ValueObject\StringLiteral;
use Notes\Domain\ValueObject\Uuid;

describe('Notes\Domain\Entity\Role\AdminRole', function () {
    describe('->__construct()', function () {
        it('should return an AdminRole object', function () {
            $actual = new AdminRole();
            expect($actual)->to->be->instanceof('Notes\Domain\Entity\Role\AdminRole');
        });
    });

    describe('->addUserInRole($userName)', function () {
        it('should add a user to the Admin Role', function () {
            $actual = new AdminRole();
            $user = new User(new Uuid());
            $user->setUsername(new StringLiteral('Joe'));
            $before = $actual->getRoleUsers();
            $actual->addUserInRole($user);
            $after = $actual->getRoleUsers();

            expect(!in_array($user, $before));
            expect(in_array($user, $after));
        });
    });

    describe('->getRoleUsers()', function () {
        it('should return the Admin Role\'s list of users', function () {
            $faker = \Faker\Factory::create();
            $user = new User(new Uuid());
            $user->setUsername(new StringLiteral($faker->userName));
            $users = array($user);
            $admin = new AdminRole();
            $admin->addUserInRole($user);

            expect($admin->getRoleUsers())->equal($users);
        }) ;
    });

    describe('->getRoleName', function () {
        it('should get the correct admin role\'s username', function () {

            $user = new User(new Uuid());
            $user->setUsername(new StringLiteral('Joe'));
            $admin = new AdminRole();
            $admin->addUserInRole($user);
            $actual = $admin->getRoleName();

            expect($actual->__toString())->equal('Joe');

        });
    });

    describe('->removeRoleUser()', function () {
        it('should delete a user that is in the admin role', function () {

            $actual = new AdminRole();
            $user = new User(new Uuid());
            $user->setUsername(new StringLiteral('Joe'));
            $before = $actual->getRoleUsers();
            $actual->removeRoleUser();
            $after = $actual->getRoleUsers();

            expect(!in_array($user, $before));
            expect(in_array($user, $after));
        });
    });

});
