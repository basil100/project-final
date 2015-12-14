<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 11/24/15
 * Time: 5:58 PM
 */

use Notes\Domain\Entity\UserFactory;
use Notes\Domain\ValueObject\StringLiteral;
use Notes\Persistence\Entity\MysqlUserRepository;



describe('Notes\Persistence\Entity\MysqlUserRepository', function () {
    beforeEach(function () {
        $this->dsn = 'mysql:dbname=testdb;host=127.0.0.1';
        $this->username = 'root';
        $this->password = '123456';

        //$this->pdo = new PdoAdapter($this->dsn, $this->username, $this->password);
        $this->repo = new MysqlUserRepository($this->dsn, $this->username, $this->password/*new \Notes\Db\Adapter\PdoAdapter($dsn, $username, $password)*/);
        $this->userFactory = new UserFactory();

    });
    describe('->__construct()', function () {
        it('should construct an MysqlUserRepository object', function () {
            expect($this->repo)->to->be->instanceof(
                'Notes\Persistence\Entity\MysqlUserRepository'
            );
        }) ;
    });
    describe('->add(User $user)', function () {
        it('should add 1 user to the repository', function () {
            $user = $this->userFactory->create();
            $user->setUsername("user100000");
            $newUser = $this->repo->add($user);
            expect(count($this->repo->getById($user->getId())))->to->equal(1);
        });
    });
    describe('->getById(Uuid $id)', function () {
        it('should return a single User object', function () {
            $user = $this->userFactory->create();
            $user->setUsername("user200");
            $newUser = $this->repo->add($user);
            expect(count($this->repo->getById($user->getId())))->to->be->equal(1);
        });
    });
    describe('->count()', function () {
        it('should return the number of users', function () {
            $numberOfUsers = count($this->repo->getUsers());
            expect($this->repo->count())->to->be->equal($numberOfUsers);
        });
    });
    describe('->getUsers()', function () {
        it('should return all the users', function () {
            $users = $this->repo->getUsers();
            expect(count($users))->to->be->equal($this->repo->count());
        });
    });
    describe('->modifyById(Uuid $id, $newUsername)', function () {
        it('should modify the username with a given Id', function () {
            $user = $this->userFactory->create();
            $user->setUsername("user300");
            $newUser = $this->repo->add($user);
            $updatedUser = $this->repo->modifyById($user->getId(), "user500");

            $selectUser = $this->repo->getById($user->getId());
            expect($selectUser[0]["username"])->to->equal("user500");
        });
    });
    describe('->removeById(Uuid $id)', function () {
        it('should remove a user with a given Id', function () {
            $user = $this->userFactory->create();
            $user->setUsername("user8800");
            $newUser = $this->repo->add($user);
            $removeUser = $this->repo->removeById($user->getId());
            expect($removeUser)->to->be->true;
        });
    });
            /*
//    public function getByUsername($username);
//    public function getUsers();
//    public function modify(User $user);
//    public function remove(User $user);
//    public function removeByUsername($username);*/
});
