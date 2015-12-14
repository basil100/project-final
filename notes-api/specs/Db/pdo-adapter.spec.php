<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 11/24/15
 * Time: 6:08 PM
 */


use Notes\Db\Adapter\PdoAdapter;
use Notes\Domain\ValueObject\Uuid;
use Notes\Domain\Entity\User;

describe('Notes\Db\Adapter\PdoAdapter', function () {

    beforeEach(
        function () {
            $this->dsn = 'mysql:dbname=testdb;host=127.0.0.1';
            $this->username = 'root';
            $this->password = '123456';

            $this->pdo = new PdoAdapter($this->dsn, $this->username, $this->password);
        }
    );
    describe('->__construct()', function () {
        it('should return a PdoAdapter object', function () {
            $actual = $this->pdo; //new PdoAdapter($this->dsn, $this->username, $this->password);
            expect($actual)->to->be->instanceof('Notes\Db\Adapter\PdoAdapter');
        });
    });
    describe('->connect()', function () {
        it('should connect to the database', function () {
            $actual = $this->pdo->connect();
            expect($actual)->to->be->true;
        });
    });
    describe('->insert($table, $data = [])', function () {
        it('should insert new data to the database', function () {

            $user = new User(new Uuid());
            $user->setUsername("Basil");
            $actual = $this->pdo->insert("users",[$user->getId()->__toString(), $user->getUsername()]);
            /* for the notes table */
            //$actual = $this->pdo->insert("notes",['100', 'notes title testing', 'body of the notes',$user->getId()->__toString()]);
            expect($actual)->to->be->true;
        });
    });
    describe('->update($table, $data = [])', function () {
        it('should update existing data of the database', function () {
            $user = new User(new Uuid());
            $user->setUsername("Professor Don.");
            $newUserRecord = $this->pdo->insert("users",[$user->getId()->__toString(), $user->getUsername()]);

            $actual = $this->pdo->update("users", ["Dr. Don", $user->getId()->__toString()]);

            expect($actual)->to->be->true;
        });
    });
    describe('->delete($table, $criteria = [])', function () {
        it('should delete existing data of the database', function () {
            $user = new User(new Uuid());
            $user->setUsername("Bazil900");
            $newUserRecord = $this->pdo->insert("users",[$user->getId()->__toString(), $user->getUsername()]);

            $actual = $this->pdo->delete("users", [$user->getId()->__toString()]);

            expect($actual)->to->be->true;
        });
    });
    describe('->select($table, $criteria = [])', function () {
        it('should retrieve (select) data from the database', function () {
            $user = new User(new Uuid());
            $user->setUsername("Bazil Alrashed001");
            $newUserRecord = $this->pdo->insert("users",[$user->getId()->__toString(), $user->getUsername()]);

            $actual = $this->pdo->select("users", [$user->getId()->__toString()]);

            expect(count($actual))->equal(1);
        });
    });
    describe('->sql($sql, $data = [])', function () {
        it('should execute any sql command against the database', function () {
            $user = new User(new Uuid());
            $user->setUsername("Bazil---999");
            $newUserRecord = $this->pdo->insert("users",[$user->getId()->__toString(), $user->getUsername()]);

            $actual = $this->pdo->sql("UPDATE users SET username=? WHERE userID=?", ["Basil999", $user->getId()->__toString()]);
            expect($actual)->to->be->true;
        });
    });
    describe('->close()', function () {
        it('should close the connection of the database', function () {
            $actual = $this->pdo->close();
            expect($actual)->to->be->null;
        });
    });
});

