<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 11/24/15
 * Time: 6:32 PM
 */

namespace Notes\Db\Adapter;



interface DbAdapterInterface
{
    public function connect();
    public function close();

}
