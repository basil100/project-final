<?php
/**
 * File name: in-memory-user-repository.spec.php
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
use Notes\Domain\ValueObject\StringLiteral;
use Notes\Persistence\Entity\InMemoryUserRepository;

describe('Notes\Persistence\Entity\InMemoryUserRepository', function () {
    beforeEach(function () {
        $this->repo = new InMemoryUserRepository();
        $this->userFactory = new UserFactory();
    });
    describe('->__construct()', function () {
        it('should construct an InMemoryUserRepository object', function () {
            expect($this->repo)->to->be->instanceof(
                'Notes\Persistence\Entity\InMemoryUserRepository'
            );
        }) ;
    });
    describe('->add()', function () {
        it('should add 1 user to the repository', function () {
            $this->repo->add($this->userFactory->create());

            expect($this->repo->count())->to->equal(1);
        });
    });
    describe('->count()', function () {
        it('should return the number of the users in the repository', function () {
            $this->repo->add($this->userFactory->create());
            $this->repo->add($this->userFactory->create());
            $this->repo->add($this->userFactory->create());

            expect($this->repo->count())->to->equal(3);
        });
    });
    describe('->getUsers()', function () {
        it('should return all the users from the repository', function () {
            $this->repo->add($this->userFactory->create());
            $this->repo->add($this->userFactory->create());
            $this->repo->add($this->userFactory->create());

            $users = $this->repo->getUsers();
            expect(count($users))->to->equal(3);
        });
    });
    describe('->getById(Uuid $id)', function () {
        it('should return a single user object with the given id from the repository', function () {

            $user1 = $this->userFactory->create();
            $user2 = $this->userFactory->create();
            $user3 = $this->userFactory->create();

            $user2->setUsername(new StringLiteral('Basil'));

            $this->repo->add($user1);
            $this->repo->add($user2);
            $this->repo->add($user3);

            $resultedUser = $this->repo->getById($user2->getId());

            $result = $resultedUser[0]->getId() === $user2->getId() && $resultedUser[0]->getUsername() === $user2->getUsername() ? true: false;

            expect($result)->to->equal(true);
        });
    });
    describe('->removeById(Uuid $id)', function () {
        it('should return true if the user with a given id was removed from the repository', function () {
            $user1 = $this->userFactory->create();
            $user2 = $this->userFactory->create();
            $user3 = $this->userFactory->create();

            $this->repo->add($user1);
            $this->repo->add($user2);
            $this->repo->add($user3);

            $result = $this->repo->removeById($user1->getId());
            expect($this->repo->count())->to->equal(2);
            expect($result)->to->be->equal(true);
        });
    });

    describe('->modifyById($id, $newUsername)', function () {
        it('should return a true if the username was modified', function () {
            /** @var \Notes\Domain\Entity\User $user */
            $user = $this->userFactory->create();
            $user->setUsername(new StringLiteral('harrie'));
            $this->repo->add($user);
            expect($this->repo->count())->to->be->equal(1);

            $userId = $user->getId();
            $newUsername = 'Basil'; //new StringLiteral('Basil');

            $result = $this->repo->modifyById($userId, $newUsername);

            expect($result)->to->be->equal(true);
            expect($user->getUsername())->to->be->equal('Basil');
        });
    });
});
