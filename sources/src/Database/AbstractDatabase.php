<?php
/**
 * Created by PhpStorm.
 * User: bigf3
 * Date: 21.07.2016
 * Time: 15:42
 */

namespace HsBremen\WebApi\Database;


abstract class AbstractDatabase
{
    abstract protected function getDatabase();
    abstract protected function setDatabase($database);
    abstract protected function addComponent($newComponent);
    abstract protected function getComponent($componentId);
    abstract protected function updateComponent($param0, $param1, $param2, $param3, $param4, $param5 , $param6, $param7 );
    abstract protected function deleteComponent($componentId);
}