<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 11/24/15
 * Time: 8:45 PM
 */

use Notes\Domain\Entity\Role\OwnerRole;
use Notes\Domain\Entity\User;
use Notes\Domain\ValueObject\StringLiteral;
use Notes\Domain\ValueObject\Uuid;

describe('Notes\Domain\Entity\Role\OwnerRole', function () {
    describe('->__construct()', function () {
        it('should return an OwnerRole object', function () {
            $actual = new OwnerRole();
            expect($actual)->to->be->instanceof('Notes\Domain\Entity\Role\OwnerRole');
        });
    });

    describe('->addUserInRole($userName)', function () {
        it('should add a user to the Owner Role', function () {
            $actual = new OwnerRole();
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
        it('should return the Owner Role\'s list of users', function () {
            $faker = \Faker\Factory::create();
            $user = new User(new Uuid());
            $user->setUsername(new StringLiteral($faker->userName));
            $users = array($user);
            $owner = new OwnerRole();
            $owner->addUserInRole($user);

            expect($owner->getRoleUsers())->equal($users);
        }) ;
    });

    describe('->getRoleName', function () {
        it('should get the correct Owner role\'s username', function () {

            $user = new User(new Uuid());
            $user->setUsername(new StringLiteral('Joe'));
            $owner = new OwnerRole();
            $owner->addUserInRole($user);
            $actual = $owner->getRoleName();

            expect($actual->__toString())->equal('Joe');

        });
    });

    describe('->removeRoleUser()', function () {
        it('should delete a user that is in the owner role', function () {

            $actual = new OwnerRole();
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
