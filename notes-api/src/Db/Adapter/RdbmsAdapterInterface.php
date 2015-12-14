<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 11/24/15
 * Time: 6:13 PM
 */

namespace Notes\Db\Adapter;


interface RdbmsAdapterInterface extends DbAdapterInterface
{

    public function delete($table, $criteria);
    public function insert($table, $data);
    public function select($table, $criteria);
    public function sql($sql, $data);
    public function update($table, $data);

}